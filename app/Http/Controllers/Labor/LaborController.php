<?php

namespace App\Http\Controllers\Labor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laborentry;
use App\Models\User;
use App\Models\Ranch;
use App\Models\Block;
use App\Models\Acre;
use App\Models\Allocatelabor;
use App\Models\Jobdescription;
use App\Models\setuppage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\crewsetup;

class LaborController extends Controller
{
    public function index(){
        $crewboss = User::where('role', 10)->get();
        $crew = User::where('role', 5)->where('is_boss', '!=', 1)->get();
        $clientId = session('client_id');
        $clientuser = User::where('role', 4)->get();
        $ranch = Ranch::latest()->get();
        $block = Block::latest()->get();
        $acres = Acre::latest()->get();
        $job = Jobdescription::latest()->get();
        $timetable = DB::select('SELECT * FROM time_table');

        return view('labor_entry', compact(['crew', 'clientuser', 'crewboss', 'ranch', 'block', 'acres', 'job', 'timetable']));
    }

    public function LaborSetupstore(Request $request)
    {

        Laborentry::updateOrCreate(
            ['id' => $request->labor_id],
            [
                'client_id' => $request->client_id,
                'entry_date' => $request->entrydate,
                'crew_boss' => $request->crewboss,
                'of_people' => $request->ofpeople,
                'ranch_id' => $request->ranch,
                'block_id' => $request->blockid,
                'acre_id' => $request->acreid,
                'job_id' => $request->jobid,
                'amount' => $request->amount,
                'starttime' => $request->starttime,
                'endtime' => $request->endtime,
                'binspicked' => $request->binspicked,
                'treescompleted' => $request->treescompleted,
                'rowscompleted' => $request->rowscompleted,
                'status' => 1,
            ]
        );
        return redirect()->route('lobor.entry');
    }

    public function updateStatuslabor(Request $request, $id)
    {
        $laborentry = Laborentry::findOrFail($id);
        $laborentry->status = $request->status;
        $laborentry->save();
        
        $start = Carbon::parse($laborentry->starttime);
        $end = Carbon::parse($laborentry->endtime);
        $diffInMinutes = $start->diffInMinutes($end);
        

        $totalpeople = $laborentry->of_people;
        $crewsetup = Crewsetup::where('crewboss_id', $laborentry->crew_boss)->first();
        if (!$crewsetup) {
            return response()->json(['error' => 'Crew setup not found for the selected crew boss.']);
        }
        $breaktime = $crewsetup->break1 + $crewsetup->break2;
        $diffAfterMinutes = $diffInMinutes - $breaktime;
        $hours = round($diffAfterMinutes / 60, 2);
        
        if ($laborentry->of_people > 15) {
            $bossamount = 1 * $hours * $crewsetup->crewboss_wage_high; // Apply crewboss_age_high rate
        } else {
            $bossamount = 1 * $hours * $crewsetup->wage_rate; // Apply regular wage rate
        }

        // dd($crewsetup);
        // if ($crewsetup->graft_chainsaw) {
        //     $invoice = $totalpeople * $hours * $crewsetup->graft_chainsaw;
            
        // } else {
            $invoice = $totalpeople * $hours * $crewsetup->wage_rate;
        // }
        $percentfullAmount = $invoice + $bossamount;
    
        $fullamount = $percentfullAmount * $crewsetup->comission_rate;
      
        Allocatelabor::create([
            'client_id' => $laborentry->client_id,
            'date' => $laborentry->entry_date,
            'crew_boss' => $laborentry->crew_boss,
            'people' => $laborentry->of_people,
            'ranch_id' => $laborentry->ranch_id,
            'block_id' => $laborentry->block_id,
            'acre_id' => $laborentry->acre_id,
            'description' => $laborentry->job_id,
            'total_amount' => $fullamount,
            'time' => $hours,
            'status' => 1,
        ]);

        return response()->json(['success' => true]);
    }

    public function getlabor($id)
    {
        $user = Laborentry::findOrFail($id);
        return response()->json($user);
    }

    public function DeleteLabor($id)
    {
        Laborentry::find($id)->delete();
        return redirect()->route('lobor.entry');
    }

    public function greendatarow(){
        $clientId = session('client_id');
        $month = session('month');
        $year = session('year');

        if ($clientId || $month || $year) {
            $labor = Laborentry::with(['laboruser', 'clientuser', 'crewuser', 'ranchuser', 'blockuser', 'jobuser'])
            ->when($clientId, function ($query) use ($clientId) {
                return $query->where('client_id', $clientId);
            })
            ->when($year, function ($query) use ($year) {
                return $query->whereYear('date', $year);
            })
            ->when($month, function ($query) use ($month) {
                // Calculate date range based on duration
                $startDate = now(); // Current date
                switch ($month) {
                    case '1w':
                        $startDate = now()->subWeek(1);
                        break;
                    case '2w':
                        $startDate = now()->subWeeks(2);
                        break;
                    case '3w':
                        $startDate = now()->subWeeks(3);
                        break;
                    case '4w':
                        $startDate = now()->subWeeks(4);
                        break;
                    case '1m':
                        $startDate = now()->subMonth(1);
                        break;
                    case '3m':
                        $startDate = now()->subMonths(3);
                        break;
                    case '6m':
                        $startDate = now()->subMonths(6);
                        break;
                    case '12m':
                        $startDate = now()->subYear(1);
                        break;
                }
                return $query->where('date', '>=', $startDate);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($invoice) {
                $invoice->date = Carbon::parse($invoice->date)->format('M/d/Y'); // Format date
                return $invoice;
            });

        } else {
    
            $labor = Laborentry::with(['laboruser','clientuser', 'crewuser', 'ranchuser', 'blockuser', 'jobuser'])->orderBy('created_at', 'desc')->get();
            
        }
        return response()->json($labor);
    }

    public function getclientranch(Request $request){
        $clientId = $request->input('client_id');
        $clientData = setuppage::with('ranch')->where('name', $clientId)->get();

        return response()->json($clientData);
    }
}

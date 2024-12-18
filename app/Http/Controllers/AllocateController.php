<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allocatelabor;
use App\Models\User;
use App\Models\Ranch;
use App\Models\Block;
use App\Models\Acre;
use App\Models\Laborentry;
use Carbon\Carbon;
use App\Models\crewsetup;
use App\Models\crew_boss;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use App\Models\Jobdescription;
use App\Models\Expense;
use Illuminate\Support\Str;

class AllocateController extends Controller
{
    public function index(){
        $clientId = session('client_id');
        $month = session('month');
        $year = session('year');

        if($clientId || $month || $year){
            $labors = Allocatelabor::with(['crewuser', 'clientuser', 'jobuser', 'ranchuser', 'blockuser'])->where('status', 1)
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

        } else{
            $labors = Allocatelabor::with(['crewuser', 'clientuser', 'jobuser', 'ranchuser', 'blockuser'])
                ->where('status', 1) 
                ->whereNotNull('client_id') 
                ->where('client_id', '!=', '') 
                ->whereNotNull('crew_boss') 
                ->where('crew_boss', '!=', '')
                ->whereNotNull('ranch_id')
                ->where('ranch_id', '!=', '') 
                ->whereNotNull('block_id') 
                ->where('block_id', '!=', '')
                ->whereNotNull('description') 
                ->where('description', '!=', '')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($labor) {
                $labor->date = Carbon::parse($labor->date)->format('M/d/Y'); // Format date
                return $labor;
            });
        }
        $crewboss = User::where('role', 10)->get();
        $ranch = Ranch::latest()->get();
        $block = Block::latest()->get();
        $acres = Acre::latest()->get();
        $clientuser = User::where('role', 4)->get();
        $jobs = Jobdescription::latest()->get();


        return view('allocate_view', compact(['labors','jobs', 'clientuser', 'crewboss', 'ranch', 'block', 'acres']));
    }

    public function AddAllocate(Request $request){

        $crewtime = Laborentry::where('crew_boss', $request->crew_boss)->orderBy('created_at', 'desc')->first();

        if (!$crewtime) {
            return back()->with('error', 'No Laborentry found for the selected crew boss. Please add a Laborentry first.')->withInput();
        }

        // Calculate the time difference in minutes
        $start = Carbon::parse($crewtime->starttime);
        $end = Carbon::parse($crewtime->endtime);
        $diffInMinutes = $start->diffInMinutes($end);
        

        $totalpeople = $request->people - 1;
        $crewsetup = Crewsetup::where('crewboss_id', $request->crew_boss)->first();
        $breaktime = $crewsetup->break1 + $crewsetup->break1;
        $hours = floor(($diffInMinutes - $breaktime) / 60);
        
        if (!$crewsetup) {
            return back()->with('error', 'Crew setup not found for the selected crew boss.')->withInput();
        }
        if ($request->people > 15) {
            $bossamount = 1 * $hours * $crewsetup->crewboss_wage_high; // Apply crewboss_age_high rate
        } else {
            $bossamount = 1 * $hours * $crewsetup->wage_rate; // Apply regular wage rate
        }

        
        if ($crewsetup->graft_chainsaw) {
            $invoice = $totalpeople * $hours * $crewsetup->graft_chainsaw;
        } else {
            $invoice = $totalpeople * $hours * $crewsetup->wage_rate;
        }

        $percentageAmount = $invoice * ($crewsetup->comission_rate / 100);
        $fullamount = $invoice + $percentageAmount + $bossamount;

        // Create the Allocatelabor record
        $allocatelabor = Allocatelabor::create([
            'client_id' => $request->client_id,
            'date' => $request->date,
            'crew_boss' => $request->crew_boss,
            'people' => $request->people,
            'ranch_id' => $request->ranch,
            'block_id' => $request->block,
            'acre_id' => $request->acre,
            'description' => $request->description,
            'status' => 1,
        ]);

        $allocatelabor->update([
            'time' => $hours,
            'total_amount' => $fullamount,
            'boss_amount' => $bossamount,
        ]);


        
        return redirect()->route('labor.allocate');
    }

    public function updateStatusallocate(Request $request, $id)
    {
        $job = Allocatelabor::findOrFail($id);
        $job->status = $request->status;
        $job->save();

        return response()->json(['success' => true]);
    }

    public function updateLabor(Request $request)
    {
        $labor = Allocatelabor::find($request->input('id'));

        if (!$labor) {
            return response()->json([
                'error' => 'Labor not found.'
            ], 404);
        }
    
        $field = $request->input('field');
        $value = $request->input('value');
    
        // Update only the specific field
        $labor->update([
            $field => $value
        ]);
        
        $totalpeople = $labor->people - 1;
        $crewsetup = Crewsetup::where('crewboss_id', $labor->crew_boss)->first();
        $hours = $labor->time;
        if (!$crewsetup) {
            return back()->with('error', 'Crew setup not found for the selected crew boss.')->withInput();
        }
        if ($labor->people > 15) {
            $bossamount = 1 * $hours * $crewsetup->crewboss_wage_high; // Apply crewboss_age_high rate
        } else {
            $bossamount = 1 * $hours * $crewsetup->wage_rate; // Apply regular wage rate
        }

        
        if ($crewsetup->graft_chainsaw) {
            $invoice = $totalpeople * $hours * $crewsetup->graft_chainsaw;
        } else {
            $invoice = $totalpeople * $hours * $crewsetup->wage_rate;
        }

        $percentageAmount = $invoice * ($crewsetup->comission_rate / 100);
        $fullamount = $invoice + $percentageAmount + $bossamount;

        $labor->update([
            'total_amount' => $fullamount
        ]);

        return response()->json([
            'success' => true,
            'amount' => $fullamount,
            'message' => 'Labor field updated successfully!'
        ], 200);
    
    }
    

    public function getallcrew(Request $request){
        $crew = crew_boss::where('boss_id', $request->crewboss)->get();
        $crewIds = $crew->pluck('crew_id');
        $users = User::whereIn('id', $crewIds)->get();
        return response()->json(['data' => $users]);
    }

    private function generateInvoiceNumber()
    {
        $year = date('Y');

        $lastInvoice = Invoice::whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastInvoice) {
            $lastInvoiceNumber = intval(substr($lastInvoice->invoice, -4)); // Assuming last 4 characters are numeric
            $newInvoiceNumber = str_pad($lastInvoiceNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            // If no previous invoice exists, start with 0001
            $newInvoiceNumber = '0001';
        }

        // Return the complete invoice number with year prefix, e.g., "2024-0001"
        return "{$year}-{$newInvoiceNumber}";
    }


    public function Allocatedetails(Request $request)
    {
        $newtotal_amount = $request->total_amount;
        $selectedRows = $request->selectedRows;
        foreach ($request->id as $laborId) {
            $existingRecord = Allocatelabor::where('id', $laborId)->first();
            if ($existingRecord) {
                $jobRecord = Jobdescription::where('id', $existingRecord->description)->first();
                $jobName = strtolower(str_replace(' ', '_', $jobRecord->name));
                $expense = Expense::where('user_id', $existingRecord->client_id)
                    ->where('ranch_id', $existingRecord->ranch_id)
                    ->where('block_id', $existingRecord->block_id)
                    ->first();
        
                if (!$expense) {
                    $data = [
                        'user_id' => $existingRecord->client_id,
                        'ranch_id' => $existingRecord->ranch_id,
                        'block_id' => $existingRecord->block_id,
                    ];
        
                    $newExpense = Expense::create($data);
                    Expense::where('user_id', $existingRecord->client_id)
                                    ->where('ranch_id', $existingRecord->ranch_id)
                                    ->where('block_id', $existingRecord->block_id)
                                    ->update([$jobName => $existingRecord->total_amount]); 
                } else {
                    if (empty($expense->$jobName)) {
                        Expense::where('user_id', $existingRecord->client_id)
                                    ->where('ranch_id', $existingRecord->ranch_id)
                                    ->where('block_id', $existingRecord->block_id)
                                    ->update([$jobName => $existingRecord->total_amount]);
                    } else {
                        $data = [
                            'user_id' => $existingRecord->client_id,
                            'ranch_id' => $existingRecord->ranch_id,
                            'block_id' => $existingRecord->block_id,
                        ];
                        Expense::create($data);
                        Expense::where('user_id', $existingRecord->client_id)
                                    ->where('ranch_id', $existingRecord->ranch_id)
                                    ->where('block_id', $existingRecord->block_id)
                                    ->update([$jobName => $existingRecord->total_amount]);
                    } 
                }
                $existingRecord->update([
                        'status' => 0
                    ]);
            } else {
                return response()->json(['error' => 'No record found in Allocatelabor for ID: ' . $laborId]);
            }
        }
        
        foreach ($selectedRows as $selectedRow) {
            if (isset($selectedRow['clientName'])) {
                $clientId = User::where('role', 4)->where('name', $selectedRow['clientName'])->value('id');
                $clientranch = Ranch::where('title', $selectedRow['ranch'])->value('id');
                $clientblock = Block::where('title', $selectedRow['block'])->value('id');
        
                Invoice::create([
                    'date' => $request->invoiceDate,
                    'invoice' => $request->invoiceNumber,
                    'client_id' => $clientId,
                    'crew_boss' => '',
                    'people' => $selectedRow['people'],
                    'ranch_id' => $clientranch,
                    'block_id' => $clientblock,
                    'description' => $selectedRow['jobdescription'],
                    'total_amount' => $newtotal_amount,
                    'full_time' => $selectedRow['time'],
                    'crewboss_amount' => 0,
                    'invoice_category' => 1
                ]);
                return response()->json(['data' => true]);
            } else {
                return response()->json(['error' => 'Client name is missing in selectedRow.']);
            }
        }
        


        // $existingRecord = Allocatelabor::where('id', $request->id)->first();
        // $invoiceNumber = $this->generateInvoiceNumber();
        // if ($existingRecord) {
        //     if(!empty($total_amount)){
              
        //     } else{
        //         $laborEntry = Invoice::create([
        //                         'date' => $existingRecord->date,  
        //                         'invoice' => $invoiceNumber,
        //                         'client_id' => $existingRecord->client_id,
        //                         'crew_boss' => $existingRecord->crew_boss,
        //                         'people' => $existingRecord->people,
        //                         'ranch_id' => $existingRecord->ranch_id,
        //                         'block_id' => $existingRecord->block_id,
        //                         'description' => $existingRecord->description,
        //                         'total_amount' => $existingRecord->total_amount,
        //                         'full_time' => $existingRecord->time,
        //                         'crewboss_amount' => $existingRecord->boss_amount,
        //                         'invoice_category' => 1
                                
        //                     ]); 
        //                     $existingRecord->update([
        //                         'status' => 0
        //                     ]);        
        //         if ($laborEntry) {
        //             return response()->json(['data' => true]);

        //         } else {
        //             return response()->json(['data' => false]);

        //         }
        //     }
        // }
    }

    public function DeleteAllocate($id){
        Allocatelabor::find($id)->delete();
        return redirect()->route('labor.allocate');
    }

    
}

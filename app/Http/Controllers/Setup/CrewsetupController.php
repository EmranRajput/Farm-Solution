<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\crewsetup;
use App\Models\User;
use App\Models\Jobdescription;
use App\Models\crew_boss;

class CrewsetupController extends Controller
{
    public function CrewSetup(){
        $crewsetup = crewsetup::with(['users','jobs'])->latest()->get();
        return view('setup.crew_setuppage', compact('crewsetup'));
    }

    public function Addcrewsetupget(){
        $jobdescription = Jobdescription::latest()->get();
        $user = User::where('role',10)->get();
        $crewuser = User::where('role', 5)->where('is_boss', 0)->where('is_assigned', 0)->get();
        // dd($setup);
        return view('setup.add_crewsetup', compact('user','jobdescription', 'crewuser'));
    }

    public function CrewSetupstore(Request $request)
    {
        crewsetup::updateOrCreate(
            ['id' => $request->crewsetup_id],
            [
                'crewboss_id' => $request->crew_id,
                'labor_contructor' => $request->contructor,
                'job_id' => $request->job_id,
                'comission_rate' => $request->commission,
                'wage_rate' => $request->wagerate,
                'crewboss_wage_high' => $request->bosswagehigh,
                'crewboss_wage_low' => $request->bosswagelow,
                'graft_chainsaw' => $request->chainsaw,
                'lunch_break' => $request->lunch,
                'break1' => $request->break1,
                'break2' => $request->break2,
                'status' => 1,
            ]
        );
        return redirect()->route('crew.setup');
    }

    public function updateStatuscrew(Request $request, $id)
    {
        $crewsetup = crewsetup::findOrFail($id);
        $crewsetup->status = $request->status;
        $crewsetup->save();

        return response()->json(['success' => true]);
    }

    public function Editcrewsetup($id)
    {
        $editsetup = crewsetup::findOrFail($id);
        $jobs = jobdescription::latest()->get();
        $user = User::where('role',10)->get();
        return view('setup.edit_crewsetup', compact(['editsetup','jobs','user']));
    }

    public function Deletecrewsetup($id)
    {
        crewsetup::find($id)->delete();
        return redirect()->route('crew.setup');
    }

    public function Ofpeople($id){
        $user = User::where('id', $id)->first();
        return response()->json($user);

    }

    public function New_crew(Request $request){
        $crewsetup = User::where('id', $request->crewboss)->first();
        if ($crewsetup) {
            $crewsetup->update([
                'max_crew' => $request->selectcrew,
            ]);
        }
        return response()->json(['crewboss_wage_high' => $request->selectcrew]);
    }

    public function updatePeopleData(Request $request){
        $crewsetup = User::where('id', $request->crewboss)->first();
        if ($crewsetup) {
            $crewsetup->update([
                'min_crew' => $request->mincrew,
            ]);
        }
        return response()->json(['mincrew' => $request->mincrew]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobdescription;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;



class JobdescriptionController extends Controller
{
    public function JobdescriptionList(){
        $job = Jobdescription::latest()->get();
        $subcategories = Subcategory::where('category', 1)->get();
        return view('jobdescription_view', compact('job', 'subcategories'));
    }

    public function storejob(Request $request)
    {
        
        Jobdescription::updateOrCreate(
            ['id' => $request->job_id],
            [
                'subcategory' => $request->subcategory,
                'name' => $request->job_name,
                'status' => 1,
            ]
        );

       $columnName = $request->job_name;
        // Step 3: Check if the column already exists, then add it dynamically
        if (!Schema::hasColumn('expensesheet', $columnName)) {
            Schema::table('expensesheet', function (Blueprint $table) use ($columnName) {
                $table->string($columnName)->nullable();
            });
        }

        return redirect()->route('job.list');
    }

    public function updateStatusjob(Request $request, $id)
    {
        $job = Jobdescription::findOrFail($id);
        $job->status = $request->status;
        $job->save();

        return response()->json(['success' => true]);
    }

    public function getjob($id)
    {
        $job = Jobdescription::findOrFail($id);
        return response()->json($job);
    }

    public function DeleteJob($id)
    {
        $nonjob = Jobdescription::find($id);

        Jobdescription::find($id)->delete();

        if (!$nonjob) {
            return response()->json(['error' => 'Nonjob not found.']);
        }
        $columnName = $nonjob->name;

        if (Schema::hasColumn('expensesheet', $columnName)) {
            Schema::table('expensesheet', function (Blueprint $table) use ($columnName) {
                $table->dropColumn($columnName);
            });

            $nonjob->delete();
            
            return redirect()->route('job.list');
        } else {
            return response()->json(['error' => "Column '{$columnName}' does not exist."]);
        }

    }

}

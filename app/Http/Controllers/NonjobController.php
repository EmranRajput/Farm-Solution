<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nonjob;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class NonjobController extends Controller
{
    public function NonlaborJobList(){
        $job = Nonjob::latest()->get();
        $subcategories = Subcategory::where('category', 2)->get();
        return view('nonlaborjob_view', compact('job', 'subcategories'));
    }

    public function Nonstorejob(Request $request)
    {
        
        Nonjob::updateOrCreate(
            ['id' => $request->job_id],
            [
                'subcategory' => $request->subcategory,
                'name' => $request->job_name,
                'status' => 1,
            ]
        );

        $columnName = 'non_' . $request->job_name;
        // Step 3: Check if the column already exists, then add it dynamically
        if (!Schema::hasColumn('expensesheet', $columnName)) {
            Schema::table('expensesheet', function (Blueprint $table) use ($columnName) {
                $table->string($columnName)->nullable();
            });
    
            return redirect()->route('nonjob.list');
        } else {
            return response()->json(['error' => "Column 'non_{$columnName}' already exists."]);
        }

    }

    public function updateStatusjob(Request $request, $id)
    {
        $job = Nonjob::findOrFail($id);
        $job->status = $request->status;
        $job->save();

        return response()->json(['success' => true]);
    }

    public function getjob($id)
    {
        $job = Nonjob::findOrFail($id);
        return response()->json($job);
    }

    public function DeleteJob($id)
    {
       
        $nonjob = Nonjob::find($id);
        Nonjob::find($id)->delete();

        if (!$nonjob) {
            return response()->json(['error' => 'Nonjob not found.']);
        }
        $columnName = 'non_' . $nonjob->name;

        if (Schema::hasColumn('expensesheet', $columnName)) {
            Schema::table('expensesheet', function (Blueprint $table) use ($columnName) {
                $table->dropColumn($columnName);
            });
            $nonjob->delete();
            return redirect()->route('nonjob.list');

        } else {
            return response()->json(['error' => "Column '{$columnName}' does not exist."]);
        }

    }
}

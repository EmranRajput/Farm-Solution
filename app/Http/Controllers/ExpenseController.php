<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Ranch;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use App\Models\Nonjob;
use App\Models\Jobdescription;

class ExpenseController extends Controller
{
    public function index(Request $request){
        $clientId = session('client_id');
        $columns = Schema::getColumnListing('expensesheet'); 
        $exclude = ['user_id', 'id', 'total_amount', 'acre_amount', 'created_at', 'updated_at'];
        $columnsname = array_diff($columns, $exclude);

        $subcategories = Nonjob::all(); 
        $jobDescriptions = Jobdescription::all(); 
    
        // Create the structure you want for Labor and Non Labor
        $columnGroups = [
            'Labor' => [
                'Pruning' => $jobDescriptions->where('subcategory', 'Pruning')->pluck('name')->toArray(),
                'Thinning' => $jobDescriptions->where('subcategory', 'Thinning')->pluck('name')->toArray(),
                'Picking' => $jobDescriptions->where('subcategory', 'Picking')->pluck('name')->toArray(),
                'Development' => $jobDescriptions->where('subcategory', 'Development')->pluck('name')->toArray(),
                'Training' => $jobDescriptions->where('subcategory', 'Training')->pluck('name')->toArray(),
                'Hail net' => $jobDescriptions->where('subcategory', 'Hail net')->pluck('name')->toArray(),
                'Upkeep' => $jobDescriptions->where('subcategory', 'Upkeep')->pluck('name')->toArray(),
                'Unique Expenses' => $jobDescriptions->where('subcategory', 'Unique Expenses')->pluck('name')->toArray(),
            ],
            'Non Labor' => [
                'Other Farm Expenses' => $subcategories->where('subcategory', 'Other Farm Expenses')->pluck('name')->toArray(),
                'All Acre Expenses' => $subcategories->where('subcategory', 'All Acre Expenses')->pluck('name')->toArray(),
                'Other Development' => $subcategories->where('subcategory', 'Other Development')->pluck('name')->toArray(),
                'Over-head' => $subcategories->where('subcategory', 'Over-head')->pluck('name')->toArray(),
                'Inventory' => $subcategories->where('subcategory', 'Inventory')->pluck('name')->toArray(),
            ]
        ];

        if($clientId){
            $expense = Expense::with(['ranch', 'block', 'acres'])->where('user_id', $clientId)->get();
            $clientName = User::where('id', $clientId)->pluck('name')->first();
        } else{
            $expense = Expense::with(['ranch', 'block', 'acres'])->get();
            $clientName = '';
        }
        // $ranches = Ranch::with('blocks.acres')->get();
        // foreach ($ranches as $ranch) {
        //     foreach ($ranch->blocks as $block) {
        //         foreach ($block->acres as $acre) {
        //             // Insert a new expense for each Acre
        //             Expense::create([
        //                 'ranch_id' => $ranch->id,
        //                 'block_id' => $block->id,
        //                 'acre_id' => $acre->id,
        //             ]);
        //         }
        //     }
        // }
        // dd($columnGroups);
        return view('expense_entry', compact('expense', 'clientName', 'columnsname', 'columnGroups'));
    }


    public function updateCell(Request $request)
    {
        $rowId = $request->input('row_id');
        $columnName = $request->input('column_name');
        $value = $request->input('value');

        Expense::where('id', $rowId)->update([$columnName => $value]);

        return response()->json(['success' => true]);
    }

}

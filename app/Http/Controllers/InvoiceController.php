<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Ranch;
use App\Models\Block;
use App\Models\Acre;
use App\Models\Jobdescription;
use Carbon\Carbon;
use App\Models\Expense;
use App\Models\database;
use App\Models\Nonjob;
use Illuminate\Support\Facades\Schema;


class InvoiceController extends Controller
{
    public function Index(Request $request)
    {
        $clientId = session('client_id');
        $month = session('month');
        $year = session('year');

        $invoice = Invoice::with(['crewuser', 'clientuser', 'ranchuser', 'blockuser'])
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
    ->whereNotNull('client_id')
    ->where('client_id', '!=', '')
    ->whereNotNull('ranch_id') 
    ->where('ranch_id', '!=', '') 
    ->whereNotNull('block_id')
    ->where('block_id', '!=', '') 
    ->whereNotNull('description') 
    ->where('description', '!=', '')
    ->where('invoice_category', 0)
    ->orderBy('created_at', 'desc')
    ->get()
    ->map(function ($invoice) {
        $invoice->date = Carbon::parse($invoice->date)->format('M/d/Y'); // Format date
        return $invoice;
    });

        $crewboss = User::where('is_boss', 1)->get();
        $ranch = Ranch::latest()->get();
        $block = Block::latest()->get();
        $acres = Acre::latest()->get();
        $jobs = Nonjob::latest()->get();
        $clientuser = User::where('role', 4)->get();

        return view('invoice_view', compact('invoice', 'clientuser', 'crewboss', 'jobs', 'ranch', 'block', 'acres'));
    }


    public function Getinvoice(Request $request)
    {
        $laboratoryDetail = Invoice::where('id', $request->id)->with('crewuser')->first();        
        $crewDetail = DB::table('allocate_details')
        ->leftJoin('users', 'allocate_details.crewboss_id', '=', 'users.id') 
        ->where('allocate_details.allocate_id', $request->id)->select('allocate_details.*','users.name')->get();
       
        return view('pdftemplate.labor_report', compact('laboratoryDetail', 'crewDetail'));

    }

    public function AddAllocate(Request $request){
        if($request->ranch == 'all'){

            $getAllRanch = Ranch::with('blocks.acres')->latest()->get();

            // Count total ranches
            $ranchCount = $getAllRanch->count();

            if ($ranchCount > 0) {
                // Calculate payment per ranch
                $ranchPayment = $request->amount / $ranchCount;

                foreach ($getAllRanch as $ranch) {
                    $blockCount = $ranch->blocks->count();

                    if ($blockCount > 0) {
                        $blockPayment = $ranchPayment / $blockCount;

                        foreach ($ranch->blocks as $block) {
                            $acreCount = $block->acres->count();

                            if ($acreCount > 0) {
                                $acrePayment = $blockPayment / $acreCount;

                                foreach ($block->acres as $acre) {
                                    // Create invoice for each acre
                                    Invoice::create([
                                        'client_id' => $request->client_id,
                                        'date' => $request->date,
                                        'invoice' => $request->invoice,
                                        'company' => $request->company,
                                        'total_amount' => $acrePayment,
                                        'ranch_id' => $ranch->id,
                                        'block_id' => $block->id,
                                        'acre_id' => $acre->id,
                                        'description' => $request->description,
                                        'jobdescription' => $request->jobdescription,
                                        'invoice_category' => $request->payment,
                                        'status' => 1,
                                    ]);

                                    if($request->payment == 1){
                                        database::create([
                                            'client_id' => $request->client_id,
                                            'date' => $request->date,
                                            'crew_boss' => '',
                                            'invoice_category' => $request->payment,
                                            'invoice' => $request->invoice,
                                            'company' => $request->company,
                                            'people' => 0,
                                            'ranch_id' => $ranch->id,
                                            'block_id' => $block->id,
                                            'acre_id' => $acre->id,
                                            'description' => $request->description,
                                            'total_amount' => $acrePayment,
                                            'full_time' => '',
                                            'comission' => 0,
                                            'crewboss_amount' => 0,
                                            'tab_type' => 0,
                                        ]);
                            
                                        $job = Nonjob::find($request->description);
                                        $jobname = $job ? $job->name : null;

                                        if ($jobname) {
                                            $columnName = strtolower('non_' . $jobname);
                                            
                                            if (Schema::hasColumn('expensesheet', $columnName)) {
                                                $currentValue = Expense::where('user_id', $request->client_id)
                                                    ->where('ranch_id', $ranch->id)
                                                    ->where('block_id', $block->id)
                                                    ->value($columnName); 
                                                $newValue = ($currentValue ?? 0) + $acrePayment;
                                                Expense::where('user_id', $request->client_id)
                                                    ->where('ranch_id', $ranch->id)
                                                    ->where('block_id', $block->id)
                                                    ->update([$columnName => $newValue]);
                                            } else {
                                                throw new Exception("Column '$columnName' does not exist in the 'expenses' table.");
                                            }
                                        }  
                            
                                    }
                                }
                            } else {
                                echo "---- No acres found in this block.<br>";
                            }
                        }
                    } else {
                        echo "-- No blocks found in this ranch.<br>";
                    }
                }
            } else {
                echo "No ranches found.<br>";
            }


        } else if($request->block == 'all'){
            $getAllBlock = Block::latest()->get();
            $blockCount = $getAllBlock->count();

            if ($blockCount > 0) {
                // Calculate the total acres across all blocks
                $totalAcreCount = 0;
                foreach ($getAllBlock as $block) {
                    $totalAcreCount += Acre::where('block_id', $block->id)->count();
                }

                // Calculate the total payment per acre
                $paymentPerAcre = $request->amount / $totalAcreCount;

                foreach ($getAllBlock as $block) {
                    // Get all acres associated with the current block
                    $getAllacre = Acre::where('block_id', $block->id)->get();
                    $acreCount = $getAllacre->count();

                    if ($acreCount > 0) {
                        // Calculate the total block payment based on its proportion of total acres
                        $blockPayment = $paymentPerAcre * $acreCount;

                        // Calculate the payment per acre in the block
                        $acrePayment = $blockPayment / $acreCount;

                        foreach ($getAllacre as $acre) {
                            // Create invoice for each acre
                            Invoice::create([
                                'client_id' => $request->client_id,
                                'date' => $request->date,
                                'invoice' => $request->invoice,
                                'company' => $request->company,
                                'total_amount' => $acrePayment,
                                'ranch_id' => $ranch->id,
                                'block_id' => $block->id,  // Correct block_id assignment
                                'acre_id' => $acre->id,
                                'description' => $request->description,
                                'jobdescription' => $request->jobdescription,
                                'invoice_category' => $request->payment,
                                'status' => 1,
                            ]);

                            if ($request->payment == 1) {
                                // Assuming you want to store some data into another table
                                database::create([
                                    'client_id' => $request->client_id,
                                    'date' => $request->date,
                                    'crew_boss' => '',
                                    'invoice_category' => $request->payment,
                                    'invoice' => $request->invoice,
                                    'company' => $request->company,
                                    'people' => 0,
                                    'ranch_id' => $ranch->id,
                                    'block_id' => $block->id,  // Correct block_id assignment
                                    'acre_id' => $acre->id,
                                    'description' => $request->description,
                                    'total_amount' => $acrePayment,
                                    'full_time' => '',
                                    'comission' => 0,
                                    'crewboss_amount' => 0,
                                    'tab_type' => 0,
                                ]);

                                // Find the job name from the description (assuming it's a Nonjob)
                                $job = Nonjob::find($request->description);
                                $jobname = $job ? $job->name : null;

                                if ($jobname) {
                                    $columnName = strtolower('non_' . $jobname);

                                    if (Schema::hasColumn('expensesheet', $columnName)) {
                                        $currentValue = Expense::where('user_id', $request->client_id)
                                            ->where('ranch_id', $ranch->id)
                                            ->where('block_id', $block->id)
                                            ->value($columnName); 
                                        $newValue = ($currentValue ?? 0) + $acrePayment;
                                        Expense::where('user_id', $request->client_id)
                                            ->where('ranch_id', $ranch->id)
                                            ->where('block_id', $block->id)
                                            ->update([$columnName => $newValue]);
                                    } else {
                                        throw new Exception("Column '$columnName' does not exist in the 'expenses' table.");
                                    }
                                }
                            }
                        }
                    } else {
                        echo "-- No acres found in this block.<br>";
                    }
                }
            } else {
                echo "-- No blocks found.<br>";
            }

                    

        }  else {
            Invoice::create([
                'client_id' => $request->client_id,
                'date' => $request->date,
                'invoice' => $request->invoice,
                'company' => $request->company,
                'total_amount' => $request->amount,
                // 'people' => $request->people,
                // 'people' => $request->people,
                'ranch_id' => $request->ranch,
                'block_id' => $request->block,
                'acre_id' => $request->acre,
                'description' => $request->description,
                'jobdescription' => $request->jobdescription,
                'invoice_category' => $request->payment,
                'status' => 1,
            ]);
    
            if($request->payment == 1){
                database::create([
                    'client_id' => $request->client_id,
                    'date' => $request->date,
                    'crew_boss' => '',
                    'invoice_category' => $request->payment,
                    'invoice' => $request->invoice,
                    'company' => $request->company,
                    'people' => 0,
                    'ranch_id' => $request->ranch,
                    'block_id' => $request->block,
                    'acre_id' => $request->acre,
                    'description' => $request->description,
                    'total_amount' => $request->amount,
                    'full_time' => '',
                    'comission' => 0,
                    'crewboss_amount' => 0,
                    'tab_type' => 0,
                ]);
    
                $job = Nonjob::find($request->description);
    
                $jobname = $job ? $job->name : null;
    
                if ($jobname) {
                    $columnName = strtolower('non_' . $jobname);
                    
                    if (Schema::hasColumn('expensesheet', $columnName)) {
                        $currentValue = Expense::where('user_id', $request->client_id)
                            ->where('ranch_id', $request->ranch)
                            ->where('block_id', $request->block)
                            ->value($columnName); 
                        $newValue = ($currentValue ?? 0) + $request->amount;
                        Expense::where('user_id', $request->client_id)
                            ->where('ranch_id', $request->ranch)
                            ->where('block_id', $request->block)
                            ->update([$columnName => $newValue]);
                    } else {
                        throw new Exception("Column '$columnName' does not exist in the 'expenses' table.");
                    }
                }  
    
            }
        }

        return redirect()->route('invoice.entry');
    }


    public function invoicestatus(Request $request)
{
    $laborId = $request->input('labor_id');
    $status = $request->input('status'); 
    $labor = Invoice::find($laborId);
    if ($labor) {
        $labor->invoice_category = $status;
        $labor->save();
        if($status == 1){
            $job = Jobdescription::find($labor->description);
            if($job){
                $jobName = strtolower(str_replace(' ', '_', $job->name));
            
                Expense::where('user_id', $labor->client_id)
                ->where('ranch_id', $labor->ranch_id)
                ->where('acre_id', $labor->acre_id)
                ->update([$jobName => $labor->total_amount]);        
            }

            database::create([
                'client_id' => $labor->client_id,
                'date' => $labor->date,
                'crew_boss' => $labor->crew_boss,
                'invoice_category' => $labor->invoice_category,
                'invoice' => $labor->invoice,
                'company' => $labor->company,
                'people' => $labor->people,
                'ranch_id' => $labor->ranch_id,
                'block_id' => $labor->block_id,
                'acre_id' => $labor->acre_id,
                'description' => $labor->description,
                'total_amount' => $labor->total_amount,
                'full_time' => $labor->full_time,
                'comission' => $labor->comission,
                'crewboss_amount' => $labor->crewboss_amount
            ]);

            Invoice::find($laborId)->delete();
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        } 
        // else{
        //     $job = Jobdescription::find($labor->description);
        //     if($job){
        //         $jobName = strtolower(str_replace(' ', '_', $job->name));

        //         Expense::where('user_id', $labor->client_id)
        //         ->where('ranch_id', $labor->ranch_id)
        //         ->where('acre_id', $labor->acre_id)
        //         ->update([$jobName => '0']);        
        //     }
        // }
    }

    return response()->json(['success' => false, 'message' => 'Labor not found']);
}


    public function getinvoicestatus(Request $request) {
        $crewBossId = $request->input('client_id'); // Get the crew_boss ID from the request

        // Find all invoices where the crew_boss matches and invoice_category is 0
        $invoices = Invoice::where('crew_boss', $crewBossId)
                            ->where('invoice_category', 0)
                            ->whereIn('description', [61, 60, 59])
                            ->get();

        $hasCrewBoss = Invoice::where('crew_boss', $crewBossId)->exists();

        if (!$hasCrewBoss) {
            return response()->json([
                'success' => false, 
                'message' => 'No invoices found for this crew boss',
                'invoices' => []
            ]);
        }

        if ($invoices->isEmpty()) {
            return response()->json([
                'success' => false, 
                'message' => 'No invoices found for this crew boss',
                'invoices' => []
            ]);
        }

        $invoiceData = $invoices->map(function ($invoice) {
            return [
                'invoice' => $invoice->invoice,
                'description' => $invoice->description,
                'invoice_category' => $invoice->invoice_category,
                'total_amount' => $invoice->total_amount
            ];
        });

        // Return the list of invoices with invoice_category and total_amount
        return response()->json([
            'success' => true,
            'message' => 'Invoices found',
            'invoices' => $invoiceData
        ]);
    }


    public function DeleteInvoice($id){
        Invoice::find($id)->delete();
        return redirect()->route('invoice.entry');
    }

    public function updateInvoice(Request $request)
    {
        $labor = Invoice::find($request->input('id'));

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
    
        return response()->json([
            'success' => true,
            'message' => 'Labor field updated successfully!'
        ], 200);
    
    }


}

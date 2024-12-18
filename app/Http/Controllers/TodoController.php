<?php

namespace App\Http\Controllers;
use App\Models\Allocatelabor;
use App\Models\User;
use App\Models\Ranch;
use App\Models\Block;
use App\Models\Laborentry;
use Carbon\Carbon;
use App\Models\crewsetup;
use App\Models\crew_boss;
use App\Models\Invoice;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        $laborss = Allocatelabor::with(['crewuser', 'clientuser', 'ranchuser', 'blockuser', 'jobuser'])->where('status', 0)->orderBy('created_at', 'desc')->get();
        $crewboss = User::where('is_boss', 1)->get();
        $ranch = Ranch::latest()->get();
        $block = Block::latest()->get();
        $ranch = Ranch::latest()->get();
        $invoices = Invoice::with(['jobuser'])->where('status', 0)->get();

        $laborss->each(function ($labor) {
            if ($labor->jobuser) {
                $labor->job_description_name = $labor->jobuser->name;
            } else {
                $labor->job_description_name = 'No Description';
            }
        });

        $invoices->each(function ($labor) {
            if ($labor->jobuser) {
                $labor->job_description_name = $labor->jobuser->name;
            } else {
                $labor->job_description_name = 'No Description';
            }
        });

        $labors = $laborss->concat($invoices);

        return view('todo_view', compact(['labors', 'crewboss', 'ranch', 'block']));
    }
}

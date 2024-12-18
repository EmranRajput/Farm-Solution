<?php

namespace App\Http\Controllers;
use App\Models\database;
use App\Models\Ranch;
use App\Models\Block;

use Illuminate\Http\Request;

class DatabaseControlller extends Controller
{
    public function Index(Request $request)
    {
        // Initialize the query
        $databases = Database::with(['ranchuser', 'blockuser', 'jobuser']);
        if ($request->has('name') && $request->input('name') != '') {
            $databases->where('company', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('ranch') && $request->input('ranch') != '') {
            $databases->where('ranch_id', $request->input('ranch'));
        }

        if ($request->has('block') && $request->input('block') != '') {
            $databases->where('block_id', $request->input('block'));
        }

        $databases = $databases->orderBy('created_at', 'desc')->get();

        $ranchs = Ranch::latest()->get();
        $blocks = Block::latest()->get();

        // Return the view with databases, ranchs, and blocks
        return view('database_view_list', compact('databases', 'ranchs', 'blocks'));
    }

    public function Deletedatabase($id)
    {
        Jobdescription::find($id)->delete();
        return redirect()->route('data.base');

    }


}

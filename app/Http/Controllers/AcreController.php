<?php

namespace App\Http\Controllers;

use App\Models\Acre;
use App\Models\Block;
use App\Models\Ranch;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Expense;

class AcreController extends Controller
{
    public function AcreList(){
        $acres = Acre::with(['ranch'])->orderBy('id', 'DESC')->get();
        
        return view('acre.acre_list', compact('acres'));
    }

    public function AddAcre(){
        $ranch = Ranch::latest()->get();
        $block = Block::latest()->get();
        $clientuser = User::where('role', 4)->get();
        return view('acre.add_acre', compact('ranch','block', 'clientuser'));
    }

    public function GetBlock($ranch_id){
        $block = Block::where('ranch_id', $ranch_id)->orderby('title', 'ASC')->get();
        return json_encode($block);
    }

    public function StoreAcre(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'ranch_id' => 'required|integer|exists:ranches,id', // Ensure ranch_id exists in the `ranches` table
            'block_id' => 'required|integer|exists:blocks,id',  // Ensure block_id exists in the `blocks` table
            'description' => 'nullable|string',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        $acre = Acre::create([
            'client_id' => $request->client_id,
            'title' => $request->title,
            'ranch_id' => $request->ranch_id,
            'block_id' => $request->block_id,
            'description' => $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);
        
        Expense::create([
            'user_id' => $request->client_id,
            'block_id' => $request->block_id,
            'ranch_id' => $request->ranch_id,
            'acre_id' => $request->title
        ]);


        return redirect()->route('acre.list');
    }

    public function EditAcre($id){
        $acre = Acre::find($id);
        $ranch = Ranch::latest()->get();
        $block = Block::latest()->get();
        $clientuser = User::where('role', 4)->get();
        return view('acre.edit_acre', compact('acre','ranch','block', 'clientuser'));
     }

    public function UpdateAcre(Request $request){
        $acre_id = $request->acre_id;
        $acre = Acre::find($acre_id);

        Acre::find($acre_id)->update([
        'client_id' => $request->client_id,
        'title' => $request->title,
        'ranch_id' =>$request->ranch_id,
        'block_id' =>$request->block_id,
        'description' => $request->description,
        'lat' => $request->lat,
        'lng' => $request->lng
        ]);

        $expense = Expense::where('user_id', $acre->client_id)
            ->where('block_id', $acre->block_id)
            ->where('ranch_id', $acre->ranch_id)
            ->where('acre_id', $acre->title)
            ->first();

        if ($expense) {
            $expense->update([
                'user_id' => $request->client_id,
                'block_id' => $request->block_id,
                'ranch_id' => $request->ranch_id,
                'acre_id' => $request->title,
            ]);
        }

        return redirect()->route('acre.list');
    }

    public function DeleteAcre($id){

        $acre = Acre::find($id);

        Acre::find($id)->delete();

        $expense = Expense::where('user_id', $acre->client_id)
            ->where('block_id', $acre->block_id)
            ->where('ranch_id', $acre->ranch_id)
            ->where('acre_id', $acre->title)
            ->first();
        if ($expense) {
            $expense->delete();
            return redirect()->back();
        } else {
            return response()->json(['error' => 'Expense not found'], 404);
        }
    }

    public function acreupdateStatus(Request $request,$id)
     
     {
         $role = Acre::findOrFail($id);
         $role->status = $request->status;
         $role->save();
 
         return response()->json(['success' => true]);
     }

}

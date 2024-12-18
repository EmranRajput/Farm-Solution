<?php

namespace App\Http\Controllers;
use Toastr;
use App\Models\Ranch;
use Illuminate\Http\Request;

class RanchController extends Controller
{
    public function RanchList(){
        $ranches = Ranch::orderBy('id', 'DESC')->get();
        return view('ranch.ranch_list', compact('ranches'));
    }

    public function AddRanch(){
        return view('ranch.add_ranch');
    }
    public function StoreRanch(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        Ranch::insert([
            'title' => $request->title,
            'description' => $request->description,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);
        return redirect()->route('ranch.list');
    }

    public function EditRanch(Request $request, $id){
        $ranch = Ranch::find($id);
        return view('ranch.edit_ranch', compact('ranch'));
     }

     public function UpdateRanch(Request $request){
        $id = $request->ranch_id;
        Ranch::find($id)->update([
        'id' => $id,
        'title' => $request->title,
        'description' => $request->description,
        ]);
        return redirect()->route('ranch.list');
     }
     public function DeleteRanch($id){
        Ranch::find($id)->delete();
        return redirect()->back();
     }


     public function ranchupdateStatus(Request $request, $id)
    {
        $role = Ranch::findOrFail($id);
        $role->status = $request->status;
        $role->save();

        return response()->json(['success' => true]);
    }
}

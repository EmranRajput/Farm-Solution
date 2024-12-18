<?php

namespace App\Http\Controllers;
use Yoeunes\Toastr\Toastr;
use App\Models\Block;
use App\Models\Ranch;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function BlockList(){
        $blocks = Block::orderBy('id', 'DESC')->get();
        return view('block.block_list', compact('blocks'));
    }

    public function AddBlock(){
        $ranch = Ranch::latest()->get();
        return view('block.add_block', compact('ranch'));
    }
    public function StoreBlock(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'ranch_id' => 'required|integer|exists:ranches,id', // Ensures ranch_id is valid
            'description' => 'nullable|string',
            'size' => 'required|numeric|min:1', // Ensures size is a number and greater than 0
            'lat' => 'required|numeric|between:-90,90',
            'lng' => 'required|numeric|between:-180,180',
        ]);

        Block::insert([
            'title' => $request->title,
            'ranch_id' =>$request->ranch_id,
            'description' => $request->description,
            'size' => $request->size,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);
        return redirect()->route('block.list');
    }

    public function EditBlock($id){
        $ranch = Ranch::latest()->get();
        $block = Block::find($id);
        return view('block.edit_block', compact('ranch','block'));
     }

     public function UpdateBlock(Request $request){
        $id = $request->block_id;
        Block::find($id)->update([
        'ranch_id' => $request->ranch_id,
        'title' => $request->title,
        'description' => $request->description,
        'size' => $request->size,
        'lat' => $request->lat,
        'lng' => $request->lng
        ]);
        return redirect()->route('block.list');
     }

     public function DeleteBlock($id){
        Block::find($id)->delete();
        return redirect()->back();
     }

     public function blockupdateStatus(Request $request,$id)
     
     {
         $role = Block::findOrFail($id);
         $role->status = $request->status;
         $role->save();
 
         return response()->json(['success' => true]);
     }
}

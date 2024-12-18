<?php

namespace App\Http\Controllers;
use App\Models\Subcategory;

use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(){
        $job = Subcategory::latest()->get();
        return view('subcategorylabor_view', compact('job'));
    }

    public function Add_subcategory(Request $request)
    {
        
        Subcategory::updateOrCreate(
            ['id' => $request->id],
            [
                'category' => $request->category,
                'subcategory' => $request->subcategory,
                'status' => 1,
            ]
        );
        return redirect()->route('jobsubcategory');
    }

    public function updateStatus_subcategory(Request $request, $id)
    {
        $job = Subcategory::findOrFail($id);
        $job->status = $request->status;
        $job->save();

        return response()->json(['success' => true]);
    }

    public function Get_subcategory($id)
    {
        $job = Subcategory::findOrFail($id);
        return response()->json($job);
    }

    public function Deletesubcategory($id)
    {
        Subcategory::find($id)->delete();
        return redirect()->route('jobsubcategory');
    }
}

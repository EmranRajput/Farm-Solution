<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\setuppage;
use App\Models\Block;
use App\Models\Ranch;
use App\Models\User;

class SetupController extends Controller
{
    public function SetupList(){
        $setup = setuppage::with(['block', 'ranch', 'username'])->latest()->get();
        //$setuppage = setuppage::with('block')->get();

        return view('setup.setup_page', compact('setup'));
    }

    public function Addsetup(){
        $block = Block::latest()->get();
        $ranch = Ranch::latest()->get();
        $user = User::where('role',4)->get();
        // dd($setup);
        return view('setup.add_labor', compact('block','ranch','user'));
    }

    public function Setupstore(Request $request)
    {
        setuppage::updateOrCreate(
            ['id' => $request->setup_id],
            [
                'name' => $request->name,
                'ranch_id' => $request->ranch_id,
                'block_id' => $request->block_id,
                'commodity' => $request->commodity,
                'variety' => $request->variety,
                'acres' => $request->acres,
                'rows' => $request->rows,
                'row_spacing' => $request->rowspacing,
                'tree_spacing' => $request->treespacing,
                'pollinator' => $request->pollinator,
                'pollinator_spacing' => $request->pollinatorspacing,
                'trees_row' => $request->treesrow,
                'trees_acre' => $request->treesacre,
                'status' => 1,
            ]
        );
        return redirect()->route('setup.page');
    }

    public function updateStatussetup(Request $request, $id)
    {
        $setup = setuppage::findOrFail($id);
        $setup->status = $request->status;
        $setup->save();

        return response()->json(['success' => true]);
    }

    public function Editsetup($id)
    {
        $editsetup = setuppage::findOrFail($id);
        $block = Block::latest()->get();
        $ranch = Ranch::latest()->get();
        return view('setup.edit_labor', compact(['editsetup','ranch','block']));
    }

    public function Deletesetup($id)
    {
        setuppage::find($id)->delete();
        return redirect()->route('setup.page');
    }
}

<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index(){
        $userrole = Role::all();

        return view('role/role_list', compact('userrole'));
    }

    public function store(Request $request)
    {
        
        Role::updateOrCreate(
            ['id' => $request->role_id],
            [
                'name' => $request->role_name,
                'role' => $request->role,
                'created_at' => "",
                'status' => 1,
            ]
        );
        return redirect()->route('user.role');
    }

    public function updateStatus(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->status = $request->status;
        $role->save();

        return response()->json(['success' => true]);
    }

    public function getrole($id)
    {
        $user = Role::findOrFail($id);
        return response()->json($user);
    }

    public function DeleteRole($id)
    {
        Role::find($id)->delete();
        return redirect()->route('user.role');
    }

}

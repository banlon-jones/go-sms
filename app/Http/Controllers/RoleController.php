<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Privilege;
use App\Role;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // gets all define roles
        $roles = Role::all();
        $privileges = Privilege::all();
        return view('roles.index',['roles'=>$roles, 'privileges'=>$privileges]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addRole(Request $request)
    {
        $role = Role::create([
           'name'=>$request->input("name"),
            'description'=>$request->input('description'),
        ]);
        if ($role){
            foreach ($request->get("privileges") as $privilege){
                DB::table('privilege_role')->insert(
                    ['privilege_id' => $privilege, 'role_id' => $role->id]
                );
            }
            return redirect()->route("roles");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRole(Request $request){
        $roleUpdate = Role::where('id',$request->input('role'))->update([
            'name'=>$request->input('name'),
            'description'=>$request->input('description'),
        ]);
        if ($roleUpdate){
            $role = Role::where('id',$request->input('role'))->first();
            $role->privileges()->sync($request->get('privileges'));
        }
        return redirect()->route("roles");

    }
    // gets all system privileges
    public function privileges(){
        $privileges = Privilege::all();
        return response()->json($privileges);
    }

}

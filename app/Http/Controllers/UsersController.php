<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                $users = User::all();
                return view('users.index',['users'=> $users]);
    }
    /*
   * Display a listing of the resource.
   */
  public function users()
  {
          $users = User::all();
          $roles = Role::all();
          //dd($users);
          return view('users.permissions',['users'=> $users, 'roles'=> $roles]);
  }

    public function inbox(){
        $user = User::where('id',Auth::user()->id)->first();
        if ($user) {
          return view('users.inbox',['user'=>$user]);
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
             $user = User::where('id',$user->id)->first();
            return view('users.show', ['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
            $user = User::where('id', $user->id)->first();
            return view('users.edit',['user'=>$user]);

    }
    /**
     * activate user account the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function user_role(Request $request, $id = null)
    {
          $user_role = User::where('id', $id)->update([
              'role_id'=>$request->input('role_id')
          ]);
          //dd($request->input('role_id'));
          if ($user_role){
              return redirect()->route('permissions')->with('success','user role successfully change');
          }else{
              return redirect()->route('users.index')->with('error','error can not change user role');
          }
    }
    /**
     * activate user account the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, $id = null)
    {
            $verifyUser = User::where('id', $id)->update([
                'status'=>$request->input('status')
            ]);
            if ($verifyUser){
                return redirect()->route('users.show',['user'=>$id])->with('success','user successfully verified');
            }else{
                return redirect()->route('users.index')->with('error','error can not verify user');
            }
    }
    //suspend user account
    public function suspend(Request $request, $id = null)
    {
        $verifyUser = User::where('id', $id)->update([
            'status'=>$request->input('status')
        ]);
        if ($verifyUser){
            return redirect()->route('users.show',['user'=>$id])->with('success','user suspended');
        }else{
            return redirect()->route('users.index')->with('error','error suspending user');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
            $updateUser = User::where('id', $user->id)->update([
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'phone'=>$request->input('phone'),
                'city'=>$request->input('city')
            ]);
            if ($updateUser){
                return redirect()->route('users.index')->with('success','user successfully updated');
            }else{
                return back()->withInput();
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // deletes a user account completely
        $deleteUser = User::where('id', $user->id)
                            ->delete();
        if ($deleteUser){
            return response()->json();
        }else{
            return redirect()->route('users.index')->with('error',"sorry error can delete user");
        }
    }
}

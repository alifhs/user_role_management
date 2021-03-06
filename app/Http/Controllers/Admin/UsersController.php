<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->middleware('auth');   
     }
    public function index()
    {
        //

        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //

        // dd($user);
        if(Gate::denies('edit-users')){
            return redirect(route('users.index'));
        }

        $roles = Role::all();


        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        if(Gate::denies('edit-users')){
            return redirect(route('users.index'));
        }
        $user->roles()->sync($request->roles);

        

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //

        if(Gate::denies('delete-users')){
            return redirect(route('users.index'));
        }
        $user->roles()->detach();

        $user->delete();

        return redirect()->route('users.index');
    }
}

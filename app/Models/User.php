<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
       return $this->belongsToMany(Role::class);
    }

    public function hasAnyRoles($roles) {
        // dd($this->id);
        // $user = DB::table('users')->where('id', $this->id);
        // $role_ids = DB::table('role_user')->where('user_id', $this->id)->pluck('role_id')->toArray();
        // $role_names = DB::table('roles')->select('name')->whereIn('id', $role_ids)->pluck('name')->toArray();
        
        // $allowed = false;

        // dd($roles, $role_names);
        // dd($roles, $role_names);
        // foreach($roles as $role){
        //     foreach($role_names as $role_name){
        //         if($role_name === $role){
        //             $allowed = true;
        //             break;
        //         }

        //     }
        //     if($allowed)
        //         break;
        // }
        
        // $this->roles()->whereIn('name', $roles)->first()
        // dd($roles);

        if($this->roles()->whereIn('name', $roles)->first()) {

            return true;
        }

        return false;

    }
    public function hasRole($role) {

        if($this->roles()->where('name', $role)->first()) {   //(select * from roles where id in(select role_id from role_user where role_user.user_id = 1))

            return true;
        }

        return false;

    }
}

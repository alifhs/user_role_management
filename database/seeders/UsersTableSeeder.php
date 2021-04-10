<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@site.com',
            'password' => Hash::make('password')   
            
            ]);
        $author = User::create([
            'name' => 'Author User',
            'email' => 'author@site.com',
            'password' => Hash::make('password')   
            
            ]);
        $user = User::create([
            'name' => 'User User',
            'email' => 'user@site.com',
            'password' => Hash::make('password')   
            
            ]);

            
            $admin->roles()->attach($adminRole);
            $author->roles()->attach($authorRole);
            $user->roles()->attach($userRole);




    }
}

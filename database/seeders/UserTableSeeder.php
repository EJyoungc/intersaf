<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::create([
            'name'=>'Joannah',
            'email'=>'admin@admin.com',
            'role'=>'admin',
            'password'=>Hash::make('root')
        ]);

        User::create([
            'name'=>'Fuluzimange',
            'email'=>'sales@sales.com',
            'role'=>'sales rep',
            'password'=>Hash::make('root')
        ]);
        User::create([
            'name'=>'Steven',
            'email'=>'ops@ops.com',
            'role'=>'operations manager',
            'password'=>Hash::make('root')
        ]);
    }
}

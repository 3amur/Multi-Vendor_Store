<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // elquent model
        User::create([
            'name' => 'OmarMuhammed',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '01061138754',
        ]);
        // query builder
        DB::table('users')->insert([
            'name' => 'OmarMuhammed',
            'email' => 'omar7@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '0106113875',
        ]);
    }
}

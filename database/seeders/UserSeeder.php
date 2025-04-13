<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin Utama',
            'username' => 'admin',
            'password' => Hash::make('Admin123'),
            'role_id' => 1, 
            'outlet_id' => 1,
            'division_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

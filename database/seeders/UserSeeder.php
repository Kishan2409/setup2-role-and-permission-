<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  User::firstOrCreate(['id' => 1], [
            'id' => 1,
            'role_id' => 1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'status' => '1',
            'password' => Hash::make('123456789'),
            'password_view' => '123456789',
            'added_by' => 1
        ]);

        $user =  User::firstOrCreate(['id' => 2], [
            'id' => 2,
            'role_id' => 2,
            'name' => 'vendor',
            'email' => 'vendor@gmail.com',
            'status' => '1',
            'password' => Hash::make('123456789'),
            'password_view' => '123456789',
            'added_by' => 1
        ]);
    }
}

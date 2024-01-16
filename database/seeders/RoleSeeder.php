<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::firstOrCreate(['id' => 1],
            ['id' => 1,'name' => 'Super admin','status' => 1,'added_by' =>1]
        );
        Role::firstOrCreate(['id' => 2],
            ['id' => 2,'name' => 'Vendor','status' => 1,'added_by' =>1]
        );
    }
}

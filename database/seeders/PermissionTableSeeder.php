<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            //role
            ['name' => 'Index Role', 'slug' => 'role.index', 'model' => 'Role', 'description' => 'User can view role menu'],
            ['name' => 'Show Role', 'slug' => 'role.show', 'model' => 'Role', 'description' => 'User can view role details'],
            ['name' => 'Create Role', 'slug' => 'role.create', 'model' => 'Role', 'description' => 'User can create new role'],
            ['name' => 'Edit Role', 'slug' => 'role.edit', 'model' => 'Role', 'description' => 'User can edit role details'],
            ['name' => 'Delete Role', 'slug' => 'role.destroy', 'model' => 'Role', 'description' => 'User can delete role'],
            ['name' => 'Active/Inactive Role', 'slug' => 'role.status', 'model' => 'Role', 'description' => 'User can change role status'],

            //user
            ['name' => 'Index User', 'slug' => 'user.index', 'model' => 'User', 'description' => 'User can view user menu'],
            ['name' => 'Show User', 'slug' => 'user.show', 'model' => 'User', 'description' => 'User can view user details'],
            ['name' => 'Create User', 'slug' => 'user.create', 'model' => 'User', 'description' => 'User can create new user'],
            ['name' => 'Edit User', 'slug' => 'user.edit', 'model' => 'User', 'description' => 'User can edit user details'],
            ['name' => 'Delete User', 'slug' => 'user.destroy', 'model' => 'User', 'description' => 'User can delete user'],
            ['name' => 'Active/Inactive User', 'slug' => 'user.status', 'model' => 'User', 'description' => 'User can change user status'],

            //profile setting
            ['name' => 'Index User Profile', 'slug' => 'profile.index', 'model' => 'Profile', 'description' => 'User can view user profile'],
            ['name' => 'Edit User Edit', 'slug' => 'profile.edit', 'model' => 'Profile', 'description' => 'User can edit user profile'],

            //websetting setting
            ['name' => 'Index Web-setting', 'slug' => 'websetting.index', 'model' => 'Web-setting', 'description' => 'User can view web-setting'],


        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate($permission);
        }
    }
}

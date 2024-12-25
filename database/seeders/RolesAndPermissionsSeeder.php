<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create Roles
        $admin = Role::create(['name' => 'Admin']);
        $manager = Role::create(['name' => 'Manager']);
        $user = Role::create(['name' => 'Customer']);
        $worker = Role::create(['name' => 'Worker']);

        // Create Permissions
        $permissions = [
            // Dashboard
            'view dashboard',

            // Task Management
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'assign tasks',
            'approve tasks',


            // User Management
            'view users',
            'add users',
            'edit users',
            'delete users',
            'assign roles',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign Permissions to Roles
        $admin->givePermissionTo(Permission::all());

        $manager->givePermissionTo([
            'view dashboard',
            'view tasks',
            'create tasks',
            'edit tasks',
            'delete tasks',
            'assign tasks',
            'approve tasks',
        ]);

        $user->givePermissionTo([
            'view dashboard',
            'view tasks',
            'create tasks',
        ]);

        $worker->givePermissionTo([
            'view dashboard',
            'view tasks',
            'edit tasks',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Master
        Permission::create(['name'=>'create-user']);
        Permission::create(['name'=>'update-user']);
        Permission::create(['name'=>'delete-user']);
        Permission::create(['name'=>'view-user']);
        Permission::create(['name'=>'view-dashboard']);
        Role::create(['name'=>'superadmin']);

        // Give Role a Permission
        $roleSuperadmin = Role::findByName('superadmin');
        $roleSuperadmin->givePermissionTo('view-dashboard');
        $roleSuperadmin->givePermissionTo('create-user');
        $roleSuperadmin->givePermissionTo('update-user');
        $roleSuperadmin->givePermissionTo('delete-user');
        $roleSuperadmin->givePermissionTo('view-user');
    }
}

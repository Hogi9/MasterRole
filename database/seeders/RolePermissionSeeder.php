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
        Permission::create(['name'=>'user.*']);
        Permission::create(['name'=>'user.create']);
        Permission::create(['name'=>'user.update']);
        Permission::create(['name'=>'user.delete']);
        Permission::create(['name'=>'user.view']);

        Permission::create(['name'=>'role.*']);
        Permission::create(['name'=>'role.create']);
        Permission::create(['name'=>'role.update']);
        Permission::create(['name'=>'role.delete']);
        Permission::create(['name'=>'role.view']);

        Permission::create(['name'=>'permission.*']);
        Permission::create(['name'=>'permission.create']);
        Permission::create(['name'=>'permission.update']);
        Permission::create(['name'=>'permission.delete']);
        Permission::create(['name'=>'permission.view']);

        Role::create(['name'=>'superadmin']);
        Role::create(['name'=>'guest']);

        // Give Role a Permission
        $roleSuperadmin = Role::findByName('superadmin');
        // user
        $roleSuperadmin->givePermissionTo('user.*');
        // $roleSuperadmin->givePermissionTo('user.create');
        // $roleSuperadmin->givePermissionTo('user.update');
        // $roleSuperadmin->givePermissionTo('user.delete');
        // $roleSuperadmin->givePermissionTo('user.view');
        
        // role
        $roleSuperadmin->givePermissionTo('role.*');
        // $roleSuperadmin->givePermissionTo('role.create');
        // $roleSuperadmin->givePermissionTo('role.update');
        // $roleSuperadmin->givePermissionTo('role.delete');
        // $roleSuperadmin->givePermissionTo('role.view');

        // permission
        $roleSuperadmin->givePermissionTo('permission.*');
        // $roleSuperadmin->givePermissionTo('permission.create');
        // $roleSuperadmin->givePermissionTo('permission.update');
        // $roleSuperadmin->givePermissionTo('permission.delete');
        // $roleSuperadmin->givePermissionTo('permission.view');
        
        // testing data
        $roleGuest = Role::findByName('guest');
    }
}

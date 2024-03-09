<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $datas = Role::all();
        return view('role.index',compact('datas'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data,[
            'role-name' => 'required|unique:roles,name',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }
        
        $role = Role::create([
            'name' => $data['role-name'],
        ]);

        foreach($data['role-permissions'] as $permission){
            $role->givePermissionTo($permission);
        }

        return redirect('/hak-akses/role')->with('success', $data['role-name'].' berhasil ditambahkan');
    }

    public function edit($roleName)
    {
        $role = Role::with('permissions')->where('name',$roleName)->first();
        $permissions = Permission::all();
        return view('role.edit',[
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    public function update(Request $request)
    {
        $new_permission = $request->all();
        $role = Role::findByName($request['role-name']);

        // Untuk menghapus dan deklarasi ulang list permissions role
        if(isset($new_permission['role-permissions'])){
            $role->syncPermissions($new_permission['role-permissions']);
        }else{
            $role->syncPermissions([]);
        }
        
        return redirect('/hak-akses/role')->with('success', $role['name'].' berhasil diupdate');
    }

    public function delete($roleName)
    {
        $deleted_role = Role::where('name',$roleName)->first();
        if($deleted_role){
            $deleted_role->delete();
            // Untuk menghapus sisa permission yang terhubung di role
            $deleted_role->permissions()->detach();
            return redirect('/hak-akses/role')->with('success', $deleted_role['name'].' berhasil dihapus');
        }else{
            return redirect('/hak-akses/role')->with('fail', $deleted_role['name'].' gagal dihapus');
        }
    }
}

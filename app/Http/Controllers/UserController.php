<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $role_list = Role::all();
        return view('profile.index',[
            'user' => $user,
            'role_list' => $role_list,
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(),[
            'email' => [
                'required',
                'email',
                Rule::unique('users','email')->ignore($user->id,'id')
            ],
            'username' => [
                'required',
                'min:3',
                Rule::unique('users','username')->ignore($user->id,'id')
            ],
            'password' => 'nullable|min:8',
        ]);

        
        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }
        dd($request->all());
    }
}

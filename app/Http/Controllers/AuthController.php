<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function loginLogic(Request $request)
    {
        $credentials = $request->only('email-username','password');

        $validator = Validator::make($credentials,[
            'email-username'=> 'required|max:100',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }

        $validator = Validator::make(['email-username' => $credentials['email-username']],[
            'email-username' => 'required|email',
        ]);
        
        if($validator->fails()){
            if(Auth::attempt(['username' => $credentials['email-username'],'password' => $credentials['password']],$request->filled('remember'))){
                return redirect('/dashboard')->with('success',"Login Berhasil !");
            }
        }else{
            if(Auth::attempt(['email' => $credentials['email-username'],'password' => $credentials['password']],$request->filled('remember'))){
                return redirect('/dashboard')->with('success',"Login Berhasil !");
            }
        }

        return back()->with('login-failed','Username Atau Password Salah !')->withInput();
    }

    public function registerLogic(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required|max:100|unique:users,username',
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator->errors())->withInput();
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        unset($input['confirm_password']);
        
        $user = User::create($input);
        $user->givePermissionTo('view-dashboard');

        return redirect('/login')->with('success','Registrasi Berhasil !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register (Request $request)
    {
        $validator = Validator::make($request->all(),[
            'username' => 'required|max:100|unique:users,username',
            'email' => 'required|email|unique:users,email|max:100',
            'password' => 'required|min:8',
            'confirm_password' => 'required|same:password',
            'remember_token' => 'nullable',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => "Gagal Register !",
                'data' => $validator->errors(),
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        unset($input['confirm_password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['username'] = $user->username;

        return response()->json([
            'success' => true,
            'message' => "Berhasil Register",
            'data' => $success,
        ]);
    }
    
    public function login(Request $request)
    {
        $credentials = $request->only('email-username','password');
        $validator = Validator::make($credentials,[
            'email-username' => 'required|max:100',
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => "Gagal Login !",
                'data' => $validator->errors(),
            ]);
        }
        
        // validator is email or username
        $validator = Validator::make(['email-username' => $credentials['email-username']], [
            'email-username' => 'required|email',
        ]);

        if($validator->fails()){
            // Jika menggunakan username
            if(Auth::attempt(['username'=>$credentials['email-username'],'password'=>$credentials['password']],$request->filled('remember'))){
                 /** @var \App\Models\User */
                $auth = Auth::user();
                $success['token'] = $auth->createToken('auth_token')->plainTextToken;
                $success['username'] = $auth['username'];
    
                return response()->json([
                    'success' => true,
                    'message' => "Berhasil Login",
                    'data' => $success,
                ]);
            }
        }else{
            // Jika menggunakan email
            if(Auth::attempt(['email'=>$credentials['email-username'],'password'=>$credentials['password']],$request->filled('remember'))){
                 /** @var \App\Models\User */
                $auth = Auth::user();
                $success['token'] = $auth->createToken('auth_token')->plainTextToken;
                $success['email'] = $auth['email'];
    
                return response()->json([
                    'success' => true,
                    'message' => "Berhasil Login",
                    'data' => $success,
                ]);
            }
            
        }

        return response()->json([
            'success' => false,
            'message' => "Username atau email atau password salah !",
            'data' => null,
        ]);
    }
}

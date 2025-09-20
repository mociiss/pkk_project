<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();

        if($user && Hash::check($request->password, $user->password)){
            Auth::login($user);
            return redirect('dashboard');
        }else{
            return back()->with('Error', 'Email atau Password salah!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}

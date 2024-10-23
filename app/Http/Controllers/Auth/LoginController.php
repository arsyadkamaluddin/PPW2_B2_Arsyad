<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function middleware(){
        return[
            new Middleware('guest',except:['logout'])
        ];
    }
    public function register(){
        return view('register');        
    }
    public function store(Request $request){
        $credentials = $request->validate([
            "email"=>['required','email','lowercase'],
            "password"=>['required']
        ]);
        User::create([
            "email"=> $request->email,
            "password"=> Hash::make($request->password),
            "level"=>"user"
        ]);
        return redirect(route('login'));
    }
    public function login(){
        return view('login');
    }
    public function authenticate(Request $request){
        $credentials = $request->validate([
            "email"=>['required','email','lowercase'],
            "password"=>['required']
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('books.index'));
        }
        return back()->withErrors(["email"=>"Periksa kembali email dan kata sandi anda"]);
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}

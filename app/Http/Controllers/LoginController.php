<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function middleware()
    {
        return [
            new Middleware('guest', except: ['logout'])
        ];
    }
    public function register()
    {
        return view('register');
    }
    public function store(Request $request)
    {
        $credentials = $request->validate([
            "email" => ['required', 'email', 'lowercase'],
            "password" => ['required', 'confirmed']
        ]);
        $content = [
            "name" => 'Halo ' . $request->email,
            "subject" => 'Registrasi Berhasil',
            "body" => 'Selamat datang di aplikasi PPW2, anda melakukan registrasi pada : '. now()
        ];
        try {
            User::create([
                "email" => $request->email,
                "password" => Hash::make($request->password),
            ]);
            Mail::to($request->email)->send(new RegistrationMail($content));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('register')->with('error', 'Anda gagal registrasi');
        }
        return redirect()->route('login')->with('success', 'Anda berhasil registrasi');
    }
    public function login()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            "email" => ['required', 'email', 'lowercase'],
            "password" => ['required']
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('books.index'));
        }
        return back()->withErrors(["email" => "Periksa kembali email dan kata sandi anda"]);
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }
}

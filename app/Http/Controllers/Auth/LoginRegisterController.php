<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;
use Intervention\Image\Facades\Image;

class LoginRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'uploadAvatar',
        ]);
        $this->middleware('guest')->except([
            'logout',
            'dashboard',
            'profile',
            'uploadAvatar',
        ]);
    }
    public function register()
    {
        return view('auth.register');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'password' => 'required|min:8|confirmed',
            'photo' => 'required|image|nullable|max:1999'
        ]);
        
        if ($request->hasFile('photo')) {
            $path = Storage::disk('public')->put('avatars',$request->file('photo'));            
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'photo' => $path
        ]);

        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();

        // $data = $request->all();
        // $data['subject'] = "Pendaftaran Berhasil";
        // $data['body'] = "Hallo, pendaftaran anda di aplikasi " . env('APP_NAME') . " berhasil.";

        // dispatch(new SendMailJob($data));

        return redirect()->route('dashboard')
            ->withSuccess('You have successfully registered & logged in!');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate(
            [
                "email"=>"required",
                "password"=>"required"
            ]
        );

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')
                ->withSuccess('You have successfully logged in!');
        }

        return back()->withErrors(['login' => 'Login failed.']);
    }
    public function dashboard()
    {
        if (Auth::check()) {
            return view('auth.dashboard');
        }

        return redirect()->route('login')
            ->withErrors([
                'email' => 'Please login to access the dashboard.',
            ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }
    public function profile()
    {
        return view('profile');
    }

    public function uploadAvatar(Request $request)
    {
        $request->validate([
            'photo' => [
                "required",
                "image",
                File::types(['jpg','jpeg','png']),
                "max:1999",
            ]
        ]);
        try {
            if ($request->hasFile('photo')) {
                $new = Storage::disk('public')->put('avatars',$request->file('photo'));
                $user = auth()->user();
                if($user->photo){
                    Storage::disk('public')->delete($user->photo);
                }
                $user->photo = $new;
                $user->save();
            }
            return redirect()->route('profile')->withSuccess('User updated successfully');
        } catch (\Throwable $th) {
            return redirect()->route('profile')->withError('Failed to update user');
        }
    }
}

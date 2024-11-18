<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'nama' => ['required'],
            'password' => ['required'],
        ]);

        // CEK USER
        $user = User::firstWhere('name', $request->nama);
        // $user = User::where('nama', $request->nama)->first();

        if (!$user) {
            return back()->withErrors([
                'nama' => 'Login Anda Salah !!!',
            ])->onlyInput('nama');
        }

        $credentials = [
            'email'     => $user->email,
            'password'  => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors([
            'nama' => 'Login Anda Salah !!!',
        ])->onlyInput('nama');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

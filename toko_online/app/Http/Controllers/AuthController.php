<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    public function showRegister() { return view('auth.register'); }

    public function login(Request $request)
    {
        $cred = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($cred)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors(['username' => 'Username atau password salah.'])->onlyInput('username');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'email'        => 'required|email|max:100|unique:users,email',
            'username'     => 'required|max:50|unique:users,username',
            'password'     => 'required|min:6|confirmed',
            'no_hp'        => 'nullable|max:15',
            'alamat'       => 'nullable',
        ]);

        $data['id_user'] = 'USR' . strtoupper(Str::random(8));
        $user = User::create($data);

        Auth::login($user);
        return redirect('/')->with('success', 'Registrasi berhasil, selamat datang!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
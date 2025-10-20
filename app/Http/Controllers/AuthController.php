<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // === TAMPILAN FORM LOGIN DAN REGISTER ===
    public function indexLogin()
    {
        return view('auth.login');
    }

    public function indexRegister()
    {
        return view('auth.registrasi');
    }

    // === PROSES REGISTRASI ===
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'alamat' => 'required|string',
            'no_telp' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ]);


        Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'role' => 'pemesan',
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'pemesan') {
                return redirect()->intended('/');
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // flutter

    public function loginHP(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = Users::where('name', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Username atau password salah'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'id' => $user->id,
            'username' => $user->name,
            'phone' => $user->no_telp,
            'job' => $user->job,
        ]);
    }
}

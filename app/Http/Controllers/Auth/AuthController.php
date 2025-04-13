<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login_view()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) 
                ->withInput()
                ->with('toast_error', 'Login gagal. Mohon isi semua kolom.');
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = $user->role->role_name ?? 'Unknown';

            session([
                'user_name' => $user->name,
                'user_role' => $role,
            ]);

            return redirect()->intended('/')->with('toast_success', 'Login berhasil!');
        }

        return back()->withInput()->with('toast_error', 'Username atau password salah.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('toast_success', 'Logout berhasil!');
    }
}

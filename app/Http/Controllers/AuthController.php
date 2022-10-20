<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        // Validate
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Credentials check
        if (Auth::attempt(request(['email', 'password']))) {
            $user = User::where('email', $request->email)->first();
            if (Hash::check($request->password, $user->password)) {
                $user->createToken('token')->plainTextToken;

                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->back()->with([
                'error' => 'Email atau password salah'
            ]);
        }
    }

    public function registerForm()
    {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        try {
            // Validate
            $request->validate([
                'first_name' => 'required|string',
                'last_name' => 'required|string',
                'full_name' => 'required|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required'
            ]);

            // Create user
            User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'full_name' => $request->full_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('login')->with([
                'success' => 'Registrasi akun berhasil. Silahkan login'
            ]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login', [
            'title'  => 'Iniciar sesión',
            'active' => ''
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // intenta autenticar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // vuelve a donde iba (si venía redirigida), si no a Inicio
            return redirect()->intended('/Inicio');
        }

        return back()
            ->withErrors(['email' => 'Correo o contraseña incorrectos.'])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller {

    public function index(): View {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse {

        $credentials = $request->validate([
            'username' => 'required',
            'password'  => 'required'
        ]);

        $isRememberMe = (bool)$request->post('remember-me');
        if (Auth::attempt($credentials, $isRememberMe)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/temples');
        }

        return back()->with('loginError', 'Ошибка входа');
    }

    public function logout(): RedirectResponse {

        Auth::logout();
        request()->session()->regenerate();
        request()->session()->regenerateToken();

        return redirect('/login')->with('success', 'Успешный выход из панели управления');
    }
}

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

        $isRememberMe = $request->POST('remember-me') ? true : false;
        if (Auth::attempt($credentials, $isRememberMe)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/temples');
        }

        return back()->with('loginError', 'Ошибка входа');
    }

    public function logout(): RedirectResponse {
//        auth()->logout();
        Auth::logout();

        request()->session()->regenerate();
        request()->session()->regenerateToken();

//        return redirect()->to('/login')->with('success', 'Успешный выход из панели управления!');
        return redirect('/login')->with('success', 'Успешный выход из панели управления');
    }
}

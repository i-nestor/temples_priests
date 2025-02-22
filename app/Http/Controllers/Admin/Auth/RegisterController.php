<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller {

    public function index(): View {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse {
        // проверка запросов
        $validatedData = $request->validate([
            "name"  => 'required|max:255',
            "username"  => 'required|max:255|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password'  => 'required|min:5|max:255'
        ]);
        // хеширование пароля
        $validatedData['password'] = Hash::make($validatedData['password']);
        // создание нового пользователя в базе данных
        User::create($validatedData);
        // перенаправление на страницу входа
        return redirect()->to('/login')->with("success", "Регистрация прошла успешно!");
    }
}

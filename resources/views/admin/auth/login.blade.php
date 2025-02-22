@extends('layouts.app')

@section('content')
<div class="">
    <div class="mx-auto max-w-md py-4 mb-5">
        <div class="m-5">
            <h2 class="text-center text-3xl text-chocolate-500">Панель управления</h2>
            <small class="text-center block text-chocolate-400">Для доступа к панели управления архивом авторизуйтесь!</small>
        </div>
        @if(session('success'))
        <div class="text-center bg-chocolate-200 shadow-sm my-2 px-4 py-2 rounded-5 border border-green-600">
            <span class="text-l text-green-600">&#9888; {{ session('success') }}</span>
        </div>
        @endif
        @if(session('loginError'))
        <div class="bg-chocolate-200 shadow-sm my-2 px-4 py-2 rounded-5 border border-red-500">
            <span class="text-l text-red-600">&#9888; {{ session('loginError') }}</span>
        </div>
        @endif
        <form class="mt-8 py-4" action="/login" method="POST" novalidate>
            @csrf
            <div>
                <div class="mb-3">
                    <label for="username" class="block text-xs text-chocolate-500 mb-2">Логин</label>
                    <input id="username" name="username" type="username" autofocus autocomplete="username"
                           class="px-4 py-2 form-control block w-full rounded-5
                           text-l border-chocolate-300 border bg-chocolate-100" value="{{ old('username') }}">
                    @error('username')
                    <small class="text-red-600 block my-2">&#9888; {{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="block text-xs text-chocolate-500 mb-2">Пароль</label>
                    <input id="password" name="password" type="password" autocomplete="password"
                           class="px-4 py-2 form-control block w-full rounded-5
                           text-l border-chocolate-300 border bg-chocolate-100">
                    @error('password')
                    <small class="text-red-600 font-medium block my-2">&#9888; {{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="items-right-2">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox"
                           class="form-check-input p-2">
                    <label for="remember-me" class="m-1 block text-xs text-chocolate-500">Запомнить меня</label>
                </div>
            </div>

            <div class="items-right-2 mb-5">
                <button type="submit"
                        class="mt-2 px-4 py-2 btn btn-w btn-outline-chocolate bg-chocolate-200 rounded-pill text-xs">
                    Войти
                </button>
            </div>

            <div class="w-full text-center">
                <a href="/register" class="text-xs my-5 text-chocolate-500 hover:text-chocolate-600">Регистрация в панели управления</a>
            </div>
        </form>
    </div>
</div>
@endsection

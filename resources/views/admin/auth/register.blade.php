@extends('layouts.app')

@section('content')
    <script src="{{ asset('resources/js/validate.js') }}"></script>
<div class="">
    <div class="mx-auto max-w-md py-4 mb-5">
        <div class="m-5">
            <h2 class="text-center text-3xl text-chocolate-500">Регистрация в панели управления</h2>
        </div>
        <form id="personalDataForm" class="mt-8 py-4" action="" method="POST" >
            @csrf
            <div>
                <div class="mb-3">
                    <label for="name" class="block text-xs text-chocolate-500 mb-2">Имя</label>
                    <input id="name" name="name" type="text" autocomplete="username"
                           class="px-4 py-2 form-control block w-full rounded-5
                           text-l border-chocolate-300 border bg-chocolate-100" value="{{ old('name') }}" autofocus required>
                    @error('name')<small class="text-red-600 block my-2">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="block text-xs text-chocolate-500 mb-2">Email адрес</label>
                   <input id="email" name="email" type="email" autocomplete="email" {{-- placeholder='example@mail.com'--}}
                           class="px-4 py-2 form-control block w-full rounded-5
                           text-l border-chocolate-300 border bg-chocolate-100" value="{{ old('email') }}" required>
                    @error('email')<small class="text-red-600 block my-2">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="block text-xs text-chocolate-500 mb-2">Логин</label>
                    <input id="username" name="username" type="text" autocomplete="username"
                           class="px-4 py-2 form-control block w-full rounded-5
                           text-l border-chocolate-300 border bg-chocolate-100" value="{{ old('username') }}" required>
                    @error('username')<small class="text-red-600 block my-2">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="block text-xs text-chocolate-500 mb-2">Пароль</label>
                    <input id="password" name="password" type="password" autocomplete="password"
                           class="px-4 py-2 form-control block w-full rounded-5
                           text-l border-chocolate-300 border bg-chocolate-100" required>
                    @error('password')<small class="text-red-600 block my-2">{{ $message }}</small>@enderror
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="block text-xs text-chocolate-500 mb-2">Подтверждение пароля</label>
                    <input id="confirmPassword" name="confirmPassword" type="password" autocomplete="password"
                           class="px-4 py-2 form-control block w-full rounded-5
                           text-l border-chocolate-300 border bg-chocolate-100" required>
                    @error('password')<small class="text-red-600 block my-2">{{ $message }}</small>@enderror
                </div>
            </div>

            <div class="items-right-2 mb-5">
                <button type="submit"
                        class="mt-2 px-4 py-2 btn btn-w btn-outline-chocolate bg-chocolate-200 rounded-pill text-xs">
                    Зарегистрировать
                </button>
            </div>

            <div class="w-full text-center">
                <a href="/login" class="text-xs my-5 text-chocolate-500 hover:text-chocolate-600">Вы уже зарегистрированны? Войдите!</a>
            </div>
        </form>
    </div>
</div>
@endsection

<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminElderFounderController;
use App\Http\Controllers\Admin\AdminPriestController;
use App\Http\Controllers\Admin\AdminTempleController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\ElderFounderController;
use App\Http\Controllers\LatestPublicationsController;
use App\Http\Controllers\PriestController;
use App\Http\Controllers\TempleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group.
|--------------------------------------------------------------------------
| Веб-маршруты
|--------------------------------------------------------------------------
| Здесь вы можете зарегистрировать веб-маршруты для вашего приложения.
| Эти маршруты загружаются RouteServiceProvider в группу, которая
| содержит middleware группу "web".
*/

Route::get('/', function () {
    return view('home');
});

// latest-publications
Route::get('/latest-publications', [LatestPublicationsController::class, 'index']);

// temples
Route::get('/temples', [TempleController::class, "index"]);
Route::get('/temples/{temple:slug}', [TempleController::class, "show"]);

// priests
Route::get('/priests', [PriestController::class, "index"]);
Route::get('/priests/{priest:slug}', [PriestController::class, "show"]);

// elder-founders
Route::get('/elder-founders', [ElderFounderController::class, "index"]);
Route::get('/elder-founders/{elder_founder:slug}', [ElderFounderController::class, "show"]);

// auth
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::delete('/logout', [LoginController::class, 'logout']);

// register
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// admin
Route::get('/admin', [AdminController::class, 'index'])->middleware('auth');

// admin temples
Route::get('/admin/temples/slug', [AdminTempleController::class, 'slug'])->middleware('auth');
Route::resource('/admin/temples', AdminTempleController::class)->middleware('auth');

// admin priests
Route::get('/admin/priests/slug', [AdminPriestController::class, 'slug'])->middleware('auth');
Route::resource('/admin/priests', AdminPriestController::class)->middleware('auth');

// admin elder-founders
Route::get('/admin/elder-founders/slug', [AdminElderFounderController::class, 'slug'])->middleware('auth');
Route::resource('/admin/elder-founders', AdminElderFounderController::class)->middleware('auth');

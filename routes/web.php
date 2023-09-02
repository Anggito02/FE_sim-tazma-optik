<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColorController;
use Illuminate\Routing\ViewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::controller(AuthController::class)->group(function(){
    Route::post('/login', 'login');
    Route::get('/dashboard', 'getUserInfo');
});

Route::controller(ColorController::class)->group(function(){
    Route::get('/warna','getAllColor');
});

Route::group([], function(){
    Route::get('/login', function(){
        return view('login');
    });

    // Route::get('/warna', function () {
    //     return view('master.warna');
    // });

    Route::get('/user', function () {
        return view('master.user');
    });

    Route::get('/employee', function () {
        return view('master.employee');
    });

    Route::get('/vendors', function () {
        return view('master.vendor');
    });

    Route::get('/brand', function () {
        return view('master.brand');
    });

    Route::get('/branch', function () {
        return view('master.branch');
    });
});



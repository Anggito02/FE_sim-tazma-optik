<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
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

    // Route::get('/login', 'checkUserStatus');
    Route::get('/dashboard', 'getUserInfo');
});

Route::group([], function(){
    Route::get('/warna', function () {
        return view('warna');
    });

    Route::get('/user', function () {
        return view('user');
    });

    Route::get('/employee', function () {
        return view('employee');
    });
});



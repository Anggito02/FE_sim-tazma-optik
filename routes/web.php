<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FrameController;

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
    Route::get('/dashboard', 'getUserInfo')->middleware('isTokenValid');
    Route::get('/logout', 'logout')->middleware('isTokenValid');
});

Route::controller(ColorController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/color','getAllColor');
    Route::post('/color/add', 'addColor');
    Route::put('/color/edit', 'updateColor');
    Route::delete('/color/delete', 'deleteColor');
});

Route::controller(BranchController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/branch','getAllBranch');
    Route::post('/branch/add', 'addBranch');
    Route::put('/branch/edit', 'updateBranch');
    Route::delete('/branch/delete', 'deleteBranch');
});

Route::controller(FrameController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/frame-category','getAllFrameCategory');
    Route::post('/frame-category/add', 'addFrameCategory');
    Route::put('/frame-category/edit', 'updateFrameCategory');
    Route::delete('/frame-category/delete', 'deleteFrameCategory');
});

Route::group([], function(){
    Route::get('/login', function(){
        return view('login');
    })->middleware('isLoggedIn');

    Route::get('/employee', function () {
        return view('master.employee');
    });

    Route::get('/vendors', function () {
        return view('master.vendor');
    });

    Route::get('/brand', function () {
        return view('master.brand');
    });

    Route::get('/lens', function () {
        return view('master.lens');
    });

    Route::get('/index', function () {
        return view('master.index');
    });

});



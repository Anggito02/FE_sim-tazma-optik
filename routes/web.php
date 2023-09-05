<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ErrorPageController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LensController;

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

Route::controller(BrandController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/brand','getAllBrand');
    Route::post('/brand/add', 'addBrand');
    Route::put('/brand/edit', 'updateBrand');
    Route::delete('/brand/delete', 'deleteBrand');
});


Route::controller(EmployeeController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/employee','getAllEmployee');
    Route::post('/employee/add', 'addEmployee');
    Route::put('/employee/edit', 'updateEmployee');
    Route::delete('/employee/delete', 'deleteEmployee');
});

Route::controller(FrameController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/frame-category','getAllFrameCategory');
    Route::post('/frame-category/add', 'addFrameCategory');
    Route::put('/frame-category/edit', 'updateFrameCategory');
    Route::delete('/frame-category/delete', 'deleteFrameCategory');
});

Route::controller(LensController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/lens-category','getAllLensCategory');
    Route::post('/lens-category/add', 'addLensCategory');
    Route::put('/lens-category/edit', 'updateLensCategory');
    Route::delete('/lens-category/delete', 'deleteLensCategory');
});

Route::controller(IndexController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/index','getAllIndexCategory');
    Route::post('/index/add', 'addIndexCategory');
    Route::put('/index/edit', 'updateIndexCategory');
    Route::delete('/index/delete', 'deleteIndexCategory');
});

// Route::controller(ErrorPageController::class)->middleware('isTokenValid')->group(function(){
//     Route::get('/404','PageError404');
// });

Route::group([], function(){
    Route::get('/login', function(){
        return view('login');
    });

    Route::get('/user', function () {
        return view('master.user');
    });


    Route::get('/vendors', function () {
        return view('master.vendor');
    });

    Route::get('/404', function () {
        return view('error_page.404');
    });

    Route::get('/505', function () {
        return view('error_page.505');
    });

});



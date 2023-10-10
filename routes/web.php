<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CoaController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ErrorPageController;
use App\Http\Controllers\FrameController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LensController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrderDetailController;
use App\Http\Controllers\ItemController;

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
    Route::post('/login', 'login')->middleware('guest');
    Route::get('/dashboard', 'getUserInfo')->middleware('isTokenValid');
    Route::get('/logout', 'logout')->middleware('isTokenValid');
    Route::post('/register/add', 'register')->middleware('isTokenValid');
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

Route::controller(VendorsController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/vendors','getAllVendor');
    Route::post('/vendors/add', 'addVendor');
    Route::put('/vendors/edit', 'updateVendor');
    Route::delete('/vendors/delete', 'deleteVendor');
});

Route::controller(PurchaseOrderController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/PO','getAllPO');
    Route::post('/PO/add', 'addPO');
    Route::put('/PO/edit', 'updatePO');
    Route::delete('/PO/delete', 'deletePO');
});

Route::controller(PurchaseOrderDetailController::class)->middleware('isTokenValid')->group(function(){
    Route::post('/PO/detail','getAllPODetail');
    Route::post('/PO/detail/add', 'addPODetail');
    Route::put('/PO/detail/edit', 'updatePODetail');
    Route::delete('/PO/detail/delete', 'deletePODetail');
});

Route::controller(CoaController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/coa','getAllCoa');
    Route::post('/coa/add', 'addCoa');
    Route::put('/coa/edit', 'updateCoa');
    Route::delete('/coa/delete', 'deleteCoa');
});

Route::controller(ItemController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/item','getAllItem');
    Route::post('/item/add', 'addItem');
    Route::put('/item/edit', 'updateItem');
    Route::delete('/item/delete', 'deleteItem');
});

// Route::controller(ErrorPageController::class)->middleware('isTokenValid')->group(function(){
//     Route::get('/404','PageError404');
// });

Route::group([], function(){
    Route::get('/login', function () {
        return view('login');
    });

    // Route::get('/user', function () {
    //     return view('master.user');
    // });

    Route::get('/404', function () {
        return view('error_page.404');
    });

    Route::get('/505', function () {
        return view('error_page.505');
    });

    // Route::get('/PO', function () {
    //     return view('master.po');
    // });

    Route::get('/PO/detail', function () {
        return view('master.poDetail');
    });

});


Route::any('{any}', function () {
    return view('error_page.404');
})->where('any', '.*');



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
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LensController;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseOrderDetailController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ReceiveOrderController;
use App\Http\Controllers\BranchItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemOutgoingController;
use App\Http\Controllers\ItemOutgoingDetailController;
use App\Http\Controllers\KasController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\StockOpnameMasterController;
use App\Http\Controllers\StockOpnameDetailController;
use App\Http\Controllers\StockOpnameBranchController;
use App\Http\Controllers\StockOpnameBranchDetailController;


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

Route::controller(CategoryController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/category','getAllCategory');
    Route::post('/category/add', 'addCategory');
    Route::put('/category/edit', 'updateCategory');
    Route::delete('/category/delete', 'deleteCategory');
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
    Route::post('/PO/edit', 'updatePO');
    Route::post('/PO/delete', 'deletePO');
    Route::post('/PO/loadDataMaster', 'loadDataMaster');
    Route::post('/PO/loadDataDetailOnly', 'loadDataDetailOnly');
});

Route::controller(PurchaseOrderDetailController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/PO/detail/{id}','getAllPODetail');
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
    Route::post('/item/edit', 'updateItem');
    Route::post('/item/delete', 'deleteItem');
    Route::post('/item/loadDataMaster', 'loadDataMaster');
    Route::post('/item/loadDataDetailOnly', 'loadDataDetailOnly');
});

Route::controller(ReceiveOrderController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/receive-order/{id}','getReceiveOrder');
    Route::post('/receive-order/add', 'addReceiveOrder');
    Route::put('/receive-order/edit', 'updateReceiveOrder');
});

Route::controller(BranchItemController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/branch-item','getAllBranchItem');
});

Route::controller(ItemOutgoingController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/item-outgoing','getAllItemOutgoing');
    Route::post('/item-outgoing/add', 'addItemOutgoing');
    Route::put('/item-outgoing/edit', 'updateItemOutgoing');
    Route::delete('/item-outgoing/delete', 'deleteItemOutgoing');
});

Route::controller(ItemOutgoingDetailController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/item-outgoing/detail/{id}','getAllItemOutgoingDetail');
    Route::post('/item-outgoing/detail/add','addItemOutgoingDetail');
    Route::put('/item-outgoing/detail/edit', 'updateItemOutgoingDetail');
    Route::put('/item-outgoing/detail/verify', 'verifyItemOutgoingDetail');
    Route::delete('/item-outgoing/detail/delete', 'deleteItemOutgoingDetail');
});

Route::controller(BranchItemController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/branch-item','getAllBranchItem');
    Route::post('/branch-item/add', 'addBranchItem');
});
Route::controller(SalesController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/sales','index');
    Route::post('/sales/addCustomer', 'addCustomer');
    Route::post('/sales/findCustomer', 'findCustomer');
    Route::post('/sales/addSalesMaster', 'addSalesMaster');
    Route::post('/sales/addSalesDetail', 'addSalesDetail');
    Route::post('/sales/findSalesMaster', 'findSalesMaster');
    Route::post('/sales/detail', 'detail');
    Route::post('/sales/addScanItem', 'addScanItem');
    Route::post('/sales/addPayment', 'addPayment');
    Route::post('/sales/verifyMaster', 'verifyMaster');
    Route::post('/sales/print_invoice', 'print_invoice');
    Route::post('/sales/delete_detail', 'delete_detail');
});

Route::controller(StockOpnameMasterController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/stock-opname','getAllStockOpnameMaster');
    Route::post('/stock-opname/add', 'addStockOpnameMaster');
    Route::post('/stock-opname/loadDataMaster', 'loadDataMaster');
    Route::post('/stock-opname/loadDataDetailOnly', 'loadDataDetailOnly');
});

Route::controller(StockOpnameDetailController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/stock-opname/detail/{id}','getAllStockOpnameDetail');
    Route::post('/stock-opname/detail/add','addStockOpnameDetail');
    route::post('/stock-opname/detail/{id}/init-adjustment', 'initAdjustment');
    Route::post('/stock-opname/detail/{id}/make-adjustment', 'makeAdjustment');
    Route::post('/stock-opname/detail/{id}/loadDataMaster', 'loadDataMaster');
    Route::post('/stock-opname/detail/{id}/loadDataDetailOnly', 'loadDataDetailOnly');
    Route::post('/stock-opname/detail/edit', 'updateStockOpnameDetail');
});

Route::controller(StockOpnameBranchController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/stock-opname-branch','getAllStockOpnameBranch');
    Route::post('/stock-opname-branch/add', 'addStockOpnameBranch');
    Route::post('/stock-opname-branch/loadDataMaster', 'loadDataMaster');
    Route::post('/stock-opname-branch/loadDataDetailOnly', 'loadDataDetailOnly');
});

Route::controller(StockOpnameBranchDetailController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/stock-opname-branch/detail/{id}','getAllStockOpnameBranchDetail');
    Route::post('/stock-opname-branch/detail/add','addStockOpnameBranchDetail');
    route::post('/stock-opname-branch/detail/{id}/init-adjustment', 'initAdjustment');
    Route::post('/stock-opname-branch/detail/{id}/make-adjustment', 'makeAdjustment');
    Route::post('/stock-opname-branch/detail/{id}/loadDataMaster', 'loadDataMaster');
    Route::post('/stock-opname-branch/detail/{id}/loadDataDetailOnly', 'loadDataDetailOnly');
    Route::post('/stock-opname-branch/detail/edit', 'updateStockOpnameBranchDetail');
});

Route::controller(CustomerController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/customer','getAllCustomer');
    Route::post('/customer/add', 'addCustomer');
    Route::post('/customer/loadDataMaster', 'loadDataMaster');
    Route::post('/customer/loadDataDetailOnly', 'loadDataDetailOnly');
});

Route::controller(StockOpnameMasterController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/stock-opname','getAllStockOpnameMaster');
    Route::post('/stock-opname/add', 'addStockOpnameMaster');
    Route::post('/stock-opname/loadDataMaster', 'loadDataMaster');
    Route::post('/stock-opname/loadDataDetailOnly', 'loadDataDetailOnly');
});

Route::controller(StockOpnameDetailController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/stock-opname/detail/{id}','getAllStockOpnameDetail');
    Route::post('/stock-opname/detail/add','addStockOpnameDetail');
    route::post('/stock-opname/detail/{id}/init-adjustment', 'initAdjustment');
    Route::post('/stock-opname/detail/{id}/make-adjustment', 'makeAdjustment');
    Route::post('/stock-opname/detail/{id}/loadDataMaster', 'loadDataMaster');
    Route::post('/stock-opname/detail/{id}/loadDataDetailOnly', 'loadDataDetailOnly');
    Route::post('/stock-opname/detail/edit', 'updateStockOpnameDetail');
});

Route::controller(StockOpnameBranchController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/stock-opname-branch','getAllStockOpnameBranch');
    Route::post('/stock-opname-branch/add', 'addStockOpnameBranch');
    Route::post('/stock-opname-branch/loadDataMaster', 'loadDataMaster');
    Route::post('/stock-opname-branch/loadDataDetailOnly', 'loadDataDetailOnly');
});

Route::controller(StockOpnameBranchDetailController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/stock-opname-branch/detail/{id}','getAllStockOpnameBranchDetail');
    Route::post('/stock-opname-branch/detail/add','addStockOpnameBranchDetail');
    route::post('/stock-opname-branch/detail/{id}/init-adjustment', 'initAdjustment');
    Route::post('/stock-opname-branch/detail/{id}/make-adjustment', 'makeAdjustment');
    Route::post('/stock-opname-branch/detail/{id}/loadDataMaster', 'loadDataMaster');
    Route::post('/stock-opname-branch/detail/{id}/loadDataDetailOnly', 'loadDataDetailOnly');
    Route::post('/stock-opname-branch/detail/edit', 'updateStockOpnameBranchDetail');
});

Route::controller(CustomerController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/customer','getAllCustomer');
    Route::post('/customer/add', 'addCustomer');
    Route::post('/customer/loadDataMaster', 'loadDataMaster');
    Route::post('/customer/loadDataDetailOnly', 'loadDataDetailOnly');
});

Route::controller(KasController::class)->middleware('isTokenValid')->group(function(){
    Route::get('/kas','prosesKasBranch');
    Route::get('/kas/all','getAllKas');
    Route::post('/kas/addCashOut', 'addKasOut');
    Route::post('/kas/addCashIn', 'addKasIn');
    Route::post('/kas/newDaily', 'addNewDailyKas');
    Route::post('/kas/exist', 'checkKasIfExist');
    Route::post('/kas/loadDataMaster', 'loadDataMaster');
    Route::post('/kas/loadDataMasterCashOut', 'loadDataMasterCashOut');
    Route::post('/kas/loadDataMasterCashIn', 'loadDataMasterCashIn');
});

Route::group([], function(){
    Route::get('/login', function () {
        return view('login');
    });

    Route::get('/404', function () {
        return view('error_page.404');
    });

    Route::get('/505', function () {
        return view('error_page.505');
    });

});


Route::any('{any}', function () {
    return view('error_page.404');
})->where('any', '.*');



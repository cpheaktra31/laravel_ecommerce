<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProductInOutController;
use App\Http\Controllers\ProductOutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// admin
Route::middleware(['auth:sanctum'])->group(function () {
    // User
    Route::get('user/all', [AdminController::class, 'index'])->name('users.index');
    Route::get('user/get-data', [AdminController::class, 'getData'])->name('users.get-data');
    Route::get('user/{user}/edit', [AdminController::class, 'editUser']);
    Route::post('user/store', [AdminController::class, 'storeUser'])->name('users.store');
    Route::patch('user/{user}/update', [AdminController::class, 'updateUser']);
    Route::patch('user/change-password/{user}', [AdminController::class, 'changePassword']);
    Route::delete('user/{user}/delete', [AdminController::class, 'deleteUser']);
    // User

    // Category
    Route::get('category/get-data', [CategoryController::class, 'getData'])->name('category.get-data');
    Route::resource('category', CategoryController::class);
    // Category

    // Products
    Route::get('product/get-data', [ProductController::class, 'getData'])->name('product.get-data');
    Route::resource('product', ProductController::class);
    // Products

    // Dashboard
    Route::get('dash-board/get-monthly-stock', [DashboardController::class, 'getMonthlyStock'])->name('dash-board.get-monthly-stock');
    Route::get('dash-board/get-product-expire', [DashboardController::class, 'getProductExpire'])->name('dash-board.getProductExpire');
    // Dashboard
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

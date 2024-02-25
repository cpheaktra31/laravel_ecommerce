<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\BlogController;

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

    // Slide
    Route::get('slide/get-data', [SlideController::class, 'getData'])->name('slide.get-data');
    Route::post('slide/btn-active/{slide}', [SlideController::class, 'btnActive'])->name('slide.btn-active');
    Route::post('slide/btn-promotion/{slide}', [SlideController::class, 'btnPromotion'])->name('slide.btn-promotion');
    Route::resource('slide', SlideController::class);
    // Slide

    // Blogs
    Route::get('blog/get-data', [BlogController::class, 'getData'])->name('blog.get-data');
    Route::post('blog/btn-active/{blog}', [BlogController::class, 'btnActive'])->name('blog.btn-active');
    Route::resource('blog', BlogController::class);
    // Blogs

    // Dashboard
    Route::get('dash-board/get-monthly-stock', [DashboardController::class, 'getMonthlyStock'])->name('dash-board.get-monthly-stock');
    Route::get('dash-board/get-product-expire', [DashboardController::class, 'getProductExpire'])->name('dash-board.getProductExpire');
    // Dashboard
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

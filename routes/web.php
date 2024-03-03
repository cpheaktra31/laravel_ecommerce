<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Frontend\SlideController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\BlogController;

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

Route::get('/', function() {
    return view('frontend.index');
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('home');

Auth::routes();

Route::get('/dash-board', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum'])->group(function () {
});

// Route::get('/home', [HomeController::class, 'index'])->name('home');
// Route::get('/{menu_type}/{slug}', [HomeController::class, 'getUrl'])->name('url');

// Frontend
Route::get('frontend/slide/get-heroes', [SlideController::class,'getHeroes']);
Route::get('frontend/slide/get-promotion', [SlideController::class,'getPromotion']);

Route::get('frontend/product/get-feature-product', [ProductController::class,'getFeatureProduct']);
Route::get('frontend/product/get-latest-product', [ProductController::class,'getLatestProduct']);

Route::get('frontend/blog/get-blogs', [BlogController::class,'getBlogs']);
// Frontend

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

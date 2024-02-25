<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

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
    return view('auth.login');
})->name('home');

Auth::routes();

Route::get('/dash-board', [DashboardController::class, 'index'])->name('dashboard');
Route::middleware(['auth:sanctum'])->group(function () {
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/{menu_type}/{slug}', [HomeController::class, 'getUrl'])->name('url');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

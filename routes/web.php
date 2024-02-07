<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

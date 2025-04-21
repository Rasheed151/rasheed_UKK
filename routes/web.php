<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use Illuminate\Support\Facades\Route;

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
    return view('users.index');
});

Route::middleware(['guest.page'])->group(function(){
    Route::get('/login',[loginController::class,'index']);
    Route::post('/login',[loginController::class,'login'])->name('login');
    Route::get('/register',[registerController::class,'index']);
    Route::post('/register',[registerController::class,'register'])->name('register');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware(['login.required'])->group(function(){
    
});
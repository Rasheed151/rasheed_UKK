<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\roomController;
use App\Http\Controllers\bookingController;
use App\Http\Controllers\transactionController;
use App\Http\Controllers\receptionistController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\SecondAdminController;
use App\Http\Controllers\printController;
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

Route::get('/', function () {return view('users.index');})->name('home');
Route::resource('/room', roomController::class);

Route::middleware(['guest.custom'])->group(function () {
    Route::get('/login',[loginController::class,'index'])->name('login.form');
    Route::post('/login',[loginController::class,'login'])->name('login');
    Route::get('/register',[registerController::class,'index']);
    Route::post('/register',[registerController::class,'register'])->name('register');
});

Route::middleware(['login.required'])->group(function(){
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::resource('/booking', bookingController::class);
    Route::resource('/transaction', transactionController::class);

    Route::get('/data_reservasi/{Id}', [printController::class, 'print'])->name('print');

    Route::middleware(['receptionist.required'])->group(function(){

        Route::resource('/receptionist', receptionistController::class);
    
    });

    Route::middleware(['admin.required'])->group(function(){

        Route::resource('/admin', adminController::class);
        Route::resource('/adminRoom', SecondAdminController::class);
    
    });

});







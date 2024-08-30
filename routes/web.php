<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
// use App\Http\Controllers\SessionController;
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

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSimpan')->name('register.simpan');
    Route::get('', 'login')->name('login');
    Route::post('login', 'loginAksi')->name('login.aksi');
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'Dashboard'])->name('Dashboard');
        Route::get('create/view', [AdminController::class, 'CreateProductView'])->name('CreateProductView');
        Route::post('create/product', [AdminController::class, 'CreateProduct'])->name('CreateProductProcess');
        Route::delete('delete/product/{id}', [AdminController::class, 'DeleteProduct'])->name('DeleteProduct');
        Route::get('edit/product/view/{id}', [AdminController::class, 'EditProductView'])->name('EditProductView');
        Route::put('edit/product/{id}', [AdminController::class, 'EditProduct'])->name('EditProductProcess');
        Route::get('order/product/view', [CashierController::class, 'OrderView'])->name('OrderProductView');
        Route::post('order/product/{id}', [CashierController::class, 'OrderProduct'])->name('OrderProductProcess');
        Route::delete('delete/pending/order/{id}', [CashierController::class, 'DeletePendingProduct'])->name('DeletePendingProduct');
        
    });
});

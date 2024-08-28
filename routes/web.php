<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

// Route::get('', [AdminController::class, 'CreateProductView'])->name('CreateProductView');
// Route::post('admin/create/product', [AdminController::class, 'CreateProduct'])->name('CreateProductProcess');
// Route::delete('admin/delete/product/{id}', [AdminController::class, 'DeleteProduct'])->name('DeleteProduct');
// Route::get('admin/edit/product/view/{id}', [AdminController::class, 'EditProductView'])->name('EditProductView');
// Route::put('admin/edit/product/{id}', [AdminController::class, 'EditProduct'])->name('EditProductProcess');


Route::controller(AuthController::class)->group(function () {
	Route::get('register', 'register')->name('register');
	Route::post('register', 'registerSimpan')->name('register.simpan');
	Route::get('', 'login')->name('login');
	Route::post('login', 'loginAksi')->name('login.aksi');
	Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');
});

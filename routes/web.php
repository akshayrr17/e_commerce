<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'index']);


Route::get('dashboard',[AdminController::class,'index']);

//login

Route::get('login',[AdminController::class,'login_form'])->name('login');
Route::post('post_login',[AdminController::class,'login']);

Route::middleware('auth')->group(function () {
//category

Route::get('categories/create',[CategoryController::class,'create'])->name('categories.create');
Route::get('categories/index',[CategoryController::class,'index'])->name('categories.index');
Route::post('categories/store',[CategoryController::class,'store'])->name('categories.store');
Route::get('categories/edit/{id}',[CategoryController::class,'edit'])->name('categories.edit');
Route::post('categories/update/{id}',[CategoryController::class,'update'])->name('categories.update');
Route::get('categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

//product

Route::get('products/create',[ProductController::class,'create'])->name('products.create');
Route::post('products/store',[ProductController::class,'store'])->name('products.store');
Route::get('products/index',[ProductController::class,'index'])->name('products.index');
Route::get('products/edit/{id}',[ProductController::class,'edit'])->name('products.edit');
Route::post('products/update/{id}',[ProductController::class,'update'])->name('products.update');
Route::get('products/delete/{id}',[ProductController::class,'delete'])->name('products.delete');

Route::get('/logout', [AdminController::class, 'logout'])->name('logout');


});

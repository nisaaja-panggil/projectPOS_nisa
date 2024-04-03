<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\Controllers\Middleware;
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
    return view('dashboard',[
        "title"=>"Dashboard"
    ]);
})->Middleware('auth');
Route::resource('kategori',CategoryController::class)->except('show','destroy','create')->Middleware('auth');
Route::resource('pelanggan',CustomerController::class)->except('destroy')->Middleware('auth');
Route::resource('product',ProductController::class)->Middleware('auth');
Route::resource('user',UserController::class)->except('show','destroy','create','update','edit')->Middleware('auth');
Route::get('login',[LoginController::class,'loginView'])->name('login');
route::post('login',[LoginController::class,'authenticate']);
Route::post('logout',[LoginController::class,'logout'])->middleware('auth');
Route::get('penjualan',function(){
    return view('penjualan.index',[
        "title"=>"penjualan"
    ]);
})->middleware('auth');
Route::get('order',function(){
    return view('penjualan.orders',[
        "title"=>"order"
    ]);
})->middleware('auth');
Route::get('cetakReceipt',[CetakController::class,'receipt'])->name('cetakReceipt')->middleware('auth');
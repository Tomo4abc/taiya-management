<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/itemlist', [App\Http\Controllers\ItemController::class, 'itemlist'])->name('itemlist');
Route::get('/item/create', [App\Http\Controllers\ItemController::class, 'create'])->name('item/create');
Route::post('/item', [App\Http\Controllers\ItemController::class, 'store'])->name('item');
Route::get('/detail/{id}', [App\Http\Controllers\ItemController::class, 'detail'])->name('detail');
Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('update');
// Route::get('/itemlist', [App\Http\Controllers\ItemController::class, 'itemlist'])->name('itemlist');


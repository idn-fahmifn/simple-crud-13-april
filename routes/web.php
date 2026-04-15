<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routing Category
Route::get('/category', [CategoryController::class, 'index'])
->name('category.index');

Route::post('/category', [CategoryController::class, 'store'])
->name('category.store');

Route::get('/category/{param}', [CategoryController::class, 'show'])
->name('category.show');

Route::put('/category/{param}', [CategoryController::class, 'update'])
->name('category.update');

Route::delete('/category/{param}', [CategoryController::class, 'destroy'])
->name('category.destroy');

// Route Item
Route::get('/item', [ItemController::class, 'index'])
->name('item.index');

Route::post('/item', [ItemController::class, 'store'])
->name('item.store');

Route::get('/item/{param}', [ItemController::class, 'show'])
->name('item.show');

Route::put('/item/{param}', [ItemController::class, 'update'])
->name('item.update');

Route::delete('/item/{param}', [ItemController::class, 'destroy'])
->name('item.destroy');

// untuk menghapus : 
/**
 * hapus biasa / delete => delete
 * restore => method put / patch dengan parameter => sama seperti show
 * melihat history => method get.
 */




// ini khusus untuk statis dan sifatnya semntara
Route::view('tampilan', 'template.app');
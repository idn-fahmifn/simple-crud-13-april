<?php

use App\Http\Controllers\CategoryController;
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





// ini khusus untuk statis dan sifatnya semntara
Route::view('tampilan', 'template.app');
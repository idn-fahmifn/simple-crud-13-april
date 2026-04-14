<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// ini khusus untuk statis dan sifatnya semntara
Route::view('tampilan', 'template.app');
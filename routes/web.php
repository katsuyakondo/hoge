<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('my_home');
});

<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('my_home');
});

Route::post('/chat', 'App\Http\Controllers\ChatController@sendToAI');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('my_home');
});

Route::post('/chat', 'App\Http\Controllers\ChatController@sendToAI');
// チャットAPIへのPOSTリクエストを処理するルート
Route::post('/send-chat', [ChatController::class, 'sendChat']);

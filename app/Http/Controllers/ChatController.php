<?php

namespace App\Http\Controllers; // 適切な名前空間を設定

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller // Controllerクラスを継承
{
public function sendToAI(Request $request) {
    $input = $request->input('userInput');
    $apiKey = env('OPENAI_API_KEY'); // .envからAPIキーを取得

    // OpenAI APIへのリクエストを送信
    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . $apiKey,
        'Content-Type' => 'application/json',
    ])->post('https://api.openai.com/v1/chat/completions', [
        "model" => "gpt-4",
        "messages" => [
            ["role" => "user", "content" => $input]
        ]
    ]);

    // APIからのレスポンスをチェックし、エラー処理をここに追加できます
    // 例えば、if ($response->failed()) { ... }

    // レスポンスをクライアントに返送
    return $response->json();
    }
}
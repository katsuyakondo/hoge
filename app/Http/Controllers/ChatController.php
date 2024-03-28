<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator; // バリデーションのために追加

class ChatController extends Controller
{
    public function sendToAI(Request $request)
    {
        // ユーザー入力のバリデーション
        $validator = Validator::make($request->all(), [
            'userInput' => 'required|string|max:255',
        ]);

        // バリデーションエラーの場合は、エラーメッセージを返す
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 400);
        }

        $input = $request->input('userInput');
        // config/services.phpで定義したAPIキーを使用する
        $apiKey = config('services.openai.key'); // .envやconfig/services.phpからAPIキーを取得

        // OpenAI APIへのリクエストを送信
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post('https://api.openai.com/v1/chat/completions', [
            "model" => "gpt-4",
            "messages" => [
                ["role" => "user", "content" => $input]
            ]
        ]);

        // APIからのレスポンスが失敗した場合にエラーレスポンスを返す
        if ($response->failed()) {
            return response()->json(["error" => "API request failed"], 500);
        }

        // レスポンスをクライアントに返送
        return $response->json();
    }
}

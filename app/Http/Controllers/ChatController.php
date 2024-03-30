<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
        $apiKey = config('services.openai.key');

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
            $statusCode = $response->status();
            $errorResponse = $response->body();

            Log::error("API request failed with status {$statusCode}: {$errorResponse}");

            // エラーレスポンスボディをクライアントに返送
            return response()->json([
                "error" => "API request failed",
                "statusCode" => $statusCode,
                "errorDetails" => json_decode($errorResponse, true)
            ], 500);
        }

        // レスポンスをクライアントに返送
        return $response->json();
    }
}

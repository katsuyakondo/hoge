<?php

// ユーザーからの入力を取得
$userInput = $_POST['userInput'];

// 環境変数からOpenAI APIキーを取得
$apiKey = getenv('OPENAI_API_KEY');

// OpenAI APIへのリクエストを設定
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    "model" => "gpt-4",
    "messages" => [
        ["role" => "user", "content" => $userInput]
    ]
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
]);

// APIからのレスポンスを取得し、結果を出力
$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
echo $response;
?>

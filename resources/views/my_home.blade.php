<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/textinput.css" />
</head>

<body>
    <div class="android-large">
        <div class="overlap-group">
            <div class="frame">
                <div class="text-wrapper">
                    <textarea id="auto-focus-field" name="input"
                        placeholder="今感じていることを言葉を選ばなくても良いから思いのままぶつけてほしい！"></textarea>
                </div>
            </div>
            <input type="button" id="sendButton" value="送信する">
            <div id="aiResponse"></div>
        </div>
    </div>
</body>

<script>
    async function sendToAI() {
    const input = document.getElementById('auto-focus-field').value;
    // URLをLaravelのルーティングに合わせて'/chat'に変更
    const response = await fetch('/chat', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json', // ヘッダーをJSONに変更
        },
        body: JSON.stringify({
            userInput: input // ボディの形式もJSONに合わせて修正
        })
    });
    const data = await response.json();
    document.getElementById('aiResponse').innerText = data.choices[0].message.content;
}

</script>
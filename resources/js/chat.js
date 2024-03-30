
document.addEventListener('DOMContentLoaded', function () {
    // テキストエリアにフォーカスを当て、プレースホルダーをクリア
    var inputField = document.getElementById('auto-focus-field');
    inputField.focus();
    setTimeout(function () {
        inputField.placeholder = '';
    }, 1000);

    // 送信ボタンクリックイベントの設定
    const sendButton = document.getElementById('sendButton');
    sendButton.addEventListener('click', function () {
        const userInput = document.getElementById('auto-focus-field').value;
         console.log("Sending to AI:", userInput); // ユーザー入力のログ
        sendToAI(userInput);
    });
});

async function sendToAI(userInput) {
        console.log("sendToAI called with input:", userInput); // 関数が呼び出されたことをログに記録
    try {
        const response = await fetch('/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: `userInput=${encodeURIComponent(userInput)}`
        });

        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }

        const data = await response.json();
        console.log("Response from AI:", data); // APIからのレスポンスのログ
        document.getElementById('aiResponse').innerText = data.choices[0].message.content;
    } catch (error) {
        console.error('Error:', error);
    }
}

document.getElementById('loadWeather').addEventListener('click', function() {
    fetch('/weather')
        .then(response => response.json())
        .then(data => {
            document.getElementById('weatherResult').innerText = JSON.stringify(data, null, 2);
        })
        .catch(error => console.error('Error:', error));
});

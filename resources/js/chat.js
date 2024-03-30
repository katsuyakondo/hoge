document.addEventListener('DOMContentLoaded', function () {
    var inputField = document.getElementById('auto-focus-field');
    inputField.focus();
    setTimeout(function () {
        inputField.placeholder = '';
    }, 1000);

    const sendButton = document.getElementById('sendButton');
    sendButton.addEventListener('click', function () {
        const userInput = document.getElementById('auto-focus-field').value;
        sendToAI(userInput);
    });
});

async function sendToAI(userInput) {
    try {
        const response = await fetch('/send-chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: `userInput=${encodeURIComponent(userInput)}`
        });

        const data = await response.json(); // レスポンスのJSONを常に先にパースする

        if (!response.ok) {
            // エラーレスポンスの内容を利用して、エラーメッセージを表示
            console.error('Error Response:', data);
            // エラーメッセージをUIに表示する例
            document.getElementById('aiResponse').innerText = data.error ? data.error : 'Unknown error occurred';
            return; // ここで処理を終了
        }

        // 成功した場合の処理
        document.getElementById('aiResponse').innerText = data.choices[0].message.content;
    } catch (error) {
        console.error('Error:', error);
        // ネットワークエラーなどの場合に、エラーメッセージをUIに表示する例
        document.getElementById('aiResponse').innerText = 'Error sending request.';
    }
}

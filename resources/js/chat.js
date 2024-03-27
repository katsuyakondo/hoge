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

        if (!response.ok) {
            throw new Error('Network response was not ok.');
        }

        const data = await response.json();
        document.getElementById('aiResponse').innerText = data.choices[0].message.content;
    } catch (error) {
        console.error('Error:', error);
    }
}

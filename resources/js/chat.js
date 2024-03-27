window.onload = function () {
    var inputField = document.getElementById('auto-focus-field');
    inputField.focus();
    setTimeout(function () {
        inputField.placeholder = '';
    }, 1000);

    document.getElementById('sendButton').onclick = function () {
        sendToAI();
    };
};

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

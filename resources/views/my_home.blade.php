<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/chat.js'])
    @vite(['resources/css/textinput.css'])
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




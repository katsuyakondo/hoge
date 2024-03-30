<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
</head>

<body>
    <div class="android-large">
        <div class="overlap">

            <div class="rectangle"></div>
            <img class="element" src="{{ asset('image/logo.png') }}" />
            <div class="div">嫌な気持ちをすべてぶつけてみて！<br />なんでも言って！</div>
            <div class="group">
                <div class="overlap-group-wrapper">
                    <div class="overlap-group">
                        <div class="div-wrapper">
                            <a href="{{ url('voice_Page2.html') }}" class="text-wrapper-2">声でぶつけてみる</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="group-wrapper">
                <div class="overlap-group-wrapper">
                    <div class="div-wrapper">
                        <a href="{{ url('textinput.html') }}" class="text-wrapper-3">テキストでぶつけてみる</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>




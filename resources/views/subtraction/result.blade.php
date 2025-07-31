<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>結果 - 減法問題</title>
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <h1>結果発表</h1>
        <div class="result">
            <p>
                問題：{{ $problem->minuend }} - {{ $problem->subtrahend }} = ?
            </p>
            <p>
                あなたのこたえ：<strong>{{ $userAnswer }}</strong>
            </p>
            <p>
                正しいこたえ：<strong>{{ $problem->answer }}</strong>
            </p>
            <p>
                @if($isCorrect)
                    <span style="color:green; font-weight:bold;">せいかい！</span>
                @else
                    <span style="color:red; font-weight:bold;">ざんねん…もういちどチャレンジ！</span>
                @endif
            </p>
        </div>
        <a href="/" class="next-btn">つぎのもんだいへ</a>
        <a href="history" class="history-btn">これまでのれきしを見る</a>
    </div>
</body>
</html>

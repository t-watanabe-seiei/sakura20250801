<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>けっか- ひきざんのもんだい</title>
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <h1>けっかはっぴょう</h1>
        <div class="result">
            <p>
                もんだい：{{ $problem->minuend }} - {{ $problem->subtrahend }} = ?
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
        <a href="{{ config('app.mix_url') }}" class="next-btn">つぎのもんだいへ</a>
        <a href="history" class="history-btn">これまでのけっかをみる</a>
    </div>
</body>
</html>

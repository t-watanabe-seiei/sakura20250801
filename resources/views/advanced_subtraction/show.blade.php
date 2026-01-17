<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ひきざん（むずかしいレベル） - 小学１年生用</title>
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <h1>ひきざんにチャレンジ！（むずかしいレベル）</h1>
        <form method="POST" action="{{ route('advanced.answer') }}">
            @csrf
            <div class="problem">
                <span class="minuend">{{ $problem->minuend }}</span>
                <span> - </span>
                <span class="subtrahend">{{ $problem->subtrahend }}</span>
                <span> = </span>
                <input type="hidden" name="minuend" value="{{ $problem->minuend }}">
                <input type="hidden" name="subtrahend" value="{{ $problem->subtrahend }}">
                <div class="choice-buttons">
                    @php
                        $choices = [];
                        $answer = $problem->answer;
                        $choices[] = $answer;
                        // 10～18の範囲で他の選択肢を生成
                        $pool = range(2, 18);
                        if(($key = array_search($answer, $pool)) !== false) {
                            unset($pool[$key]);
                        }
                        $pool = array_values($pool);
                        while(count($choices) < 6 && count($pool) > 0) {
                            $randKey = array_rand($pool);
                            $choices[] = $pool[$randKey];
                            unset($pool[$randKey]);
                            $pool = array_values($pool);
                        }
                        shuffle($choices);
                        $colors = ['#ffb6c1', '#ffd700', '#90ee90', '#87cefa', '#ffa07a', '#dda0dd'];
                    @endphp
                    @foreach($choices as $i => $choice)
                        <button type="submit" name="answer" value="{{ $choice }}" class="choice-btn color-{{ $i }}">
                            {{ $choice }}
                        </button>
                    @endforeach
                </div>
            </div>
        </form>
        <a href="{{ config('app.mix_url') }}" class="back-btn">かんたんなレベルにもどる</a>
    </div>
</body>
</html>

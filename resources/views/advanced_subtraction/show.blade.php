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
                        
                        // 正解の前後の数字を選択肢にする（負の数を避ける）
                        // 正解の±1, ±2, ±3から選択
                        $offsets = [-3, -2, -1, 1, 2, 3];
                        foreach($offsets as $offset) {
                            $candidate = $answer + $offset;
                            // 0以上18以下の範囲で追加
                            if ($candidate >= 0 && $candidate <= 18 && !in_array($candidate, $choices)) {
                                $choices[] = $candidate;
                            }
                        }
                        
                        // 足りない場合は範囲内から追加
                        while(count($choices) < 6) {
                            $candidate = rand(max(0, $answer - 5), min(18, $answer + 5));
                            if (!in_array($candidate, $choices)) {
                                $choices[] = $candidate;
                            }
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
    
    <!-- キーボード入力オプション -->
    <script>
        // 数字キーでの回答を可能にする
        document.addEventListener('keydown', function(e) {
            const key = e.key;
            // 0-9のキーまたはテンキー
            if (key >= '0' && key <= '9') {
                const buttons = document.querySelectorAll('.choice-btn');
                buttons.forEach(button => {
                    if (button.value === key) {
                        button.click();
                    }
                });
            }
        });
    </script>
</body>
</html>

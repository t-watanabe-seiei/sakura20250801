<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ひきざん - 小学１年生用</title>
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <h1>ひきざんにチャレンジ！</h1>
        <p><a href="{{ route('advanced.show') }}" style="color: #007bff;">むずかしいレベルにチャレンジ</a></p>
        <form method="POST" action="{{ route('subtraction.answer') }}">
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
                        $pool = range(1, 9);
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

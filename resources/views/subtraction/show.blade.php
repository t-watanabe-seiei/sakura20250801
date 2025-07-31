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
        <form method="POST" action="answer">
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
                        $min = max(0, $answer - 3);
                        $max = min($problem->minuend, $answer + 3);
                        while(count($choices) < 6) {
                            $rand = rand($min, $max);
                            if(!in_array($rand, $choices)) $choices[] = $rand;
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
</body>
</html>

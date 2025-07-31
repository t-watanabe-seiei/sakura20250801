<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>解答履歴 - 減法問題</title>
<!-- Styles -->
<link rel="stylesheet" href="{{ config('app.mix_url') . mix('css/app.css') }}">
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <h1>これまでの解答履歴</h1>
        <table border="1" style="width:100%; text-align:center;">
            <thead>
                <tr>
                    <th>日付</th>
                    <th>問題</th>
                    <th>あなたのこたえ</th>
                    <th>正しいこたえ</th>
                    <th>結果</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                <tr>
                    <td>{{ $history->created_at }}</td>
                    <td>{{ $history->minuend }} - {{ $history->subtrahend }}</td>
                    <td>{{ $history->user_answer }}</td>
                    <td>{{ $history->correct_answer }}</td>
                    <td>
                        @if($history->is_correct)
                            <span style="color:green;">○</span>
                        @else
                            <span style="color:red;">×</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="/" class="next-btn">もんだいに戻る</a>
    </div>
</body>
</html>

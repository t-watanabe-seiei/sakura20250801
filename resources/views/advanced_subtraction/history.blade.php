<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>解答履歴 - 減法問題（むずかしいレベル）</title>
<!-- Styles -->
<link rel="stylesheet" href="{{ mix('css/app.css') }}">
<!-- Scripts -->
<script src="{{ mix('js/app.js') }}" defer></script>
<style>
    .stats-section {
        margin: 20px 0;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }
    .stats-table {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }
    .stats-table th, .stats-table td {
        padding: 8px;
        text-align: center;
        border: 1px solid #dee2e6;
    }
    .stats-table th {
        background-color: #e9ecef;
    }
    .pagination {
        display: flex;
        justify-content: center;
        list-style: none;
        padding: 0;
        margin: 20px 0;
        gap: 5px;
    }
    .pagination li {
        display: inline;
    }
    .pagination a, .pagination span {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        text-decoration: none;
        color: #007bff;
    }
    .pagination .active span {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
    .pagination .disabled span {
        color: #6c757d;
        cursor: not-allowed;
    }
    .reset-btn {
        background-color: #dc3545;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin: 10px 0;
    }
    .reset-btn:hover {
        background-color: #c82333;
    }
    .message {
        padding: 10px;
        margin: 10px 0;
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>これまでの解答履歴（むずかしいレベル）</h1>
        
        @if(session('message'))
            <div class="message">{{ session('message') }}</div>
        @endif
        
        <div class="stats-section">
            <h2>日付ごとの正答率</h2>
            <table class="stats-table">
                <thead>
                    <tr>
                        <th>日付</th>
                        <th>解答数</th>
                        <th>正解数</th>
                        <th>正答率</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dailyStats as $stat)
                    <tr>
                        <td>{{ $stat->date }}</td>
                        <td>{{ $stat->total }}</td>
                        <td>{{ $stat->correct }}</td>
                        <td><strong>{{ $stat->accuracy }}%</strong></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">まだ履歴がありません</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h2>解答履歴一覧</h2>
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
                @forelse($histories as $history)
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
                @empty
                <tr>
                    <td colspan="5">まだ履歴がありません</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="pagination">
            {{ $histories->links() }}
        </div>
        
        <a href="{{ route('advanced.show') }}" class="next-btn">もんだいにもどる</a>
        <a href="{{ route('subtraction.show') }}" class="back-btn">かんたんなレベルにもどる</a>
        
        <form method="POST" action="{{ route('advanced.reset') }}" style="display:inline;" onsubmit="return confirm('本当に履歴を削除しますか？');">
            @csrf
            <button type="submit" class="reset-btn">履歴をリセット</button>
        </form>
    </div>
</body>
</html>

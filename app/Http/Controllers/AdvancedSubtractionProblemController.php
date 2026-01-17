<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvancedSubtractionProblem;
use Illuminate\Support\Facades\DB;

class AdvancedSubtractionProblemController extends Controller
{
    // 問題出題
    public function show()
    {
        $problem = AdvancedSubtractionProblem::generate();
        return view('advanced_subtraction.show', ['problem' => $problem]);
    }

    // 解答判定・履歴保存
    public function answer(Request $request)
    {
        $minuend = $request->input('minuend');
        $subtrahend = $request->input('subtrahend');
        $userAnswer = $request->input('answer');
        $problem = new AdvancedSubtractionProblem($minuend, $subtrahend);
        $isCorrect = ((int)$userAnswer === $problem->answer);

        // 連続正解カウント（むずかしいレベル用）
        $correctStreak = $request->session()->get('advanced_correct_streak', 0);
        if ($isCorrect) {
            $correctStreak++;
        } else {
            $correctStreak = 0;
        }
        $request->session()->put('advanced_correct_streak', $correctStreak);

        // 履歴保存（匿名、IPやセッションIDで管理可能）
        $sessionId = $request->session()->getId();
        DB::table('advanced_subtraction_histories')->insert([
            'minuend' => $minuend,
            'subtrahend' => $subtrahend,
            'user_answer' => $userAnswer,
            'correct_answer' => $problem->answer,
            'is_correct' => $isCorrect,
            'session_id' => $sessionId,
            'created_at' => now(),
        ]);

        return view('advanced_subtraction.result', [
            'problem' => $problem,
            'userAnswer' => $userAnswer,
            'isCorrect' => $isCorrect,
            'correctStreak' => $correctStreak
        ]);
    }

    // 履歴一覧
    public function history()
    {
        $histories = DB::table('advanced_subtraction_histories')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // 日付ごとの正答率を計算
        $dailyStats = DB::table('advanced_subtraction_histories')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total, SUM(is_correct) as correct')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function($stat) {
                $stat->accuracy = $stat->total > 0 ? round(($stat->correct / $stat->total) * 100, 1) : 0;
                return $stat;
            });
        
        return view('advanced_subtraction.history', [
            'histories' => $histories,
            'dailyStats' => $dailyStats
        ]);
    }

    // 履歴リセット
    public function resetHistory(Request $request)
    {
        $sessionId = $request->session()->getId();
        DB::table('advanced_subtraction_histories')
            ->where('session_id', $sessionId)
            ->delete();
        
        return redirect()->route('advanced.history')
            ->with('message', '履歴をリセットしました');
    }
}

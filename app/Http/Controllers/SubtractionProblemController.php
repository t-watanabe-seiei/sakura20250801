<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubtractionProblem;
use Illuminate\Support\Facades\DB;

class SubtractionProblemController extends Controller
{
    // 問題出題
    public function show()
    {
        $problem = SubtractionProblem::generate();
        return view('subtraction.show', ['problem' => $problem]);
    }

    // 解答判定・履歴保存
    public function answer(Request $request)
    {
        $minuend = $request->input('minuend');
        $subtrahend = $request->input('subtrahend');
        $userAnswer = $request->input('answer');
        $problem = new SubtractionProblem($minuend, $subtrahend);
        $isCorrect = ((int)$userAnswer === $problem->answer);

        // 履歴保存（匿名、IPやセッションIDで管理可能）
        $sessionId = $request->session()->getId();
        DB::table('subtraction_histories')->insert([
            'minuend' => $minuend,
            'subtrahend' => $subtrahend,
            'user_answer' => $userAnswer,
            'correct_answer' => $problem->answer,
            'is_correct' => $isCorrect,
            'session_id' => $sessionId,
            'created_at' => now(),
        ]);

        return view('subtraction.result', [
            'problem' => $problem,
            'userAnswer' => $userAnswer,
            'isCorrect' => $isCorrect
        ]);
    }

    // 履歴一覧
    public function history()
    {
        $histories = DB::table('subtraction_histories')->orderBy('created_at', 'desc')->get();
        return view('subtraction.history', ['histories' => $histories]);
    }
}

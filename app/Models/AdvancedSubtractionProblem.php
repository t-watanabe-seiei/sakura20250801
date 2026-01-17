<?php

namespace App\Models;

class AdvancedSubtractionProblem
{
    public $minuend; // 被減数（10～18）
    public $subtrahend; // 減数（適切に調整）
    public $answer;

    public function __construct($minuend, $subtrahend)
    {
        $this->minuend = $minuend;
        $this->subtrahend = $subtrahend;
        $this->answer = $minuend - $subtrahend;
    }

    // ランダムな減法問題を生成（答えが1桁になるように調整）
    public static function generate()
    {
        // 答えを1～9の範囲で決める
        $answer = rand(1, 9);
        // 被減数を10～18の範囲で決める
        $minuend = rand(10, 18);
        // 減数を逆算（答えが1桁になるように）
        $subtrahend = $minuend - $answer;
        
        // 減数が10以上になる場合は調整
        if ($subtrahend >= 10) {
            // 被減数を小さくして減数が1桁になるようにする
            $minuend = $answer + rand(1, 9);
            $subtrahend = $minuend - $answer;
        }
        
        return new self($minuend, $subtrahend);
    }
}

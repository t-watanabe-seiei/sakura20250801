<?php

namespace App\Models;

class AdvancedSubtractionProblem
{
    public $minuend; // 被減数（11～19）
    public $subtrahend; // 減数（1～9）
    public $answer;

    public function __construct($minuend, $subtrahend)
    {
        $this->minuend = $minuend;
        $this->subtrahend = $subtrahend;
        $this->answer = $minuend - $subtrahend;
    }

    // ランダムな減法問題を生成（11～19から1～9を引く）
    public static function generate()
    {
        $minuend = rand(11, 19);
        $subtrahend = rand(1, 9);
        return new self($minuend, $subtrahend);
    }
}

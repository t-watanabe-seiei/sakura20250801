<?php

namespace App\Models;

class SubtractionProblem
{
    public $minuend; // 被減数（10以下）
    public $subtrahend; // 減数（1位数）
    public $answer;

    public function __construct($minuend, $subtrahend)
    {
        $this->minuend = $minuend;
        $this->subtrahend = $subtrahend;
        $this->answer = $minuend - $subtrahend;
    }

    // ランダムな減法問題を生成
    public static function generate()
    {
        $minuend = rand(1, 10);
        $subtrahend = rand(1, $minuend); // 答えが負にならないように
        return new self($minuend, $subtrahend);
    }
}

<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\SubtractionProblem;

class SubtractionProblemTest extends TestCase
{
    public function test_generate_problem_range()
    {
        for ($i = 0; $i < 100; $i++) {
            $problem = SubtractionProblem::generate();
            $this->assertGreaterThanOrEqual(1, $problem->minuend);
            $this->assertLessThanOrEqual(10, $problem->minuend);
            $this->assertGreaterThanOrEqual(1, $problem->subtrahend);
            $this->assertLessThanOrEqual($problem->minuend, $problem->subtrahend);
            $this->assertEquals($problem->minuend - $problem->subtrahend, $problem->answer);
        }
    }
}

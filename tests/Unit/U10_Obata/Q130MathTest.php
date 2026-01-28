<?php

namespace Tests\Unit\U10_Obata;

use PHPUnit\Framework\TestCase;

class Q130MathTest extends TestCase
{
    public function test_130_010(): void
    {
        $r = 1 + 1;

        // QUESTION
		$a = null;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_130_020(): void
    {
        $r = 1 - 1;

        // QUESTION
		$a = null;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_130_030(): void
    {
        $r = 1 * 2;

        // QUESTION
		$a = null;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_130_040(): void
    {
        $r = 4 / 2;

        // QUESTION
		$a = null;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_130_050(): void
    {
        $r = 4 % 3;

        // QUESTION
		$a = null;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_130_060(): void
    {
        $r = 5 % 3;

        // QUESTION
		$a = null;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_130_070(): void
    {
        $r = 6 % 3;

        // QUESTION
		$a = null;
        // /QUESTION

        $this->assertSame($a, $r);
    }
}


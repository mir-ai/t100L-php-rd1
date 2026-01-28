<?php

namespace Tests\Unit\U01_Answer;

use PHPUnit\Framework\TestCase;

class U120BoolTest extends TestCase
{
    public function test_120_010(): void
    {
        $r = true;
        $r = ! $r;

        // QUESTION
        $a = false;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_120_020(): void
    {
        $r = false;
        $r = ! $r;

        // QUESTION
        $a = true;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_120_030(): void
    {
        $r = true && true;

        // QUESTION
        $a = true;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_120_040(): void
    {
        $r = true && false;

        // QUESTION
        $a = false;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_120_050(): void
    {
        $r = true || true;

        // QUESTION
        $a = true;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_120_060(): void
    {
        $r = true || false;

        // QUESTION
        $a = true;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_120_070(): void
    {
        $r = false || true;

        // QUESTION
        $a = true;
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_120_080(): void
    {
        $r = false || false;

        // QUESTION
        $a = false;
        // /QUESTION

        $this->assertSame($a, $r);
    }
}


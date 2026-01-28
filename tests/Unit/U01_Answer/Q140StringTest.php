<?php

namespace Tests\Unit\U01_Answer;

use PHPUnit\Framework\TestCase;

class Q140StringTest extends TestCase
{
    public function test_140_010(): void
    {
        $r = 'abc';

        // QUESTION
        $a = 'abc';
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_140_020(): void
    {
        $r = "abc";

        // QUESTION
        $a = 'abc';
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_140_030(): void
    {
        $n = 1;
        $r = 'abc{$n}';

        // QUESTION
        $a = 'abc{$n}';
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_140_040(): void
    {
        $n = 1;
        $r = "abc{$n}";

        // QUESTION
        $a = 'abc1';
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_140_050(): void
    {
        $s = 'def';
        $r = "abc{$s}";

        // QUESTION
        $a = 'abcdef';
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_140_060(): void
    {
        $r = 'a' . 'b' . 'c';

        // QUESTION
        $a = 'abc';
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_140_070(): void
    {
        $r = 'a' . 'b' . 'c' . 1 . 2 . 3;

        // QUESTION
        $a = 'abc123';
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_140_080(): void
    {
        $r = '\n';

        // QUESTION
        $a = '\n';
        // /QUESTION

        $this->assertSame($a, $r);
    }

    public function test_140_090(): void
    {
        $r = ("\n" == '\n');

        // QUESTION
        $a = false;
        // /QUESTION
        
        $this->assertSame($a, $r);
    }

    public function test_140_100(): void
    {
        $r = ('"' == "\"");

        // QUESTION
        $a = true;
        // /QUESTION

        $this->assertSame($a, $r); // "
    }

    public function test_140_110(): void
    {
        $r = ("'" == '\'');

        // QUESTION
        $a = true;
        // /QUESTION

        $this->assertSame($a, $r); // '
    }
}


<?php

namespace Tests\Feature\Laravel;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Lib\Mir\MirChrome;

class OnceTest extends TestCase
{
    public function test_once_plus1(): void
    {
        $ans1 = $this->getPlus1(1);
        logger("$ans1");

        $ans2 = $this->getPlus1(2);
        logger("$ans2");

        $ans3 = $this->getPlus1(3);
        logger("$ans3");

        $ans4 = $this->getPlus1(1);
        logger("$ans4");

        $ans5 = $this->getPlus1(2);
        logger("$ans5");

        $ans6 = $this->getPlus1(3);
        logger("$ans6");

        $this->assertTrue($ans1 != $ans2);
    }

    public function test_once_time(): void
    {
        $ans1 = $this->getTime(1);
        logger("$ans1");

        $ans2 = $this->getTime(2);
        logger("$ans2");

        $ans3 = $this->getTime(3);
        logger("$ans3");

        $ans4 = $this->getTime(1);
        logger("$ans4");

        $ans5 = $this->getTime(2);
        logger("$ans5");

        $ans6 = $this->getTime(3);
        logger("$ans6");

        $this->assertTrue($ans1 != $ans2);
    }

    private function getPlus1(int $i)
    {
        return once(function() use ($i) {
            sleep (1);
            return $i + 1;
        });
    }

    private function getTime(int $i)
    {
        return once(function() use ($i) {
            sleep (1);
            return time();
        });
    }
}


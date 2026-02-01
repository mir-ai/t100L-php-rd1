<?php

namespace Tests\Feature\UseCases;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\GomiItem;
use App\Models\Template;
use App\DataAccess\GomiItemDa;
use App\UseCases\GomiItemUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\TemplateNotFoundException;

class GomiItemUseCaseTest extends TestCase
{
    // use RefreshDatabase;

    public function test_example_01()
    {
        $this->assertTrue(true);
    }
}

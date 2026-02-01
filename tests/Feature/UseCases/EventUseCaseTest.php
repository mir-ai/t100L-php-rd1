<?php

namespace Tests\Feature\UseCases;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Event;
use App\Models\Template;
use App\DataAccess\EventDa;
use App\UseCases\EventUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\TemplateNotFoundException;

class EventUseCaseTest extends TestCase
{
    // use RefreshDatabase;

    public function test_example_01()
    {
        $this->assertTrue(true);
    }
}

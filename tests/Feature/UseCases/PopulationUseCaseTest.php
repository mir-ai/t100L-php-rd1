<?php

namespace Tests\Feature\UseCases;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Population;
use App\Models\Template;
use App\DataAccess\PopulationDa;
use App\UseCases\PopulationUseCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Exceptions\TemplateNotFoundException;

class PopulationUseCaseTest extends TestCase
{
    // use RefreshDatabase;

    public function test_example_01()
    {
        $this->assertTrue(true);
    }
}

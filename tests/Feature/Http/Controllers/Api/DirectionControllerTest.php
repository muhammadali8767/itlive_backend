<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Direction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\DirectionController
 */
class DirectionControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $directions = Direction::factory()->count(3)->create();

        $response = $this->get(route('direction.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $direction = Direction::factory()->create();

        $response = $this->get(route('direction.show', $direction));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }
}

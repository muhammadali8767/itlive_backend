<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Direction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\DirectionController
 */
class DirectionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

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
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\DirectionController::class,
            'store',
            \App\Http\Requests\Admin\DirectionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $description = $this->faker->text;

        $response = $this->post(route('direction.store'), [
            'name' => $name,
            'description' => $description,
        ]);

        $directions = Direction::query()
            ->where('name', $name)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $directions);
        $direction = $directions->first();

        $response->assertCreated();
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


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\DirectionController::class,
            'update',
            \App\Http\Requests\Admin\DirectionUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $direction = Direction::factory()->create();
        $name = $this->faker->name;
        $description = $this->faker->text;

        $response = $this->put(route('direction.update', $direction), [
            'name' => $name,
            'description' => $description,
        ]);

        $direction->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $direction->name);
        $this->assertEquals($description, $direction->description);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $direction = Direction::factory()->create();

        $response = $this->delete(route('direction.destroy', $direction));

        $response->assertNoContent();

        $this->assertModelMissing($direction);
    }
}

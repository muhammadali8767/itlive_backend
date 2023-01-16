<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\TeacherController
 */
class TeacherControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $teachers = Teacher::factory()->count(3)->create();

        $response = $this->get(route('teacher.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\TeacherController::class,
            'store',
            \App\Http\Requests\Admin\TeacherStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $image = $this->faker->word;
        $description = $this->faker->text;
        $column_5 = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('teacher.store'), [
            'name' => $name,
            'image' => $image,
            'description' => $description,
            'column_5' => $column_5,
        ]);

        $teachers = Teacher::query()
            ->where('name', $name)
            ->where('image', $image)
            ->where('description', $description)
            ->where('column_5', $column_5)
            ->get();
        $this->assertCount(1, $teachers);
        $teacher = $teachers->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->get(route('teacher.show', $teacher));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\TeacherController::class,
            'update',
            \App\Http\Requests\Admin\TeacherUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $teacher = Teacher::factory()->create();
        $name = $this->faker->name;
        $image = $this->faker->word;
        $description = $this->faker->text;
        $column_5 = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('teacher.update', $teacher), [
            'name' => $name,
            'image' => $image,
            'description' => $description,
            'column_5' => $column_5,
        ]);

        $teacher->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $teacher->name);
        $this->assertEquals($image, $teacher->image);
        $this->assertEquals($description, $teacher->description);
        $this->assertEquals($column_5, $teacher->column_5);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->delete(route('teacher.destroy', $teacher));

        $response->assertNoContent();

        $this->assertModelMissing($teacher);
    }
}

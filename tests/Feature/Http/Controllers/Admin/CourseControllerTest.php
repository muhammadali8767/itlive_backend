<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\CourseController
 */
class CourseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $courses = Course::factory()->count(3)->create();

        $response = $this->get(route('course.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\CourseController::class,
            'store',
            \App\Http\Requests\Admin\CourseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves()
    {
        $name = $this->faker->name;
        $image = $this->faker->word;
        $price = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('course.store'), [
            'name' => $name,
            'image' => $image,
            'price' => $price,
        ]);

        $courses = Course::query()
            ->where('name', $name)
            ->where('image', $image)
            ->where('price', $price)
            ->get();
        $this->assertCount(1, $courses);
        $course = $courses->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $course = Course::factory()->create();

        $response = $this->get(route('course.show', $course));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\CourseController::class,
            'update',
            \App\Http\Requests\Admin\CourseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $course = Course::factory()->create();
        $name = $this->faker->name;
        $image = $this->faker->word;
        $price = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('course.update', $course), [
            'name' => $name,
            'image' => $image,
            'price' => $price,
        ]);

        $course->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $course->name);
        $this->assertEquals($image, $course->image);
        $this->assertEquals($price, $course->price);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $course = Course::factory()->create();

        $response = $this->delete(route('course.destroy', $course));

        $response->assertNoContent();

        $this->assertModelMissing($course);
    }
}

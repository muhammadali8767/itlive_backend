<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\CourseController
 */
class CourseControllerTest extends TestCase
{
    use RefreshDatabase;

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
    public function show_behaves_as_expected()
    {
        $course = Course::factory()->create();

        $response = $this->get(route('course.show', $course));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }
}

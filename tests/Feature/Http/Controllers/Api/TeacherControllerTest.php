<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Api\TeacherController
 */
class TeacherControllerTest extends TestCase
{
    use RefreshDatabase;

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
    public function show_behaves_as_expected()
    {
        $teacher = Teacher::factory()->create();

        $response = $this->get(route('teacher.show', $teacher));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }
}

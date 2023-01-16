<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\StudentController
 */
class StudentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_behaves_as_expected()
    {
        $students = Student::factory()->count(3)->create();

        $response = $this->get(route('student.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\StudentController::class,
            'store',
            \App\Http\Requests\Admin\StudentStoreRequest::class
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

        $response = $this->post(route('student.store'), [
            'name' => $name,
            'image' => $image,
            'description' => $description,
        ]);

        $students = Student::query()
            ->where('name', $name)
            ->where('image', $image)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $students);
        $student = $students->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function show_behaves_as_expected()
    {
        $student = Student::factory()->create();

        $response = $this->get(route('student.show', $student));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Admin\StudentController::class,
            'update',
            \App\Http\Requests\Admin\StudentUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_behaves_as_expected()
    {
        $student = Student::factory()->create();
        $name = $this->faker->name;
        $image = $this->faker->word;
        $description = $this->faker->text;

        $response = $this->put(route('student.update', $student), [
            'name' => $name,
            'image' => $image,
            'description' => $description,
        ]);

        $student->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $student->name);
        $this->assertEquals($image, $student->image);
        $this->assertEquals($description, $student->description);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_responds_with()
    {
        $student = Student::factory()->create();

        $response = $this->delete(route('student.destroy', $student));

        $response->assertNoContent();

        $this->assertModelMissing($student);
    }
}

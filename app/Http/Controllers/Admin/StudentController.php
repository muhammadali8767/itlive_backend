<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentStoreRequest;
use App\Http\Requests\Admin\StudentUpdateRequest;
use App\Http\Resources\Admin\StudentCollection;
use App\Http\Resources\Admin\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Admin\StudentCollection
     */
    public function index(Request $request)
    {
        $students = Student::all();

        return new StudentCollection($students);
    }

    /**
     * @param \App\Http\Requests\Admin\StudentStoreRequest $request
     * @return \App\Http\Resources\Admin\StudentResource
     */
    public function store(StudentStoreRequest $request)
    {
        $student = Student::create($request->validated());

        return new StudentResource($student);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \App\Http\Resources\Admin\StudentResource
     */
    public function show(Request $request, Student $student)
    {
        return new StudentResource($student);
    }

    /**
     * @param \App\Http\Requests\Admin\StudentUpdateRequest $request
     * @param \App\Models\Student $student
     * @return \App\Http\Resources\Admin\StudentResource
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $student->update($request->validated());

        return new StudentResource($student);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Student $student)
    {
        $student->delete();

        return response()->noContent();
    }
}

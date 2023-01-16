<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\StudentCollection;
use App\Http\Resources\Api\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\StudentCollection
     */
    public function index(Request $request)
    {
        $students = Student::all();

        return new StudentCollection($students);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \App\Http\Resources\Api\StudentResource
     */
    public function show(Request $request, Student $student)
    {
        return new StudentResource($student);
    }
}

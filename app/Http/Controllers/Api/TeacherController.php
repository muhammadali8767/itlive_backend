<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\TeacherCollection;
use App\Http\Resources\Api\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\TeacherCollection
     */
    public function index(Request $request)
    {
        $teachers = Teacher::all();

        return new TeacherCollection($teachers);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Teacher $teacher
     * @return \App\Http\Resources\Api\TeacherResource
     */
    public function show(Request $request, Teacher $teacher)
    {
        return new TeacherResource($teacher);
    }
}

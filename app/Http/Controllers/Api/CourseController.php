<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CourseCollection;
use App\Http\Resources\Api\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\CourseCollection
     */
    public function index(Request $request)
    {
        $courses = Course::all();

        return new CourseCollection($courses);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \App\Http\Resources\Api\CourseResource
     */
    public function show(Request $request, Course $course)
    {
        return new CourseResource($course);
    }
}

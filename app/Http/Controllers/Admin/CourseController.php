<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CourseStoreRequest;
use App\Http\Requests\Admin\CourseUpdateRequest;
use App\Http\Resources\Admin\CourseCollection;
use App\Http\Resources\Admin\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Admin\CourseCollection
     */
    public function index(Request $request)
    {
        $courses = Course::all();

        return new CourseCollection($courses);
    }

    /**
     * @param \App\Http\Requests\Admin\CourseStoreRequest $request
     * @return \App\Http\Resources\Admin\CourseResource
     */
    public function store(CourseStoreRequest $request)
    {
        $course = Course::create($request->validated());

        return new CourseResource($course);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \App\Http\Resources\Admin\CourseResource
     */
    public function show(Request $request, Course $course)
    {
        return new CourseResource($course);
    }

    /**
     * @param \App\Http\Requests\Admin\CourseUpdateRequest $request
     * @param \App\Models\Course $course
     * @return \App\Http\Resources\Admin\CourseResource
     */
    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update($request->validated());

        return new CourseResource($course);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Course $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Course $course)
    {
        $course->delete();

        return response()->noContent();
    }
}

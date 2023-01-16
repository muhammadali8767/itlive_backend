<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TeacherStoreRequest;
use App\Http\Requests\Admin\TeacherUpdateRequest;
use App\Http\Resources\Admin\TeacherCollection;
use App\Http\Resources\Admin\TeacherResource;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Admin\TeacherCollection
     */
    public function index(Request $request)
    {
        $teachers = Teacher::all();

        return new TeacherCollection($teachers);
    }

    /**
     * @param \App\Http\Requests\Admin\TeacherStoreRequest $request
     * @return \App\Http\Resources\Admin\TeacherResource
     */
    public function store(TeacherStoreRequest $request)
    {
        $teacher = Teacher::create($request->validated());

        return new TeacherResource($teacher);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Teacher $teacher
     * @return \App\Http\Resources\Admin\TeacherResource
     */
    public function show(Request $request, Teacher $teacher)
    {
        return new TeacherResource($teacher);
    }

    /**
     * @param \App\Http\Requests\Admin\TeacherUpdateRequest $request
     * @param \App\Models\Teacher $teacher
     * @return \App\Http\Resources\Admin\TeacherResource
     */
    public function update(TeacherUpdateRequest $request, Teacher $teacher)
    {
        $teacher->update($request->validated());

        return new TeacherResource($teacher);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Teacher $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Teacher $teacher)
    {
        $teacher->delete();

        return response()->noContent();
    }
}

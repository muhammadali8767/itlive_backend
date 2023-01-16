<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DirectionStoreRequest;
use App\Http\Requests\Admin\DirectionUpdateRequest;
use App\Http\Resources\Admin\DirectionCollection;
use App\Http\Resources\Admin\DirectionResource;
use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Admin\DirectionCollection
     */
    public function index(Request $request)
    {
        $directions = Direction::all();

        return new DirectionCollection($directions);
    }

    /**
     * @param \App\Http\Requests\Admin\DirectionStoreRequest $request
     * @return \App\Http\Resources\Admin\DirectionResource
     */
    public function store(DirectionStoreRequest $request)
    {
        $direction = Direction::create($request->validated());

        return new DirectionResource($direction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Direction $direction
     * @return \App\Http\Resources\Admin\DirectionResource
     */
    public function show(Request $request, Direction $direction)
    {
        return new DirectionResource($direction);
    }

    /**
     * @param \App\Http\Requests\Admin\DirectionUpdateRequest $request
     * @param \App\Models\Direction $direction
     * @return \App\Http\Resources\Admin\DirectionResource
     */
    public function update(DirectionUpdateRequest $request, Direction $direction)
    {
        $direction->update($request->validated());

        return new DirectionResource($direction);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Direction $direction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Direction $direction)
    {
        $direction->delete();

        return response()->noContent();
    }
}

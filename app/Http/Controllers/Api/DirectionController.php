<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\DirectionCollection;
use App\Http\Resources\Api\DirectionResource;
use App\Models\Direction;
use Illuminate\Http\Request;

class DirectionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\Api\DirectionCollection
     */
    public function index(Request $request)
    {
        $directions = Direction::all();

        return new DirectionCollection($directions);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Direction $direction
     * @return \App\Http\Resources\Api\DirectionResource
     */
    public function show(Request $request, Direction $direction)
    {
        return new DirectionResource($direction);
    }
}

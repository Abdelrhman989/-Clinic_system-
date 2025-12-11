<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use App\Http\Resources\MajorResource;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::all();
        return response()->json(MajorResource::collection($majors));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|string',
        ]);
        $major = Major::create($request->all());
        return response()->json(new MajorResource($major), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $major = Major::findOrFail($id);
        return response()->json(new MajorResource($major), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $major = Major::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|string',
        ]);
        $major->update($request->all());
        return response()->json(new MajorResource($major), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $major = Major::findOrFail($id);
        $major->delete();
        return response()->json(['message' => 'Major deleted successfully'], 200);
    }
}

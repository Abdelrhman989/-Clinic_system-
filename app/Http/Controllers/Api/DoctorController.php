<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Resources\DoctorResource;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();
        return response()->json(DoctorResource::collection($doctors));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required|string|max:255',
            'email'=> 'required|email|unique:doctors,email',
            'phone'=> 'required|string|max:20',
            'image'=> 'nullable|string',
            'bio'=> 'required|string',
            'major_id'=> 'required|integer|exists:majors,id',
        ]);
        $doctor = Doctor::create($request->all());
        return response()->json(new DoctorResource($doctor), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        return response()->json(new DoctorResource($doctor), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $request->validate([
            'name'=> 'sometimes|required|string|max:255',
            'email'=> 'sometimes|required|email|unique:doctors,email,'.$doctor->id,
            'phone'=> 'sometimes|required|string|max:20',
            'image'=> 'nullable|string',
            'bio'=> 'nullable|string',
            'major_id'=> 'sometimes|required|integer|exists:majors,id',
        ]);
        $doctor->update($request->all());
        return response()->json(new DoctorResource($doctor), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();
        return response()->json(['message' => 'Doctor deleted successfully'], 200);
    }
}

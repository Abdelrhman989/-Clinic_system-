<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apointment;
use Illuminate\Http\Request;
use App\Http\Resources\ApointmentResource;

class ApointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apointments = Apointment::all();
        return response()->json(ApointmentResource::collection($apointments));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
            'doctor_id' => 'required|integer|exists:doctors,id',
        ]);
        $apointment = Apointment::create($request->all());
        return response()->json(new ApointmentResource($apointment), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $apointment = Apointment::findOrFail($id);
        return response()->json(new ApointmentResource($apointment), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $apointment = Apointment::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email',
            'phone' => 'sometimes|required|string|max:20',
            'image' => 'nullable|string',
            'status' => 'nullable|string',
            'doctor_id' => 'sometimes|required|integer|exists:doctors,id',
        ]);
        $apointment->update($request->all());
        return response()->json(new ApointmentResource($apointment), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apointment = Apointment::findOrFail($id);
        $apointment->delete();
        return response()->json(['message' => 'Apointment deleted successfully'], 200);
    }
}

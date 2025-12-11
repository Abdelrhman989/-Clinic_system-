<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use App\Models\Apointment;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Models\Major;

class ApointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    /**
     * Check for existing appointment
     */

    /**
     * Show the form for creating a new resource.
     */
    public function show(Doctor $doctor)
    {
        $doctor = Doctor::findOrFail($doctor->id);
        $existingAppointment = null;
        return view('front.doctor-form', compact('doctor', 'existingAppointment'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $data = $request->validated();
        $data['doctor_id'] = $request->doctor_id;

        // Check if appointment already exists for this doctor
        $existingAppointment = Apointment::where('doctor_id', $request->doctor_id)
            ->where(function ($query) use ($request) {
                $query->where('phone', $request->phone)
                    ->orWhere('email', $request->email);
            })
            ->first();

        if ($existingAppointment) {
            // Update existing appointment
            $existingAppointment->update($data);
            return redirect()->route('front.doctor-form', $request->doctor_id)->with('info', 'Your appointment has been updated successfully');
        }

        // Create new appointment
        Apointment::create($data);
        return redirect()->route('front.doctor-form', $request->doctor_id)->with('success', 'Your appointment has been created successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function createDoctors($major = null)
    {
        if ($major) {
            $major = Major::findOrFail($major);
            $doctors = Doctor::where('major_id', $major->id)->with('major')->get();
        } else {
            $doctors = Doctor::with('major')->get();
        }
        return view('front.doctors', compact('doctors', 'major'));
    }
}

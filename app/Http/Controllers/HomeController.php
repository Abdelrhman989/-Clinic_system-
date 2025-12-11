<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Major;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $majors = Major::with('doctors')->get();
        $doctors = Doctor::with('major')->get();
        return view('front.home', compact('majors', 'doctors'));
    }
}

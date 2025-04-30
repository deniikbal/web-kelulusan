<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class GraduationController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function check(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string',
            'tanggal_lahir' => 'required|date'
        ]);

        $student = Student::with('classroom')
            ->where('nisn', $request->nisn)
            ->where('tanggal_lahir', $request->tanggal_lahir)
            ->first();

        return view('graduation.result', [
            'student' => $student,
            'tanggal_lahir' => $request->tanggal_lahir
        ]);
    }
}

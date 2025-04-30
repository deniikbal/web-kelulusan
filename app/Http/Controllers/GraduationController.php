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

        // Format tanggal untuk pencarian
        $formattedDate = date('Y-m-d', strtotime($request->tanggal_lahir));

        $student = Student::with('classroom')
            ->where('nisn', $request->nisn)
            ->whereDate('tanggal_lahir', $formattedDate)
            ->first();

        // Debugging - bisa dihapus setelah testing
        \Illuminate\Support\Facades\Log::info('Graduation Check:', [
            'nisn' => $request->nisn,
            'input_date' => $request->tanggal_lahir,
            'formatted_date' => $formattedDate,
            'found' => $student ? true : false
        ]);

            $months = [
                1 => 'JANUARI', 2 => 'FEBRUARI', 3 => 'MARET', 4 => 'APRIL', 
                5 => 'MEI', 6 => 'JUNI', 7 => 'JULI', 8 => 'AGUSTUS',
                9 => 'SEPTEMBER', 10 => 'OKTOBER', 11 => 'NOVEMBER', 12 => 'DESEMBER'
            ];
            
            $date = date_create($request->tanggal_lahir);
            $day = date_format($date, 'd');
            $month = $months[date_format($date, 'n')];
            $year = date_format($date, 'Y');
            
            return view('graduation.result', [
                'student' => $student,
                'tanggal_lahir' => "$day $month $year"
            ]);
    }
}

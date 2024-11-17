<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
        return view('faculty.index');
    }

    public function fetchDepartments(Request $request)
    {
        $faculty = Faculty::where('name', $request->faculty_name)->first();

        if ($faculty) {
            return response()->json([
                'success' => true,
                'departments' => $faculty->departments,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Faculty not found.',
            ]);
        }
    }
}
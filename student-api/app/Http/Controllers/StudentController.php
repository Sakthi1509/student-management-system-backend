<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    // GET ALL STUDENTS
    public function index()
    {
        $students = Student::all();

        return response()->json($students);
    }

    // ADD STUDENT
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'course' => 'required',
            'age' => 'required|integer'
        ]);

        $student = Student::create($validated);

        return response()->json([
            'message' => 'Student Added',
            'data' => $student
        ]);
    }

    // GET SINGLE STUDENT
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student Not Found'
            ], 404);
        }

        return response()->json($student);
    }

    // UPDATE STUDENT
    public function update(Request $request, $id)
{
    $student = Student::find($id);

    if (!$student) {
        return response()->json([
            'message' => 'Student Not Found'
        ], 404);
    }

    $student->name = $request->name;
    $student->course = $request->course;
    $student->age = $request->age;

    $student->save();

    return response()->json([
        'message' => 'Student Updated',
        'data' => $student
    ]);
}

    // DELETE STUDENT
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student Not Found'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Student Deleted'
        ]);
    }
}
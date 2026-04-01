<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();
        return view('students.index', compact('students'));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            'course' => 'required'
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student created successfully!');
    }

    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'course' => 'required'
        ]);

        $student->update($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Student updated!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->back()
            ->with('success', 'Student moved to trash!');
    }

    // Lixeira
    public function trash()
    {
        $students = Student::onlyTrashed()->get();
        return view('students.trash', compact('students'));
    }

    public function restore($id)
    {
        Student::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Student restored!');
    }

    public function forceDelete($id)
    {
        Student::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Deleted permanently!');
    }
}
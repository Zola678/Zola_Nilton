<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all(); // pega todos os estudantes
        return view('students.index', compact('students')); // aponta para a view correta
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

        return redirect()->route('students.index')->with('success', 'Student created successfully!');
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

        return redirect()->route('students.index')->with('success', 'Student updated!');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Student moved to trash!');
    }
    
    public function trash()
{
    // Pega os estudantes que foram deletados (soft delete)
    $students = Student::onlyTrashed()->get();

    // Retorna para a view 'students.trash'
    return view('students.trash', compact('students'));
}

 public function restore($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->restore();

        return redirect()->route('students.trash')
            ->with('success', 'Student restored successfully!');
    }

    // Deletar permanentemente
    public function forceDelete($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->forceDelete();

        return redirect()->route('students.trash')
            ->with('success', 'Student deleted permanently!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    // Lista todos os estudantes ativos
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    // Formulário de criação
    public function create()
    {
        $courses = Course::all();
        return view('students.create', compact('courses'));
    }

    // Formulário de edição
    public function edit(Student $student)
    {
        $courses = Course::all();
        return view('students.edit', compact('student', 'courses'));
    }

 public function store(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email',
        'course' => 'required|string',
        'phone' => 'nullable|string',
        'birth_date' => 'nullable|date',
        'photo' => 'nullable|image|max:2048',
    ]);

    // Upload da foto
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('students', 'public');
    }

    Student::create($data);

    return redirect()->route('students.index')
        ->with('success', 'Estudante criado com sucesso!');
}

public function update(Request $request, Student $student)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:students,email,' . $student->id,
        'course' => 'required|string|in:Electrônica e Telecomunicações,Informática,Informática e Sistemas Multimídia',
        'phone' => 'required|numeric|digits_between:9,15',
        'birth_date' => 'required|date|before:today|after:1900-01-01',
        'photo' => 'nullable|image|max:2048',
    ], [
        'course.in' => 'Selecione um curso válido.',
    ]);

    $data = $request->only(['name', 'email', 'course', 'phone', 'birth_date']);

    // Upload da foto
    if ($request->hasFile('photo')) {
        // Remove foto antiga se existir
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }
        $data['photo'] = $request->file('photo')->store('students', 'public');
    }

    $student->update($data);

    return redirect()->route('students.index')
        ->with('success', 'Estudante atualizado com sucesso!');
}

    // Move para lixeira (soft delete)
    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('success', 'Estudante movido para a lixeira!');
    }

    // Lista estudantes na lixeira
    public function trash()
    {
        $students = Student::onlyTrashed()->get();
        return view('students.trash', compact('students'));
    }

    // Restaurar estudante da lixeira
    public function restore($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);
        $student->restore();

        return redirect()->route('students.trash')
            ->with('success', 'Estudante restaurado com sucesso!');
    }

    // Deletar permanentemente
    public function forceDelete($id)
    {
        $student = Student::onlyTrashed()->findOrFail($id);

        // Remove foto se existir
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        $student->forceDelete();

        return redirect()->route('students.trash')
            ->with('success', 'Estudante deletado permanentemente!');
    }
}
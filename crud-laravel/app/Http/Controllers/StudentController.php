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
        // Cursos fixos
        $courses = [
            1 => 'Electrônica e Telecomunicações',
            2 => 'Informática',
            3 => 'Informática e Sistemas Multimídia'
        ];

        return view('students.create', compact('courses'));
    }

    // Formulário de edição
    public function edit(Student $student)
    {
        // Cursos fixos
        $courses = [
            1 => 'Electrônica e Telecomunicações',
            2 => 'Informática',
            3 => 'Informática e Sistemas Multimídia'
        ];

        return view('students.edit', compact('student', 'courses'));
    }

    // Armazenar novo estudante
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'course_id' => 'required|in:1,2,3', // IDs fixos
            'phone' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'photo' => 'nullable|image|max:2048',
        ], [
            'course_id.in' => 'Selecione um curso válido.',
        ]);

        // Upload da foto
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        Student::create($data);

        return redirect()->route('students.index')
            ->with('success', 'Estudante criado com sucesso!');
    }

    // Atualizar estudante existente
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'course_id' => 'required|integer',
            'phone' => 'required|numeric|digits_between:9,15',
            'birth_date' => 'required|date|before:today|after:1900-01-01',
            'photo' => 'nullable|image|max:2048',
        ], [
            'course_id.in' => 'Selecione um curso válido.',
        ]);

        // Upload da foto
        if ($request->hasFile('photo')) {
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

        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        $student->forceDelete();

        return redirect()->route('students.trash')
            ->with('success', 'Estudante deletado permanentemente!');
    }
}
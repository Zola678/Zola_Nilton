<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

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
        return view('students.create');
    }

    // Armazena um estudante novo com validação completa
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'course' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:8,15',
            'birth_date' => 'required|date|before:today|after:1900-01-01',
        ], [
            'name.required' => 'O nome é obrigatório.',
            'name.string' => 'O nome deve conter apenas letras.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O email é obrigatório.',
            'email.email' => 'Digite um email válido (ex: exemplo@dominio.com).',
            'email.unique' => 'Este email já está cadastrado.',
            'course.required' => 'O curso é obrigatório.',
            'course.string' => 'O curso deve conter apenas texto.',
            'course.max' => 'O curso não pode ter mais de 255 caracteres.',
            'phone.required' => 'O telefone é obrigatório.',
            'phone.numeric' => 'O telefone deve conter apenas números.',
            'phone.digits_between' => 'O telefone deve ter entre 8 e 15 dígitos.',
            'birth_date.required' => 'A data de nascimento é obrigatória.',
            'birth_date.date' => 'Insira uma data válida.',
            'birth_date.before' => 'A data de nascimento deve ser anterior a hoje.',
            'birth_date.after' => 'A data de nascimento não pode ser anterior a 1900.',
        ]);

        Student::create($request->all());

        return redirect()->route('students.index')
            ->with('success', 'Estudante cadastrado com sucesso!');
    }

    // Formulário de edição
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Atualiza estudante com validação completa
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $student->id,
            'course' => 'required|string|max:255',
            'phone' => 'required|numeric|digits_between:8,15',
            'birth_date' => 'required|date|before:today|after:1900-01-01',
        ]);

        $student->update($request->all());

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
        $student->forceDelete();

        return redirect()->route('students.trash')
            ->with('success', 'Estudante deletado permanentemente!');
    }
}
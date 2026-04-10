@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">{{ isset($student) ? 'Editar Estudante' : 'Adicionar Estudante' }}</h2>

    <form method="POST" 
          action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}" 
          enctype="multipart/form-data">
        @csrf
        @if(isset($student))
            @method('PUT')
        @endif

        <!-- Nome -->
        <input type="text" name="name" 
               value="{{ old('name', $student->name ?? '') }}" 
               class="form-control mb-2 @error('name') is-invalid @enderror" 
               placeholder="Nome" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Email -->
        <input type="email" name="email" 
               value="{{ old('email', $student->email ?? '') }}" 
               class="form-control mb-2 @error('email') is-invalid @enderror" 
               placeholder="Email" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Cursos fixos -->
        @php
            $fixedCourses = [
                1 => 'Electrônica e Telecomunicações',
                2 => 'Informática',
                3 => 'Informática e Sistemas Multimídia'
            ];
            $selected = old('course_id', $student->course_id ?? '');
        @endphp
        <select name="course_id" 
                class="form-control mb-2 @error('course_id') is-invalid @enderror" 
                required>
            <option value="">Selecione o Curso</option>
            @foreach($fixedCourses as $id => $name)
                <option value="{{ $id }}" {{ $selected == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>
        @error('course_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Telefone -->
        <input type="text" name="phone" 
               value="{{ old('phone', $student->phone ?? '') }}" 
               class="form-control mb-2 @error('phone') is-invalid @enderror" 
               placeholder="Telefone">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Data de nascimento -->
        <input type="date" 
               name="birth_date" 
               value="{{ old('birth_date', isset($student->birth_date) ? \Carbon\Carbon::parse($student->birth_date)->format('Y-m-d') : '') }}" 
               class="form-control mb-2 @error('birth_date') is-invalid @enderror">
        @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Foto -->
        <input type="file" name="photo" 
               class="form-control mb-2 @error('photo') is-invalid @enderror" 
               accept="image/*">
        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Mostrar foto atual -->
        @if(!empty($student->photo))
            <img src="{{ asset('storage/' . $student->photo) }}" 
                 width="100" class="mb-2" alt="Foto do Estudante">
        @endif

        <!-- Botões -->
        <button type="submit" class="btn btn-success">
            {{ isset($student) ? 'Atualizar' : 'Salvar' }}
        </button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">{{ isset($student) ? 'Edit Student' : 'Add Student' }}</h2>

    <form method="POST" action="{{ isset($student) ? route('students.update', $student) : route('students.store') }}" enctype="multipart/form-data">
        @csrf
        @if(isset($student))
            @method('PUT')
        @endif

        <!-- Name -->
        <input type="text" name="name" value="{{ old('name', $student->name ?? '') }}" 
               class="form-control mb-2 @error('name') is-invalid @enderror" placeholder="Name" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Email -->
        <input type="email" name="email" value="{{ old('email', $student->email ?? '') }}" 
               class="form-control mb-2 @error('email') is-invalid @enderror" placeholder="Email" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Course (SIMPLIFICADO E CORRETO) -->
        @php
            $courses = [
                'Electrônica e Telecomunicações',
                'Informática',
                'Informática e Sistemas Multimídia'
            ];
            $selected = old('course', $student->course ?? '');
        @endphp

        <select name="course" class="form-control mb-2 @error('course') is-invalid @enderror" required>
            <option value="">Select Course</option>
            @foreach($courses as $course)
                <option value="{{ $course }}" {{ $selected == $course ? 'selected' : '' }}>
                    {{ $course }}
                </option>
            @endforeach
        </select>

        @error('course')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Phone -->
        <input type="text" name="phone" value="{{ old('phone', $student->phone ?? '') }}" 
               class="form-control mb-2 @error('phone') is-invalid @enderror" placeholder="Phone">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Birth Date (CORRIGIDO) -->
        <input type="date" 
               name="birth_date" 
               value="{{ old('birth_date', isset($student->birth_date) ? date('Y-m-d', strtotime($student->birth_date)) : '') }}" 
               class="form-control mb-2 @error('birth_date') is-invalid @enderror">
        @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Photo Upload -->
        <input type="file" name="photo" class="form-control mb-2 @error('photo') is-invalid @enderror" accept="image/*">
        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Mostrar imagem atual -->
        @if(!empty($student->photo))
            <img src="{{ asset('storage/' . $student->photo) }}" 
                 alt="Student Photo" 
                 width="100" 
                 class="mb-2">
        @endif

        <button type="submit" class="btn btn-success">
            {{ isset($student) ? 'Update' : 'Save' }}
        </button>

        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
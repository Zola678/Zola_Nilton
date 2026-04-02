@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">{{ $student->id ?? '' ? 'Edit Student' : 'Add Student' }}</h2>

    <!-- Adicionamos enctype para upload de imagem -->
    <form method="POST" action="{{ $student->id ?? '' ? route('students.update', $student) : route('students.store') }}" enctype="multipart/form-data">
        @csrf
        @if($student->id ?? false)
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

        <!-- Course Select -->
        <select name="course" class="form-control mb-2 @error('course') is-invalid @enderror" required>
            <option value="">Select Course</option>
            <option value="Electronica e Telecomunicacoes" {{ old('course', $student->course ?? '') == 'Electronica e Telecomunicacoes' ? 'selected' : '' }}>Electronica e Telecomunicacoes</option>
            <option value="Informatica" {{ old('course', $student->course ?? '') == 'Informatica' ? 'selected' : '' }}>Informatica</option>
            <option value="Informatica e Sistemas Multimedia" {{ old('course', $student->course ?? '') == 'Informatica e Sistemas Multimedia' ? 'selected' : '' }}>Informatica e Sistemas Multimedia</option>
        </select>
        @error('course')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <select name="course_id" class="form-control mb-2" required>
    <option value="">Select Course</option>
    @foreach($courses as $course)
        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
            {{ $course->name }}
        </option>
    @endforeach
</select>

        <!-- Phone -->
        <input type="text" name="phone" value="{{ old('phone', $student->phone ?? '') }}" 
               class="form-control mb-2 @error('phone') is-invalid @enderror" placeholder="Phone">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Birth Date -->
        <input type="date" name="birth_date" value="{{ old('birth_date', $student->birth_date ?? '') }}" 
               class="form-control mb-2 @error('birth_date') is-invalid @enderror">
        @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Photo Upload -->
        <input type="file" name="photo" class="form-control mb-2 @error('photo') is-invalid @enderror" accept="image/*">
        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Mostrar imagem atual se existir -->
        @if(!empty($student->photo))
            <img src="{{ asset('storage/students/'.$student->photo) }}" alt="Student Photo" width="100" class="mb-2">
        @endif

        <button type="submit" class="btn btn-success">{{ $student->id ?? '' ? 'Update' : 'Save' }}</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
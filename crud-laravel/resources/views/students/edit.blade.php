@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Edit Student</h2>

    <!-- Adicionamos enctype para upload de imagem -->
    <form method="POST" action="{{ route('students.update', $student) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <input type="text" name="name" value="{{ old('name', $student->name) }}" 
               class="form-control mb-2 @error('name') is-invalid @enderror" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Email -->
        <input type="email" name="email" value="{{ old('email', $student->email) }}" 
               class="form-control mb-2 @error('email') is-invalid @enderror" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Course Select -->
        <select name="course" class="form-control mb-2 @error('course') is-invalid @enderror" required>
            <option value="">Select Course</option>
            <option value="Electronica e Telecomunicacoes" {{ old('course', $student->course) == 'Electronica e Telecomunicacoes' ? 'selected' : '' }}>Electronica e Telecomunicacoes</option>
            <option value="Informatica" {{ old('course', $student->course) == 'Informatica' ? 'selected' : '' }}>Informatica</option>
            <option value="Informatica e Sistemas Multimedia" {{ old('course', $student->course) == 'Informatica e Sistemas Multimedia' ? 'selected' : '' }}>Informatica e Sistemas Multimedia</option>
        </select>
        
        @error('course')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Phone -->
        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" 
               class="form-control mb-2 @error('phone') is-invalid @enderror">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Birth Date -->
        <input type="date" name="birth_date" value="{{ old('birth_date', $student->birth_date?->format('Y-m-d')) }}" 
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
            <img src="{{ asset('storage/students/'.$student->photo) }}" alt="Student Photo" width="100" class="mb-2">
        @endif

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </form>

</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Add Student</h2>

    <form method="POST" action="{{ route('students.store') }}">
        @csrf

        <!-- Name -->
        <input type="text" name="name" value="{{ old('name') }}" class="form-control mb-2 @error('name') is-invalid @enderror" placeholder="Name" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Email -->
        <input type="email" name="email" value="{{ old('email') }}" class="form-control mb-2 @error('email') is-invalid @enderror" placeholder="Email" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <select name="course" class="form-control mb-2" required>
            <option value="">Select Course</option>
            <option value="Electronica e Telecomunicações" {{ (old('course', $student->course ?? '') == 'Electronica e Telecomunicacoes') ? 'selected' : '' }}>Electronica e Telecomunicacoes</option>
            <option value="Informática" {{ (old('course', $student->course ?? '') == 'Informatica') ? 'selected' : '' }}>Informatica</option>
            <option value="Informática e Sistemas Multimídia" {{ (old('course', $student->course ?? '') == 'Informatica e Sistemas Multimedia') ? 'selected' : '' }}>Informatica e Sistemas Multimedia</option>
        </select>

        <!-- Phone -->
        <input type="text" name="phone" value="{{ old('phone') }}" class="form-control mb-2 @error('phone') is-invalid @enderror" placeholder="Phone">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Birth Date -->
        <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control mb-2 @error('birth_date') is-invalid @enderror">
        @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
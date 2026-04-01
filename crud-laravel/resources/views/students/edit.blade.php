@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Edit Student</h2>

    <form method="POST" action="{{ route('students.update', $student) }}">
        @csrf
        @method('PUT')

        <!-- Name -->
        <input type="text" name="name" value="{{ old('name', $student->name) }}" class="form-control mb-2 @error('name') is-invalid @enderror" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Email -->
        <input type="email" name="email" value="{{ old('email', $student->email) }}" class="form-control mb-2 @error('email') is-invalid @enderror" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Course -->
        <input type="text" name="course" value="{{ old('course', $student->course) }}" class="form-control mb-2 @error('course') is-invalid @enderror" required>
        @error('course')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Phone -->
        <input type="text" name="phone" value="{{ old('phone', $student->phone) }}" class="form-control mb-2 @error('phone') is-invalid @enderror">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <!-- Birth Date -->
        <input type="date" name="birth_date" value="{{ old('birth_date', $student->birth_date?->format('Y-m-d')) }}" class="form-control mb-2 @error('birth_date') is-invalid @enderror">
        @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back</a>
    </form>

</div>
@endsection
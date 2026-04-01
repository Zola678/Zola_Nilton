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

        <!-- Course -->
        <input type="text" name="course" value="{{ old('course') }}" class="form-control mb-2 @error('course') is-invalid @enderror" placeholder="Course" required>
        @error('course')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

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
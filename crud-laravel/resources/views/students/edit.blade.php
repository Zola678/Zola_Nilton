@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2>Edit Student</h2>

    <form method="POST" action="{{ route('students.update', $student) }}">
        @csrf
        @method('PUT')

        <input class="form-control mb-2" name="name" value="{{ $student->name }}" required>
        <input class="form-control mb-2" name="email" value="{{ $student->email }}" required>
        <input class="form-control mb-2" name="course" value="{{ $student->course }}" required>
        <input class="form-control mb-2" name="phone" value="{{ $student->phone }}">
        <input class="form-control mb-2" type="date" name="birth_date" value="{{ $student->birth_date }}">

        <button class="btn btn-success">Update</button>

    </form>

</div>
@endsection
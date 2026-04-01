@extends('layouts.app')

@section('content')

<h2>Add Student</h2>

<form method="POST" action="{{ route('students.store') }}">
    @csrf

    <input class="form-control mb-2" name="name" placeholder="Name" required>
    <input class="form-control mb-2" name="email" placeholder="Email" required>
    <input class="form-control mb-2" name="course" placeholder="Course" required>
    <input class="form-control mb-2" name="phone" placeholder="Phone">
    <input class="form-control mb-2" type="date" name="birth_date">

    <button class="btn btn-success">Save</button>

</form>

@endsection
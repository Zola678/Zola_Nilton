@extends('layouts.app')

@section('content')

<h2>Students</h2>

<a href="{{ route('students.create') }}" class="btn btn-primary mb-3">+ Add Student</a>
<a href="{{ route('students.trash') }}" class="btn btn-secondary mb-3">🗑️ Trash</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($students as $s)
        <tr>
            <td>{{ $s->name }}</td>
            <td>{{ $s->email }}</td>
            <td>{{ $s->course }}</td>
            <td>
                <a href="{{ route('students.edit', $s) }}" class="btn btn-warning btn-sm">Edit</a>

                <form action="{{ route('students.destroy', $s) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
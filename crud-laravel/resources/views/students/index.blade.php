@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Students</h2>

    <div class="mb-3">
        <a href="{{ route('students.create') }}" class="btn btn-primary">+ Add Student</a>
        <a href="{{ route('students.trash') }}" class="btn btn-secondary">🗑️ Trash</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($students->isEmpty())
        <div class="alert alert-info">No students registered yet.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Phone</th>
                    <th>Birth Date</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($students as $s)
                <tr>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->email }}</td>
                    <td>{{ $s->course }}</td>
                    <td>{{ $s->phone ?? '-' }}</td>
                    <td>{{ $s->birth_date ? $s->birth_date->format('d/m/Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('students.edit', $s) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('students.destroy', $s) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Move student to trash?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-4">Students</h2>

    <div class="mb-3">
        <a href="{{ route('students.create') }}" class="btn btn-primary">+ Add Student</a>
        <a href="{{ route('students.trash') }}" class="btn btn-secondary">🗑️ Trash</a>
    </div>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Verifica se há estudantes --}}
    @if($students->isEmpty())
        <div class="alert alert-info">No students registered yet.</div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Phone</th>
                        <th>Birth Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        {{-- Foto do estudante --}}
                        <td>
                            @if(!empty($student->photo) && file_exists(public_path('storage/' . $student->photo)))
                                <img src="{{ asset('storage/' . $student->photo) }}" alt="Student Photo" width="50" class="rounded">
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->course ?? '-' }}</td>
                        <td>{{ $student->phone ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d/m/Y') }}</td>

                        <td>
                            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Move student to trash?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-3">🗑️ Trash</h2>

    <a href="{{ route('students.index') }}" class="btn btn-primary mb-4">&larr; Back to Students List</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($students->isEmpty())
        <div class="alert alert-info">No students in trash.</div>
    @else
        @foreach($students as $s)
            <div class="card p-3 mb-2 d-flex flex-row justify-content-between align-items-center">

                <div>
                    <strong>{{ $s->name }}</strong><br>
                    {{ $s->email }} | {{ $s->course }}
                </div>

                <div class="d-flex gap-2">

                    <!-- Restore -->
                    <form method="POST" action="{{ route('students.restore', $s->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm">Restore</button>
                    </form>

                    <!-- Delete Permanently -->
                    <form method="POST" action="{{ route('students.delete', $s->id) }}" onsubmit="return confirm('Are you sure you want to permanently delete this student?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete permanently</button>
                    </form>

                </div>
            </div>
        @endforeach
    @endif

</div>

@endsection
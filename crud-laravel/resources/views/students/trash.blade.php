@extends('layouts.app')

@section('content')

<h2>🗑️ Trash</h2>
<a href="{{ route('students.index') }}" class="btn btn-primary" style="margin-bottom: 20px;">
    &larr; Voltar para a lista de estudantes
</a>

@foreach($students as $s)
    <div class="card p-3 mb-2">

        <strong>{{ $s->name }}</strong>

        <form method="POST" action="{{ route('students.restore', $s->id) }}">
            @csrf
            <button class="btn btn-success btn-sm">Restore</button>
        </form>

        <form method="POST" action="{{ route('students.delete', $s->id) }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm">Delete permanently</button>
        </form>

    </div>
@endforeach

@endsection
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Students</h1>
    <a class="btn btn-primary" href="{{ route('students.create') }}">New Student</a>
</div>

<form class="row row-cols-lg-auto g-2 align-items-center mb-3" method="get">
    <div class="col-12">
        <input type="text" name="q" class="form-control" placeholder="Search name, email, roll" value="{{ $q }}">
    </div>
    <div class="col-12">
        <button class="btn btn-outline-secondary" type="submit">Search</button>
    </div>
</form>

@if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-striped align-middle">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Roll</th>
            <th>Created</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse($students as $s)
            <tr>
                <td>{{ $s->id }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        @if($s->photo_path)
                            <img src="{{ asset('storage/'.$s->photo_path) }}" width="32" height="32" class="rounded-circle" alt="">
                        @else
                            <span class="badge bg-secondary">N/A</span>
                        @endif
                        {{ $s->full_name }}
                    </div>
                </td>
                <td>{{ $s->email }}</td>
                <td>{{ $s->roll_no }}</td>
                <td>{{ $s->created_at->diffForHumans() }}</td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('students.show', $s) }}">View</a>
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('students.edit', $s) }}">Edit</a>
                    <form class="d-inline" method="post" action="{{ route('students.destroy', $s) }}" onsubmit="return confirm('Delete this student?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center text-muted">No students found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

{{ $students->links() }}
@endsection

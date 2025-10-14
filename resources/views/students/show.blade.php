@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">{{ $student->full_name }}</h1>
    <div>
        <a class="btn btn-outline-secondary" href="{{ route('students.edit', $student) }}">Edit</a>
        <a class="btn btn-outline-dark" href="{{ route('students.index') }}">Back</a>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                @if($student->photo_path)
                    <img src="{{ asset('storage/'.$student->photo_path) }}" class="img-fluid rounded mb-2" alt="">
                @else
                    <span class="badge bg-secondary">No photo</span>
                @endif
                <div class="text-muted small mt-2">Roll: {{ $student->roll_no }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-3">Email</dt><dd class="col-sm-9">{{ $student->email }}</dd>
                    <dt class="col-sm-3">Phone</dt><dd class="col-sm-9">{{ $student->phone ?? '—' }}</dd>
                    <dt class="col-sm-3">DOB</dt><dd class="col-sm-9">{{ optional($student->dob)->toFormattedDateString() ?? '—' }}</dd>
                    <dt class="col-sm-3">Gender</dt><dd class="col-sm-9">{{ $student->gender ?? '—' }}</dd>
                    <dt class="col-sm-3">Address</dt><dd class="col-sm-9">{{ $student->address ?? '—' }}</dd>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection

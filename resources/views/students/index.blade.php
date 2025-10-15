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

<div class="d-flex gap-2 mb-3">
    <a href="{{ route('students.index', array_filter(['q' => request('q'), 'only' => null])) }}" class="btn btn-sm {{ request('only') ? 'btn-outline-secondary' : 'btn-secondary' }}">Active</a>
    <a href="{{ route('students.index', array_filter(['q' => request('q'), 'only' => 'trashed'])) }}" class="btn btn-sm {{ request('only')==='trashed' ? 'btn-secondary' : 'btn-outline-secondary' }}">Trashed</a>
    <a href="{{ route('students.index', array_filter(['q' => request('q'), 'only' => 'all'])) }}" class="btn btn-sm {{ request('only')==='all' ? 'btn-secondary' : 'btn-outline-secondary' }}">All</a>
</div>


@if(session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

<div class="table-responsive">
    <table class="table table-striped align-middle">
        @php
            function sort_link($label, $field, $sort, $dir) {
                $next = ($sort === $field && $dir === 'asc') ? 'desc' : 'asc';
                $icon = $sort === $field ? ($dir === 'asc' ? '↑' : '↓') : '';
                $query = array_merge(request()->query(), ['sort' => $field, 'dir' => $next]);
                $url = route('students.index', $query);
                return '<a href="'.$url.'">'.$label.' '.$icon.'</a>';
            }
        @endphp

        <thead>
        <tr>
            <th>{!! sort_link('#','id',$sort,$dir) !!}</th>
            <th>{!! sort_link('Name','name',$sort,$dir) !!}</th>
            <th>{!! sort_link('Email','email',$sort,$dir) !!}</th>
            <th>Roll</th>
            <th>{!! sort_link('Created','created_at',$sort,$dir) !!}</th>
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
                    @if($s->trashed())
                        <a class="btn btn-sm btn-success" href="{{ route('students.restore', $s->id) }}">Restore</a>
                        <form class="d-inline" method="post" action="{{ route('students.force-delete', $s->id) }}" onsubmit="return confirm('Permanently delete?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Force Delete</button>
                        </form>
                    @else
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('students.show', $s) }}">View</a>
                        <a class="btn btn-sm btn-outline-secondary" href="{{ route('students.edit', $s) }}">Edit</a>
                        <form class="d-inline" method="post" action="{{ route('students.destroy', $s) }}" onsubmit="return confirm('Move to trash?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                        </form>
                    @endif
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

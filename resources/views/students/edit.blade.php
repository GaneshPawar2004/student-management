@extends('layouts.app')

@section('content')
<h1 class="h4 mb-3">Edit Student</h1>
<form method="post" action="{{ route('students.update', $student) }}" enctype="multipart/form-data">
    @method('PUT')
    @include('students._form', ['student' => $student])
</form>
@endsection

@extends('layouts.app')

@section('content')
<h1 class="h4 mb-3">New Student</h1>
<form method="post" action="{{ route('students.store') }}" enctype="multipart/form-data">
    @include('students._form', ['student' => null])
</form>
@endsection

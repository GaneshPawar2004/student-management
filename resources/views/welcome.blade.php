@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h3 mb-3">Laravel + Bootstrap + MySQL</h1>
                <p class="mb-0">Stack is wired up successfully. Next, we’ll build the Students module.</p>
            </div>
        </div>
        <div class="alert alert-info mt-3">
            Visit <a href="{{ url('/health') }}">/health</a> for a quick status JSON.
        </div>
    </div>
</div>
@endsection

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Student Management') }}</title>
    @vite(['resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        ...
    </nav>
    @if(session('status'))
        <div class="container mt-3"><div class="alert alert-success">{{ session('status') }}</div></div>
    @endif
    @if($errors->any())
        <div class="container mt-3"><div class="alert alert-danger mb-0">
            <ul class="mb-0">
                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
            </ul>
        </div></div>
    @endif


    <main class="container py-4">
        @yield('content')
    </main>
</body>
</html>

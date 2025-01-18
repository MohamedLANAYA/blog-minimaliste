<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- ================= Bootstrap ================= --}}
    <link href="{{ url('css/bootstrap.css') }}" rel="stylesheet">

    {{-- ================= FontAwesome ================= --}}
    <link href="{{ url('fontawesome/css/fontawesome.css') }}" rel="stylesheet">
    <link href="{{ url('fontawesome/css/brands.css') }}" rel="stylesheet">
    <link href="{{ url('fontawesome/css/solid.css') }}" rel="stylesheet">

    {{-- ================= CSS Personnalisé ================= --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    {{-- Titre de la page --}}
    <title>@yield('titre', 'Blog Minimaliste')</title>
</head>
<body>
    {{-- Notifications de session --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- Navigation incluse --}}
    @include('layouts.nav')

    {{-- Contenu principal --}}
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- Pied de page inclus --}}
    @include('layouts.footer')

    {{-- ================= Scripts ================= --}}
    <script src="{{ url('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ url('js/bootstrap.bundle.js') }}"></script>
</body>
</html>

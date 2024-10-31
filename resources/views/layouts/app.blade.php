<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="{{ asset('img/Logo.png') }}">
        <title>@yield('title', '3d Tech')</title>
        <link href="https://fonts.googleapis.com/css2?family=Inknut+Antiqua:wght@400;500;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
        <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
        <link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
        <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @yield('head')
    </head>
    <body>
        <div class="d-flex">
            @include('partials.sidebar')
            <div class="main">
                @include('partials.navbar')
                @include('partials.modal_notif')
                @include('partials.notif')
                <div class="content">
                    @yield('content')            
                </div>
                <footer class="footer mt-5 py-3">
                    <div class="container">
                        <span class="text-muted">© 2024 Project 01. All rights reserved.</span>
                    </div>
                </footer>      
            </div>        
        </div>    
        @yield('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/script.js') }}"></script>
    </body>
</html>

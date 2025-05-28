<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ Vite::asset('resources/images/dark_logo.png') }}" type="image/x-icon">
        <title>Page Not Found</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/general.js', 'resources/js/diary.js'])
    </head>
    <body class="d-flex justify-content-center align-items-center vh-100">
        <main class="d-flex justify-content-center align-items-center w-100 p-4" style="height: 100vh">
            <div class="d-flex flex-column justify-content-center align-items-center p-4 w-100 h-100">
                @yield('content')
            </div>
        </main>

        @stack('scripts')
    </body>
</html>

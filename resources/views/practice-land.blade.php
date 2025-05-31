<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('resources/images/dark_logo.png') }}" type="image/x-icon">
        <title>{{ $title ?? 'WeProTech' }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/general.js', 'resources/js/diary.js'])
    </head>
    <body class="d-flex align-items-center justify-content-center vh-100" style="background-color: #191919;">
        <button class="btn btn-primary" onclick="vp()">Verify</button>

        <x-vault-password/>
    </body>
    @stack('scripts')
</html>

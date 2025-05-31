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
    <body class="d-flex align-items-center vh-100" style="background-color: #191919;">
        <form action="{{ route('updateSecretAccount') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="8"> {{-- test ID --}}
            <input type="text" name="category" value="test">
            <input type="text" name="account_name" value="test">
            <input type="email" name="account_email" value="test@email.com">
            <input type="password" name="old_password" value="asdfasdf">
            <input type="password" name="new_password" value="abcd1234">
            <input type="password" name="new_password_confirmation" value="abcd1234">
            <button type="submit">Test Submit</button>
        </form>

        @if(session('message'))
            <script>
                window.addEventListener('load', function () {
                    messageToast(@json(session('message')), @json(session('type') ?? 'success'));
                });
            </script>
        @endif
    </body>
    @stack('scripts')
</html>

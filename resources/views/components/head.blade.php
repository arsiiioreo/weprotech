@props(['title'])

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title : 'WeProTech' }}</title>

    <link rel="shortcut icon" href="{{asset('images/dark_logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('build/assets/app-a2f2d654.css')}}">
    <script src="{{asset('build/assets/app-751f7b87.js')}}"></script>
    <script src="{{asset('build/assets/diary-2efdbf10.js')}}"></script>
    <script src="{{asset('build/assets/general-2d77b5fb.js')}}"></script>
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/general.js', 'resources/js/diary.js']) --}}
</head>
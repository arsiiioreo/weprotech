@props(['title'])

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ? $title : 'WeProTech' }}</title>

    <link rel="shortcut icon" href="{{asset('images/dark_logo.png')}}" type="image/x-icon">
    @vite(['resources/js/general.js', 'resources/js/diary.js', 'resources/js/app.js', 'resources/css/app.css',])
</head>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
@endpush
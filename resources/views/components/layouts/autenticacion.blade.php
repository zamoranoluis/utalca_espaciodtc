<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="{{ asset('css/global.css') }}" rel="stylesheet">
        <link href="{{ asset('css/popup.css') }}" rel="stylesheet">
        <link href="{{ asset('css/autenticacion.css') }}" rel="stylesheet">

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/*.css', 'resources/js/app.js'])
        @endif

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body class="autenticacion__body">
        {{ $slot }}
    </body>
</html>

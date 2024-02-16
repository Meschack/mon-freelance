<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Inclure les fichiers CSS de FontAwesome -->
    {{-- <link rel="stylesheet" href="{{ asset('node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}"> --}}


    <title>@yield('title', config('app.name', 'MonFreelance'))</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-screen overflow-y-auto">
    @include('layouts.customer.header')

    <main class="py-10 px-5 md:px-10 lg:px-20 flex flex-col gap-20">
        @yield('content')
    </main>
</body>

</html>

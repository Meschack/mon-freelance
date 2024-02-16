<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased h-screen overflow-y-auto">
    <div class="grid grid-cols-6">
        <div class="">
            @include('layouts.sidebar')
        </div>

        <div class="col-span-5 min-h-[200vh] overflow-visible">
            @include('layouts.navigation')

            <div class="">

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

</body>

</html>

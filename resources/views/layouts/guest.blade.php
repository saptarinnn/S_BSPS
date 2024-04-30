<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Fugaz+One&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body class="font-sans antialiased text-dark bg-body">
    <div class="flex flex-col items-center justify-center min-h-screen py-10 sm:py-6">
        <a href="{{ route('home') }}">
            {{-- <x-logo /> --}}
            <div class="text-center">
                <h1 class="italic font-bold md:text-4xl text-2xl text-primary tracking-widest text-logo mb-0 p-0">
                    {{ $data->logo }}</h1>
            </div>

        </a>
        <div class="w-full px-6 py-2 mt-4 overflow-hidden bg-white shadow-md sm:max-w-lg sm:rounded-lg">

            {{ $slot }}

        </div>
    </div>
</body>

</html>

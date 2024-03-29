<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased dark">
<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

    @if (Route::has('login'))
        <div class="hidden fixed top-0 left-0 px-6 py-4 sm:block">
            <a href="{{ route('splashscreen') }}">
                <img src="{{ asset('images/apprenticeship-tracker-logo.png') }}" alt="Apprentice Dashboard" class="rounded w-1/5">
            </a>
        </div>
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block text-white text-xl">
            @auth
                <a href="{{ Auth::user()->apprentice ? route('apprentice_dashboard') : route('manager_dashboard') }}" class="bg-purple-500 px-4 py-1 hover:bg-purple-600">Dashboard</a>
            @else
                @if (\Request::route()->getName() == "register")
                    <a href="{{ route('login') }}" class="bg-purple-500 px-4 py-1 hover:bg-purple-600">Log in</a>
                @else
                    <a href="{{ route('register') }}" class="ml-4 bg-purple-500 px-4 py-1 hover:bg-purple-600">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
</body>
</html>

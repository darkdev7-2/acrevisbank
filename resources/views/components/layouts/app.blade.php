<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Acrevis Bank') }} - {{ config('app.name') }}</title>

    <!-- SEO Meta Tags -->
    @if(isset($metaDescription))
    <meta name="description" content="{{ $metaDescription }}">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    @stack('styles')
</head>
<body class="antialiased bg-white">
    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main class="min-h-screen">
        {{ $slot }}
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- WhatsApp Widget -->
    @include('partials.whatsapp-widget')

    <!-- Cookie Consent -->
    @include('partials.cookie-consent')

    @livewireScripts
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dwarfinder') }} — Find Your Spark ❤️‍🔥</title>
        <meta name="description" content="The inclusive dating app where every spark matters.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            [x-cloak] { display: none !important; }
            html, body { height: 100%; }
            body { padding-bottom: 64px; } /* space for bottom nav */
            @media (min-width: 640px) { body { padding-bottom: 0; } }
        </style>
    </head>
    <body class="font-sans antialiased" style="background: #F8F8FC;">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- ── Bottom Navigation (mobile only) ──────────────────── -->
        <nav class="bottom-nav sm:hidden" id="bottom-nav">
            <a href="{{ route('dashboard') }}"
               class="bottom-nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}"
               id="nav-home">
                <svg fill="{{ request()->routeIs('dashboard') ? '#8b5cf6' : 'none' }}" stroke="{{ request()->routeIs('dashboard') ? '#8b5cf6' : 'currentColor' }}" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Home</span>
            </a>

            <a href="{{ route('discover.index') }}"
               class="bottom-nav-item {{ request()->routeIs('discover.*') ? 'active' : '' }}"
               id="nav-discover">
                <!-- Royal icon in the middle — bigger -->
                <span style="font-size:28px; line-height:1; {{ request()->routeIs('discover.*') ? '' : 'filter: grayscale(0.5)' }}">🔥</span>
                <span>Discover</span>
            </a>

            <a href="{{ route('matches.index') }}"
               class="bottom-nav-item {{ request()->routeIs('matches.*') ? 'active' : '' }}"
               id="nav-matches">
                <svg fill="{{ request()->routeIs('matches.*') ? '#8b5cf6' : 'none' }}" stroke="{{ request()->routeIs('matches.*') ? '#8b5cf6' : 'currentColor' }}" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
                <span>Matches</span>
            </a>

            <a href="{{ route('messages.index') }}"
               class="bottom-nav-item {{ request()->routeIs('messages.*') ? 'active' : '' }}"
               id="nav-messages">
                <svg fill="{{ request()->routeIs('messages.*') ? '#8b5cf6' : 'none' }}" stroke="{{ request()->routeIs('messages.*') ? '#8b5cf6' : 'currentColor' }}" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span>Chat</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="bottom-nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}"
               id="nav-profile">
                <svg fill="{{ request()->routeIs('profile.*') ? '#8b5cf6' : 'none' }}" stroke="{{ request()->routeIs('profile.*') ? '#8b5cf6' : 'currentColor' }}" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <span>Profile</span>
            </a>
        </nav>
    </body>
</html>

<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white border-b border-gray-100 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-royal-gradient shadow-lg shadow-royal-500/20 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>
                <span class="text-xl font-black tracking-tight text-royal-gradient">
                    Dwarfinder
                </span>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden sm:flex items-center gap-1">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('dashboard') ? 'text-royal-600 bg-royal-50' : 'text-gray-500 hover:text-royal-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Home
                </a>

                <a href="{{ route('discover.index') }}"
                   class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('discover.*') ? 'text-royal-600 bg-royal-50' : 'text-gray-500 hover:text-royal-600 hover:bg-gray-50' }}">
                    🔥 Discover
                </a>

                <a href="{{ route('matches.index') }}"
                   class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('matches.*') ? 'text-royal-600 bg-royal-50' : 'text-gray-500 hover:text-royal-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                    Matches
                </a>

                <a href="{{ route('messages.index') }}"
                   class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('messages.*') ? 'text-royal-600 bg-royal-50' : 'text-gray-500 hover:text-royal-600 hover:bg-gray-50' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    Chat
                </a>

                <a href="{{ route('likes.index') }}"
                   class="flex items-center gap-1.5 px-3 py-2 rounded-xl text-sm font-semibold transition-all duration-200 {{ request()->routeIs('likes.*') ? 'text-royal-600 bg-royal-50' : 'text-gray-500 hover:text-royal-600 hover:bg-gray-50' }}">
                    ❤️ Likes
                </a>
            </div>

            <!-- Right: User Menu -->
            <div class="flex items-center gap-3">
                <!-- Notification Bell -->
                <button class="relative w-9 h-9 flex items-center justify-center rounded-xl text-gray-400 hover:text-royal-600 hover:bg-royal-50 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>

                <!-- Avatar Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 pl-1 pr-3 py-1 rounded-full border border-gray-200 hover:border-royal-300 hover:shadow-md transition-all duration-200">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold flex-shrink-0 bg-royal-gradient">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:block text-sm font-semibold text-gray-700 max-w-24 truncate">{{ Auth::user()->name }}</span>
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-xs text-gray-500">Signed in as</p>
                            <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        @if(Auth::user()->isAdmin())
                            <x-dropdown-link :href="route('admin.dashboard')" class="text-royal-600 font-bold">
                                🛡️ Admin Dashboard
                            </x-dropdown-link>
                            <div class="border-t border-gray-100 my-1"></div>
                        @endif
                        <x-dropdown-link :href="route('profile.edit')">
                            ⚙️ Profile Settings
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>

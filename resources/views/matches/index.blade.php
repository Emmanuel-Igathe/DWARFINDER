<x-app-layout>
    <div class="min-h-screen" style="background:#F8F8FC;">

        <!-- ── HEADER ──────────────────────────────────────────── -->
        <div class="pt-6 pb-2 px-4 max-w-2xl mx-auto">
            <h1 class="text-2xl font-black text-gray-900">Matches ❤️</h1>
            <p class="text-gray-500 text-sm">People who liked you back</p>
        </div>

        <div class="max-w-2xl mx-auto px-4 pb-10">

            @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded-2xl text-center font-semibold text-white text-sm"
                     class="px-5 py-3 rounded-2xl flex items-center justify-center text-white font-black text-sm shadow-lg shadow-royal-500/20 bg-royal-gradient">
                    {{ session('success') }}
                </div>
            @endif

            @if($matches->isEmpty())
                <!-- Empty State -->
                <div class="text-center py-24">
                    <div class="text-8xl mb-6 animate-bounce-slow">💔</div>
                    <h3 class="text-2xl font-black text-gray-800 mb-2">No Matches Yet</h3>
                    <p class="text-gray-500 text-sm max-w-xs mx-auto mb-8">
                        Start swiping to find people who like you back. Your first match is just a swipe away!
                    </p>
                    <a href="{{ route('discover.index') }}" class="btn-royal text-base">
                        Start Swiping 🔥
                    </a>
                </div>

            @else
                <!-- Match Count Badge -->
                <div class="flex items-center gap-2 mb-5 px-1">
                    <span class="match-badge">{{ $matches->count() }} {{ $matches->count() == 1 ? 'Match' : 'Matches' }}</span>
                    <span class="text-xs text-gray-400">Keep swiping to get more!</span>
                </div>

                <!-- ── New Matches Bubbles Row ─────────────────── -->
                @php $newMatches = $matches->take(8); @endphp
                <div class="mb-6">
                    <h2 class="text-sm font-bold text-gray-700 mb-3 px-1">New Matches 🆕</h2>
                    <div class="flex gap-4 overflow-x-auto pb-2 scrollbar-hide" style="-ms-overflow-style:none;scrollbar-width:none;">
                        @foreach($newMatches as $match)
                            @if($match->otherUser && $match->otherUser->profile)
                                <a href="{{ route('messages.show', $match) }}" class="match-bubble flex-shrink-0">
                                    @if($match->otherUser->profile->photos->first())
                                        <img src="{{ asset('storage/' . $match->otherUser->profile->photos->first()->path) }}"
                                             alt="{{ $match->otherUser->profile->display_name }}"
                                             class="match-bubble-avatar">
                                    @else
                                        <div class="match-bubble-avatar flex items-center justify-center text-white text-xl font-black"
                                             class="w-full h-full bg-royal-gradient">
                                            {{ strtoupper(substr($match->otherUser->profile->display_name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="truncate max-w-16">{{ explode(' ', $match->otherUser->profile->display_name)[0] }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- ── Conversation List ───────────────────────── -->
                <div>
                    <h2 class="text-sm font-bold text-gray-700 mb-3 px-1">Conversations 💬</h2>
                    <div class="space-y-2">
                        @foreach($matches as $match)
                            @if($match->otherUser && $match->otherUser->profile)
                                <a href="{{ route('messages.show', $match) }}" class="convo-item block">
                                    <!-- Avatar -->
                                    @if($match->otherUser->profile->photos->first())
                                        <img src="{{ asset('storage/' . $match->otherUser->profile->photos->first()->path) }}"
                                             alt="{{ $match->otherUser->profile->display_name }}"
                                             class="convo-avatar">
                                    @else
                                        <div class="convo-avatar flex items-center justify-center text-white font-black text-lg flex-shrink-0"
                                             class="w-full h-full bg-royal-gradient">
                                            {{ strtoupper(substr($match->otherUser->profile->display_name, 0, 1)) }}
                                        </div>
                                    @endif

                                    <!-- Info -->
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between">
                                            <p class="font-bold text-gray-900 text-sm truncate">
                                                {{ $match->otherUser->profile->display_name }},
                                                {{ \Carbon\Carbon::parse($match->otherUser->profile->birth_date)->age }}
                                            </p>
                                            <span class="text-xs text-gray-400 ml-2 flex-shrink-0">
                                                {{ $match->matched_at->diffForHumans(null, true) }}
                                            </span>
                                        </div>
                                        <p class="text-xs text-gray-400 mt-0.5 truncate">
                                            @if($match->otherUser->profile->city)
                                                📍 {{ $match->otherUser->profile->city }} ·
                                            @endif
                                            Matched {{ $match->matched_at->diffForHumans() }}
                                        </p>
                                        <p class="text-xs mt-1 font-medium text-royal-600">
                                            Tap to say hello 👋
                                        </p>
                                    </div>

                                    <!-- Arrow -->
                                    <svg class="w-4 h-4 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

            @endif
        </div>
    </div>
</x-app-layout>

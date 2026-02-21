<x-app-layout>
    <div class="min-h-screen" style="background:#F8F8FC;">

        <!-- ── HEADER ──────────────────────────────────────────── -->
        <div class="pt-8 pb-4 px-4 max-w-5xl mx-auto">
            <div class="flex items-center justify-between mb-1">
                <div>
                    <h1 class="text-2xl font-black text-gray-900">
                        Hey, {{ Auth::user()->profile->display_name ?? Auth::user()->name }} 👋
                    </h1>
                    <p class="text-gray-500 text-sm">Your journey to love continues here</p>
                </div>
                <a href="{{ route('discover.index') }}" class="btn-royal text-sm px-5 py-2.5">
                    Discover 💜
                </a>
            </div>
        </div>

        <div class="max-w-5xl mx-auto px-4 pb-16 space-y-8">

            <!-- ── QUICK STATS ───────────────────────────────── -->
            <div class="grid grid-cols-3 gap-3">
                @foreach([
                    ['label'=>'Matches','value' => Auth::user()->profile->match_count ?? 0,'emoji'=>'💜','href'=>route('matches.index'),'color'=>'#8b5cf6'],
                    ['label'=>'Profile Views','value' => Auth::user()->profile->profile_views ?? 0,'emoji'=>'👀','href'=>'#','color'=>'#7c3aed'],
                    ['label'=>'Likes Given','value' => Auth::user()->profile->like_count ?? 0,'emoji'=>'✨','href'=>route('likes.index'),'color'=>'#6d28d9'],
                ] as $stat)
                <a href="{{ $stat['href'] }}"
                   class="bg-white rounded-2xl p-4 text-center shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5">
                    <div class="text-2xl mb-1">{{ $stat['emoji'] }}</div>
                    <div class="text-2xl font-black" style="color:{{ $stat['color'] }};">{{ $stat['value'] }}</div>
                    <div class="text-xs text-gray-500 font-medium mt-0.5">{{ $stat['label'] }}</div>
                </a>
                @endforeach
            </div>

            <!-- ── DISCOVER CTA CARD ─────────────────────────── -->
            <a href="{{ route('discover.index') }}"
               class="block w-full rounded-3xl overflow-hidden relative group"
               style="height:160px; background:linear-gradient(135deg,#8b5cf6,#6d28d9,#4f46e5);">
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity" style="background:rgba(0,0,0,0.15);"></div>
                <div class="absolute inset-0 flex items-center justify-between px-8">
                    <div class="text-white">
                        <p class="text-xs font-bold uppercase tracking-widest text-white/70 mb-1">Ready?</p>
                        <h2 class="text-2xl font-black leading-tight">Start Discovering</h2>
                        <p class="text-white/70 text-sm mt-1">Amazing connections await 💜</p>
                    </div>
                    <div class="text-7xl group-hover:scale-110 transition-transform">✨</div>
                </div>
            </a>

            <!-- ── QUICK ACTIONS ─────────────────────────────── -->
            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('messages.index') }}"
                   class="bg-white rounded-2xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 group">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform" style="background:#FFF1F2;">
                        💬
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">Messages</p>
                        <p class="text-xs text-gray-500">Chat with matches</p>
                    </div>
                </a>

                <a href="{{ route('likes.index') }}"
                   class="bg-white rounded-2xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 group">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform" style="background:#FFF1F2;">
                        ❤️
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">Your Likes</p>
                        <p class="text-xs text-gray-500">See who you liked</p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}"
                   class="bg-white rounded-2xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 group">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform" style="background:#F0FFF4;">
                        ⚙️
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-sm">Edit Profile</p>
                        <p class="text-xs text-gray-500">Update your info</p>
                    </div>
                </a>

                <a href="{{ route('matches.index') }}"
                   class="rounded-2xl p-5 flex items-center gap-4 shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 group"
                   style="background:linear-gradient(135deg,#8b5cf6,#6d28d9);">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform bg-white/20">
                        💜
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm">My Matches</p>
                        <p class="text-xs text-white/70">View all matches</p>
                    </div>
                </a>
            </div>

            <!-- ── PROFILE COMPLETION ────────────────────────── -->
            @if(!Auth::user()->profile || !Auth::user()->profile->photos->first())
                <div class="bg-white rounded-2xl p-5 shadow-sm border-l-4" style="border-color:#8b5cf6;">
                    <div class="flex items-center gap-4">
                        <div class="text-3xl">📸</div>
                        <div class="flex-1">
                            <p class="font-bold text-gray-900 text-sm">Update your photos</p>
                            <p class="text-xs text-gray-500 mt-0.5">High-quality photos get 10× more engagement</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="text-xs font-bold px-3 py-1.5 rounded-full text-white bg-royal-gradient">
                            Add Photo
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
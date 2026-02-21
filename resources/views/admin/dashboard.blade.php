<x-app-layout>
    <div class="min-h-screen" style="background:#F8F8FC;">

        <!-- ── ADMIN HEADER ──────────────────────────────────────────── -->
        <div class="pt-10 pb-6 px-6 max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Admin Dashboard 💜</h1>
                    <p class="text-gray-500 font-medium">Manage the cave of sparks</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ url('/') }}" class="px-6 py-3 rounded-2xl bg-white text-gray-600 font-bold border border-gray-100 shadow-sm hover:bg-gray-50 transition-all">
                        View Site
                    </a>
                </div>
            </div>

            <!-- ── STATS GRID ────────────────────────────────── -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                    <div class="text-4xl mb-4">👥</div>
                    <div class="text-4xl font-black text-gray-900">{{ $stats['total_users'] }}</div>
                    <div class="text-sm font-bold text-gray-400 uppercase tracking-widest mt-2">Total Sparks</div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                    <div class="text-4xl mb-4">🛡️</div>
                    <div class="text-4xl font-black text-royal-600">{{ $stats['admins'] }}</div>
                    <div class="text-sm font-bold text-gray-400 uppercase tracking-widest mt-2">Platform Admins</div>
                </div>

                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-gray-100">
                    <div class="text-4xl mb-4">✨</div>
                    <div class="text-4xl font-black text-indigo-500">{{ $stats['completed_profiles'] }}</div>
                    <div class="text-sm font-bold text-gray-400 uppercase tracking-widest mt-2">Ready to Match</div>
                </div>
            </div>

            <!-- ── QUICK ACTIONS ─────────────────────────────── -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100 overflow-hidden relative">
                <div class="absolute top-0 right-0 p-10 opacity-5">
                    <svg class="w-64 h-64 text-royal-600/10" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </div>

                <h2 class="text-2xl font-black text-gray-900 mb-8">Management Tools</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 relative z-10">
                    <a href="{{ route('admin.users') }}" class="p-6 rounded-3xl bg-white border border-gray-100 hover:border-royal-500/30 hover:shadow-lg hover:shadow-royal-500/5 transition-all group">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-royal-100/50 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">🔥</div>
                            <span class="text-royal-600 font-bold text-xs uppercase tracking-widest">Active Sparks</span>
                        </div>
                        <h3 class="font-black text-gray-900 mb-1">Browse Sparks</h3>
                        <p class="text-xs text-gray-500 font-medium">Manage all registered users</p>
                    </a>

                    <a href="#" class="p-6 rounded-3xl bg-gray-50 border border-gray-100 opacity-50 cursor-not-allowed">
                        <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-xl mb-4">🚩</div>
                        <h3 class="font-black text-gray-900 mb-1">Reports</h3>
                        <p class="text-xs text-gray-500 font-medium">Coming soon</p>
                    </a>

                    <a href="#" class="p-6 rounded-3xl bg-gray-50 border border-gray-100 opacity-50 cursor-not-allowed">
                        <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-xl mb-4">💬</div>
                        <h3 class="font-black text-gray-900 mb-1">Global Msg</h3>
                        <p class="text-xs text-gray-500 font-medium">Coming soon</p>
                    </a>

                    <a href="#" class="p-6 rounded-3xl bg-gray-50 border border-gray-100 opacity-50 cursor-not-allowed">
                        <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-xl mb-4">⚙️</div>
                        <h3 class="font-black text-gray-900 mb-1">Setings</h3>
                        <p class="text-xs text-gray-500 font-medium">Coming soon</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

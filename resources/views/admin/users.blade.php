<x-app-layout>
    <div class="min-h-screen" style="background:#F8F8FC;">

        <!-- ── HEADER ──────────────────────────────────────────── -->
        <div class="pt-10 pb-6 px-6 max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <a href="{{ route('admin.dashboard') }}" class="text-royal-600 font-black text-sm uppercase tracking-widest mb-2 inline-flex items-center gap-2">
                        ← Admin Dashboard
                    </a>
                    <h1 class="text-3xl font-black text-gray-900 tracking-tight">Active Sparks 🔥</h1>
                </div>
            </div>

            <!-- ── USERS TABLE ────────────────────────────────── -->
            <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100">
                                <th class="px-8 py-6 text-left text-xs font-black uppercase tracking-widest text-gray-400">Spark</th>
                                <th class="px-8 py-6 text-left text-xs font-black uppercase tracking-widest text-gray-400">Role</th>
                                <th class="px-8 py-6 text-left text-xs font-black uppercase tracking-widest text-gray-400">Status</th>
                                <th class="px-8 py-6 text-left text-xs font-black uppercase tracking-widest text-gray-400">Joined</th>
                                <th class="px-8 py-6 text-right text-xs font-black uppercase tracking-widest text-gray-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50/30 transition-colors group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-royal-gradient-soft flex items-center justify-center text-xl overflow-hidden border border-royal-100/20">
                                            @if($user->profile && $user->profile->photos && $user->profile->photos->first())
                                                <img src="{{ asset('storage/' . $user->profile->photos->first()->path) }}" class="w-full h-full object-cover">
                                            @else
                                                <span class="font-black text-white/50">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-4xl font-black text-royal-600">{{ $stats['admins'] }}</div>
                                            <div class="text-xs text-gray-500 font-medium">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="inline-flex px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $user->isAdmin() ? 'bg-royal-gradient text-white shadow-sm' : 'bg-gray-100 text-gray-400' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="flex items-center gap-1.5 text-xs font-bold {{ $user->profile_completed ? 'text-green-500' : 'text-gray-300' }}">
                                        <span class="w-1.5 h-1.5 rounded-full bg-current"></span>
                                        {{ $user->profile_completed ? 'Ready' : 'Pending' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-xs text-gray-500 font-medium">
                                    {{ $user->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex justify-end items-center gap-2">
                                        <form method="POST" action="{{ route('admin.toggle-admin', $user) }}">
                                            @csrf
                                            <button type="submit" class="p-2 rounded-xl hover:bg-white hover:shadow-sm border border-transparent hover:border-gray-100 transition-all text-xs font-bold {{ $user->isAdmin() ? 'text-gray-400' : 'text-royal-600' }}">
                                                {{ $user->isAdmin() ? 'Remove Admin' : 'Make Admin' }}
                                            </button>
                                        </form>
                                        
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Kill this spark forever?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-xl text-gray-300 hover:text-red-500 hover:bg-white hover:shadow-sm border border-transparent hover:border-gray-100 transition-all">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

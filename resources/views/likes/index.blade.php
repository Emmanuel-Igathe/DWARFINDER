<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Likes You') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($likesReceived->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 text-center">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        <h3 class="text-xl font-medium text-gray-900">No likes yet</h3>
                        <p class="mt-1 text-gray-500">Keep your profile updated and be active to get more visibility!</p>
                    </div>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($likesReceived as $user)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-md transition-shadow duration-300">
                            <!-- Profile Image -->
                            <div class="h-64 bg-gray-200 relative group">
                                @if($user->profile && $user->profile->photos->first())
                                    <img src="{{ asset('storage/' . $user->profile->photos->first()->path) }}" 
                                         alt="{{ $user->profile->display_name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-100">
                                        <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                                    <a href="{{ route('users.show', $user) }}" class="px-4 py-2 bg-white text-gray-800 rounded-full font-medium shadow-lg transform hover:scale-105 transition-transform">
                                        View Profile
                                    </a>
                                </div>
                            </div>

                            <!-- Profile Info -->
                            <div class="p-6">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">
                                            {{ $user->profile ? $user->profile->display_name : $user->name }}
                                        </h3>
                                        @if($user->profile && $user->profile->birth_date)
                                            <p class="text-gray-600 text-sm">
                                                {{ \Carbon\Carbon::parse($user->profile->birth_date)->age }} years old
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($user->profile && $user->profile->city)
                                    <p class="text-gray-500 text-sm mb-4 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        {{ $user->profile->city }}
                                    </p>
                                @endif

                                <!-- Like Back Button -->
                                <form action="{{ route('like.store', $user) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="w-full btn-royal py-3 px-4 text-sm gap-2">
                                        💜 Send Like Back
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

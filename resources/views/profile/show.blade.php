<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid md:grid-cols-2 gap-0">
                    <!-- Left Column: Photos -->
                    <div class="bg-gray-100 relative h-96 md:h-auto min-h-[500px]">
                        @if($user->profile && $user->profile->photos->count() > 0)
                            <!-- Main Photo -->
                            <img src="{{ asset('storage/' . $user->profile->photos->first()->path) }}" 
                                 alt="{{ $user->profile->display_name }}"
                                 class="w-full h-full object-cover">
                                 
                            <!-- Photo Indicators (if multiple) -->
                            @if($user->profile->photos->count() > 1)
                                <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
                                    @foreach($user->profile->photos as $index => $photo)
                                        <div class="w-2 h-2 rounded-full {{ $index === 0 ? 'bg-white' : 'bg-white/50' }}"></div>
                                    @endforeach
                                </div>
                            @endif
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-200">
                                <svg class="w-32 h-32 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column: Details -->
                    <div class="p-8 flex flex-col h-full">
                        <div class="flex-grow">
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                {{ $user->profile->display_name }}
                                <span class="text-2xl font-normal text-gray-600">
                                    {{ \Carbon\Carbon::parse($user->profile->birth_date)->age }}
                                </span>
                            </h1>

                            <div class="flex items-center text-gray-600 mb-6">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $user->profile->city }}
                                {{ $user->profile->country ? ', ' . $user->profile->country : '' }}
                            </div>

                            @if($user->profile->bio)
                                <div class="mb-6">
                                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">About</h3>
                                    <p class="text-gray-700 leading-relaxed">{{ $user->profile->bio }}</p>
                                </div>
                            @endif

                            <!-- Details Grid -->
                            <div class="grid grid-cols-2 gap-4 mb-8">
                                @if($user->profile->height)
                                    <div>
                                        <h4 class="text-xs font-semibold text-gray-500 uppercase">Height</h4>
                                        <p class="text-gray-800">{{ $user->profile->height }} cm</p>
                                    </div>
                                @endif
                                @if($user->profile->beard_style)
                                    <div>
                                        <h4 class="text-xs font-semibold text-gray-500 uppercase">Beard Style</h4>
                                        <p class="text-gray-800">{{ $user->profile->beard_style }}</p>
                                    </div>
                                @endif
                                @if($user->profile->mountain_origin)
                                    <div>
                                        <h4 class="text-xs font-semibold text-gray-500 uppercase">Origin</h4>
                                        <p class="text-gray-800">{{ $user->profile->mountain_origin }}</p>
                                    </div>
                                @endif
                                @if($user->profile->craft_specialty)
                                    <div>
                                        <h4 class="text-xs font-semibold text-gray-500 uppercase">Craft</h4>
                                        <p class="text-gray-800">{{ $user->profile->craft_specialty }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-auto pt-6 border-t border-gray-100">
                            @if($isMatched)
                                <a href="{{ route('messages.show', $user) }}" class="w-full block text-center bg-purple-600 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded-xl transition-colors duration-300">
                                    Message
                                </a>
                            @elseif($hasLikedMe)
                                <form action="{{ route('like.store', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full btn-royal py-3 px-4">
                                        Like Back!
                                    </button>
                                </form>
                            @elseif($hasLiked)
                                <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-3 px-4 rounded-xl cursor-not-allowed">
                                    Liked
                                </button>
                            @else
                                <form action="{{ route('like.store', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full btn-royal py-3 px-4 shadow-lg shadow-royal-500/20">
                                        Like
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

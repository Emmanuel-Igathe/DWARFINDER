<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-royal-gradient">
            {{ __('Messages') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if($conversations->isEmpty())
                <div class="text-center py-20 bg-white rounded-2xl shadow-lg">
                    <svg class="w-24 h-24 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">No Messages Yet</h3>
                    <p class="text-gray-500 mb-6">Match with someone to start chatting!</p>
                    <a href="{{ route('discover.index') }}" class="btn-primary inline-block">
                        Find Matches
                    </a>
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                    @foreach($conversations as $conversation)
                        @if($conversation->otherUser && $conversation->otherUser->profile)
                            <a href="{{ route('messages.show', $conversation) }}" 
                               class="flex items-center p-4 border-b hover:bg-royal-50 transition-all duration-200">
                                <!-- Profile Picture -->
                                <div class="flex-shrink-0 mr-4 relative">
                                    <div class="w-16 h-16 rounded-full bg-royal-gradient flex items-center justify-center overflow-hidden">
                                        @if($conversation->otherUser->profile->photos->first())
                                            <img src="{{ asset('storage/' . $conversation->otherUser->profile->photos->first()->path) }}" 
                                                 alt="{{ $conversation->otherUser->profile->display_name }}"
                                                 class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                            </svg>
                                        @endif
                                    </div>
                                    @if($conversation->unreadCount > 0)
                                        <span class="absolute -top-1 -right-1 w-6 h-6 bg-royal-gradient text-white text-xs font-bold rounded-full flex items-center justify-center">
                                            {{ $conversation->unreadCount }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Message Info -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start mb-1">
                                        <h4 class="text-lg font-bold text-gray-900 truncate">
                                            {{ $conversation->otherUser->profile->display_name }}
                                        </h4>
                                        @if($conversation->latestMessage)
                                            <span class="text-xs text-gray-500 ml-2 flex-shrink-0">
                                                {{ $conversation->latestMessage->created_at->diffForHumans() }}
                                            </span>
                                        @endif
                                    </div>
                                    
                                    @if($conversation->latestMessage)
                                        <p class="text-sm text-gray-600 truncate {{ $conversation->unreadCount > 0 ? 'font-semibold' : '' }}">
                                            {{ Str::limit($conversation->latestMessage->message, 50) }}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 italic">No messages yet</p>
                                    @endif
                                </div>

                                <!-- Arrow Icon -->
                                <svg class="w-5 h-5 text-gray-400 ml-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

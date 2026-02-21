<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('messages.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-full bg-royal-gradient flex items-center justify-center overflow-hidden">
                    @if($otherUser->profile && $otherUser->profile->photos->first())
                        <img src="{{ asset('storage/' . $otherUser->profile->photos->first()->path) }}" 
                             alt="{{ $otherUser->profile->display_name }}"
                             class="w-full h-full object-cover">
                    @else
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                        </svg>
                    @endif
                </div>
                <h2 class="font-semibold text-xl text-royal-gradient">
                    {{ $otherUser->profile ? $otherUser->profile->display_name : $otherUser->name }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Messages Container -->
            <div class="bg-white rounded-2xl shadow-lg mb-6 overflow-hidden">
                <div class="h-[600px] overflow-y-auto p-6 space-y-4" id="messagesContainer">
                    @if($messages->isEmpty())
                        <div class="text-center py-20">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p class="text-gray-500">No messages yet. Start the conversation!</p>
                        </div>
                    @else
                        @foreach($messages as $message)
                            <div class="flex {{ $message->sender_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                <div class="{{ $message->sender_id == Auth::id() ? 'message-sent' : 'message-received' }}">
                                    <p class="break-words">{{ $message->message }}</p>
                                    <p class="text-xs mt-1 opacity-70">
                                        {{ $message->created_at->format('g:i A') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Message Input -->
            <div class="bg-white rounded-2xl shadow-lg p-4">
                <form action="{{ route('messages.store', $match) }}" method="POST" class="flex space-x-3">
                    @csrf
                    <input type="text" 
                           name="message" 
                           placeholder="Type a message..." 
                           required
                           maxlength="1000"
                           class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-200"
                           autocomplete="off">
                    <button type="submit" class="btn-primary flex items-center space-x-2">
                        <span>Send</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Auto-scroll to bottom of messages
        const messagesContainer = document.getElementById('messagesContainer');
        if (messagesContainer) {
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
    </script>
    @endpush
</x-app-layout>

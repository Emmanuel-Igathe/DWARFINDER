<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile Setup') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <!-- Progress Bar -->
            <div class="mb-8 p-6 bg-white/5 backdrop-blur-xl rounded-[2.5rem] border border-white/10 shadow-2xl">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-sm font-black text-royal-400 uppercase tracking-widest">Step 2 of 3</span>
                    <span class="text-sm font-black text-white/50">66%</span>
                </div>
                <div class="w-full bg-white/10 rounded-full h-3 overflow-hidden shadow-inner">
                    <div class="bg-royal-gradient h-full rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(139,92,246,0.5)]" style="width: 66%"></div>
                </div>
                <div class="flex justify-between mt-4 text-[10px] font-black uppercase tracking-widest text-white/30">
                    <span class="text-royal-400">Basic Info</span>
                    <span class="text-royal-400">Photos</span>
                    <span>Details</span>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Add your best photos</h3>
                    
                    @if(count($photos) > 0)
                        <div class="mb-8">
                            <h4 class="text-sm font-medium text-gray-700 mb-3">Your Photos</h4>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach($photos as $photo)
                                    <div class="relative group aspect-square bg-gray-100 rounded-lg overflow-hidden">
                                        <img src="{{ Storage::url($photo->path) }}" alt="Profile photo" class="w-full h-full object-cover">
                                        @if($photo->is_primary)
                                            <div class="absolute top-2 left-2 bg-royal-600 text-white text-[10px] font-black uppercase tracking-widest px-2 py-1 rounded-lg">Main</div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="mb-6 p-4 bg-royal-50 border-l-4 border-royal-400 text-royal-700 rounded-r-xl">
                            <p class="text-sm font-bold flex items-center gap-2">
                                <span>ℹ️</span> You need to upload at least one photo to continue.
                            </p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.setup.step2') }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Photo Upload -->
                        <div>
                            <x-input-label for="photos" :value="__('Upload New Photos')" />
                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-purple-500 transition-colors cursor-pointer" onclick="document.getElementById('photos').click()">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="photos" class="relative cursor-pointer bg-white rounded-md font-medium text-royal-600 hover:text-royal-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-royal-500">
                                            <span>Upload images</span>
                                            <input id="photos" name="photos[]" type="file" class="sr-only" multiple accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 5MB</p>
                                </div>
                            </div>
                            <p id="file-count" class="text-sm text-gray-500 mt-2 text-center"></p>
                            <x-input-error :messages="$errors->get('photos')" class="mt-2" />
                            <x-input-error :messages="$errors->get('photos.*')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-between mt-10">
                            <a href="{{ route('profile.setup.step1') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                                &larr; Back
                            </a>

                            <button type="submit" class="btn-royal px-10 py-4 text-base shadow-xl shadow-royal-500/20">
                                {{ __('Next Step →') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('photos').addEventListener('change', function(e) {
            const count = e.target.files.length;
            const text = count === 1 ? '1 file selected' : count + ' files selected';
            document.getElementById('file-count').textContent = text;
        });
    </script>
</x-app-layout>

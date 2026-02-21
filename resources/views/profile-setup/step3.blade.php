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
                    <span class="text-sm font-black text-royal-400 uppercase tracking-widest">Step 3 of 3</span>
                    <span class="text-sm font-black text-white/50">99%</span>
                </div>
                <div class="w-full bg-white/10 rounded-full h-3 overflow-hidden shadow-inner">
                    <div class="bg-royal-gradient h-full rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(139,92,246,0.5)]" style="width: 100%"></div>
                </div>
                <div class="flex justify-between mt-4 text-[10px] font-black uppercase tracking-widest text-white/30">
                    <span class="text-royal-400">Basic Info</span>
                    <span class="text-royal-400">Photos</span>
                    <span class="text-royal-400">Details</span>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">More About You</h3>
                        <form method="POST" action="{{ route('profile.setup.skip') }}">
                            @csrf
                            <button type="submit" class="text-xs font-bold text-white/40 hover:text-royal-400 transition-colors">
                                Skip & Finish
                            </button>
                        </form>
                    </div>
                    
                    <p class="mb-6 text-gray-600 text-sm">These details are optional but help you find better matches.</p>

                    <form method="POST" action="{{ route('profile.setup.step3') }}" class="space-y-6">
                        @csrf

                        <!-- Bio -->
                        <div>
                            <x-input-label for="bio" :value="__('About Me')" />
                            <textarea id="bio" name="bio" rows="4" class="block mt-1 w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm" placeholder="Tell us about yourself, your interests, and what you're looking for...">{{ old('bio', $profile->bio) }}</textarea>
                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                        </div>

                        <!-- Location -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="city" :value="__('City')" />
                                <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $profile->city)" />
                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="country" :value="__('Country')" />
                                <x-text-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country', $profile->country)" />
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                            </div>
                        </div>

                        <div class="border-t border-gray-200 my-6 pt-6">
                            <h4 class="text-md font-medium text-gray-900 mb-4">Dwarf Traits (Just for fun!)</h4>
                            
                            <!-- Beard Style -->
                            <div class="mb-4">
                                <x-input-label for="beard_style" :value="__('Beard Style')" />
                                <x-text-input id="beard_style" class="block mt-1 w-full" type="text" name="beard_style" :value="old('beard_style', $profile->beard_style)" placeholder="e.g. Braided, Bushy, Short" />
                                <x-input-error :messages="$errors->get('beard_style')" class="mt-2" />
                            </div>

                            <!-- Mining Expertise -->
                            <div class="mb-4">
                                <x-input-label for="mining_expertise" :value="__('Mining Expertise')" />
                                <select id="mining_expertise" name="mining_expertise" class="block mt-1 w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm">
                                    <option value="" {{ old('mining_expertise', $profile->mining_expertise) ? '' : 'selected' }}>None selected</option>
                                    <option value="beginner" {{ old('mining_expertise', $profile->mining_expertise) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="intermediate" {{ old('mining_expertise', $profile->mining_expertise) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="expert" {{ old('mining_expertise', $profile->mining_expertise) == 'expert' ? 'selected' : '' }}>Expert</option>
                                    <option value="master" {{ old('mining_expertise', $profile->mining_expertise) == 'master' ? 'selected' : '' }}>Master</option>
                                </select>
                                <x-input-error :messages="$errors->get('mining_expertise')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between mt-10">
                            <a href="{{ route('profile.setup.step2') }}" class="text-sm font-bold text-gray-400 hover:text-gray-600 transition-colors">
                                &larr; Back
                            </a>

                            <button type="submit" class="btn-royal px-10 py-4 text-base shadow-xl shadow-royal-500/20">
                                {{ __('Complete Setup 💜') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

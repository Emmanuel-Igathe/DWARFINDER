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
                    <span class="text-sm font-black text-royal-400 uppercase tracking-widest">Step 1 of 3</span>
                    <span class="text-sm font-black text-white/50">33%</span>
                </div>
                <div class="w-full bg-white/10 rounded-full h-3 overflow-hidden shadow-inner">
                    <div class="bg-royal-gradient h-full rounded-full transition-all duration-1000 shadow-[0_0_15px_rgba(139,92,246,0.5)]" style="width: 33%"></div>
                </div>
                <div class="flex justify-between mt-4 text-[10px] font-black uppercase tracking-widest text-white/30">
                    <span class="text-royal-400">Basic Info</span>
                    <span>Photos</span>
                    <span>Details</span>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Tell us about yourself</h3>
                    
                    <form method="POST" action="{{ route('profile.setup.step1') }}" class="space-y-6">
                        @csrf

                        <!-- Display Name -->
                        <div>
                            <x-input-label for="display_name" :value="__('Display Name')" />
                            <x-text-input id="display_name" class="block mt-1 w-full" type="text" name="display_name" :value="old('display_name', $profile->display_name ?? $user->name)" required autofocus placeholder="Your public handle" />
                            <x-input-error :messages="$errors->get('display_name')" class="mt-2" />
                            <p class="text-sm text-gray-500 mt-1">This is the name others will see.</p>
                        </div>

                        <!-- Birth Date -->
                        <div>
                            <x-input-label for="birth_date" :value="__('Date of Birth')" />
                            <x-text-input id="birth_date" class="block mt-1 w-full" type="date" name="birth_date" :value="old('birth_date', $profile->birth_date ? $profile->birth_date->format('Y-m-d') : '')" required autofocus />
                            <x-input-error :messages="$errors->get('birth_date')" class="mt-2" />
                            <p class="text-sm text-gray-500 mt-1">You must be at least 18 years old to join.</p>
                        </div>

                        <!-- Gender -->
                        <div>
                            <x-input-label for="gender" :value="__('I identify as')" />
                            <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm" required>
                                <option value="" disabled {{ old('gender', $profile->gender) ? '' : 'selected' }}>Select gender</option>
                                <option value="male" {{ old('gender', $profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="non_binary" {{ old('gender', $profile->gender) == 'non_binary' ? 'selected' : '' }}>Non-binary</option>
                                <option value="other" {{ old('gender', $profile->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>

                        <!-- Looking For -->
                        <div>
                            <x-input-label for="looking_for" :value="__('I am looking for')" />
                            <select id="looking_for" name="looking_for" class="block mt-1 w-full border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-md shadow-sm" required>
                                <option value="" disabled {{ old('looking_for', $profile->looking_for) ? '' : 'selected' }}>Select preference</option>
                                <option value="male" {{ old('looking_for', $profile->looking_for) == 'male' ? 'selected' : '' }}>Men</option>
                                <option value="female" {{ old('looking_for', $profile->looking_for) == 'female' ? 'selected' : '' }}>Women</option>
                                <option value="both" {{ old('looking_for', $profile->looking_for) == 'both' ? 'selected' : '' }}>Both</option>
                                <option value="non_binary" {{ old('looking_for', $profile->looking_for) == 'non_binary' ? 'selected' : '' }}>Non-binary people</option>
                                <option value="all" {{ old('looking_for', $profile->looking_for) == 'all' ? 'selected' : '' }}>Everyone</option>
                            </select>
                            <x-input-error :messages="$errors->get('looking_for')" class="mt-2" />
                        </div>

                        <!-- Height (Optional) -->
                        <div>
                            <div class="flex justify-between">
                                <x-input-label for="height" :value="__('Height (cm)')" />
                                <span class="text-xs text-gray-500">Optional</span>
                            </div>
                            <x-text-input id="height" class="block mt-1 w-full" type="number" name="height" :value="old('height', $profile->height)" min="50" max="300" placeholder="e.g. 145" />
                            <x-input-error :messages="$errors->get('height')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-10">
                            <button type="submit" class="btn-royal px-10 py-4 text-base shadow-xl shadow-royal-500/20">
                                {{ __('Next Step →') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

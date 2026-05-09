<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="display_name" :value="__('Display Name')" />
            <x-text-input id="display_name" name="display_name" type="text" class="mt-1 block w-full" :value="old('display_name', $user->profile->display_name ?? $user->name)" required autocomplete="nickname" />
            <x-input-error class="mt-2" :messages="$errors->get('display_name')" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio')" />
            <textarea id="bio" name="bio" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="3">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="gender" :value="__('I am a')" />
                <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach(['male', 'female', 'non_binary', 'other'] as $g)
                        <option value="{{ $g }}" {{ old('gender', $user->profile->gender ?? '') == $g ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $g)) }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>

            <div>
                <x-input-label for="looking_for" :value="__('Looking for')" />
                <select id="looking_for" name="looking_for" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach(['male', 'female', 'both', 'non_binary', 'all'] as $l)
                        <option value="{{ $l }}" {{ old('looking_for', $user->profile->looking_for ?? '') == $l ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $l)) }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('looking_for')" />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div>
                <x-input-label for="height" :value="__('Height (cm)')" />
                <x-text-input id="height" name="height" type="number" class="mt-1 block w-full" :value="old('height', $user->profile->height ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('height')" />
            </div>

            <div>
                <x-input-label for="city" :value="__('City')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $user->profile->city ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('city')" />
            </div>

            <div>
                <x-input-label for="country" :value="__('Country')" />
                <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $user->profile->country ?? '')" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

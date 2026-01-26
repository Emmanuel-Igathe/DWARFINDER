<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Register - Dwarfinder</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
                min-height: 100vh;
            }
            
            .dwarf-card {
                background: rgba(255, 255, 255, 0.05);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            
            .dwarf-input {
                background: rgba(0, 0, 0, 0.3);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: white;
            }
            
            .dwarf-input:focus {
                border-color: #8b5cf6;
                box-shadow: 0 0 0 2px rgba(139, 92, 246, 0.2);
            }
        </style>
    </head>
    <body class="font-sans text-gray-100 antialiased">
        <div class="min-h-screen flex flex-col items-center justify-center pt-6 sm:pt-0 px-4">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="inline-block p-4 rounded-full bg-gradient-to-br from-purple-900 to-gray-900 mb-4">
                    <span class="text-4xl">⚒️</span>
                </div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-purple-400 to-pink-600 bg-clip-text text-transparent">
                    Dwarfinder
                </h1>
                <p class="text-gray-400 mt-2">Find your perfect mining partner</p>
            </div>

            <!-- Registration Card -->
            <div class="w-full max-w-md dwarf-card rounded-2xl shadow-2xl p-8">
                <h2 class="text-2xl font-bold text-center mb-6">Create Your Account</h2>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                               class="dwarf-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                               placeholder="Thorin Oakenshield">
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Display Name -->
                    <div class="mb-4">
                        <label for="display_name" class="block text-sm font-medium text-gray-300 mb-2">Display Name</label>
                        <input id="display_name" type="text" name="display_name" value="{{ old('display_name') }}" required
                               class="dwarf-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                               placeholder="MountainKing">
                        @error('display_name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               class="dwarf-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                               placeholder="thorin@dwarfinder.com">
                        @error('email')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                        <input id="password" type="password" name="password" required
                               class="dwarf-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                               placeholder="••••••••">
                        @error('password')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="dwarf-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                               placeholder="••••••••">
                    </div>

                    <!-- Dwarf Profile Section -->
                    <div class="mb-6 p-4 bg-gray-900/50 rounded-xl border border-gray-700">
                        <h3 class="text-lg font-semibold text-gray-200 mb-4 flex items-center">
                            <span class="mr-2">⚔️</span> Dwarf Profile
                        </h3>
                        
                        <!-- Birth Date -->
                        <div class="mb-4">
                            <label for="birth_date" class="block text-sm font-medium text-gray-300 mb-2">Birth Date</label>
                            <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}" required
                                   class="dwarf-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                            <p class="text-gray-500 text-xs mt-1">Must be at least 18 years old</p>
                            @error('birth_date')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="mb-4">
                            <label for="gender" class="block text-sm font-medium text-gray-300 mb-2">Gender</label>
                            <select id="gender" name="gender" required
                                    class="dwarf-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="non_binary" {{ old('gender') == 'non_binary' ? 'selected' : '' }}>Non-binary</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Height -->
                        <div class="mb-4">
                            <label for="height" class="block text-sm font-medium text-gray-300 mb-2">Height (cm)</label>
                            <input id="height" type="number" name="height" min="50" max="250" 
                                   value="{{ old('height', 150) }}" required
                                   class="dwarf-input w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition"
                                   placeholder="150">
                            @error('height')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="terms" required 
                                   class="rounded border-gray-600 text-purple-600 focus:ring-purple-500">
                            <span class="ml-2 text-sm text-gray-400">
                                I agree to the <a href="#" class="text-purple-400 hover:text-purple-300">Terms of Service</a> 
                                and <a href="#" class="text-purple-400 hover:text-purple-300">Privacy Policy</a>
                            </span>
                        </label>
                        @error('terms')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-3 px-4 rounded-lg hover:from-purple-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 focus:ring-offset-gray-900 transition duration-300">
                        Begin Your Journey
                    </button>

                    <!-- Login Link -->
                    <div class="text-center mt-6">
                        <p class="text-gray-400 text-sm">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-purple-400 hover:text-purple-300 font-medium ml-1">
                                Sign in here
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center text-gray-500 text-sm">
                <p>© 2024 Dwarfinder. All rights reserved.</p>
                <p class="mt-1">Forge new connections in the deepest mines</p>
            </div>
        </div>

        <script>
            // Set max date to 18 years ago
            document.addEventListener('DOMContentLoaded', function() {
                const birthDateInput = document.getElementById('birth_date');
                if (birthDateInput) {
                    const today = new Date();
                    const maxDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
                    const maxDateString = maxDate.toISOString().split('T')[0];
                    
                    birthDateInput.max = maxDateString;
                    
                    // Set default value to 25 years ago if empty
                    if (!birthDateInput.value) {
                        const defaultDate = new Date(today.getFullYear() - 25, today.getMonth(), today.getDate());
                        const defaultDateString = defaultDate.toISOString().split('T')[0];
                        birthDateInput.value = defaultDateString;
                    }
                }
            });
        </script>
    </body>
</html>
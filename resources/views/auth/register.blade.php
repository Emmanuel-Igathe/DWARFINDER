<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - Dwarfinder</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900" style="background:#0F0F13;">
    <div class="min-h-screen flex flex-col items-center justify-center p-6 relative overflow-hidden">
        
        <!-- Background Blobs -->
        <div class="absolute top-0 right-1/2 translate-x-1/2 w-full h-full pointer-events-none opacity-20">
            <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-indigo-500 rounded-full mix-blend-screen filter blur-[120px] animate-pulse"></div>
            <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-royal-500 rounded-full mix-blend-screen filter blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="w-full max-w-md relative z-10">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shadow-xl shadow-royal-500/20 bg-royal-gradient">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                </a>
                <h1 class="text-4xl font-black text-white mt-4 tracking-tight">Dwarfinder</h1>
                <p class="text-white/50 mt-2 font-medium">Join the cave of sparks 💜</p>
            </div>

            <div class="bg-white/10 backdrop-blur-2xl rounded-[2.5rem] p-10 border border-white/15 shadow-2xl">
                <h2 class="text-2xl font-black text-white mb-8 text-center">Create Spark</h2>

                <!-- Social Login -->
                <div class="grid grid-cols-2 gap-3 mb-8">
                    <a href="{{ route('social.redirect', 'google') }}" class="flex items-center justify-center h-14 rounded-2xl bg-white hover:bg-gray-100 transition-all">
                        <svg class="w-6 h-6" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                    </a>
                    <a href="{{ route('social.redirect', 'facebook') }}" class="flex items-center justify-center h-14 rounded-2xl bg-[#1877F2] hover:bg-[#166FE5] transition-all">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                </div>

                <div class="relative py-4 mb-4">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/10"></div>
                    </div>
                    <div class="relative flex justify-center text-xs font-bold uppercase tracking-widest">
                        <span class="px-4 text-white/30">Or Registration</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               class="w-full h-14 px-5 rounded-2xl bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-royal-500/50 focus:border-royal-500 transition-all text-white font-medium placeholder:text-white/20"
                               placeholder="Full Name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs font-bold text-royal-500" />
                    </div>

                    <!-- Email -->
                    <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               class="w-full h-14 px-5 rounded-2xl bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-royal-500/50 focus:border-royal-500 transition-all text-white font-medium placeholder:text-white/20"
                               placeholder="Email Address">
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs font-bold text-royal-500" />
                    </div>

                    <!-- Password -->
                    <div>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                               class="w-full h-14 px-5 rounded-2xl bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-royal-500/50 focus:border-royal-500 transition-all text-white font-medium placeholder:text-white/20"
                               placeholder="Create Password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs font-bold text-royal-500" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="w-full h-14 px-5 rounded-2xl bg-white/5 border border-white/10 focus:outline-none focus:ring-2 focus:ring-royal-500/50 focus:border-royal-500 transition-all text-white font-medium placeholder:text-white/20"
                               placeholder="Confirm Password">
                    </div>

                    <button type="submit" class="w-full h-16 bg-royal-gradient text-white font-black py-4 rounded-2xl shadow-xl shadow-royal-500/30 hover:shadow-royal-500/50 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 text-lg mt-4">
                        Create Account 💜
                    </button>
                    
                    <p class="text-center text-white/50 text-sm mt-8">
                        Already have a Spark? 
                        <a href="{{ route('login') }}" class="text-white font-black hover:text-royal-400 underline underline-offset-8 decoration-2 transition-all">Sign In</a>
                    </p>
                </form>
            </div>
            
            <p class="text-center text-xs text-white/20 mt-10">
                <a href="{{ url('/') }}" class="hover:text-white/40 transition-colors">Back to Home</a>
            </p>
        </div>
    </div>
</body>
</html>
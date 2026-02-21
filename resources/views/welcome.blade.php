<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dwarfinder — Find Your Spark ❤️‍🔥</title>
    <meta name="description" content="The inclusive dating app where every spark matters. Swipe, match, and connect with amazing people worldwide.">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        body { overflow-x: hidden; }

        /* Floating hearts */
        .heart-particle { position: absolute; bottom: -30px; animation: floatHeart linear infinite; pointer-events: none; }
        @keyframes floatHeart {
            0%   { transform: translateY(0) rotate(0deg) scale(1); opacity: 0.7; }
            100% { transform: translateY(-110vh) rotate(720deg) scale(0.4); opacity: 0; }
        }

        /* Tinder card stack mockup */
        .demo-card { position: absolute; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .demo-card-1 { width: 220px; height: 300px; top: 0; left: 50%; transform: translateX(-50%); z-index: 3; }
        .demo-card-2 { width: 210px; height: 290px; top: 8px; left: 50%; transform: translateX(-42%) rotate(5deg); z-index: 2; filter: brightness(0.8); }
        .demo-card-3 { width: 200px; height: 280px; top: 16px; left: 50%; transform: translateX(-58%) rotate(-5deg); z-index: 1; filter: brightness(0.65); }

        .nav-scroll { transition: all 0.3s ease; }
        .nav-scroll.scrolled { background: rgba(255,255,255,0.95)!important; backdrop-filter: blur(16px); box-shadow: 0 2px 20px rgba(0,0,0,0.1); }
        .nav-scroll.scrolled .logo-text { -webkit-text-fill-color: #8b5cf6!important; }
        .nav-scroll.scrolled .nav-btn-login { color: #333!important; }
        
        .bg-royal-gradient { background: linear-gradient(135deg, #8b5cf6, #6d28d9, #4f46e5); }
        .text-royal-gradient { 
            background: linear-gradient(135deg, #a78bfa, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="font-sans antialiased" style="background:#0F0F13;">

    <!-- ── NAVBAR ──────────────────────────────────────────────── -->
    <nav class="fixed w-full z-50 nav-scroll" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-18 py-4">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-royal-gradient">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-black logo-text" style="background:linear-gradient(135deg,#FFF,rgba(255,255,255,0.8));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                        Dwarfinder
                    </span>
                </a>

                <!-- Right actions -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 rounded-full bg-white text-royal-600 font-bold text-sm hover:scale-105 transition-transform shadow-lg shadow-royal-500/10">
                            Dashboard →
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="nav-btn-login text-white/80 hover:text-white font-semibold text-sm transition-colors">Sign in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-5 py-2.5 rounded-full bg-white text-royal-600 font-bold text-sm hover:scale-105 transition-transform shadow-lg shadow-royal-500/10">
                                Join Free
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- ── HERO ────────────────────────────────────────────────── -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden" style="background: linear-gradient(160deg, #1e1b4b 0%, #2e1065 30%, #6d28d9 70%, #8b5cf6 100%);">

        <!-- Floating hearts background -->
        <div class="hearts-bg" id="heartsContainer"></div>

        <!-- Animated blobs -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute w-96 h-96 rounded-full blur-3xl opacity-20 animate-pulse-royal" style="background:#8b5cf6; top:-80px; right:-60px;"></div>
            <div class="absolute w-72 h-72 rounded-full blur-3xl opacity-15 animate-pulse-royal" style="background:#4f46e5; bottom:-40px; left:-40px; animation-delay:1s;"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-16">
            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <!-- Left: Copy + Auth -->
                <div class="text-center lg:text-left">

                    <!-- Badge -->
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-sm font-semibold mb-6 animate-bounce-slow" style="background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.25);color:rgba(255,255,255,0.9);">
                        <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                        10,000+ Members Online
                    </div>

                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white leading-none mb-6 tracking-tight">
                        Swipe.<br>
                        Match.<br>
                        <span style="background:linear-gradient(135deg,#a78bfa,#c4b5fd);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">
                            Connect. 💜
                        </span>
                    </h1>

                    <p class="text-lg text-white/70 mb-10 max-w-lg mx-auto lg:mx-0 leading-relaxed">
                        A safe, inclusive space for persons with disability to find genuine love. Swipe right on your next great story.
                    </p>

                    @guest
                        <!-- Auth Box -->
                        <div class="max-w-sm mx-auto lg:mx-0 space-y-3 p-6 rounded-3xl" style="background:rgba(255,255,255,0.08);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.15);">
                            <!-- Facebook -->
                            <a href="{{ route('social.redirect', 'facebook') }}"
                               class="flex items-center justify-center gap-3 w-full py-3.5 px-5 rounded-2xl font-bold text-white transition-all duration-200 hover:scale-[1.02] hover:shadow-xl active:scale-[0.98]"
                               style="background:#1877F2;">
                                <svg class="w-5 h-5 shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                Continue with Facebook
                            </a>

                            <!-- Google -->
                            <a href="{{ route('social.redirect', 'google') }}"
                               class="flex items-center justify-center gap-3 w-full py-3.5 px-5 rounded-2xl font-bold text-gray-800 bg-white transition-all duration-200 hover:scale-[1.02] hover:shadow-xl active:scale-[0.98]">
                                <svg class="w-5 h-5 shrink-0" viewBox="0 0 24 24">
                                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                                </svg>
                                Continue with Google
                            </a>

                            <!-- Divider -->
                            <div class="flex items-center gap-3 py-1">
                                <div class="flex-1 h-px" style="background:rgba(255,255,255,0.15);"></div>
                                <span class="text-xs font-medium" style="color:rgba(255,255,255,0.4);">OR</span>
                                <div class="flex-1 h-px" style="background:rgba(255,255,255,0.15);"></div>
                            </div>

                            <!-- Email -->
                            <a href="{{ route('register') }}"
                               class="flex items-center justify-center gap-3 w-full py-3.5 px-5 rounded-2xl font-bold text-white transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]"
                               style="background:linear-gradient(135deg,#8b5cf6,#6d28d9);box-shadow:0 4px 20px rgba(139,92,246,0.3);">
                                ✉️ Create Account with Email
                            </a>

                            <p class="text-center text-xs mt-2" style="color:rgba(255,255,255,0.4);">
                                By continuing you agree to our <a href="#" class="underline hover:text-white/70">Terms</a> & <a href="#" class="underline hover:text-white/70">Privacy</a>
                            </p>
                        </div>

                        <p class="mt-5 text-center lg:text-left text-sm" style="color:rgba(255,255,255,0.5);">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-bold underline hover:text-white transition-colors" style="color:rgba(255,255,255,0.85);">Sign in →</a>
                        </p>

                    @else
                        <a href="{{ route('dashboard') }}"
                           class="inline-flex items-center gap-2 px-8 py-4 rounded-full font-black text-royal-600 bg-white text-lg hover:scale-105 transition-transform shadow-2xl shadow-royal-950/20">
                            Go to Dashboard 💜
                        </a>
                    @endguest
                </div>

                <!-- Right: Card Stack Demo -->
                <div class="hidden lg:flex justify-center">
                    <div class="relative" style="width:260px; height:360px;">
                        <!-- Card 3 (back) -->
                        <div class="demo-card demo-card-3" style="width:220px;height:320px;background:linear-gradient(160deg,#c4b5fd,#8b5cf6);">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&q=80" class="w-full h-full object-cover opacity-80" alt="Profile">
                        </div>
                        <!-- Card 2 (middle) -->
                        <div class="demo-card demo-card-2" style="width:235px;height:335px;background:linear-gradient(160deg,#8b5cf6,#6d28d9);">
                            <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&q=80" class="w-full h-full object-cover opacity-90" alt="Profile">
                        </div>
                        <!-- Card 1 (front) -->
                        <div class="demo-card demo-card-1" style="width:250px;height:350px;">
                            <img src="https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=400&q=80" class="w-full h-full object-cover" alt="Profile">
                            <div class="absolute inset-0" style="background:linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 55%);"></div>
                            <div class="absolute bottom-0 left-0 p-5 text-white">
                                <p class="font-bold text-xl">Sarah, 24</p>
                                <p class="text-sm text-white/70">📍 Nairobi, Kenya</p>
                                <!-- Action Buttons mockup -->
                                <div class="flex items-center justify-center gap-4 mt-4">
                                    <div class="w-11 h-11 rounded-full bg-white flex items-center justify-center text-red-400 shadow-lg text-lg">✕</div>
                                    <div class="w-9 h-9 rounded-full bg-white flex items-center justify-center text-blue-400 shadow-lg text-sm">⭐</div>
                                    <div class="w-11 h-11 rounded-full bg-white flex items-center justify-center text-green-400 shadow-lg text-lg">♥</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /grid -->

            <!-- Scroll hint -->
            <div class="text-center mt-16">
                <a href="#features" class="text-white/40 hover:text-white/70 transition-colors animate-bounce-slow inline-flex flex-col items-center gap-1 text-xs">
                    <span>Learn More</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- ── HOW IT WORKS ──────────────────────────────────────── -->
    <section class="py-24 bg-white" id="features">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background:#f5f3ff;color:#8b5cf6;">How It Works</span>
            <h2 class="text-5xl sm:text-6xl font-black text-gray-900 mb-4">
                Love in <span class="text-royal-gradient">3 Steps</span>
            </h2>
            <p class="text-gray-500 text-xl max-w-2xl mx-auto mb-16">Simple, fun, and built for real connections.</p>

            <div class="grid md:grid-cols-3 gap-10">
                @foreach([
                    ['emoji'=>'👤','title'=>'Create Your Profile','desc'=>'Sign up in seconds with Google, Facebook, or email. Add photos and let your personality shine.','color'=>'#8b5cf6'],
                    ['emoji'=>'💜','title'=>'Swipe & Discover','desc'=>'Browse profiles, swipe right to like, left to pass. It\'s as easy and exciting as it sounds.','color'=>'#7c3aed'],
                    ['emoji'=>'💬','title'=>'Match & Chat','desc'=>'When someone likes you back — it\'s a Match! Start chatting and build something real.','color'=>'#6d28d9'],
                ] as $i => $step)
                <div class="group p-10 rounded-[2.5rem] border border-gray-100 hover:border-royal-100 shadow-sm hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
                    <div class="w-20 h-20 rounded-3xl mx-auto mb-6 flex items-center justify-center text-4xl shadow-lg group-hover:scale-110 transition-transform" style="background:linear-gradient(135deg,{{ $step['color'] }}22,{{ $step['color'] }}11); border: 1px solid {{ $step['color'] }}33;">
                        {{ $step['emoji'] }}
                    </div>
                    <div class="w-10 h-10 rounded-full mx-auto mb-6 flex items-center justify-center text-white text-lg font-bold" style="background:{{ $step['color'] }}; shadow: 0 4px 12px {{ $step['color'] }}66;">{{ $i+1 }}</div>
                    <h3 class="text-2xl font-black text-gray-900 mb-3">{{ $step['title'] }}</h3>
                    <p class="text-gray-500 text-base leading-relaxed">{{ $step['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── FEATURES ──────────────────────────────────────────── -->
    <section class="py-24" style="background:#F8F8FC;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <span class="inline-block px-4 py-1.5 rounded-full text-sm font-semibold mb-4" style="background:#f5f3ff;color:#8b5cf6;">Why Dwarfinder</span>
                <h2 class="text-5xl sm:text-6xl font-black text-gray-900">Love Without <span class="text-royal-gradient">Limits</span></h2>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach([
                    ['icon'=>'🌍','title'=>'Inclusive Community','desc'=>'A dedicated space where disability is understood and celebrated, not just accommodated.','bg'=>'#FFF1F2','border'=>'#FFC0CB'],
                    ['icon'=>'🔒','title'=>'Safe & Verified','desc'=>'Verified profiles, secure messaging, and strict moderation for safe and genuine connections.','bg'=>'#F0FFF4','border'=>'#86EFAC'],
                    ['icon'=>'⚡','title'=>'Smart Matching','desc'=>'Our algorithm learns your preferences and surfaces the most compatible people for you.','bg'=>'#FFFBEB','border'=>'#FCD34D'],
                ] as $feat)
                <div class="p-10 rounded-[2.5rem] transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl bg-white border border-gray-100">
                    <div class="text-5xl mb-6">{{ $feat['icon'] }}</div>
                    <h3 class="text-xl font-black text-gray-900 mb-3">{{ $feat['title'] }}</h3>
                    <p class="text-gray-600 text-base leading-relaxed">{{ $feat['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ── CTA ───────────────────────────────────────────────── -->
    <section class="py-24 text-center relative overflow-hidden" style="background:linear-gradient(135deg,#1e1b4b,#2e1065,#6d28d9);">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute w-96 h-96 rounded-full blur-3xl opacity-20" style="background:#FFD700;top:-80px;right:-60px;"></div>
        </div>
        <div class="relative max-w-2xl mx-auto px-4">
            <div class="text-6xl mb-6">❤️‍🔥</div>
            <h2 class="text-4xl sm:text-5xl font-black text-white mb-4">Ready to Find Your Match?</h2>
            <p class="text-white/60 text-lg mb-10">Join thousands of singles finding love on Dwarfinder. It's free!</p>
            @guest
                <a href="{{ route('register') }}"
                   class="inline-flex items-center gap-2 px-10 py-4 rounded-full font-black text-royal-600 bg-white text-xl hover:scale-105 transition-transform shadow-2xl shadow-black/40">
                    Start Swiping Free 💜
                </a>
            @else
                <a href="{{ route('discover.index') }}"
                   class="inline-flex items-center gap-2 px-10 py-4 rounded-full font-black text-royal-600 bg-white text-xl hover:scale-105 transition-transform shadow-2xl shadow-black/40">
                    Discover Matches 💜
                </a>
            @endguest
        </div>
    </section>

    <!-- ── FOOTER ─────────────────────────────────────────────── -->
    <footer class="py-10 text-center" style="background:#0F0F13;color:rgba(255,255,255,0.3);">
        <div class="flex justify-center items-center gap-2 mb-3">
            <svg class="w-5 h-5 text-royal-500" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
            <span class="font-bold text-white">Dwarfinder</span>
        </div>
        <p class="text-xs">© {{ date('Y') }} Dwarfinder. All rights reserved.</p>
        <p class="text-xs mt-1">The inclusive dating platform for everyone, everywhere.</p>
    </footer>

    <script>
        // Scroll nav effect
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            nav.classList.toggle('scrolled', window.scrollY > 40);
        });

        // Floating hearts generator
        const heartsContainer = document.getElementById('heartsContainer');
        const heartChars = ['❤️','🧡','💛','💚','💙','💜','🩷','❤️‍🔥','💘','💝'];
        function createHeart() {
            const el = document.createElement('span');
            el.className = 'heart-particle';
            el.style.cssText = `
                left: ${Math.random()*100}%;
                font-size: ${0.8 + Math.random()*1.2}rem;
                animation-duration: ${6 + Math.random()*10}s;
                animation-delay: ${Math.random()*5}s;
            `;
            el.textContent = heartChars[Math.floor(Math.random()*heartChars.length)];
            heartsContainer.appendChild(el);
            setTimeout(() => el.remove(), 16000);
        }
        // Spawn hearts periodically
        setInterval(createHeart, 800);
        for(let i=0;i<8;i++) setTimeout(createHeart, i*300);
    </script>
</body>
</html>

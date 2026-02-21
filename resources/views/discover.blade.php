<x-app-layout>
    <div class="min-h-screen flex flex-col" style="background:#F8F8FC;">

        <!-- Page Header (desktop) -->
        <div class="hidden sm:block py-6 px-4 text-center">
            <h1 class="text-2xl font-black text-gray-900">Discover ❤️‍🔥</h1>
            <p class="text-gray-500 text-sm mt-1">Swipe right to like, left to pass</p>
        </div>

        @if(session('success'))
            <div class="mx-auto max-w-sm mt-4 px-4">
                <div class="px-4 py-3 rounded-2xl text-center font-semibold text-white text-sm bg-royal-gradient shadow-lg shadow-royal-500/20">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if($potentialMatches->isEmpty())
            <!-- Empty State -->
            <div class="flex-1 flex flex-col items-center justify-center text-center px-8 py-20">
                <div class="text-8xl mb-6 animate-bounce-slow">😔</div>
                <h3 class="text-2xl font-black text-gray-800 mb-3">You've seen everyone!</h3>
                <p class="text-gray-500 max-w-xs text-sm leading-relaxed">No more profiles to show right now. New members join every day — check back soon!</p>
                <a href="{{ route('dashboard') }}" class="btn-royal mt-8 text-base">
                    Back to Dashboard
                </a>
            </div>

        @else
            <!-- ── SWIPE CARD AREA ─────────────────────────────── -->
            <div class="flex-1 flex flex-col items-center justify-center px-4 py-8" id="discoverArea">

                <!-- Card Stack -->
                <div class="relative w-full" style="max-width:450px; height:650px;" id="cardStack">

                    @foreach($potentialMatches->take(5)->reverse() as $i => $user)
                        @if($user->profile)
                            @php
                                $isTop = $loop->last;
                                $stackIndex = $loop->remaining; 
                            @endphp
                            <div class="swipe-card absolute inset-0 {{ !$isTop ? ($stackIndex==1 ? 'card-stack-behind-1' : 'card-stack-behind-2') : '' }}"
                                 id="card-{{ $user->id }}"
                                 data-user-id="{{ $user->id }}"
                                 data-like-url="{{ route('like.store', $user) }}"
                                 style="{{ $isTop ? 'z-index:3; animation: cardEnter 0.4s cubic-bezier(0.175,0.885,0.32,1.275) both;' : '' }}">

                                <!-- LIKE / NOPE stamps -->
                                <div class="stamp-like" id="stamp-like-{{ $user->id }}">LIKE</div>
                                <div class="stamp-nope" id="stamp-nope-{{ $user->id }}">NOPE</div>

                                <!-- Photo -->
                                <div class="w-full h-full">
                                    @if($user->profile->photos->first())
                                        <img src="{{ asset('storage/' . $user->profile->photos->first()->path) }}"
                                             alt="{{ $user->profile->display_name }}"
                                             class="w-full h-full object-cover pointer-events-none" draggable="false">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-royal-50">
                                            <div class="w-24 h-24 rounded-full bg-royal-100 flex items-center justify-center">
                                                <svg class="w-12 h-12 text-royal-500" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Info Overlay -->
                                <div class="absolute inset-0 bg-card-overlay pointer-events-none"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-8 pt-20 text-white select-none">
                                    <div class="flex items-end justify-between gap-4">
                                        <div class="flex-1">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h2 class="text-4xl font-black tracking-tight">
                                                    {{ $user->profile->display_name }}, {{ \Carbon\Carbon::parse($user->profile->birth_date)->age }}
                                                </h2>
                                                @if($user->profile->is_verified)
                                                    <div class="w-5 h-5 rounded-full bg-royal-400 flex items-center justify-center p-0.5 shadow-sm border border-white">
                                                        <svg class="w-full h-full text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9 11l3-3m-3 3l-3-3m3 3v6m-5-2a9 9 0 1118 0 9 9 0 01-18 0z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($user->profile->city)
                                                <p class="text-white font-bold text-sm flex items-center gap-1.5 opacity-90 mb-2">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                                    </svg>
                                                    {{ $user->profile->city }}{{ $user->profile->mountain_origin ? ' • '.$user->profile->mountain_origin : '' }}
                                                </p>
                                            @endif
                                            
                                            <p class="text-white/80 text-sm font-medium line-clamp-2 max-w-sm italic">{{ $user->profile->bio }}</p>
                                        </div>
                                        
                                        <a href="{{ route('users.show', $user) }}" 
                                           class="w-11 h-11 rounded-full bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center hover:bg-white/20 transition-all flex-shrink-0 pointer-events-auto shadow-sm">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <!-- ── Action Buttons ─────────────────────── -->
                <div class="flex items-center justify-center gap-6 mt-8 mb-6" id="actionButtons">
                    <!-- Nope -->
                    <button class="action-btn btn-nope" id="nopeBtn" onclick="swipeAction('left')" title="Pass">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <!-- Super Like -->
                    <button class="action-btn btn-superlike" id="superlikeBtn" onclick="swipeAction('up')" title="Super Like">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                        </svg>
                    </button>

                    <!-- Like -->
                    <button class="action-btn btn-like" id="likeBtn" onclick="swipeAction('right')" title="Like">
                        <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </button>
                </div>


                <!-- Swipe hint -->
                <p class="text-xs text-gray-400 text-center">Drag the card or use the buttons</p>

            </div><!-- /discoverArea -->
        @endif
    </div>

    <!-- ── MATCH MODAL ───────────────────────────────────────── -->
    <div class="match-modal-overlay" id="matchModal" style="display:none;">
        <div class="match-modal-card" id="matchModalCard">
            <!-- Confetti -->
            <div id="confettiContainer" style="position:absolute;inset:0;overflow:hidden;pointer-events:none;border-radius:2rem;"></div>

            <div class="text-5xl mb-3 animate-bounce-slow">🎉</div>
            <p class="text-xs font-bold uppercase tracking-widest mb-2 text-royal-400">It's a Match!</p>
            <h2 class="text-3xl font-black text-white mb-2">You and <span id="matchName" class="text-royal-gradient">Someone</span></h2>
            <p class="text-gray-400 text-sm mb-8">Start the conversation and make something happen ✨</p>

            <div class="flex gap-3">
                <button onclick="closeMatchModal()" class="flex-1 py-3 rounded-2xl font-bold text-gray-400 text-sm" style="background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.1);">
                    Keep Swiping
                </button>
                <a href="{{ route('messages.index') }}" id="matchMessageBtn"
                   class="flex-1 py-3 rounded-2xl font-bold text-white text-sm flex items-center justify-center gap-2"
                   class="w-full btn-royal py-4 shadow-xl shadow-royal-500/20">
                    💬 Send Message
                </a>
            </div>
        </div>
    </div>

    <!-- ── SWIPE LOGIC ────────────────────────────────────────── -->
    @csrf
    <script>
    (function() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content
                       || document.querySelector('input[name="_token"]')?.value;

        // Build queue of cards from DOM
        const queue = Array.from(document.querySelectorAll('#cardStack .swipe-card')).reverse(); // top card first
        let currentCard = queue[0] || null;

        // ── Drag to Swipe ────────────────────────────────────
        let startX, startY, isDragging = false, offsetX = 0;

        function attachDrag(card) {
            if (!card) return;

            function onStart(e) {
                isDragging = true;
                const pt = e.touches ? e.touches[0] : e;
                startX = pt.clientX;
                startY = pt.clientY;
                offsetX = 0;
                card.classList.add('is-dragging');
            }

            function onMove(e) {
                if (!isDragging) return;
                const pt = e.touches ? e.touches[0] : e;
                offsetX = pt.clientX - startX;
                const offsetY = pt.clientY - startY;
                const rot = offsetX * 0.08;
                card.style.transform = `translateX(${offsetX}px) translateY(${offsetY * 0.3}px) rotate(${rot}deg)`;

                // Show stamps
                const threshold = 60;
                const likeStamp = document.getElementById('stamp-like-' + card.dataset.userId);
                const nopeStamp = document.getElementById('stamp-nope-' + card.dataset.userId);
                if (likeStamp) likeStamp.style.opacity = Math.min(1, (offsetX - threshold/2) / threshold);
                if (nopeStamp) nopeStamp.style.opacity = Math.min(1, (-offsetX - threshold/2) / threshold);
            }

            function onEnd() {
                if (!isDragging) return;
                isDragging = false;
                card.classList.remove('is-dragging');
                card.style.transform = '';
                const threshold = 100;
                if (offsetX > threshold) {
                    swipeCardOut(card, 'right');
                } else if (offsetX < -threshold) {
                    swipeCardOut(card, 'left');
                } else {
                    // Snap back
                    const likeStamp = document.getElementById('stamp-like-' + card.dataset.userId);
                    const nopeStamp = document.getElementById('stamp-nope-' + card.dataset.userId);
                    if (likeStamp) likeStamp.style.opacity = 0;
                    if (nopeStamp) nopeStamp.style.opacity = 0;
                }
            }

            card.addEventListener('mousedown', onStart);
            card.addEventListener('touchstart', onStart, {passive:true});
            window.addEventListener('mousemove', onMove);
            window.addEventListener('touchmove', onMove, {passive:true});
            window.addEventListener('mouseup', onEnd);
            window.addEventListener('touchend', onEnd);
        }

        if (currentCard) attachDrag(currentCard);

        // ── Global swipeAction (called by buttons) ─────────
        window.swipeAction = function(dir) {
            if (!currentCard) return;
            swipeCardOut(currentCard, dir);
        };

        function swipeCardOut(card, dir) {
            const userId = card.dataset.userId;
            const likeUrl = card.dataset.likeUrl;

            // Animate out
            if (dir === 'right') {
                card.classList.add('swipe-out-right');
                sendLike(userId, likeUrl, card);
            } else if (dir === 'left') {
                card.classList.add('swipe-out-left');
                // Just remove — no like needed
                card.addEventListener('animationend', () => removeCard(card), {once:true});
            } else if (dir === 'up') {
                card.classList.add('swipe-out-up');
                sendLike(userId, likeUrl, card, true);
            }
        }

        function removeCard(card) {
            card.remove();
            queue.shift();
            // Promote next card
            currentCard = queue[0] || null;
            if (currentCard) {
                currentCard.style.zIndex = 3;
                currentCard.classList.remove('card-stack-behind-1', 'card-stack-behind-2');
                currentCard.classList.add('animate-card-enter');
                currentCard.style.transform = '';
                currentCard.style.filter = '';
                attachDrag(currentCard);

                // Promote second card
                if (queue[1]) {
                    queue[1].classList.remove('card-stack-behind-2');
                    queue[1].classList.add('card-stack-behind-1');
                }
            } else {
                // No more cards
                const area = document.getElementById('discoverArea');
                if (area) {
                    area.innerHTML = `
                        <div class="text-center px-8 py-20">
                            <div class="text-8xl mb-6" style="animation:bounce 2s infinite">😔</div>
                            <h3 class="text-2xl font-black text-gray-800 mb-3">You've seen everyone!</h3>
                            <p class="text-gray-500 text-sm">Check back soon for new members!</p>
                            <a href="/dashboard" class="btn-royal mt-8 text-base inline-flex">Back to Dashboard</a>
                        </div>`;
                }
            }
        }

        function sendLike(userId, url, card, superlike = false) {
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ superlike: superlike }),
            })
            .then(r => r.json().catch(() => ({})))
            .then(data => {
                if (data.matched) {
                    const name = card.querySelector('h2')?.textContent?.split(',')[0]?.trim() || 'Someone';
                    showMatchModal(name);
                }
            })
            .catch(() => {})
            .finally(() => {
                card.addEventListener('animationend', () => removeCard(card), {once:true});
            });
        }

        // ── Match Modal ─────────────────────────────────────
        window.showMatchModal = function(name) {
            document.getElementById('matchName').textContent = name;
            const modal = document.getElementById('matchModal');
            modal.style.display = 'flex';
            spawnConfetti();
        };

        window.closeMatchModal = function() {
            document.getElementById('matchModal').style.display = 'none';
        };

        function spawnConfetti() {
            const container = document.getElementById('confettiContainer');
            const colors = ['#8b5cf6','#7c3aed','#6d28d9','#a78bfa','#4f46e5','#fff'];
            for (let i = 0; i < 40; i++) {
                setTimeout(() => {
                    const el = document.createElement('div');
                    el.className = 'confetti-piece';
                    el.style.left = Math.random()*100 + '%';
                    el.style.top = Math.random()*40 + '%';
                    el.style.background = colors[Math.floor(Math.random()*colors.length)];
                    el.style.width = (6 + Math.random()*6) + 'px';
                    el.style.height = (6 + Math.random()*6) + 'px';
                    el.style.animationDuration = (1 + Math.random()*1.5) + 's';
                    el.style.animationDelay = Math.random()*0.5 + 's';
                    container.appendChild(el);
                    setTimeout(() => el.remove(), 2500);
                }, i * 40);
            }
        }

        // Close modal on backdrop click
        document.getElementById('matchModal')?.addEventListener('click', function(e) {
            if (e.target === this) closeMatchModal();
        });
    })();
    </script>
</x-app-layout>

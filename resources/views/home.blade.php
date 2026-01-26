<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Dwarfinder - Find your perfect match in the dwarf community">
    <title>Dwarfinder - Where Dwarves Find Love</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #8B4513; /* SaddleBrown - earthy dwarf color */
            --secondary: #D2691E; /* Chocolate */
            --accent: #F4A460; /* SandyBrown */
            --dark: #2C1810; /* Dark brown */
            --light: #FAF3E0; /* Light beige */
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #2C1810 0%, #8B4513 100%);
            color: var(--light);
            min-height: 100vh;
        }
        
        .hero-section {
            background: linear-gradient(rgba(44, 24, 16, 0.8), rgba(44, 24, 16, 0.9)), 
                        url('https://images.unsplash.com/photo-1511988617509-a57c8a288659?ixlib=rb-4.0.3&auto=format&fit=crop&w=2071&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .dwarf-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(139, 69, 19, 0.3);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .dwarf-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary), var(--primary));
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(139, 69, 19, 0.3);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background: rgba(244, 164, 96, 0.2);
            border: 2px solid var(--accent);
        }
        
        .testimonial-card {
            background: rgba(250, 243, 224, 0.1);
            border-left: 4px solid var(--accent);
        }
        
        .nav-link {
            position: relative;
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--accent);
            transition: width 0.3s;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .forge-animation {
            animation: forge 2s infinite;
        }
        
        @keyframes forge {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .mining-animation {
            animation: mining 3s infinite;
        }
        
        @keyframes mining {
            0% { transform: rotate(0deg); }
            25% { transform: rotate(15deg); }
            75% { transform: rotate(-15deg); }
            100% { transform: rotate(0deg); }
        }
    </style>
</head>
<body class="overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-dark/90 backdrop-blur-md">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary to-accent rounded-full flex items-center justify-center">
                        <i class="fas fa-mountain text-2xl text-light"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold" style="font-family: 'Playfair Display', serif;">Dwarfinder</h1>
                        <p class="text-xs text-accent">Est. 1203 Dwarf Era</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="nav-link text-light hover:text-accent">Home</a>
                    <a href="#features" class="nav-link text-light hover:text-accent">Features</a>
                    <a href="#profiles" class="nav-link text-light hover:text-accent">Profiles</a>
                    <a href="#testimonials" class="nav-link text-light hover:text-accent">Success Stories</a>
                    <a href="#pricing" class="nav-link text-light hover:text-accent">Mining Plans</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    <a href="/login" class="text-light hover:text-accent">Log In</a>
                    <a href="/register" class="btn-primary px-6 py-2 rounded-full font-semibold">Forge Account</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section min-h-screen flex items-center pt-20">
        <div class="container mx-auto px-6 py-20">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Hero Content -->
                <div class="text-center md:text-left">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6" style="font-family: 'Playfair Display', serif;">
                        Mine for Love,<br>
                        <span class="text-accent">Forge Forever</span>
                    </h1>
                    <p class="text-xl mb-8 text-light/80">
                        The first dating platform exclusively for dwarves. Find your perfect mining partner, 
                        forge lasting relationships, and build your mountain kingdom together.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <a href="/register" class="btn-primary px-8 py-4 rounded-full font-bold text-lg">
                            Start Your Quest <i class="ml-2 fas fa-hammer"></i>
                        </a>
                        <a href="#profiles" class="border-2 border-accent text-accent px-8 py-4 rounded-full font-bold text-lg hover:bg-accent hover:text-dark transition">
                            View Profiles <i class="ml-2 fas fa-users"></i>
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-accent">5,000+</div>
                            <div class="text-sm">Active Dwarves</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-accent">1,200+</div>
                            <div class="text-sm">Forged Unions</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-accent">87%</div>
                            <div class="text-sm">Success Rate</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Image/Animation -->
                <div class="relative">
                    <div class="relative z-10">
                        <img src="https://images.unsplash.com/photo-1546182990-dffeafbe841d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Dwarf Couple"
                             class="rounded-2xl shadow-2xl w-full">
                    </div>
                    <!-- Animated Elements -->
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-accent/20 rounded-full flex items-center justify-center mining-animation">
                        <i class="fas fa-gem text-3xl text-accent"></i>
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-20 h-20 bg-primary/20 rounded-full flex items-center justify-center forge-animation">
                        <i class="fas fa-hammer text-2xl text-primary"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-dark">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Why Choose Dwarfinder?</h2>
                <p class="text-xl text-light/70 max-w-3xl mx-auto">
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="dwarf-card rounded-2xl p-8">
                    <div class="feature-icon rounded-full flex items-center justify-center mb-6 mx-auto">

                        <i class="fas fa-mountain text-3xl text-accent"></i>

                    </div>

                    <h3 class="text-2xl font-bold mb-4 text-center">Mountain-Compatible Matching</h3>

                    <p class="text-light/70 text-center">

                        Our algorithm considers your preferred mountain type, cave depth tolerance, and mining specialization.

                    </p>
                </div>


                <!-- Feature 2 -->
                <div class="dwarf-card rounded-2xl p-8">

                    <div class="feature-icon rounded-full flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-gem text-3xl text-accent"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-center">Treasure Verification</h3>
                    <p class="text-light/70 text-center">
                        All profiles verified for authentic beard length, mining skills, and treasure hoard authenticity.

                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="dwarf-card rounded-2xl p-8">
                    <div class="feature-icon rounded-full flex items-center justify-center mb-6 mx-auto">

                        <i class="fas fa-axe text-3xl text-accent"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-center">Forge Connections</h3>
                    <p class="text-light/70 text-center">
                        Connect over shared interests like axe-sharpening, ale brewing, and dragon-slaying stories.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Profiles Section -->
    <section id="profiles" class="py-20">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Meet Our Dwarves</h2>
                <p class="text-xl text-light/70 max-w-3xl mx-auto">
                    These sturdy souls are ready to share their mountain halls.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Profile 1 -->
                <div class="dwarf-card rounded-2xl overflow-hidden">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1518710843675-2540c2c4a6d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Thorin"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Thorin</h3>
                                <p class="text-accent">Mountain King</p>
                            </div>
                            <span class="bg-primary/20 text-primary px-3 py-1 rounded-full text-sm">Gold Smith</span>
                        </div>
                        <p class="text-light/70 mb-4">Expert in precious metals. Looking for a queen to share my mountain kingdom.</p>
                        <div class="flex items-center text-sm text-light/50">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Lonely Mountain</span>
                        </div>
                    </div>
                </div>

                <!-- Profile 2 -->
                <div class="dwarf-card rounded-2xl overflow-hidden">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Gimli"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Gimli</h3>
                                <p class="text-accent">Axe Master</p>
                            </div>
                            <span class="bg-primary/20 text-primary px-3 py-1 rounded-full text-sm">Warrior</span>
                        </div>
                        <p class="text-light/70 mb-4">42 dragon notches on my axe. Seeking someone who appreciates a good battle story.</p>
                        <div class="flex items-center text-sm text-light/50">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Glittering Caves</span>
                        </div>
                    </div>
                </div>

                <!-- Profile 3 -->
                <div class="dwarf-card rounded-2xl overflow-hidden">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Balin"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Balin</h3>
                                <p class="text-accent">Archivist</p>
                            </div>
                            <span class="bg-primary/20 text-primary px-3 py-1 rounded-full text-sm">Historian</span>
                        </div>
                        <p class="text-light/70 mb-4">Knowledgeable in dwarf lore and genealogy. Looking for an intellectual companion.</p>
                        <div class="flex items-center text-sm text-light/50">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Moria</span>
                        </div>
                    </div>
                </div>

                <!-- Profile 4 -->
                <div class="dwarf-card rounded-2xl overflow-hidden">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1518709268805-4e9042af2176?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                             alt="Dís"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold">Dís</h3>
                                <p class="text-accent">Jewel Crafter</p>
                            </div>
                            <span class="bg-primary/20 text-primary px-3 py-1 rounded-full text-sm">Artisan</span>
                        </div>
                        <p class="text-light/70 mb-4">Creates the finest mithril jewelry. Seeking someone with appreciation for craftsmanship.</p>
                        <div class="flex items-center text-sm text-light/50">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>Blue Mountains</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="/profiles" class="btn-primary px-8 py-3 rounded-full font-bold">
                    View All Profiles <i class="ml-2 fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section id="testimonials" class="py-20 bg-dark">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Success Stories from the Mines</h2>
                <p class="text-xl text-light/70 max-w-3xl mx-auto">
                    Real dwarves who found real love through Dwarfinder
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Testimonial 1 -->
                <div class="testimonial-card rounded-2xl p-8">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1518710843675-2540c2c4a6d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                             alt="Bofur"
                             class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="text-xl font-bold">Bofur & Bifur</h4>
                            <p class="text-accent">Married for 15 years</p>
                        </div>
                    </div>
                    <p class="text-light/80 italic mb-4">
                        "We were both mining in different mountains until Dwarfinder brought us together. 
                        Now we run the most productive mine in the Iron Hills!"
                    </p>
                    <div class="flex text-accent">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card rounded-2xl p-8">
                    <div class="flex items-center mb-6">
                        <img src="https://images.unsplash.com/photo-1544717305-2782549b5136?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                             alt="Ori"
                             class="w-16 h-16 rounded-full mr-4">
                        <div>
                            <h4 class="text-xl font-bold">Ori & Nori</h4>
                            <p class="text-accent">Together for 8 years</p>
                        </div>
                    </div>
                    <p class="text-light/80 italic mb-4">
                        "As scholars, we thought we'd never find someone who shared our love for ancient runes. 
                        Dwarfinder proved us wrong!"
                    </p>
                    <div class="flex text-accent">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20">
        <div class="container mx-auto px-6 text-center">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-5xl font-bold mb-6">Ready to Mine for Love?</h2>
                <p class="text-xl mb-10 text-light/80">
                    Join thousands of dwarves who have found their perfect match. 
                    Your mountain partner is waiting!
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/register" class="btn-primary px-10 py-4 rounded-full font-bold text-lg">
                        Start Free Trial <i class="ml-2 fas fa-gem"></i>
                    </a>
                    <a href="/how-it-works" class="border-2 border-accent text-accent px-10 py-4 rounded-full font-bold text-lg hover:bg-accent hover:text-dark transition">
                        How It Works <i class="ml-2 fas fa-question-circle"></i>
                    </a>
                </div>
                <p class="mt-6 text-light/60 text-sm">
                    No dragon's hoard required. Free to join, with premium mining plans available.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark py-12 border-t border-primary/20">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-accent rounded-full flex items-center justify-center">
                            <i class="fas fa-mountain text-xl text-dark"></i>
                        </div>
                        <h3 class="text-xl font-bold">Dwarfinder</h3>
                    </div>
                    <p class="text-light/70 mb-4">
                        Forging dwarf relationships since the Third Age. 
                        By dwarves, for dwarves.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 border border-accent/30 rounded-full flex items-center justify-center hover:bg-accent hover:text-dark transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 border border-accent/30 rounded-full flex items-center justify-center hover:bg-accent hover:text-dark transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 border border-accent/30 rounded-full flex items-center justify-center hover:bg-accent hover:text-dark transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-accent">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Home</a></li>
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Browse Profiles</a></li>
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Success Stories</a></li>
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Safety Guide</a></li>
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Dwarf Codex</a></li>
                    </ul>
                </div>

                <!-- Legal -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-accent">Legal</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Terms of Service</a></li>
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Cookie Policy</a></li>
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Community Guidelines</a></li>
                        <li><a href="#" class="text-light/70 hover:text-accent transition">Accessibility</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="text-lg font-bold mb-6 text-accent">Contact Us</h4>
                    <ul class="space-y-3">
                        <li class="text-light/70">
                            <i class="fas fa-envelope mr-2 text-accent"></i>
                            support@dwarfinder.com
                        </li>
                        <li class="text-light/70">
                            <i class="fas fa-phone mr-2 text-accent"></i>
                            +1 (555) MINE-LOVE
                        </li>
                        <li class="text-light/70">
                            <i class="fas fa-map-marker-alt mr-2 text-accent"></i>
                            The Lonely Mountain, Erebor
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-primary/20 text-center text-light/50 text-sm">
                <p>&copy; 2023 Dwarfinder. All rights reserved. "Dwarfinder" is a trademark of Erebor Enterprises.</p>
                <p class="mt-2">Crafted with <i class="fas fa-heart text-red-400"></i> in the heart of the mountain.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript for interactivity -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    if(targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if(targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Add scroll effect to navbar
            window.addEventListener('scroll', function() {
                const nav = document.querySelector('nav');
                if(window.scrollY > 100) {
                    nav.classList.add('bg-dark', 'shadow-lg');
                } else {
                    nav.classList.remove('bg-dark', 'shadow-lg');
                }
            });

            // Simple counter animation for stats
            function animateCounter(element, finalValue, duration = 2000) {
                let startValue = 0;
                const increment = finalValue / (duration / 16); // 60fps
                const counter = setInterval(() => {
                    startValue += increment;
                    if(startValue >= finalValue) {
                        element.textContent = finalValue + '+';
                        clearInterval(counter);
                    } else {
                        element.textContent = Math.floor(startValue);
                    }
                }, 16);
            }

            // Animate stats when in viewport
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if(entry.isIntersecting) {
                        const stats = entry.target.querySelectorAll('.text-3xl');
                        stats.forEach(stat => {
                            const value = parseInt(stat.textContent);
                            animateCounter(stat, value);
                        });
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });

            const statsSection = document.querySelector('.hero-section');
            if(statsSection) {
                observer.observe(statsSection);
            }

            console.log('Dwarfinder loaded successfully! May your beard never thin!');
        });
    </script>
</body>
</html>



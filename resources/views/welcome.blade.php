<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="smooth-scroll">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Studio.mu - Professional Photo Studio & Visual Art</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        },
                        accent: {
                            gold: '#D4AF37',
                            dark: '#1e1e1e',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s ease-out forwards',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .hero-gradient {
            background: linear-gradient(135deg, #0c4a6e 0%, #082f49 100%);
        }
        .text-gradient {
            background: linear-gradient(to right, #D4AF37, #F59E0B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        .hover-lift:hover {
            transform: translateY(-8px);
        }
        /* Custom CSS to toggle icons via checkbox sibling hack */
        #menu-toggle:checked ~ div label #open-icon { display: none; }
        #menu-toggle:checked ~ div label #close-icon { display: block; }
    </style>
</head>
<body class="antialiased font-sans text-slate-900 bg-slate-50">
    
    <!-- Navigation -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-500 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-12">
            <!-- Checkbox hidden control -->
            <input type="checkbox" id="menu-toggle" class="peer hidden">
            
            <div class="flex justify-between h-16 items-center glass-card px-6 rounded-2xl shadow-sm relative">
                <!-- Logo -->
                <a href="#" class="flex items-center group">
                    <img src="{{ asset('img/logo.png') }}" alt="Studio.mu Logo" class="h-8 md:h-10 w-auto transition-transform duration-300 group-hover:scale-110">
                </a>

                <div class="hidden lg:flex space-x-10 text-[11px] font-extrabold uppercase tracking-[0.2em] text-slate-600">
                    <a href="#" class="hover:text-primary-600 transition-colors">Beranda</a>
                    <a href="#services" class="hover:text-primary-600 transition-colors">Layanan</a>
                    <a href="#collections" class="hover:text-primary-600 transition-colors">Portofolio</a>
                </div>
                
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="bg-primary-950 text-white px-6 sm:px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-800 transition-all shadow-lg shadow-primary-950/20">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:block border-2 border-slate-300 hover:border-primary-950 hover:text-primary-950 text-slate-700 px-6 sm:px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-primary-950 text-white px-6 sm:px-8 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-primary-800 transition-all shadow-lg shadow-primary-950/20">
                            Daftar
                        </a>
                    @endauth
                    
                    <!-- Hamburger Toggle (Hidden on Desktop) -->
                    <label for="menu-toggle" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-600 cursor-pointer transition-colors relative">
                        <svg id="open-icon" class="w-6 h-6 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg id="close-icon" class="w-6 h-6 hidden pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </label>
                </div>
            </div>
            
            <!-- Mobile Menu Dropdown (Murni CSS lewat peer) -->
            <div class="peer-checked:block hidden lg:hidden mt-3 glass-card rounded-2xl p-6 shadow-xl border border-slate-100/50 animate-fade-in-up">
                <div class="flex flex-col space-y-4 text-[11px] font-extrabold uppercase tracking-[0.2em] text-slate-600">
                    <a href="#" class="hover:text-primary-600 transition-colors py-2 border-b border-slate-50">Beranda</a>
                    <a href="#services" class="hover:text-primary-600 transition-colors py-2 border-b border-slate-50">Layanan</a>
                    <a href="#collections" class="hover:text-primary-600 transition-colors py-2 border-b border-slate-50">Portofolio</a>
                    @guest
                        <a href="{{ route('login') }}" class="text-center border-2 border-slate-300 hover:border-primary-950 hover:text-primary-950 text-slate-700 py-3 rounded-xl transition-all font-black uppercase tracking-widest mt-2">Masuk</a>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center pt-20 overflow-hidden bg-white">
        <!-- Abstract Background Elements -->
        <div class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/4 w-[800px] h-[800px] bg-primary-50 rounded-full blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 translate-y-1/2 -translate-x-1/4 w-[600px] h-[600px] bg-amber-50 rounded-full blur-3xl opacity-50"></div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center relative z-10">
            <div class="animate-fade-in-up">
                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 text-[10px] font-black uppercase tracking-[0.2em] rounded-full mb-6">
                    Professional Photography Studio
                </span>
                <h1 class="text-4xl sm:text-5xl md:text-7xl lg:text-8xl font-black tracking-tighter leading-[0.9] mb-8 text-slate-900">
                    Abadikan <span class="text-gradient">Momen</span><br>Abadi Anda.
                </h1>
                <p class="text-lg md:text-xl text-slate-500 leading-relaxed max-w-xl mb-10 font-medium">
                    Setiap kebersamaan pasti akan berakhir, tapi kebahagiaannya akan tetap abadi dalam kenangan indah bersama Studio.mu. Kami hadir untuk menangkap setiap detail emosi Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('login') }}" class="bg-primary-950 text-white px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-800 transition-all shadow-xl shadow-primary-950/20 text-center">
                        Mulai Sekarang
                    </a>
                    <a href="#collections" class="bg-white border-2 border-primary-950 text-primary-950 px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-primary-50 transition-all text-center shadow-lg shadow-primary-950/5">
                        Lihat Portofolio
                    </a>
                </div>

                <div class="mt-16 flex flex-wrap items-center gap-6 sm:gap-8 border-t border-slate-100 pt-8">
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-slate-900">1.2k+</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Klien Puas</p>
                    </div>
                    <div class="hidden sm:block w-px h-8 bg-slate-100"></div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-slate-900">15+</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Fotografer Pro</p>
                    </div>
                    <div class="hidden sm:block w-px h-8 bg-slate-100"></div>
                    <div>
                        <p class="text-2xl sm:text-3xl font-black text-slate-900">4.9/5</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Rating Google</p>
                    </div>
                </div>
            </div>

            <div class="relative hidden lg:block">
                <div class="relative z-10 animate-float">
                    <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=2071&auto=format&fit=crop" alt="Photography Session" class="rounded-[2rem] shadow-2xl transition-all duration-700">
                </div>
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-400 rounded-3xl -z-10 rotate-12 opacity-20"></div>
                <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-primary-600 rounded-3xl -z-10 -rotate-12 opacity-20"></div>

            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-32 bg-slate-50 border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6 md:px-12">
            <div class="text-center mb-20">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 mb-4 block">Apa yang Kami Lakukan</span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tighter mb-6 text-slate-900">Layanan Kami</h2>
                <p class="text-slate-500 max-w-2xl mx-auto font-medium">Kami menyediakan berbagai layanan fotografi profesional untuk memenuhi kebutuhan visual Anda.</p>
            </div>

            <div id="services-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Loaded dynamically from localStorage -->
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="collections" class="py-32 bg-slate-950 text-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-20">
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary-400 mb-4 block">Hasil Karya Kami</span>
                <h2 class="text-4xl md:text-5xl font-black tracking-tighter mb-6">Koleksi Visual</h2>
                <div class="flex justify-center gap-8 text-[10px] font-black uppercase tracking-widest text-slate-500">
                    <button class="text-white border-b-2 border-primary-500 pb-2">Semua</button>
                    <button class="hover:text-white transition-colors">Wedding</button>
                    <button class="hover:text-white transition-colors">Graduation</button>
                    <button class="hover:text-white transition-colors">Personal</button>
                </div>
            </div>

            <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6">
                <div class="relative group rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2069&auto=format&fit=crop" class="w-full h-auto transition-all duration-700 transform group-hover:scale-105" alt="Collection">
                </div>
                <div class="relative group rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2070&auto=format&fit=crop" class="w-full h-auto transition-all duration-700 transform group-hover:scale-105" alt="Collection">
                </div>
                <div class="relative group rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1520850838145-4c6d291b1cd2?q=80&w=2070&auto=format&fit=crop" class="w-full h-auto transition-all duration-700 transform group-hover:scale-105" alt="Collection">
                </div>
                <div class="relative group rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1491438590914-bc09fcaaf77a?q=80&w=2070&auto=format&fit=crop" class="w-full h-auto transition-all duration-700 transform group-hover:scale-105" alt="Collection">
                </div>
                <div class="relative group rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1522673607200-164883212c2f?q=80&w=2072&auto=format&fit=crop" class="w-full h-auto transition-all duration-700 transform group-hover:scale-105" alt="Collection">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Us Section -->
    <section class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-primary-600 mb-4 block">Kenapa Studio.mu?</span>
                    <h2 class="text-4xl md:text-5xl font-black tracking-tighter mb-10 text-slate-900 leading-tight">Kami Memberikan Lebih Dari Sekedar Foto.</h2>
                    
                    <div class="space-y-8">
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-primary-50 rounded-xl flex items-center justify-center text-primary-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-black mb-2">Proses Cepat</h4>
                                <p class="text-slate-500 text-sm font-medium">Hasil editing selesai dalam waktu 3-5 hari kerja dengan kualitas premium.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-black mb-2">Custom Styling</h4>
                                <p class="text-slate-500 text-sm font-medium">Konsultasi konsep dan wardrobe sesuai dengan karakter dan keinginan Anda.</p>
                            </div>
                        </div>
                        <div class="flex gap-6">
                            <div class="flex-shrink-0 w-12 h-12 bg-slate-900 rounded-xl flex items-center justify-center text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-black mb-2">Peralatan High-End</h4>
                                <p class="text-slate-500 text-sm font-medium">Menggunakan kamera dan lighting terkini untuk hasil yang tajam dan sinematik.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1520850838145-4c6d291b1cd2?q=80&w=2070&auto=format&fit=crop" class="rounded-[3rem] shadow-2xl" alt="Our Studio">
                    <div class="absolute -bottom-10 -left-10 glass-card p-10 rounded-[2rem] shadow-2xl max-w-sm hidden md:block">
                        <p class="text-2xl font-serif italic text-slate-900 mb-4">"Fotografi adalah cara untuk merasakan, menyentuh, dan mencintai."</p>
                        <p class="text-[10px] font-black uppercase tracking-widest text-primary-600">— Studio.mu Team</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-slate-950 text-white pt-32 pb-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 mb-24">
                <div class="col-span-1 lg:col-span-1">
                    <img src="{{ asset('img/logo.png') }}" alt="Studio.mu Logo" class="h-12 w-auto mb-8">
                    <p class="text-slate-400 text-sm leading-relaxed mb-8 font-medium">
                        Studio fotografi profesional yang didedikasikan untuk menangkap momen paling berharga Anda dengan presisi dan seni tingkat tinggi.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="#" class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center hover:bg-primary-600 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] mb-10 text-slate-500">Navigasi Cepat</h4>
                    <ul class="space-y-6 text-sm font-bold uppercase tracking-widest">
                        <li><a href="#" class="text-slate-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#services" class="text-slate-400 hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="#prices" class="text-slate-400 hover:text-white transition-colors">Paket Harga</a></li>
                        <li><a href="#collections" class="text-slate-400 hover:text-white transition-colors">Portofolio</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] mb-10 text-slate-500">Hubungi Kami</h4>
                    <ul class="space-y-6 text-sm font-medium text-slate-400">
                        <li class="flex items-start gap-4">
                            <span class="text-primary-500">📍</span>
                            <span>Studio.mu Building, Jakarta Selatan, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="text-primary-500">📞</span>
                            <span>0812-8804-5066</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="text-primary-500">✉️</span>
                            <span>hello@studio.mu</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] mb-10 text-slate-500">Admin & Tim</h4>
                    <p class="text-slate-400 text-xs mb-8 font-medium">Akses khusus untuk tim fotografer dan administrator Studio.mu.</p>
                    <a href="{{ route('login') }}" class="inline-flex items-center text-white border-2 border-white/20 px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-white hover:text-slate-950 hover:border-white transition-all">
                        Login Dashboard
                    </a>
                </div>
            </div>
            <div class="pt-12 border-t border-slate-900 flex flex-col md:flex-row justify-between items-center text-[10px] font-black uppercase tracking-[0.2em] text-slate-600">
                <p>&copy; {{ date('Y') }} Studio.mu Visual Art. All rights reserved.</p>
                <div class="mt-8 md:mt-0 space-x-10">
                    <a href="#" class="hover:text-white">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Luxurious Service Detail Modal (Visual Showcase matched with user reference) -->
    <div id="service-modal" class="fixed inset-0 bg-slate-950/60 backdrop-blur-md z-50 flex items-center justify-center p-4 md:p-6 opacity-0 pointer-events-none transition-all duration-300">
        <!-- Close trigger by clicking backdrop -->
        <div class="absolute inset-0 cursor-default" onclick="closeServiceModal()"></div>

        <!-- Modal Card -->
        <div class="bg-white border border-slate-100 rounded-[2rem] shadow-2xl w-full max-w-5xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative max-h-[95vh] overflow-y-auto z-10 p-6 sm:p-10 flex flex-col">
            <!-- Close Button -->
            <button onclick="closeServiceModal()" class="absolute top-4 right-4 z-20 w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-900 border border-slate-200 transition-colors cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Breadcrumbs -->
            <nav class="text-xs font-semibold text-slate-400 mb-6 flex items-center gap-1.5 font-sans tracking-wide">
                <button onclick="closeServiceModal()" class="hover:text-slate-700 transition-colors cursor-pointer text-slate-400 font-semibold">Beranda</button>
                <span class="text-slate-400 font-bold font-serif">&rsaquo;</span>
                <span id="modal-breadcrumb-title" class="text-slate-600 font-black"></span>
            </nav>

            <!-- Package Title Header Badge (Black Rectangle upgraded to pill badge) -->
            <div class="mb-8 border-b border-slate-100 pb-4">
                <span id="modal-header-badge" class="inline-block bg-slate-900/90 text-white px-5 py-2.5 font-black text-xs uppercase tracking-widest rounded-xl shadow-md"></span>
            </div>

            <!-- Content Area (Grid Layout matching the reference image) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-stretch flex-1">
                <!-- Left: Beautiful Image Showcase with Carousel Overlays -->
                <div class="lg:col-span-5 relative rounded-2xl overflow-hidden group min-h-[300px] lg:min-h-[420px] flex items-center justify-center bg-slate-50 shadow-inner">
                    <img id="modal-image" src="" alt="" class="w-full h-full object-cover">
                    
                    <!-- Left Arrow Indicator -->
                    <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-950/40 hover:bg-slate-950/60 text-white flex items-center justify-center transition-all cursor-pointer">
                        <svg class="w-6 h-6 stroke-[1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                    </button>
                    
                    <!-- Right Arrow Indicator -->
                    <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-950/40 hover:bg-slate-950/60 text-white flex items-center justify-center transition-all cursor-pointer">
                        <svg class="w-6 h-6 stroke-[1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                        </svg>
                    </button>

                    <!-- Dot Indicators -->
                    <div id="modal-carousel-dots" class="absolute bottom-6 left-0 right-0 flex justify-center gap-1.5">
                        <!-- Dynamically filled -->
                    </div>
                </div>

                <!-- Right: Package Comparison Columns (Layanan / Paket Columns) -->
                <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                    <!-- Column 1: Best Deal / Silver Package -->
                    <div class="border-t border-slate-200 pt-4">
                        <h4 id="col1-title" class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2"></h4>
                        
                        <!-- Price Container -->
                        <div class="flex items-baseline gap-3 mb-6">
                            <span id="col1-oldprice" class="text-lg font-normal text-slate-400 line-through tracking-wide font-sans"></span>
                            <span id="col1-newprice" class="text-3xl font-bold text-slate-900 tracking-tight font-sans"></span>
                        </div>

                        <!-- Benefit Section -->
                        <h5 class="text-xs font-bold uppercase tracking-wider text-slate-800 mb-4">Benefit</h5>
                        <ul id="col1-features" class="space-y-3.5 text-xs font-normal text-slate-700 tracking-wide">
                            <!-- Dynamically loaded -->
                        </ul>
                    </div>

                    <!-- Column 2: Special Package / Gold Package -->
                    <div class="border-t border-slate-200 pt-4">
                        <h4 id="col2-title" class="text-sm font-bold uppercase tracking-wider text-slate-800 mb-2"></h4>
                        
                        <!-- Price Container -->
                        <div class="flex items-baseline gap-3 mb-6">
                            <span id="col2-oldprice" class="text-lg font-normal text-slate-400 line-through tracking-wide font-sans"></span>
                            <span id="col2-newprice" class="text-3xl font-bold text-slate-900 tracking-tight font-sans"></span>
                        </div>

                        <!-- Benefit Section -->
                        <h5 class="text-xs font-bold uppercase tracking-wider text-slate-800 mb-4">Benefit</h5>
                        <ul id="col2-features" class="space-y-3.5 text-xs font-normal text-slate-700 tracking-wide">
                            <!-- Dynamically loaded -->
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Notes Box (Catatan) -->
            <div id="modal-note-container" class="mt-8 border-t border-slate-100 pt-6 text-left hidden">
                <h4 class="text-xs font-bold text-slate-800 tracking-wide mb-3 flex items-center gap-1">* Catatan :</h4>
                <div id="modal-note-text" class="text-xs text-slate-600 font-medium leading-relaxed tracking-wide space-y-4 pl-1">
                    <!-- Loaded dynamically -->
                </div>
            </div>

            <!-- Booking Now Button at the bottom center (Redirects to Login on welcome page) -->
            <div class="mt-12 flex justify-center border-t border-slate-100 pt-8">
                <button onclick="bookService()" class="bg-gradient-to-r from-primary-600 to-primary-800 hover:from-primary-700 hover:to-primary-900 text-white font-black uppercase tracking-[0.2em] text-[10px] py-4 px-10 rounded-2xl transition-all shadow-xl shadow-primary-500/20 transform hover:-translate-y-0.5 active:scale-95 cursor-pointer">
                    Booking Now
                </button>
            </div>
        </div>
    </div>

    <script>
        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) {
                nav.classList.add('glass-nav');
                nav.classList.remove('py-4');
                nav.classList.add('py-2');
            } else {
                nav.classList.remove('glass-nav');
                nav.classList.add('py-4');
                nav.classList.remove('py-2');
            }
        });

        const dbServices = @json($services);

        function getServiceKey(service) {
            const title = service.title.toLowerCase();
            if (title.includes('wedding')) return 'wedding';
            if (title.includes('wisuda') || title.includes('akademik') || title.includes('graduation')) return 'graduation';
            if (title.includes('komersial') || title.includes('produk') || title.includes('commercial')) return 'commercial';
            if (title.includes('keluarga') || title.includes('maternity') || title.includes('family')) return 'family';
            if (title.includes('potret') || title.includes('branding') || title.includes('personal')) return 'personal';
            return service.title.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
        }

        function getSlideUrl(slide) {
            if (!slide) return 'https://images.unsplash.com/photo-1520850838145-4c6d291b1cd2?q=80&w=2070&auto=format&fit=crop';
            if (slide.startsWith('http') || slide.startsWith('/')) {
                return slide;
            }
            return `/storage/${slide}`;
        }

        const serviceData = {};
        dbServices.forEach(svc => {
            const key = getServiceKey(svc);
            
            // Format slide paths
            let resolvedSlides = [];
            if (Array.isArray(svc.slides)) {
                resolvedSlides = svc.slides.map(getSlideUrl);
            }
            
            serviceData[key] = {
                title: svc.title,
                category: svc.title,
                description: svc.description || '',
                starting: svc.starting || '',
                note: svc.note || '',
                slides: resolvedSlides,
                highlights: svc.highlights || [],
                col1: {
                    title: svc.col1?.title || 'BASIC',
                    oldPrice: svc.col1?.oldPrice || svc.col1?.old || '',
                    newPrice: svc.col1?.newPrice || svc.col1?.new || '',
                    features: svc.col1?.features || []
                },
                col2: {
                    title: svc.col2?.title || 'PREMIUM',
                    oldPrice: svc.col2?.oldPrice || svc.col2?.old || '',
                    newPrice: svc.col2?.newPrice || svc.col2?.new || '',
                    features: svc.col2?.features || []
                }
            };
        });

        function renderWelcomeServices() {
            const grid = document.getElementById('services-grid');
            if (!grid) return;
            grid.innerHTML = '';
            
            Object.keys(serviceData).forEach(key => {
                const svc = serviceData[key];
                const firstSlide = svc.slides && svc.slides.length > 0 ? svc.slides[0] : 'https://images.unsplash.com/photo-1520850838145-4c6d291b1cd2?q=80&w=2070&auto=format&fit=crop';
                
                // Build highlights bullets
                let highlightsHtml = '';
                const bullets = svc.highlights && svc.highlights.length > 0 ? svc.highlights : ['Kualitas Premium', 'Editing Cepat', 'Kreatif & Profesional'];
                bullets.slice(0, 3).forEach(hl => {
                    highlightsHtml += `
                        <li class="flex items-center gap-1.5">
                            <span class="text-accent-gold">•</span> ${hl}
                        </li>
                    `;
                });
                
                const card = document.createElement('div');
                card.className = "group bg-white border border-slate-200/80 rounded-[2rem] overflow-hidden shadow-xl shadow-slate-100/50 hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 flex flex-col justify-between";
                card.innerHTML = `
                    <div>
                        <div class="relative h-48 overflow-hidden">
                            <img src="${firstSlide}" alt="${svc.title}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-serif italic font-bold text-slate-900 mb-2">${svc.title}</h3>
                            <p class="text-xs text-slate-600 font-medium tracking-wide leading-relaxed mb-4">
                                ${svc.description}
                            </p>
                            <ul class="text-[9px] font-black uppercase tracking-widest text-slate-400 space-y-1 mb-2">
                                ${highlightsHtml}
                            </ul>
                        </div>
                    </div>
                    <div class="p-6 pt-0 flex justify-between items-center border-t border-slate-50 mt-auto">
                        <span class="text-xs font-black text-slate-950 uppercase tracking-widest">${svc.starting}</span>
                        <button onclick="showServiceDetail('${key}')" class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-primary-600 to-primary-800 text-white font-black uppercase tracking-[0.2em] text-[9px] rounded-xl hover:from-primary-700 hover:to-primary-900 transition-all gap-1.5 shadow-md shadow-primary-500/20 transform hover:-translate-y-0.5 active:scale-95 border-none cursor-pointer">
                            Lihat Detail
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            renderWelcomeServices();
        });

        let selectedService = '';
        let currentSlides = [];
        let activeSlideIndex = 0;

        function formatFeatureText(text) {
            if (text.includes('(berlaku')) {
                const parts = text.split(' (berlaku');
                return `${parts[0]}<br><strong class="font-bold text-slate-900">(berlaku ${parts[1].replace(')', '')})</strong>`;
            }
            if (text.includes('(tanpa frame)')) {
                return text.replace('(tanpa frame)', '<strong class="font-bold text-slate-900">(tanpa frame)</strong>');
            }
            return text;
        }

        function updateCarousel() {
            if (currentSlides.length === 0) return;
            document.getElementById('modal-image').src = currentSlides[activeSlideIndex];
            
            const dotsContainer = document.getElementById('modal-carousel-dots');
            dotsContainer.innerHTML = '';
            currentSlides.forEach((slide, idx) => {
                const dot = document.createElement('span');
                dot.className = idx === activeSlideIndex 
                    ? 'w-7 h-[2px] bg-white transition-all duration-300' 
                    : 'w-3 h-[2px] bg-white/40 transition-all duration-300';
                dotsContainer.appendChild(dot);
            });
        }

        function prevSlide() {
            if (currentSlides.length <= 1) return;
            activeSlideIndex = (activeSlideIndex - 1 + currentSlides.length) % currentSlides.length;
            updateCarousel();
        }

        function nextSlide() {
            if (currentSlides.length <= 1) return;
            activeSlideIndex = (activeSlideIndex + 1) % currentSlides.length;
            updateCarousel();
        }

        function showServiceDetail(serviceKey) {
            const service = serviceData[serviceKey];
            if (!service) return;

            selectedService = service.title;
            currentSlides = service.slides || [];
            activeSlideIndex = 0;

            // Fill breadcrumbs & header badge
            document.getElementById('modal-breadcrumb-title').textContent = service.title;
            document.getElementById('modal-header-badge').textContent = service.category;
            
            // Render image slider
            updateCarousel();

            // Fill Col 1 details
            document.getElementById('col1-title').textContent = service.col1.title;
            document.getElementById('col1-oldprice').textContent = service.col1.oldPrice;
            document.getElementById('col1-newprice').textContent = service.col1.newPrice;
            
            const col1Container = document.getElementById('col1-features');
            col1Container.innerHTML = '';
            service.col1.features.forEach(feat => {
                const li = document.createElement('li');
                li.innerHTML = formatFeatureText(feat);
                col1Container.appendChild(li);
            });

            // Fill Col 2 details
            document.getElementById('col2-title').textContent = service.col2.title;
            document.getElementById('col2-oldprice').textContent = service.col2.oldPrice;
            document.getElementById('col2-newprice').textContent = service.col2.newPrice;
            
            const col2Container = document.getElementById('col2-features');
            col2Container.innerHTML = '';
            service.col2.features.forEach(feat => {
                const li = document.createElement('li');
                li.innerHTML = formatFeatureText(feat);
                col2Container.appendChild(li);
            });

            // Fill Note if exists
            const noteContainer = document.getElementById('modal-note-container');
            const noteText = document.getElementById('modal-note-text');
            
            if (service.note) {
                noteText.innerHTML = service.note;
                noteContainer.classList.remove('hidden');
            } else {
                noteContainer.classList.add('hidden');
            }

            // Open modal with smooth transition
            const modal = document.getElementById('service-modal');
            const modalContent = modal.querySelector('.bg-white');

            modal.classList.remove('opacity-0', 'pointer-events-none');
            modal.classList.add('opacity-100', 'pointer-events-auto');
            
            // Wait a tiny bit for transition to apply
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
            
            document.body.style.overflow = 'hidden';
        }

        function closeServiceModal() {
            const modal = document.getElementById('service-modal');
            const modalContent = modal.querySelector('.bg-white');

            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            setTimeout(() => {
                modal.classList.remove('opacity-100', 'pointer-events-auto');
                modal.classList.add('opacity-0', 'pointer-events-none');
                document.body.style.overflow = '';
            }, 300);
        }

        function bookService() {
            window.location.href = "{{ route('login') }}";
        }
    </script>

</body>
</html>

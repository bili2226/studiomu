<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Studio.mu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,900;1,700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff', 100: '#e0f2fe', 200: '#bae6fd',
                            300: '#7dd3fc', 400: '#38bdf8', 500: '#0ea5e9',
                            600: '#0284c7', 700: '#0369a1', 800: '#075985',
                            900: '#0c4a6e', 950: '#082f49',
                        },
                        accent: { gold: '#D4AF37', dark: '#1e1e1e' }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui'],
                        serif: ['Playfair Display', 'serif'],
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.6s ease-out forwards',
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                        'float-bg': 'floatBg 7s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(16px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        floatBg: {
                            '0%, 100%': { transform: 'scale(1.07) translateY(0px)' },
                            '50%': { transform: 'scale(1.07) translateY(-10px)' },
                        },
                    }
                }
            }
        }
    </script>

    <style>
        * { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }

        /* ── Left Panel ── */
        .auth-left {
            background: linear-gradient(135deg, #090d16 0%, #020617 100%);
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }

        .auth-left-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.22;
            mix-blend-mode: luminosity;
            transform: scale(1.07);
            animation: floatBgAnim 7s ease-in-out infinite;
        }
        @keyframes floatBgAnim {
            0%, 100% { transform: scale(1.07) translateY(0px); }
            50%       { transform: scale(1.07) translateY(-10px); }
        }

        .auth-left-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, #020617 0%, rgba(2,6,23,0.6) 55%, rgba(2,6,23,0.15) 100%);
        }

        .auth-left-content {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }

        /* ── Stat boxes ── */
        .stat-box {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.13);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border-radius: 12px;
            padding: 12px 16px;
        }

        /* ── Right Panel ── */
        .auth-right {
            background: #ffffff;
            overflow-y: auto;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* ── Auth Input ── */
        .auth-input {
            width: 100%;
            padding: 0.72rem 1rem 0.72rem 2.75rem;
            border: 1.5px solid #D4AF37;
            border-radius: 10px;
            background: #ffffff;
            font-size: 0.875rem;
            font-weight: 500;
            color: #0f172a;
            outline: none;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .auth-input:focus {
            border-color: #b28e1d;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(212,175,55,0.15);
        }
        .auth-input::placeholder { color: #94a3b8; font-weight: 400; }
        .auth-input-pr { padding-right: 3rem; }

        /* Force grey font classes to dark black/slate, excluding elements inside dark areas (like the left panel) */
        .text-slate-400:not(.auth-left *),
        .text-slate-500:not(.auth-left *),
        .text-gray-400:not(.auth-left *),
        .text-gray-500:not(.auth-left *) {
            color: #0f172a !important;
        }

        /* Scrollbar */
        .auth-right::-webkit-scrollbar { width: 5px; }
        .auth-right::-webkit-scrollbar-track { background: transparent; }
        .auth-right::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    </style>
</head>
<body class="antialiased font-sans" style="height:100vh; display:flex; overflow:hidden;">

    {{-- ══ LEFT PANEL ══ --}}
    <div class="auth-left hidden lg:flex lg:w-[42%] xl:w-[38%] p-12 xl:p-16 text-white">

        {{-- Background Photo --}}
        <img src="https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=2071&auto=format&fit=crop"
             alt="Studio.mu Photography"
             class="auth-left-img">
        <div class="auth-left-overlay"></div>

        {{-- Content --}}
        <div class="auth-left-content">

            {{-- Logo --}}
            <div>
                <a href="/" class="inline-flex items-center group">
                    <img src="{{ asset('img/logo.png') }}" alt="Studio.mu"
                         class="h-9 w-auto group-hover:opacity-75 transition-opacity duration-300">
                </a>
            </div>

            {{-- Headline + Stats --}}
            <div>
                <h1 class="text-4xl xl:text-5xl font-black leading-[1.1] mb-5 tracking-tight">
                    Abadikan<br>Momen yang<br>
                    <span style="color:#D4AF37;">Tak Ternilai.</span>
                </h1>
                <p class="text-slate-300 text-sm font-medium leading-relaxed max-w-xs mb-10">
                    Bergabunglah dengan ribuan klien yang telah mempercayakan momen berharga mereka kepada Studio.mu.
                </p>

                {{-- Stat Boxes --}}
                <div class="flex gap-3">
                    <div class="stat-box">
                        <p class="text-lg font-black text-white">1.2k+</p>
                        <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mt-0.5">Klien Puas</p>
                    </div>
                    <div class="stat-box">
                        <p class="text-lg font-black text-white">15+</p>
                        <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mt-0.5">Fotografer Pro</p>
                    </div>
                    <div class="stat-box">
                        <p class="text-lg font-black text-white">4.9 ★</p>
                        <p class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider mt-0.5">Rating</p>
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <p class="text-[10px] font-semibold text-slate-500 uppercase tracking-widest">
                &copy; {{ date('Y') }} Studio.mu Visual Art
            </p>

        </div>{{-- end auth-left-content --}}
    </div>{{-- end auth-left --}}


    {{-- ══ RIGHT PANEL ══ --}}
    <div class="auth-right">

        {{-- Mobile top bar --}}
        <div class="lg:hidden flex items-center justify-between px-6 pt-5 pb-3 border-b border-white flex-shrink-0">
            <a href="/"><img src="{{ asset('img/logo.png') }}" alt="Studio.mu" class="h-7 w-auto"></a>
            <a href="/" class="flex items-center text-[10px] font-black uppercase tracking-widest text-slate-600 hover:text-slate-900 transition-colors group">
                <svg class="w-3.5 h-3.5 mr-1.5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Beranda
            </a>
        </div>

        {{-- Desktop back link --}}
        <div class="hidden lg:flex justify-end px-10 pt-6 flex-shrink-0">
            <a href="/" class="flex items-center text-[10px] font-black uppercase tracking-widest text-slate-700 hover:text-slate-950 transition-colors group">
                <svg class="w-3.5 h-3.5 mr-1.5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        {{-- Form Area --}}
        <div class="flex-1 flex items-center justify-center px-6 sm:px-12 lg:px-14 xl:px-20 py-6">
            <div class="w-full max-w-[440px] animate-fade-in">
                @yield('content')
            </div>
        </div>

        {{-- Mobile footer --}}
        <div class="lg:hidden border-t border-white py-4 px-6 text-center text-[9px] font-bold uppercase tracking-widest text-slate-400 flex-shrink-0">
            <p>&copy; {{ date('Y') }} Studio.mu Visual Art</p>
        </div>

    </div>{{-- end auth-right --}}

    @yield('scripts')

</body>
</html>

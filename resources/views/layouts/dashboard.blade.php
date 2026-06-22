<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Studio.mu Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
                        accent: { gold: '#D4AF37' }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'ui-sans-serif', 'system-ui'],
                        serif: ['Playfair Display', 'serif'],
                    },
                }
            }
        }
    </script>

    <style>
        body { background-color: #f8fafc; }

        /* Sidebar transition */
        #sidebar {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Backdrop */
        #sidebar-backdrop {
            transition: opacity 0.3s ease;
        }

        /* Sidebar nav items */
        .sidebar-item-active {
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%) !important;
            color: #92400e !important;
            border-left: 4px solid #b45309 !important;
            border-top-left-radius: 0px !important;
            border-bottom-left-radius: 0px !important;
            box-shadow: 0 4px 15px -3px rgba(146, 64, 14, 0.15), 0 4px 6px -2px rgba(146, 64, 14, 0.1) !important;
        }
        .sidebar-item {
            border: 1px solid transparent;
            border-radius: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .sidebar-item:hover:not(.sidebar-item-active) {
            background-color: #f1f5f9;
            border-color: #e2e8f0;
            color: #0f172a !important;
            transform: translateX(6px);
        }

        /* Customer Top Navbar Specific Overrides */
        .customer-nav .sidebar-item {
            display: flex;
            align-items: center;
            padding: 8px 16px !important;
            font-size: 10px !important;
            font-weight: 800 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.15em !important;
            border-radius: 12px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .customer-nav .sidebar-item:not(.sidebar-item-active) {
            color: #64748b !important;
        }
        .customer-nav .sidebar-item:hover:not(.sidebar-item-active) {
            transform: translateY(-2px) !important;
            background-color: #f0f9ff !important;
            border-color: #bae6fd !important;
            color: #0284c7 !important;
        }
        .customer-nav .sidebar-item-active {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%) !important;
            color: #0c4a6e !important;
            border-left: none !important;
            border-bottom: 3px solid #0284c7 !important;
            border-radius: 12px !important;
            box-shadow: 0 4px 10px -3px rgba(2, 132, 199, 0.15) !important;
            transform: none !important;
        }
        .customer-nav .sidebar-item svg {
            margin-right: 8px !important;
        }

        /* Force grey font classes to dark black/slate, excluding elements inside dark areas */
        .text-slate-400:not(.bg-slate-800 *):not(.bg-slate-900 *):not(.bg-slate-950 *):not(.bg-primary-600 *):not(.bg-primary-950 *),
        .text-slate-500:not(.bg-slate-800 *):not(.bg-slate-900 *):not(.bg-slate-950 *):not(.bg-primary-600 *):not(.bg-primary-950 *),
        .text-gray-400:not(.bg-slate-800 *):not(.bg-slate-900 *):not(.bg-slate-950 *):not(.bg-primary-600 *):not(.bg-primary-950 *),
        .text-gray-500:not(.bg-slate-800 *):not(.bg-slate-900 *):not(.bg-slate-950 *):not(.bg-primary-600 *):not(.bg-primary-950 *) {
            color: #0f172a !important;
        }
    </style>
</head>
 <body class="antialiased font-sans text-slate-800 bg-slate-50">
 
     @if(Auth::user()->role === 'customer')
         {{-- ══ CUSTOMER TOP NAVBAR LAYOUT ══ --}}
         <div class="min-h-screen flex flex-col bg-slate-50 relative">
             {{-- Decorative blob --}}
             <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-500/5 rounded-full blur-3xl opacity-20 -z-10 pointer-events-none"></div>
 
             {{-- ── Top Navigation Bar ── --}}
             <nav class="fixed top-0 left-0 right-0 h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200 z-50 shadow-sm">
                 <div class="max-w-7xl mx-auto px-5 md:px-12 h-full flex items-center justify-between">
                     {{-- Logo --}}
                     <div class="flex items-center gap-8">
                         <a href="/" class="group">
                             <img src="{{ asset('img/logo.png') }}" alt="Studio.mu Logo" class="h-9 sm:h-10 w-auto transition-transform group-hover:scale-105 duration-300">
                         </a>
                         
                         {{-- Desktop Menu --}}
                         <div class="hidden lg:flex items-center gap-1.5 customer-nav">
                             @yield('sidebar')
                         </div>
                     </div>
 
                     {{-- Right Controls --}}
                     <div class="flex items-center gap-4">
                         {{-- Halaman Utama link --}}
                         <a href="{{ route('welcome') }}" class="hidden sm:inline-flex items-center px-4 py-2.5 text-[10px] font-black uppercase tracking-[0.18em] text-slate-750 hover:text-primary-700 bg-slate-100/50 hover:bg-slate-100 rounded-xl transition-all gap-1.5 border border-slate-200">
                             <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                 <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                             </svg>
                             <span>Utama</span>
                         </a>
 
                         {{-- User Avatar Dropdown --}}
                         <div class="relative" id="user-dropdown-wrapper">
                             <button onclick="toggleUserDropdown()" class="flex items-center gap-3 focus:outline-none group">
                                 <div class="text-right hidden sm:block">
                                     <p class="text-xs font-black uppercase tracking-widest text-slate-800 group-hover:text-primary-600 transition-colors">{{ Auth::user()->name }}</p>
                                     <p class="text-[9px] font-black text-primary-600 uppercase tracking-widest">{{ Auth::user()->role }}</p>
                                 </div>
                                 <div class="relative">
                                     <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-primary-800 text-white border border-primary-600/10 rounded-2xl flex items-center justify-center text-sm font-black shadow-md shadow-primary-950/20 group-hover:scale-105 transition-transform">
                                         {{ substr(Auth::user()->name, 0, 1) }}
                                     </div>
                                     <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                                 </div>
                             </button>

                            {{-- Dropdown Card --}}
                            <div id="user-dropdown" class="absolute right-0 mt-3 w-56 bg-white border border-slate-200 rounded-2xl shadow-xl py-2 hidden animate-fade-in-up z-50">
                                <div class="px-4 py-3 border-b border-slate-100 sm:hidden">
                                    <p class="text-xs font-black uppercase tracking-widest text-slate-800">{{ Auth::user()->name }}</p>
                                    <p class="text-[9px] font-black text-amber-700 uppercase tracking-widest">{{ Auth::user()->role }}</p>
                                </div>
                                <a href="{{ route('welcome') }}" class="flex items-center px-4 py-3 text-[10px] font-black uppercase tracking-[0.15em] text-slate-700 hover:bg-slate-50 transition-colors sm:hidden">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                                    </svg>
                                    Halaman Utama
                                </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 text-[10px] font-black uppercase tracking-[0.15em] text-red-600 hover:bg-red-50 transition-colors text-left">
                                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Mobile Menu Trigger --}}
                        <button onclick="toggleMobileMenu()" class="lg:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-650 transition-colors border border-slate-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Mobile Dropdown Menu --}}
                <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-slate-200 shadow-xl px-6 py-6 flex-col gap-2 customer-nav">
                    @yield('sidebar')
                </div>
            </nav>

            {{-- ── Main Content Area ── --}}
            <main class="flex-1 max-w-7xl w-full mx-auto px-5 md:px-12 pt-28 pb-12">
                @yield('content')
            </main>

            {{-- ── Footer ── --}}
            <footer class="p-6 md:p-12 text-[10px] font-bold uppercase tracking-widest text-slate-600 border-t border-slate-200 bg-white">
                <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left">
                    <p>&copy; {{ date('Y') }} Studio.mu Visual Art.</p>
                    <div class="flex space-x-8">
                        <a href="#" class="hover:text-amber-700 transition-colors">Bantuan</a>
                        <a href="#" class="hover:text-amber-700 transition-colors">Privasi</a>
                    </div>
                </div>
            </footer>
        </div>

        <script>
            function toggleUserDropdown() {
                const dropdown = document.getElementById('user-dropdown');
                dropdown.classList.toggle('hidden');
            }

            function toggleMobileMenu() {
                const menu = document.getElementById('mobile-menu');
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    menu.classList.add('flex');
                } else {
                    menu.classList.remove('flex');
                    menu.classList.add('hidden');
                }
            }

            // Close dropdown when clicking outside
            window.addEventListener('click', function(e) {
                const dropdown = document.getElementById('user-dropdown');
                const wrapper = document.getElementById('user-dropdown-wrapper');
                if (dropdown && wrapper && !wrapper.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        </script>
    @else
        {{-- ── Backdrop Overlay ── --}}
        <div id="sidebar-backdrop"
             class="fixed inset-0 bg-slate-950/40 backdrop-blur-sm z-40 hidden"
             onclick="closeSidebar()">
        </div>

        <div class="flex min-h-screen">

            {{-- ══ SIDEBAR ══ --}}
            <aside id="sidebar"
                   class="w-72 bg-white border-r border-slate-200 fixed top-0 left-0 h-screen z-50 flex flex-col
                          -translate-x-full md:translate-x-0 shadow-sm">

                {{-- Mobile close button --}}
                <div class="flex justify-end p-4 md:hidden">
                    <button onclick="closeSidebar()"
                            class="w-10 h-10 flex items-center justify-center rounded-xl bg-white hover:bg-slate-50 text-slate-700 border border-slate-200 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Logo --}}
                <div class="px-8 pb-4 pt-4 md:pt-10">
                    <a href="/" class="group inline-block">
                        <img src="{{ asset('img/logo.png') }}" alt="Studio.mu Logo"
                             class="h-11 w-auto transition-transform group-hover:scale-105 duration-300">
                    </a>
                </div>

                {{-- Nav Menu --}}
                <nav class="flex-1 px-5 space-y-1 mt-2 overflow-y-auto">
                    <p class="px-4 mb-3 text-[9px] font-extrabold text-slate-600 uppercase tracking-[0.25em]">Menu Utama</p>
                    @yield('sidebar')
                </nav>

                   <div class="p-5 border-t border-slate-200 space-y-1.5 bg-slate-50/50">
                    {{-- Kembali ke Beranda --}}
                    <a href="{{ route('welcome') }}"
                       class="sidebar-item flex items-center w-full px-4 py-3 text-[10px] font-black uppercase tracking-[0.18em] text-slate-750 hover:text-primary-700 hover:bg-slate-100 group">
                        <svg class="w-4 h-4 mr-3 flex-shrink-0 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                        </svg>
                        Halaman Utama
                    </a>

                    {{-- Logout --}}
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="sidebar-item flex items-center w-full px-4 py-3 text-[10px] font-black uppercase tracking-[0.18em] text-red-600 hover:bg-red-50 group">
                            <svg class="w-4 h-4 mr-3 flex-shrink-0 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9"/>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </aside>

            {{-- ══ MAIN CONTENT ══ --}}
            <main class="flex-1 flex flex-col relative md:ml-72">

                {{-- Decorative blob --}}
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary-500/5 rounded-full blur-3xl opacity-20 -z-10 pointer-events-none"></div>

                {{-- ── Header ── --}}
                <header class="h-20 bg-white/80 backdrop-blur-xl border-b border-slate-200 flex items-center justify-between px-5 md:px-12 sticky top-0 z-30">
                    <div class="flex items-center gap-3">
                        {{-- Hamburger (mobile only) --}}
                        <button onclick="openSidebar()"
                                class="md:hidden flex items-center justify-center w-10 h-10 rounded-xl bg-white hover:bg-slate-50 text-slate-655 transition-colors border border-slate-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>

                        <div>
                            <p class="text-[9px] font-black uppercase tracking-[0.4em] text-slate-500 mb-0.5">Halaman</p>
                            <h1 class="text-lg font-black text-slate-800 leading-none">@yield('title')</h1>
                        </div>
                    </div>

                    {{-- Right: user info + avatar --}}
                    <div class="flex items-center gap-4">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-black uppercase tracking-widest text-slate-800">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] font-black text-primary-600 uppercase tracking-widest">{{ Auth::user()->role }}</p>
                        </div>
                        <div class="relative">
                            <div class="w-10 h-10 sm:w-11 sm:h-11 bg-gradient-to-br from-primary-600 to-primary-800 text-white border border-primary-600/10 rounded-2xl flex items-center justify-center text-sm font-black shadow-md shadow-primary-950/20">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <div class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
                        </div>
                    </div>
                </header>

                {{-- Page Content --}}
                <div class="p-5 md:p-12 relative">
                    @yield('content')
                </div>

                {{-- Footer --}}
                <footer class="mt-auto p-6 md:p-12 text-[10px] font-bold uppercase tracking-widest text-slate-600 border-t border-slate-200">
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 text-center sm:text-left">
                        <p>&copy; {{ date('Y') }} Studio.mu Visual Art.</p>
                        <div class="flex space-x-8">
                            <a href="#" class="hover:text-primary-700 transition-colors">Bantuan</a>
                            <a href="#" class="hover:text-primary-700 transition-colors">Privasi</a>
                        </div>
                    </div>
                </footer>
            </main>
        </div>

        {{-- Sidebar JS Toggle --}}
        <script>
            const sidebar   = document.getElementById('sidebar');
            const backdrop  = document.getElementById('sidebar-backdrop');

            function openSidebar() {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                backdrop.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeSidebar() {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                backdrop.classList.add('hidden');
                document.body.style.overflow = '';
            }

            // Auto-close on resize to desktop
            window.addEventListener('resize', () => {
                if (window.innerWidth >= 768) {
                    backdrop.classList.add('hidden');
                    document.body.style.overflow = '';
                }
            });
        </script>
    @endif

    @yield('scripts')
</body>
</html>

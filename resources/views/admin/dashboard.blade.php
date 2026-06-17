@extends('layouts.dashboard')

@section('title', 'Admin Workspace')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    {{-- ── 1. OVERVIEW PANEL ── --}}
    <div id="tab-panel-overview" class="tab-panel transition-opacity duration-300 opacity-100 block">
        <!-- Cards Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 mb-12">
            {{-- Card 1: Revenue --}}
            <div class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-md shadow-slate-100 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100/30 rounded-full blur-2xl group-hover:bg-amber-100/50 transition-all duration-500"></div>
                <div class="flex justify-between items-start mb-3 relative z-10">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-700">Total Pendapatan</p>
                        <h3 id="stat-revenue" class="text-3xl font-serif italic font-bold mt-2 text-amber-800">Rp 0</h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 text-amber-800 flex items-center justify-center border border-amber-200 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.007m0-.007A2.25 2.25 0 0 1 6 2.25h2.25A2.25 2.25 0 0 1 10.5 4.5v.007m-6.75-.007a2.25 2.25 0 0 0-2.25 2.25v.007M3.75 6.75h.007m-.007 0A2.25 2.25 0 0 1 6 4.5h2.25a2.25 2.25 0 0 1 2.25 2.25v.007M3.75 6.75a2.25 2.25 0 0 0-2.25 2.25v.007M3.75 9h.007M3.75 9a2.25 2.25 0 0 1 2.25-2.25h2.25A2.25 2.25 0 0 1 10.5 9v.007M3.75 9a2.25 2.25 0 0 0-2.25 2.25v.007M3.75 11.25h.007M3.75 11.25A2.25 2.25 0 0 1 6 9h2.25a2.25 2.25 0 0 1 2.25 2.25v.007M3.75 11.25a2.25 2.25 0 0 0-2.25 2.25v.007M3.75 13.5h.007M3.75 13.5a2.25 2.25 0 0 1 2.25-2.25h2.25A2.25 2.25 0 0 1 10.5 13.5v.007M3.75 13.5a2.25 2.25 0 0 0-2.25 2.25v.007M3.75 15.75h.007M3.75 15.75a2.25 2.25 0 0 1 2.25-2.25h2.25a2.25 2.25 0 0 1 2.25 2.25v.007M3.75 15.75a2.25 2.25 0 0 0-2.25 2.25v.007M3.75 18h.007M3.75 18A2.25 2.25 0 0 1 6 15.75h2.25a2.25 2.25 0 0 1 2.25 2.25v.007M3.75 18a2.25 2.25 0 0 0-2.25 2.25v.007" />
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <span class="text-[9px] font-black text-amber-800 inline-flex items-center gap-1 uppercase tracking-widest bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200 shadow-sm shadow-amber-100">
                        <svg class="w-2.5 h-2.5 animate-bounce" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L10 10.586 13.586 7H12z" clip-rule="evenodd"></path></svg>
                        ↑ 12% BULAN INI
                    </span>
                </div>
            </div>
            
            {{-- Card 2: Pending Bookings --}}
            <div class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-md shadow-slate-100 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100/30 rounded-full blur-2xl group-hover:bg-amber-100/50 transition-all duration-500"></div>
                <div class="flex justify-between items-start mb-3 relative z-10">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-700">Booking Pending</p>
                        <h3 id="stat-pending" class="text-3xl font-serif italic font-bold mt-2 text-amber-800">0</h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 text-amber-800 flex items-center justify-center border border-amber-200 shadow-sm">
                        <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <span id="stat-pending-badge" class="text-[9px] font-black text-amber-800 inline-block uppercase tracking-widest bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200 shadow-sm shadow-amber-100">
                        Menunggu Approval
                    </span>
                </div>
            </div>
            
            {{-- Card 3: Active Services --}}
            <div class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-md shadow-slate-100 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100/30 rounded-full blur-2xl group-hover:bg-amber-100/50 transition-all duration-500"></div>
                <div class="flex justify-between items-start mb-3 relative z-10">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-700">Layanan Aktif</p>
                        <h3 class="text-3xl font-black mt-2 text-slate-900">{{ $services->count() }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 text-amber-800 flex items-center justify-center border border-amber-200 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316A2.192 2.192 0 0 0 14.51 3.75h-5.02a2.192 2.192 0 0 0-1.841.982l-.822 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" />
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <span class="text-[9px] font-black text-amber-800 inline-block uppercase tracking-widest bg-amber-50 px-2.5 py-1 rounded-lg border border-amber-200 shadow-sm shadow-amber-100">
                        Tersedia di Landing
                    </span>
                </div>
            </div>
            
            {{-- Card 4: Customers --}}
            <div class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-md shadow-slate-100 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-violet-100/30 rounded-full blur-2xl group-hover:bg-violet-100/50 transition-all duration-500"></div>
                <div class="flex justify-between items-start mb-3 relative z-10">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-700">Basis Pelanggan</p>
                        <h3 class="text-3xl font-black mt-2 text-slate-900">{{ $totalCustomers }}</h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-50 to-violet-100 text-violet-850 flex items-center justify-center border border-violet-200 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.97 5.97 0 0 0-.75-2.985m-.94-3.198A5.977 5.977 0 0 0 15 10c0-1.88-.65-3.59-1.74-4.96A9.092 9.092 0 0 1 18 8.08a3 3 0 0 1 3 3c0 .888-.387 1.685-1 2.23M12 2a5 5 0 0 1 5 5v3a5 5 0 0 1-10 0V7a5 5 0 0 1 5-5Z" />
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <span class="text-[9px] font-black text-violet-850 inline-block uppercase tracking-widest bg-violet-50 px-2.5 py-1 rounded-lg border border-violet-200 shadow-sm shadow-violet-100">
                        Sistem Loyalitas Aktif
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-12">
            <!-- Analytic minimalist SVG Line Chart -->
            <div class="lg:col-span-8 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-700">Analisis Pendapatan</p>
                        <h4 class="text-lg font-serif italic font-bold text-slate-900 mt-1">Tren Bulanan (2026)</h4>
                    </div>
                    <div class="flex gap-4 text-[9px] font-black uppercase tracking-wider text-slate-700">
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-slate-400 rounded-sm"></span> TARGET</span>
                        <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 bg-amber-600 rounded-sm"></span> REALISASI</span>
                    </div>
                </div>
                <!-- Elegant SVG mockup graph -->
                <div class="w-full h-64 bg-gradient-to-b from-slate-50 to-white rounded-2xl border border-slate-200 relative overflow-hidden flex items-end p-4 shadow-inner">
                    <svg class="absolute inset-0 w-full h-full" viewBox="0 0 600 240" fill="none" preserveAspectRatio="none">
                        <!-- Grid lines -->
                        <line x1="0" y1="40" x2="600" y2="40" stroke="#e2e8f0" stroke-width="1"></line>
                        <line x1="0" y1="100" x2="600" y2="100" stroke="#e2e8f0" stroke-width="1"></line>
                        <line x1="0" y1="160" x2="600" y2="160" stroke="#e2e8f0" stroke-width="1"></line>
                        
                        <!-- Line 1: Target (Minimalist dashed) -->
                        <path d="M0,180 Q100,160 200,120 T400,90 T600,60" stroke="#94a3b8" stroke-width="1.5" stroke-dasharray="6,6" fill="none"></path>
                        <!-- Line 2: Realisasi -->
                        <path d="M0,190 C100,170 150,110 250,95 S400,110 500,70 L600,45" stroke="#b28e1d" stroke-width="3" fill="none" filter="url(#glow)"></path>
                        <!-- Gradient Fill under realisasi -->
                        <path d="M0,190 C100,170 150,110 250,95 S400,110 500,70 L600,45 L600,240 L0,240 Z" fill="url(#chart-grad)" opacity="0.12"></path>
                        
                        <!-- Glowing coordinators -->
                        <circle cx="250" cy="95" r="5" fill="#b28e1d" stroke="#ffffff" stroke-width="2" filter="url(#glow)"></circle>
                        <circle cx="500" cy="70" r="5" fill="#b28e1d" stroke="#ffffff" stroke-width="2" filter="url(#glow)"></circle>
                        <circle cx="600" cy="45" r="5" fill="#b28e1d" stroke="#ffffff" stroke-width="2" filter="url(#glow)"></circle>
                        
                        <defs>
                            <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                                <feGaussianBlur stdDeviation="3" result="blur" />
                                <feComposite in="SourceGraphic" in2="blur" operator="over" />
                            </filter>
                            <linearGradient id="chart-grad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#b28e1d"></stop>
                                <stop offset="100%" stop-color="#ffffff" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                    <div class="absolute bottom-2 left-0 right-0 flex justify-between px-6 text-[8px] font-black uppercase tracking-wider text-slate-700 z-10">
                        <span>Jan</span>
                        <span>Feb</span>
                        <span>Mar</span>
                        <span>Apr</span>
                        <span>Mei (Kini)</span>
                        <span>Jun</span>
                    </div>
                </div>
            </div>
 
            <!-- Activity Logs Feed -->
            <div class="lg:col-span-4 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] mb-6 text-slate-900">Aktivitas Sistem</h4>
                <div class="space-y-6 relative border-l-2 border-slate-200 pl-6 ml-2">
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-slate-300 border-4 border-white ring-4 ring-slate-100"></div>
                        <p class="text-[9px] font-bold text-slate-700 uppercase tracking-widest">10 Menit Lalu</p>
                        <h5 class="text-xs font-bold text-slate-900 mt-1 uppercase tracking-wide">Pendaftaran Pengguna Baru</h5>
                        <p class="text-[11px] text-slate-800 mt-0.5 font-medium leading-relaxed">Admin menambahkan fotografer baru: "Photographer Two"</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-amber-500 border-4 border-white ring-4 ring-amber-100"></div>
                        <p class="text-[9px] font-bold text-slate-700 uppercase tracking-widest">2 Jam Lalu</p>
                        <h5 class="text-xs font-bold text-slate-900 mt-1 uppercase tracking-wide">Booking Baru Terdaftar</h5>
                        <p class="text-[11px] text-slate-800 mt-0.5 font-medium leading-relaxed">Budi Santoso memesan Wedding & Pre-Wedding</p>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full bg-amber-600 border-4 border-white ring-4 ring-amber-100"></div>
                        <p class="text-[9px] font-bold text-slate-700 uppercase tracking-widest">1 Hari Lalu</p>
                        <h5 class="text-xs font-bold text-slate-900 mt-1 uppercase tracking-wide">Penukaran Reward Sukses</h5>
                        <p class="text-[11px] text-slate-800 mt-0.5 font-medium leading-relaxed">Customer User menukarkan 200 pts dengan Frame 16R</p>
                    </div>
                </div>
            </div>
        </div>


    {{-- ── 4. MANAGE USERS PANEL ── --}}
    <div id="tab-panel-users" class="tab-panel transition-opacity duration-300 opacity-0 hidden">
        <div class="bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">
            <div class="p-8 sm:p-12 flex flex-col items-center justify-center text-center gap-6 min-h-[320px]">
                <div class="w-16 h-16 rounded-3xl bg-amber-50 border border-amber-200 flex items-center justify-center">
                    <svg class="w-8 h-8 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0 1 10.089 18M15 12.75a3.375 3.375 0 1 0 0-6.75 3.375 3.375 0 0 0 0 6.75Zm-8.907 4.966A9.28 9.28 0 0 1 10.09 18c.983 0 1.937-.153 2.836-.435a4.125 4.125 0 0 0-7.833-2.316ZM10.5 12.75a3.375 3.375 0 1 1 0-6.75 3.375 3.375 0 0 1 0 6.75Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-serif italic font-bold text-slate-900 mb-2">Kelola User</h2>
                    <p class="text-sm text-slate-500 font-medium max-w-sm">
                        Manajemen akun admin, fotografer, dan customer — termasuk kelola poin loyalty — kini tersedia di halaman tersendiri.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row items-center gap-3">
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center gap-2 bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] py-3.5 px-8 rounded-2xl transition-all shadow-md active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        Buka Halaman Kelola User
                    </a>
                    <a href="{{ route('admin.users.create') }}"
                        class="inline-flex items-center gap-2 border border-slate-200 hover:border-amber-400 text-slate-600 hover:text-amber-800 font-bold text-[10px] py-3.5 px-6 rounded-2xl transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Tambah User Baru
                    </a>
                </div>
                <div class="grid grid-cols-3 gap-4 w-full max-w-sm mt-2">
                    <div class="text-center p-3 bg-slate-50 rounded-2xl border border-slate-200">
                        <p class="text-xl font-black text-slate-900">{{ $totalUsers }}</p>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">Total</p>
                    </div>
                    <div class="text-center p-3 bg-slate-50 rounded-2xl border border-slate-200">
                        <p class="text-xl font-black text-slate-900">{{ $totalPhotographers }}</p>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">Fotografer</p>
                    </div>
                    <div class="text-center p-3 bg-slate-50 rounded-2xl border border-slate-200">
                        <p class="text-xl font-black text-slate-900">{{ $totalCustomers }}</p>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">Customer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── 5. LOYALTY & REWARDS PANEL ── --}}
    <div id="tab-panel-loyalty" class="tab-panel transition-opacity duration-300 opacity-0 hidden">
        <!-- Settings Loyalty Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-stretch">
            <!-- Points Multiplier Setup -->
            <div class="lg:col-span-4 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50 flex flex-col justify-between">
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-2">Skema Loyalitas</h4>
                    <h3 class="text-xl font-serif italic font-bold text-slate-900 mb-6">Konfigurasi Rasio Poin</h3>
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-750 mb-2">Nilai Transaksi per 1 Poin</label>
                            <div class="relative rounded-2xl border border-slate-200 focus-within:border-amber-600 focus-within:ring-4 focus-within:ring-amber-500/10 overflow-hidden flex items-center px-4 bg-slate-50 transition-all duration-300">
                                <span class="text-xs font-black text-slate-700 mr-2">Rp</span>
                                <input type="number" id="setting-multiplier" value="10000" class="w-full bg-transparent py-3.5 text-xs font-semibold focus:outline-none text-slate-900">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-750 mb-2">Tier Leveling (Silver/Gold)</label>
                            <p class="text-slate-700 text-[11px] leading-relaxed font-semibold">Silver Member di atas 150 poin, Gold Member di atas 400 poin secara otomatis disematkan pada data member.</p>
                        </div>
                    </div>
                </div>
                <button onclick="saveLoyaltySettings()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                    SIMPAN PENGATURAN LOYALITAS
                </button>
            </div>

            <!-- Loyalty Catalogue Table -->
            <div class="lg:col-span-8 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700">Katalog Voucher</h4>
                        <h3 class="text-xl font-serif italic font-bold text-slate-900 mt-1">Reward Penukaran Poin</h3>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-700 bg-slate-50">
                                <th class="px-4 py-4">Kode Voucher</th>
                                <th class="px-4 py-4">Nama Reward</th>
                                <th class="px-4 py-4">Biaya Poin</th>
                                <th class="px-4 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 font-semibold text-slate-800 bg-white">
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3.5"><span class="bg-slate-50 text-slate-800 border border-slate-200 rounded-lg px-2.5 py-1 text-[9px] font-black uppercase tracking-widest font-sans inline-block shadow-sm">V-100</span></td>
                                <td class="px-4 py-3.5 text-slate-900">Voucher Diskon Rp 100.000 (Semua Sesi)</td>
                                <td class="px-4 py-3.5"><span class="text-amber-800 font-extrabold font-sans text-[10px] bg-amber-50 border border-amber-200 rounded-full px-3 py-1 inline-block shadow-sm">100 PTS</span></td>
                                <td class="px-4 py-3.5"><span class="bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-full px-3 py-1 font-black text-[9px] uppercase tracking-wider inline-block shadow-sm">AKTIF</span></td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3.5"><span class="bg-slate-50 text-slate-800 border border-slate-200 rounded-lg px-2.5 py-1 text-[9px] font-black uppercase tracking-widest font-sans inline-block shadow-sm">F-16R</span></td>
                                <td class="px-4 py-3.5 text-slate-900">Cetak Canvas + Frame Ukuran 16R Premium</td>
                                <td class="px-4 py-3.5"><span class="text-amber-800 font-extrabold font-sans text-[10px] bg-amber-50 border border-amber-200 rounded-full px-3 py-1 inline-block shadow-sm">200 PTS</span></td>
                                <td class="px-4 py-3.5"><span class="bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-full px-3 py-1 font-black text-[9px] uppercase tracking-wider inline-block shadow-sm">AKTIF</span></td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3.5"><span class="bg-slate-50 text-slate-800 border border-slate-200 rounded-lg px-2.5 py-1 text-[9px] font-black uppercase tracking-widest font-sans inline-block shadow-sm">B-CUST</span></td>
                                <td class="px-4 py-3.5 text-slate-900">Bebas Ganti Custom Background Studio (3 Pilihan)</td>
                                <td class="px-4 py-3.5"><span class="text-amber-800 font-extrabold font-sans text-[10px] bg-amber-50 border border-amber-200 rounded-full px-3 py-1 inline-block shadow-sm">150 PTS</span></td>
                                <td class="px-4 py-3.5"><span class="bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-full px-3 py-1 font-black text-[9px] uppercase tracking-wider inline-block shadow-sm">AKTIF</span></td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3.5"><span class="bg-slate-50 text-slate-800 border border-slate-200 rounded-lg px-2.5 py-1 text-[9px] font-black uppercase tracking-widest font-sans inline-block shadow-sm">F-ALB</span></td>
                                <td class="px-4 py-3.5 text-slate-900">Cetak Premium Leather Album (20 Halaman)</td>
                                <td class="px-4 py-3.5"><span class="text-amber-800 font-extrabold font-sans text-[10px] bg-amber-50 border border-amber-200 rounded-full px-3 py-1 inline-block shadow-sm">300 PTS</span></td>
                                <td class="px-4 py-3.5"><span class="bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-full px-3 py-1 font-black text-[9px] uppercase tracking-wider inline-block shadow-sm">AKTIF</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Loyalty Points Table balance -->
        <div class="bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">
            <div class="p-6 sm:p-8 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-1">Database Poin</h4>
                    <h2 class="text-2xl font-serif italic font-bold text-slate-900">Informasi Point Loyalitas Pelanggan</h2>
                </div>
                <input type="text" id="search-loyalty" oninput="renderLoyalty()" placeholder="Cari pelanggan..." class="border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs focus:outline-none font-semibold min-w-[200px] bg-white text-slate-900 transition-all duration-300">
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-700 bg-slate-50">
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Alamat Email</th>
                            <th class="px-6 py-4">Total Poin Terkumpul</th>
                            <th class="px-6 py-4">Tingkat Membership (Tier)</th>
                            <th class="px-6 py-4 text-center">Aksi Penyesuaian</th>
                        </tr>
                    </thead>
                    <tbody id="loyalty-table-body" class="divide-y divide-slate-100 text-xs font-semibold text-slate-800 bg-white">
                        <!-- Loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── 6. MANAGE HOLIDAYS PANEL ── --}}
    <div id="tab-panel-holidays" class="tab-panel transition-opacity duration-300 opacity-0 hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-stretch">
            
            <!-- Add Holiday Form -->
            <div class="lg:col-span-4 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50 flex flex-col justify-between">
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-2">Operasional Studio</h4>
                    <h3 class="text-xl font-serif italic font-bold text-slate-900 mb-6">Tambah Hari Libur</h3>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-750 mb-2">Pilih Tanggal</label>
                            <div class="relative bg-slate-50 border border-slate-200 rounded-2xl p-1 focus-within:border-amber-600 focus-within:ring-4 focus-within:ring-amber-500/10 overflow-hidden flex items-center transition-all duration-300 shadow-sm">
                                <input type="date" id="holiday-form-date" class="w-full bg-transparent px-4 py-3 text-xs font-semibold focus:outline-none text-slate-900 cursor-pointer">
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-755 mb-2">Keterangan / Alasan Libur</label>
                            <input type="text" id="holiday-form-desc" placeholder="Contoh: Libur Idul Fitri, Tutup Rutin" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300 shadow-sm">
                        </div>
                    </div>
                </div>
                <button onclick="saveHoliday()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                    SIMPAN HARI LIBUR TOKO
                </button>
            </div>

            <!-- Holidays List Table -->
            <div class="lg:col-span-8 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700">Daftar Penutupan Toko</h4>
                        <h3 class="text-xl font-serif italic font-bold text-slate-900 mt-1">Jadwal Hari Libur Studio</h3>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-700 bg-slate-50">
                                <th class="px-4 py-4 w-12">No</th>
                                <th class="px-4 py-4 w-44">Tanggal Libur</th>
                                <th class="px-4 py-4">Keterangan / Alasan</th>
                                <th class="px-4 py-4 text-center w-28">Aksi Pengelolaan</th>
                            </tr>
                        </thead>
                        <tbody id="holidays-table-body" class="divide-y divide-slate-100 font-semibold text-slate-800 bg-white">
                            <!-- Loaded dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>


    {{-- ══ MODALS ══ --}}

    {{-- MODAL A: ADD/EDIT USER MODAL --}}
    <div id="modal-user" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="modal-card bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-lg overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col">
            <button onclick="closeUserModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 id="modal-user-title" class="text-2xl font-serif italic font-bold text-slate-900 mb-7">Tambah User Baru</h3>
            <input type="hidden" id="form-user-index">
            <div class="space-y-5">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Nama Pengguna</label>
                    <input type="text" id="form-user-name" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Email Address</label>
                    <input type="email" id="form-user-email" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Peran (Role)</label>
                    <select id="form-user-role" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-black uppercase tracking-wider text-slate-750 focus:outline-none cursor-pointer transition-all duration-300">
                        <option value="admin">ADMIN</option>
                        <option value="photographer">PHOTOGRAPHER</option>
                        <option value="customer">CUSTOMER</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Password</label>
                    <input type="password" id="form-user-password" placeholder="Kosongkan jika tidak ingin diubah (default: password)" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                </div>
            </div>
            <button onclick="saveUser()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                SIMPAN DATA USER
            </button>
        </div>
    </div>

    {{-- MODAL B: ADD/EDIT SERVICE MODAL --}}
    <div id="modal-service" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="modal-card bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-3xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col max-h-[90vh] overflow-y-auto">
            <button onclick="closeServiceModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 id="modal-service-title" class="text-2xl font-serif italic font-bold text-slate-900 mb-7">Ubah Detail Layanan</h3>
            <input type="hidden" id="form-service-key">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Form Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Nama Layanan</label>
                        <input type="text" id="form-service-title" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Kategori</label>
                        <input type="text" id="form-service-category" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Mulai Dari Harga (Contoh: "Mulai Rp 850.000")</label>
                        <input type="text" id="form-service-starting" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Deskripsi Layanan</label>
                        <textarea id="form-service-description" rows="2" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Slides Gambar (Satu URL per baris)</label>
                        <textarea id="form-service-slides" rows="2" placeholder="Contoh:&#10;/img/prewedding_showcase.png&#10;https://images.unsplash.com/photo-..." class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Sorotan Utama / Bullet Card (Satu per baris)</label>
                        <textarea id="form-service-highlights" rows="2" placeholder="Contoh:&#10;Full Day Coverage&#10;Cinematic Highlight" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Catatan Layanan (Teks / HTML)</label>
                        <textarea id="form-service-note" rows="2" placeholder="Contoh:&#10;* Reservasi H-1 bulan&#10;* DP minimal 30%" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                </div>

                <!-- Right Form Fields (Packages detail) -->
                <div class="space-y-4 border-t md:border-t-0 md:border-l border-slate-100 pt-4 md:pt-0 md:pl-6">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-800 border-b border-slate-100 pb-3 mb-2">Konfigurasi Detail Paket</h4>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-650 uppercase tracking-widest mb-1.5">Judul Paket 1 (Silver)</label>
                        <input type="text" id="form-service-col1-title" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-2">
                        <div>
                            <label class="block text-[9px] font-bold text-slate-650 uppercase tracking-widest mb-1.5">Harga Lama P1 (k)</label>
                            <input type="text" id="form-service-col1-old" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                        </div>
                        <div>
                            <label class="block text-[9px] font-bold text-slate-655 uppercase tracking-widest mb-1.5">Harga Baru P1 (k)</label>
                            <input type="text" id="form-service-col1-new" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-650 uppercase tracking-widest mb-1.5">Fitur/Benefit Paket 1 (Satu per baris)</label>
                        <textarea id="form-service-col1-features" rows="2" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                    
                    <div class="border-t border-slate-100 pt-2">
                        <label class="block text-[9px] font-bold text-slate-650 uppercase tracking-widest mb-1.5">Judul Paket 2 (Gold)</label>
                        <input type="text" id="form-service-col2-title" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-2">
                        <div>
                            <label class="block text-[9px] font-bold text-slate-655 uppercase tracking-widest mb-1.5">Harga Lama P2 (k)</label>
                            <input type="text" id="form-service-col2-old" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                        </div>
                        <div>
                            <label class="block text-[9px] font-bold text-slate-655 uppercase tracking-widest mb-1.5">Harga Baru P2 (k)</label>
                            <input type="text" id="form-service-col2-new" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-655 uppercase tracking-widest mb-1.5">Fitur/Benefit Paket 2 (Satu per baris)</label>
                        <textarea id="form-service-col2-features" rows="2" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                </div>
            </div>

            <button onclick="saveService()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                SIMPAN DETAIL LAYANAN
            </button>
        </div>
    </div>

    {{-- MODAL C: CUSTOM LOYALTY MANUAL POINTS ADJUSTMENT MODAL --}}
    <div id="modal-points" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="modal-card bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-md overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col">
            <button onclick="closePointsModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 id="modal-points-title" class="text-2xl font-serif italic font-bold text-slate-900 mb-1">Sesuaikan Poin Pelanggan</h3>
            <p id="modal-points-subtitle" class="text-xs text-slate-700 mb-6 font-semibold tracking-wide"></p>
            <input type="hidden" id="form-points-email">
            <div class="space-y-5">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Metode Penyesuaian</label>
                    <div class="grid grid-cols-2 gap-4">
                        <button onclick="setPointsMethod('ADD')" id="btn-points-add" class="py-3.5 px-4 bg-amber-500 text-white font-black text-xs uppercase tracking-wider rounded-2xl transition-all text-center shadow-md shadow-amber-500/10 border border-amber-600">TAMBAH (+)</button>
                        <button onclick="setPointsMethod('SUB')" id="btn-points-sub" class="py-3.5 px-4 border border-slate-200 hover:border-slate-350 font-black text-xs uppercase tracking-wider rounded-2xl transition-all text-center text-slate-500 hover:text-slate-700 bg-slate-50">KURANG (-)</button>
                    </div>
                    <input type="hidden" id="form-points-method" value="ADD">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Jumlah Poin</label>
                    <input type="number" id="form-points-value" value="50" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                </div>
            </div>
            <button onclick="savePointsAdjust()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                KONFIRMASI PENYESUAIAN POIN
            </button>
        </div>
    </div>

    {{-- MODAL D: INVOICE DETAIL / BILL MODAL --}}

    {{-- TOAST ALERTS NOTIFICATIONS --}}
    <div id="alert-toast" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-500 pointer-events-none max-w-sm w-full">
        <div class="bg-white/95 backdrop-blur-md text-slate-900 p-5 rounded-2xl border border-slate-200 shadow-2xl flex items-center gap-4">
            <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            </div>
            <div>
                <p id="alert-toast-message" class="text-xs font-black uppercase tracking-wider text-slate-800">Perubahan Berhasil Disimpan!</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Tab switching engine
    function switchTab(tabId) {
        // Toggle tab panels display
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.remove('opacity-100', 'block');
            panel.classList.add('opacity-0', 'hidden');
        });

        const activePanel = document.getElementById(`tab-panel-${tabId}`);
        activePanel.classList.remove('hidden');
        setTimeout(() => {
            activePanel.classList.remove('opacity-0');
            activePanel.classList.add('opacity-100', 'block');
        }, 50);

        // Update active class in sidebar button
        document.querySelectorAll('.sidebar-item').forEach(btn => {
            btn.classList.remove('sidebar-item-active', 'text-white');
            btn.classList.add('text-slate-500');
        });

        const activeBtn = document.getElementById(`btn-${tabId}`);
        activeBtn.classList.add('sidebar-item-active', 'text-white');
        activeBtn.classList.remove('text-slate-500');
    }

    // Default Seed Data
    const defaultUsers = [
        { name: 'Admin Studio', email: 'admin@studio.mu', role: 'admin', joined: '2026-01-10' },
        { name: 'Photographer One', email: 'photo@studio.mu', role: 'photographer', joined: '2026-02-15' },
        { name: 'Customer User', email: 'customer@gmail.com', role: 'customer', joined: '2026-03-20' },
        { name: 'Budi Santoso', email: 'budi@gmail.com', role: 'customer', joined: '2026-04-05' },
        { name: 'Siti Aminah', email: 'siti@gmail.com', role: 'customer', joined: '2026-04-12' },
        { name: 'Photographer Two', email: 'photo2@studio.mu', role: 'photographer', joined: '2026-04-18' }
    ];

    const defaultServices = {
        wedding: {
            title: 'Wedding & Pre-Wedding',
            category: 'Wedding & Pre-Wedding',
            starting: 'Mulai Rp 1.500.000',
            description: 'Abadikan janji suci dan kebahagiaan tak ternilai di hari pernikahan Anda dengan sentuhan artistik kami.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Reservasi disarankan dilakukan minimal 1 bulan sebelum hari H</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Biaya transport & akomodasi luar kota :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Ditanggung sepenuhnya oleh klien</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> H-3 konfirmasi rincian akomodasi</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> DP minimal 30% untuk penguncian tanggal jadwal</li>
                </ul>
            `,
            slides: [
                '/img/prewedding_showcase.png',
                'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2069&auto=format&fit=crop'
            ],
            highlights: [
                'Full Day Coverage',
                'Cinematic Highlight',
                'Premium Photo Book'
            ],
            col1: {
                title: 'BASIC PREWEDD',
                old: '1.999k',
                new: '1.500k',
                features: [
                    '2 Background Indoor Studio',
                    '2 Jam Sesi Photo',
                    'Sudah termasuk Photographer & Crew',
                    'Free 20 Edited Photos',
                    'Foto unlimited / sepuasnya',
                    'All Softcopy on Google Drive'
                ]
            },
            col2: {
                title: 'EXCLUSIVE WEDDING',
                old: '3.999k',
                new: '3.200k',
                features: [
                    'Full Day Coverage (10 Jam)',
                    '2 Professional Photographers',
                    'Cinematic Highlight Video (1-3 Min)',
                    '1 Premium Photo Book Exclusive (10R, 20 Halaman)',
                    '50 Edited Photos Pilihan',
                    'All Softcopy in Exclusive USB Drive'
                ]
            }
        },
        graduation: {
            title: 'Wisuda & Akademik',
            category: 'Wisuda & Akademik',
            starting: 'Mulai Rp 850.000',
            description: 'Rayakan pencapaian akademik Anda dengan sesi foto studio yang elegan dan penuh kebanggaan.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Bisa untuk 1 - 2 busana (bawa sendiri)</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Penambahan orang :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Dewasa : 50k</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Anak-anak : 35k</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Diatas 14 orang pakai studio 3 (di lantai atas)</li>
                </ul>
            `,
            slides: [
                '/img/graduation_showcase.png',
                'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop'
            ],
            highlights: [
                'Studio & Outdoor',
                'Family Grouping',
                'Fast Editing'
            ],
            col1: {
                title: 'BEST DEAL',
                old: '1.199k',
                new: '850k',
                features: [
                    '2 Background Studio',
                    '1 Jam Sesi Foto',
                    'Sudah termasuk Photographer',
                    'Max 6 orang (Keluarga Inti)',
                    'Free 15 Edited Photos, edit tone warna',
                    'Foto unlimited / sepuasnya',
                    'All Softcopy on Google drive (berlaku 2 Minggu)'
                ]
            },
            col2: {
                title: 'SPECIAL PACKAGE',
                old: '1.599k',
                new: '1.200k',
                features: [
                    '3 Background Studio + Outdoor Sesi',
                    '2 Jam Sesi Foto',
                    'Sudah termasuk Photographer & Asisten',
                    'Max 10 orang (Keluarga Besar)',
                    '1 Cetak Frame ukuran 16R',
                    '5 pcs Cetak ukuran 5R (tanpa frame)',
                    'Free 25 Edited Photos, edit tone warna',
                    'Foto unlimited / sepuasnya',
                    'All softcopy on Google drive (berlaku 1 Bulan)'
                ]
            }
        },
        commercial: {
            title: 'Komersial & Produk',
            category: 'Komersial & Produk',
            starting: 'Mulai Rp 1.200.000',
            description: 'Tingkatkan nilai brand Anda dengan visual produk yang profesional dan menarik perhatian audiens.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Pengiriman sampel produk minimal H-3 sesi pemotretan</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Penambahan Properti khusus :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Custom backdrop & model : Hubungi admin</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Makanan/Minuman segar disiapkan oleh klien</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Retouching di luar batas revisi dikenakan biaya tambahan</li>
                </ul>
            `,
            slides: [
                '/img/commercial_showcase.png',
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=2071&auto=format&fit=crop'
            ],
            highlights: [
                'High-End Retouching',
                'Concept Styling',
                'Professional Lighting'
            ],
            col1: {
                title: 'STARTER KIT',
                old: '1.599k',
                new: '1.200k',
                features: [
                    'Minimalist Concept Styling',
                    '15 Produk Unggulan Sesi',
                    'Sudah termasuk Product Photographer',
                    'High-End Retouching (10 Foto)',
                    'Background Solid / Polos',
                    'All Softcopy via Google Drive'
                ]
            },
            col2: {
                title: 'BRAND CHAMPION',
                old: '2.999k',
                new: '2.400k',
                features: [
                    'Premium Concept & Storyboard',
                    'Unlimited Produk Sesi (4 Jam)',
                    'Model & Talent Friendly Setup',
                    'High-End Retouching (30 Foto)',
                    'Professional Lighting & Studio Rent',
                    'Siap untuk Banner & E-Commerce'
                ]
            }
        },
        family: {
            title: 'Keluarga & Maternity',
            category: 'Family Package',
            starting: 'Mulai Rp 500.000',
            description: 'Abadikan kehangatan kasih sayang keluarga dan perjalanan berharga kehamilan Anda dalam potret penuh makna.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-650 font-bold">•</span> Sesi foto maternity disarankan usia kehamilan 28-34 minggu</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-650 font-bold">•</span> Penambahan orang :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/85 font-bold">›</span> Dewasa : 50k</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/85 font-bold">›</span> Anak-anak : 35k</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-655 font-bold">•</span> Kostum bebas rapi (bawa sendiri)</li>
                </ul>
            `,
            slides: [
                '/img/family_showcase.png',
                'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1609234656388-0ff363383899?q=80&w=2070&auto=format&fit=crop'
            ],
            highlights: [
                'Studio & Home Session',
                'Wardrobe Consultation',
                'High-Res Digital Files'
            ],
            col1: {
                title: 'BEST DEAL',
                old: '699k',
                new: '500k',
                features: [
                    '2 Background Photo',
                    '1 jam Photo Session',
                    'Sudah termasuk Photographer',
                    'Max 6 orang',
                    'Free 10-15 Photo, edit tone warna',
                    'Foto unlimited / sepuasnya',
                    'All Softcopy on Google drive (berlaku 2 Minggu)'
                ]
            },
            col2: {
                title: 'SPECIAL PACKAGE',
                old: '999k',
                new: '800k',
                features: [
                    '2 Background Photo',
                    '1 jam Photo Session',
                    'Sudah termasuk Photographer',
                    'Max 8 orang',
                    '1 cetak Canvas + Frame ukuran 17R / kalau sudah di pasang frame ukurannya 40cm x 50 cm',
                    '5 pcs cetak ukuran 5R (tanpa frame)',
                    'Free 10-20 Photo, edit tone warna',
                    'Foto unlimited / sepuasnya',
                    'All softcopy on drive (berlaku 2 Minggu)'
                ]
            }
        },
        personal: {
            title: 'Potret Pribadi & Branding',
            category: 'Potret Pribadi & Branding',
            starting: 'Mulai Rp 650.000',
            description: 'Tampilkan versi terbaik diri Anda untuk profil profesional, CV, LinkedIn, portofolio model, atau personal branding.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Sudah termasuk konsultasi pose standar</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Pakaian & Busana ganti :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Klien membawa jas/pakaian formal sendiri</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Disediakan ruang ganti privat yang nyaman</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Tambahan make-up artist profesional disarankan konfirmasi H-3</li>
                </ul>
            `,
            slides: [
                '/img/personal_showcase.png',
                'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=2070&auto=format&fit=crop'
            ],
            highlights: [
                'Corporate Headshot',
                'Model Portfolio',
                'Custom Backdrop'
            ],
            col1: {
                title: 'BASIC PORTRAIT',
                old: '899k',
                new: '650k',
                features: [
                    '1 Background Pilihan',
                    '45 Menit Sesi Foto',
                    'Sudah termasuk Portrait Photographer',
                    'Max 1 orang (Personal)',
                    'Free 5 Edited Photos (LinkedIn Standard)',
                    '1x Pergantian Pakaian',
                    'All Softcopy on Google Drive'
                ]
            },
            col2: {
                title: 'PREMIUM BRANDING',
                old: '1.499k',
                new: '1.100k',
                features: [
                    '3 Pilihan Background',
                    '1.5 Jam Sesi Foto',
                    'Sudah termasuk Senior Photographer',
                    'Max 2 orang',
                    'Free 15 Edited Photos (Premium Retouch)',
                    '3x Pergantian Pakaian',
                    'All softcopy on Google drive'
                ]
            }
        }
    };

    const defaultTransactions = [
        { id: 'BOOK-1001', name: 'Budi Santoso', email: 'budi@gmail.com', service: 'Wedding & Pre-Wedding (EXCLUSIVE)', date: '2026-05-24 09:00', amount: 'Rp 3.200.000', status: 'Pending' },
        { id: 'BOOK-1002', name: 'Siti Aminah', email: 'siti@gmail.com', service: 'Wisuda & Akademik (BEST DEAL)', date: '2026-05-25 13:00', amount: 'Rp 850.000', status: 'Confirmed' },
        { id: 'BOOK-1003', name: 'Customer User', email: 'customer@gmail.com', service: 'Potret Pribadi & Branding (PREMIUM)', date: '2026-05-26 10:00', amount: 'Rp 1.100.000', status: 'Pending' },
        { id: 'BOOK-1004', name: 'Budi Santoso', email: 'budi@gmail.com', service: 'Keluarga & Maternity (SPECIAL)', date: '2026-05-28 15:00', amount: 'Rp 800.000', status: 'Completed' },
        { id: 'BOOK-1005', name: 'Siti Aminah', email: 'siti@gmail.com', service: 'Komersial & Produk (STARTER KIT)', date: '2026-05-30 11:00', amount: 'Rp 1.200.000', status: 'Cancelled' }
    ];

    const defaultLoyalty = [
        { name: 'Budi Santoso', email: 'budi@gmail.com', points: 450 },
        { name: 'Siti Aminah', email: 'siti@gmail.com', points: 180 },
        { name: 'Customer User', email: 'customer@gmail.com', points: 50 }
    ];

    const defaultHolidays = [
        { date: "2026-05-29", desc: "Hari Raya Waisak (Studio Libur)" },
        { date: "2026-06-01", desc: "Hari Lahir Pancasila (Studio Libur)" }
    ];

    // Database State Loader
    let users = @json($allUsers);
    let transactions = @json($bookings);
    let loyalty = @json($customers);
    @php
        $settingsPath = storage_path('app/settings.json');
        $multiplier = 10000;
        if (file_exists($settingsPath)) {
            $settings = json_decode(file_get_contents($settingsPath), true);
            $multiplier = $settings['points_multiplier'] ?? 10000;
        }
    @endphp
    let pointMultiplier = {{ $multiplier }};
    let holidays = JSON.parse(localStorage.getItem('studio_holidays')) || defaultHolidays;

    // Toast Alert Trigger
    function triggerToast(message) {
        document.getElementById('alert-toast-message').textContent = message;
        const toast = document.getElementById('alert-toast');
        toast.classList.remove('translate-y-20', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');

        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-20', 'opacity-0');
        }, 3500);
    }

    // Save functions to Local Storage
    function persistData(key, data) {
        localStorage.setItem(key, JSON.stringify(data));
        updateOverviewStats();
    }

    // Update Overview Stats values
    function updateOverviewStats() {
        // Stats calculations
        let totalRevenue = 0;
        let pendingCount = 0;
        
        transactions.forEach(tx => {
            if (tx.status === 'Confirmed' || tx.status === 'Completed') {
                const numericPrice = parseInt(tx.amount.replace(/[^0-9]/g, ''));
                totalRevenue += numericPrice;
            }
            if (tx.status === 'Pending') {
                pendingCount++;
            }
        });

        // Format to Indonesian Rupiah Millions/Thousands
        let formattedRevenue = 'Rp 0';
        if (totalRevenue >= 1000000) {
            formattedRevenue = 'Rp ' + (totalRevenue / 1000000).toFixed(1) + ' Jt';
        } else {
            formattedRevenue = 'Rp ' + totalRevenue.toLocaleString('id-ID');
        }

        document.getElementById('stat-revenue').textContent = formattedRevenue;
        document.getElementById('stat-pending').textContent = pendingCount;
        
        // Dynamic badge text for pending
        const pendingBadge = document.getElementById('stat-pending-badge');
        if (pendingCount > 0) {
            pendingBadge.textContent = 'Butuh Tindakan Admin';
            pendingBadge.className = 'text-[9px] font-black text-rose-400 mt-4 inline-block uppercase tracking-widest bg-rose-500/10 px-2.5 py-1 rounded border border-rose-500/20 animate-pulse shadow-sm shadow-rose-500/5';
        } else {
            pendingBadge.textContent = 'Semua Bersih';
            pendingBadge.className = 'text-[9px] font-black text-slate-400 mt-4 inline-block uppercase tracking-widest bg-slate-800/50 px-2.5 py-1 rounded border border-slate-700/50';
        }

        document.getElementById('stat-services').textContent = {{ \App\Models\Service::count() }};
        document.getElementById('stat-customers').textContent = users.filter(u => u.role === 'customer').length;
    }





    /* ─── TAB 4: MANAGE USERS FUNCTIONS ─── */
    function renderUsers() {
        const tbody = document.getElementById('users-table-body');
        tbody.innerHTML = '';

        const searchQuery = document.getElementById('search-users').value.toLowerCase();
        const roleFilter = document.getElementById('filter-role').value;

        users.forEach((usr, idx) => {
            const matchesSearch = usr.name.toLowerCase().includes(searchQuery) || usr.email.toLowerCase().includes(searchQuery);
            const matchesRole = roleFilter === 'ALL' || usr.role === roleFilter;

            if (matchesSearch && matchesRole) {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-slate-50 transition-all duration-350 border-b border-slate-200';

                // Unique color badges for roles
                let badgeClass = '';
                let avatarClass = '';
                if (usr.role === 'admin') {
                    badgeClass = 'bg-amber-50 text-amber-800 border-amber-200';
                    avatarClass = 'bg-amber-50 text-amber-800 border border-amber-200 shadow-sm';
                } else if (usr.role === 'photographer') {
                    badgeClass = 'bg-sky-50 text-sky-800 border-sky-200';
                    avatarClass = 'bg-sky-50 text-sky-800 border border-sky-200 shadow-sm';
                } else if (usr.role === 'customer') {
                    badgeClass = 'bg-emerald-50 text-emerald-800 border-emerald-200';
                    avatarClass = 'bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-sm';
                }

                tr.innerHTML = `
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-black uppercase text-[12px] ${avatarClass}">
                                ${(usr.name || '').substring(0, 1)}
                            </div>
                            <span class="font-bold text-slate-900 text-[13px] leading-snug">${usr.name}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 font-semibold text-slate-700 font-sans text-xs">${usr.email}</td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1.5 text-[9px] font-black uppercase tracking-widest rounded-full border ${badgeClass} inline-block leading-none shadow-sm">
                            ${usr.role}
                        </span>
                    </td>
                    <td class="px-6 py-5 font-semibold text-slate-700 font-sans text-xs">${usr.joined}</td>
                    <td class="px-6 py-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openEditUserModal(${idx})" class="px-4 py-2 bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Ubah</button>
                            <button onclick="deleteUser(${idx})" class="px-4 py-2 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Hapus</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            }
        });
    }

    function openAddUserModal() {
        document.getElementById('modal-user-title').textContent = 'Tambah User Baru';
        document.getElementById('form-user-index').value = '-1';
        document.getElementById('form-user-name').value = '';
        document.getElementById('form-user-email').value = '';
        document.getElementById('form-user-role').value = 'customer';
        document.getElementById('form-user-password').value = '';
        document.getElementById('form-user-password').placeholder = 'Password (default: password)';
        openModal('modal-user');
    }

    function openEditUserModal(index) {
        const usr = users[index];
        if (!usr) return;

        document.getElementById('modal-user-title').textContent = 'Ubah Pengguna';
        document.getElementById('form-user-index').value = index;
        document.getElementById('form-user-name').value = usr.name;
        document.getElementById('form-user-email').value = usr.email;
        document.getElementById('form-user-role').value = usr.role;
        document.getElementById('form-user-password').value = '';
        document.getElementById('form-user-password').placeholder = 'Kosongkan jika tidak ingin diubah';
        openModal('modal-user');
    }

    function saveUser() {
        const index = parseInt(document.getElementById('form-user-index').value);
        const name = document.getElementById('form-user-name').value.trim();
        const email = document.getElementById('form-user-email').value.trim();
        const role = document.getElementById('form-user-role').value;
        const password = document.getElementById('form-user-password').value;

        if (!name || !email) {
            alert('Mohon isi seluruh data form secara lengkap!');
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        let url = '/admin/users';
        let method = 'POST';
        
        if (index !== -1) {
            const id = users[index].id;
            url = `/admin/users/${id}`;
            method = 'PUT';
        }

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ name, email, role, password })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (index === -1) {
                    users.push(data.user);
                    
                    if (role === 'customer') {
                        if (!loyalty.find(c => c.email.toLowerCase() === email.toLowerCase())) {
                            loyalty.push({ name: name, email: email, points: 0 });
                            persistData('studio_loyalty', loyalty);
                        }
                    }
                    triggerToast(`User ${name} Berhasil Ditambahkan.`);
                } else {
                    const prevRole = users[index].role;
                    users[index] = data.user;
                    
                    if (role === 'customer' && prevRole !== 'customer') {
                        if (!loyalty.find(c => c.email.toLowerCase() === email.toLowerCase())) {
                            loyalty.push({ name: name, email: email, points: 0 });
                            persistData('studio_loyalty', loyalty);
                        }
                    }
                    triggerToast(`Akun ${name} Berhasil Diperbarui.`);
                }

                updateOverviewStats();
                renderUsers();
                renderLoyalty();
                closeUserModal();
            } else {
                alert(data.message || 'Terjadi kesalahan saat menyimpan data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.errors) {
                const errorMsg = Object.values(error.errors).flat().join('\n');
                alert('Gagal menyimpan user:\n' + errorMsg);
            } else {
                alert(error.message || 'Terjadi kesalahan sistem.');
            }
        });
    }

    function deleteUser(index) {
        if (!confirm('Apakah Anda yakin ingin menghapus akun user ini?')) return;
        const name = users[index].name;
        const email = users[index].email;
        const id = users[index].id;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/admin/users/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                users.splice(index, 1);
                
                const lIdx = loyalty.findIndex(c => c.email.toLowerCase() === email.toLowerCase());
                if (lIdx !== -1) {
                    loyalty.splice(lIdx, 1);
                    persistData('studio_loyalty', loyalty);
                }

                updateOverviewStats();
                renderUsers();
                renderLoyalty();
                triggerToast(`Akun ${name} Telah Dihapus dari Database.`);
            } else {
                alert(data.message || 'Gagal menghapus user.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Gagal menghapus user. Terjadi kesalahan sistem.');
        });
    }

    function closeUserModal() {
        closeModal('modal-user');
    }


    /* ─── TAB 5: LOYALTY & REWARDS FUNCTIONS ─── */
    function renderLoyalty() {
        const tbody = document.getElementById('loyalty-table-body');
        tbody.innerHTML = '';

        const searchQuery = document.getElementById('search-loyalty').value.toLowerCase();

        loyalty.forEach(c => {
            if (c.name.toLowerCase().includes(searchQuery) || c.email.toLowerCase().includes(searchQuery)) {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-slate-50 transition-all duration-350 border-b border-slate-200';

                // Determine Tier badge
                let tier = 'BRONZE MEMBER';
                let tierBadge = 'bg-slate-50 text-slate-700 border-slate-200';
                if (c.points >= 400) {
                    tier = 'GOLD MEMBER';
                    tierBadge = 'bg-amber-50 text-amber-800 border-amber-300 shadow-sm shadow-amber-100';
                } else if (c.points >= 150) {
                    tier = 'SILVER MEMBER';
                    tierBadge = 'bg-slate-100 text-slate-800 border-slate-300 shadow-sm';
                }

                tr.innerHTML = `
                    <td class="px-6 py-5 font-bold text-slate-900 text-[13px]">${c.name}</td>
                    <td class="px-6 py-5 font-semibold text-slate-700 font-sans text-xs">${c.email}</td>
                    <td class="px-6 py-5 font-bold text-slate-900 font-sans">
                        <span class="text-base text-amber-800 font-extrabold">${c.points}</span>
                        <span class="text-[9px] text-slate-650 font-black uppercase tracking-wider ml-1">pts</span>
                    </td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1.5 rounded-full text-[9px] font-black tracking-widest uppercase border ${tierBadge} inline-block leading-none">
                            ${tier}
                        </span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openPointsAdjustModal('${c.email}', '${c.name}')" class="px-3.5 py-2 bg-slate-50 text-slate-800 border border-slate-300 hover:bg-slate-950 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Sesuaikan Poin</button>
                            <button onclick="quickRedeemVoucher('${c.email}')" class="px-3.5 py-2 bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Klaim Reward</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            }
        });
    }

    function openPointsAdjustModal(email, name) {
        document.getElementById('modal-points-subtitle').textContent = `Pelanggan: ${name} (${email})`;
        document.getElementById('form-points-email').value = email;
        document.getElementById('form-points-value').value = '50';
        setPointsMethod('ADD');
        openModal('modal-points');
    }

    function setPointsMethod(method) {
        document.getElementById('form-points-method').value = method;
        
        const addBtn = document.getElementById('btn-points-add');
        const subBtn = document.getElementById('btn-points-sub');

        if (method === 'ADD') {
            addBtn.className = 'py-3.5 px-4 bg-amber-600 text-white font-black text-xs uppercase tracking-wider rounded-2xl transition-all text-center shadow-md shadow-amber-900/10 border border-amber-600';
            subBtn.className = 'py-3.5 px-4 border border-slate-200 hover:border-slate-300 font-black text-xs uppercase tracking-wider rounded-2xl transition-all text-center text-slate-600 hover:text-slate-900 bg-slate-50 hover:bg-slate-100';
        } else {
            subBtn.className = 'py-3.5 px-4 bg-amber-600 text-white font-black text-xs uppercase tracking-wider rounded-2xl transition-all text-center shadow-md shadow-amber-900/10 border border-amber-600';
            addBtn.className = 'py-3.5 px-4 border border-slate-200 hover:border-slate-300 font-black text-xs uppercase tracking-wider rounded-2xl transition-all text-center text-slate-600 hover:text-slate-900 bg-slate-50 hover:bg-slate-100';
        }
    }

    function savePointsAdjust() {
        const email = document.getElementById('form-points-email').value;
        const method = document.getElementById('form-points-method').value;
        const value = parseInt(document.getElementById('form-points-value').value);

        if (isNaN(value) || value <= 0) {
            alert('Jumlah poin harus berupa angka positif!');
            return;
        }

        let customer = loyalty.find(c => c.email.toLowerCase() === email.toLowerCase());
        if (!customer) return;

        if (method !== 'ADD' && customer.points < value) {
            alert('Poin pelanggan tidak mencukupi untuk pengurangan ini!');
            return;
        }

        const actionVal = method === 'ADD' ? 'add' : 'sub';
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/admin/users/${customer.id}/points`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                points: value,
                action: actionVal
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                customer.points = data.user.points;
                
                if (method === 'ADD') {
                    triggerToast(`Berhasil menambahkan +${value} poin untuk ${customer.name}.`);
                } else {
                    triggerToast(`Berhasil mengurangi -${value} poin untuk ${customer.name}.`);
                }

                renderLoyalty();
                closePointsModal();
            } else {
                alert(data.message || 'Gagal menyesuaikan poin.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan sistem saat menghubungi server.');
        });
    }

    function quickRedeemVoucher(email) {
        let customer = loyalty.find(c => c.email.toLowerCase() === email.toLowerCase());
        if (!customer) return;

        // Prompt simple redeem choice
        const choice = prompt(`Tukarkan poin untuk ${customer.name} (${customer.points} pts):\n\nKetik kode voucher:\n"V-100" (Diskon 100k - Biaya 100 pts)\n"F-16R" (Cetak Canvas Frame 16R - Biaya 200 pts)\n"B-CUST" (Custom Background - Biaya 150 pts)\n"F-ALB" (Premium Album - Biaya 300 pts)`);
        
        if (!choice) return;
        const code = choice.toUpperCase().trim();

        let cost = 0;
        let giftName = '';

        if (code === 'V-100') { cost = 100; giftName = 'Voucher Diskon Rp 100.000'; }
        else if (code === 'F-16R') { cost = 200; giftName = 'Cetak Frame 16R Premium'; }
        else if (code === 'B-CUST') { cost = 150; giftName = 'Bebas Ganti Custom Background'; }
        else if (code === 'F-ALB') { cost = 300; giftName = 'Cetak Premium Leather Album'; }
        else {
            alert('Kode voucher tidak ditemukan!');
            return;
        }

        if (customer.points < cost) {
            alert(`Poin tidak cukup! ${customer.name} hanya memiliki ${customer.points} poin.`);
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/admin/users/${customer.id}/points`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                points: cost,
                action: 'sub'
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                customer.points = data.user.points;
                renderLoyalty();
                triggerToast(`Sukses! ${customer.name} menukarkan ${cost} poin dengan "${giftName}".`);
            } else {
                alert('Gagal memproses penukaran voucher.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan sistem saat menghubungi server.');
        });
    }

    function saveLoyaltySettings() {
        const multInput = parseInt(document.getElementById('setting-multiplier').value);
        if (isNaN(multInput) || multInput <= 100) {
            alert('Rasio pengali poin harus berupa angka minimal Rp 100!');
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('admin.settings.multiplier') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                multiplier: multInput
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                pointMultiplier = multInput;
                triggerToast('Konfigurasi rasio loyalitas berhasil diperbarui!');
            } else {
                alert('Gagal memperbarui konfigurasi rasio loyalitas.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan sistem saat menghubungi server.');
        });
    }

    function closePointsModal() {
        closeModal('modal-points');
    }


    /* ─── TAB 6: MANAGE HOLIDAYS FUNCTIONS ─── */
    function renderHolidays() {
        const tbody = document.getElementById('holidays-table-body');
        if (!tbody) return;
        tbody.innerHTML = '';

        if (holidays.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-slate-500 font-semibold italic text-xs">Belum ada hari libur toko yang ditambahkan.</td>
                </tr>
            `;
            return;
        }

        holidays.forEach((h, idx) => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-slate-50 transition-colors border-b border-slate-100';
            
            const dateStr = typeof h === 'string' ? h : h.date;
            const descStr = typeof h === 'string' ? 'Studio Libur Rutin' : h.desc;

            let formattedDate = dateStr;
            try {
                const dateObj = new Date(dateStr);
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                formattedDate = dateObj.toLocaleDateString('id-ID', options);
            } catch (e) {
                console.error(e);
            }

            tr.innerHTML = `
                <td class="px-4 py-4 text-slate-700 font-sans text-xs">${idx + 1}</td>
                <td class="px-4 py-4 font-bold text-slate-900 font-sans text-xs">${formattedDate}</td>
                <td class="px-4 py-4 text-slate-700 text-xs font-semibold">${descStr}</td>
                <td class="px-4 py-4 text-center">
                    <button onclick="deleteHoliday(${idx})" class="px-3.5 py-2 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Hapus</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function saveHoliday() {
        const dateInput = document.getElementById('holiday-form-date');
        const descInput = document.getElementById('holiday-form-desc');

        const dateVal = dateInput.value;
        const descVal = descInput.value.trim() || 'Studio Libur';

        if (!dateVal) {
            alert('Silakan tentukan tanggal libur terlebih dahulu!');
            return;
        }

        const exists = holidays.some(h => {
            const existingDate = typeof h === 'string' ? h : h.date;
            return existingDate === dateVal;
        });

        if (exists) {
            alert('Tanggal libur tersebut sudah terdaftar!');
            return;
        }

        holidays.push({ date: dateVal, desc: descVal });
        persistHolidays();
        renderHolidays();

        dateInput.value = '';
        descInput.value = '';

        triggerToast('Hari Libur Toko Berhasil Ditambahkan!');
    }

    function deleteHoliday(index) {
        if (!confirm('Apakah Anda yakin ingin menghapus hari libur ini? Toko akan dibuka kembali pada tanggal tersebut.')) return;
        
        holidays.splice(index, 1);
        persistHolidays();
        renderHolidays();
        triggerToast('Hari Libur Toko Telah Dihapus.');
    }

    function persistHolidays() {
        localStorage.setItem('studio_holidays', JSON.stringify(holidays));
    }


    /* ─── BASE MODAL CONTROLLER UTILS ─── */
    function openModal(id) {
        const modal = document.getElementById(id);
        const modalContent = modal.querySelector('.modal-card') || modal.querySelector('.bg-white');

        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');

        setTimeout(() => {
            if (modalContent) {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        const modalContent = modal.querySelector('.modal-card') || modal.querySelector('.bg-white');

        if (modalContent) {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
        }

        setTimeout(() => {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        }, 300);
    }


    // INITIALIZER
    window.addEventListener('DOMContentLoaded', () => {
        updateOverviewStats();
        renderUsers();
        renderLoyalty();
        renderHolidays();
        
        // Load initial multiplier setting
        document.getElementById('setting-multiplier').value = pointMultiplier;
    });
</script>
@endsection

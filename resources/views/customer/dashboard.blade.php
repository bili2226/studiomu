@extends('layouts.dashboard')

@section('title', 'Main Menu')

@section('sidebar')
    <a href="{{ url('/menu-utama') }}" class="sidebar-item sidebar-item-active flex items-center px-5 py-3.5 transition-all text-white">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
        </svg>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('customer.history') }}" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008ZM0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
        </svg>
        <span>Riwayat Booking</span>
    </a>
    <a href="{{ route('customer.gallery') }}" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
        </svg>
        <span>Galeri Foto</span>
    </a>
    <a href="{{ route('customer.loyalty') }}" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
        </svg>
        <span>Poin Loyalitas</span>
    </a>
@endsection

@section('content')
    @php
        $points = Auth::user()->points ?? 0;
        $target = 500;
        $pct = min(100, round(($points / $target) * 100));
        $remaining = max(0, $target - $points);
        $tier = 'BRONZE MEMBER';
        if ($points >= 400) {
            $tier = 'GOLD MEMBER';
        } elseif ($points >= 150) {
            $tier = 'SILVER MEMBER';
        }
    @endphp
    <!-- Luxurious Welcome Banner -->
    <div class="bg-gradient-to-br from-primary-950 via-[#0c4a6e] to-primary-950 text-white p-8 sm:p-12 border border-white/10 rounded-[2rem] shadow-2xl mb-10 relative overflow-hidden animate-fade-in-up">
        <!-- Decorative blur effect inside card -->
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-10 -bottom-10 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex items-center px-3 py-1 bg-white/10 backdrop-blur-md text-[#D4AF37] text-[8px] font-black uppercase tracking-[0.25em] rounded-md mb-4 border border-white/10">
                Studio.mu Visual Art
            </span>
            <h3 class="text-3xl sm:text-5xl font-serif italic font-bold tracking-tight mb-4 text-white">
                Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#F59E0B] font-bold">{{ Auth::user()->name }}</span>!
            </h3>
            <p class="text-slate-300 text-xs sm:text-sm font-medium tracking-wide leading-relaxed mb-8">
                Selamat datang kembali di ruang visual Anda. Abadikan setiap momen berharga bersama tim fotografer handal kami, telusuri karya eksklusif di galeri, atau jadwalkan sesi pemotretan Anda berikutnya dengan mudah.
            </p>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#creative-services" class="bg-white hover:bg-slate-50 text-primary-950 font-black uppercase tracking-[0.2em] text-[10px] py-4 px-8 rounded-xl transition-all flex items-center justify-center gap-2 group shadow-xl border-none">
                    <span>Pesan Sesi Foto</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats & Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <!-- Card 1: Loyalty Points -->
        <div id="loyalty-card" class="bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 text-white p-7 rounded-[1.8rem] border border-white/10 flex flex-col justify-between shadow-xl hover:shadow-2xl hover:border-amber-500/30 hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden">
            <div class="absolute right-[-20px] top-[-20px] w-24 h-24 bg-amber-500/10 rounded-full blur-2xl"></div>
            <div>
                <div class="flex justify-between items-center mb-6">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Poin Loyalitas</span>
                    <span class="px-2.5 py-1 bg-gradient-to-r from-[#D4AF37] to-[#F59E0B] text-slate-950 text-[8px] font-black uppercase tracking-widest rounded border-none shadow-md">{{ $tier }}</span>
                </div>
                <h3 class="text-5xl font-serif italic font-bold text-white">
                    {{ $points }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#D4AF37] to-[#F59E0B] text-xs font-sans font-black uppercase tracking-widest ml-1">pts</span>
                </h3>
            </div>
            <div class="mt-8">
                <div class="flex justify-between text-[9px] font-black uppercase tracking-wider text-slate-350 mb-2">
                    <span>{{ $pct }}% Menuju Free Booking</span>
                    <span class="text-[#D4AF37] font-extrabold">{{ $remaining }} Poin Lagi</span>
                </div>
                <div class="w-full bg-slate-800 h-1.5 rounded-full overflow-hidden mb-4">
                    <div class="bg-gradient-to-r from-[#D4AF37] to-[#F59E0B] h-full rounded-full" style="width: {{ $pct }}%"></div>
                </div>
                <a href="{{ route('customer.loyalty') }}" class="text-[#D4AF37] hover:text-[#F59E0B] text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5 transition-colors group">
                    <span>Detail Poin & Reward</span>
                    <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Card 2: Upcoming Photo Sessions -->
        <div id="booking-card" class="bg-gradient-to-br from-slate-900 via-slate-950 to-slate-900 text-white p-7 rounded-[1.8rem] border border-white/10 flex flex-col justify-between shadow-xl hover:shadow-2xl hover:border-primary-500/30 hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-24 h-24 bg-primary-500/10 rounded-full blur-2xl group-hover:bg-primary-500/20 transition-all duration-500"></div>
            <div>
                <div class="flex justify-between items-center mb-6">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Sesi Aktif</span>
                    <div class="flex items-center gap-2">
                        <span id="upcoming-session-status" class="px-2.5 py-0.5 bg-slate-800 border border-slate-700 text-slate-400 text-[8px] font-black uppercase tracking-widest rounded-lg hidden"></span>
                        <span class="w-2.5 h-2.5 bg-emerald-400 rounded-full animate-pulse shadow-lg shadow-emerald-400/50"></span>
                    </div>
                </div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-slate-800 border border-slate-700 rounded-2xl flex items-center justify-center text-primary-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316A2.192 2.192 0 0 0 14.502 4h-5c-.75 0-1.436.386-1.841 1.015l-.834 1.16Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-xs font-black uppercase tracking-wider text-white">Sesi Foto Terdekat</h4>
                        <p id="upcoming-session-detail" class="text-[11px] text-slate-350 font-semibold mt-0.5">Belum ada sesi pemotretan aktif.</p>
                    </div>
                </div>
            </div>
            <div class="mt-8 relative z-10">
                <a href="#creative-services" class="text-primary-400 hover:text-primary-300 text-[10px] font-black uppercase tracking-widest flex items-center gap-1.5 transition-colors group">
                    <span>Mulai Reservasi</span>
                    <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>



    <!-- Redesigned Services Section (Synced with Welcome Page) -->
    <div id="creative-services" class="mb-12">
        <h4 class="text-[10px] font-black uppercase tracking-[0.25em] mb-6 text-slate-600">Layanan Kreatif Studio.mu</h4>
        <div id="services-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Loaded dynamically -->
        </div>
    </div>



    <!-- Luxurious Service Detail Modal (Visual Showcase matched with user reference) -->
    <div id="service-modal" class="fixed inset-0 bg-slate-950/60 backdrop-blur-md z-50 flex items-center justify-center p-4 md:p-6 opacity-0 pointer-events-none transition-all duration-300">
        <!-- Close trigger by clicking backdrop -->
        <div class="absolute inset-0 cursor-default" onclick="closeServiceModal()"></div>

        <!-- Modal Card -->
        <div class="modal-card bg-white border border-slate-200 rounded-[2rem] shadow-2xl w-full max-w-5xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative max-h-[95vh] overflow-y-auto z-10 p-6 sm:p-10 flex flex-col">
            <!-- Close Button -->
            <button onclick="closeServiceModal()" class="absolute top-4 right-4 z-20 w-10 h-10 flex items-center justify-center rounded-xl bg-slate-50 hover:bg-slate-100 text-slate-900 border border-slate-200 transition-colors cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Breadcrumbs -->
            <nav class="text-xs font-semibold text-slate-500 mb-6 flex items-center gap-1.5 font-sans tracking-wide">
                <button onclick="closeServiceModal()" class="hover:text-primary-700 transition-colors cursor-pointer text-slate-500 font-semibold">Dashboard</button>
                <span class="text-slate-400 font-bold font-serif">&rsaquo;</span>
                <span id="modal-breadcrumb-title" class="text-slate-900 font-black"></span>
            </nav>

            <!-- Package Title Header Badge (Black Rectangle upgraded to pill badge) -->
            <div class="mb-8 border-b border-slate-100 pb-4">
                <span id="modal-header-badge" class="inline-block bg-slate-900/90 text-white px-5 py-2.5 font-black text-xs uppercase tracking-widest rounded-xl shadow-md border-none"></span>
            </div>

            <!-- Content Area (Grid Layout matching the reference image) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-stretch flex-1">
                <!-- Left: Beautiful Image Showcase with Carousel Overlays -->
                <div class="lg:col-span-5 relative rounded-2xl overflow-hidden group min-h-[300px] lg:min-h-[420px] flex items-center justify-center bg-slate-100 border border-slate-200 shadow-inner">
                    <img id="modal-image" src="" alt="" class="w-full h-full object-cover">
                    
                    <!-- Left Arrow Indicator -->
                    <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-900/40 hover:bg-slate-900/60 text-white flex items-center justify-center transition-all cursor-pointer">
                        <svg class="w-6 h-6 stroke-[1]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5"/>
                        </svg>
                    </button>
                    
                    <!-- Right Arrow Indicator -->
                    <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 rounded-full bg-slate-900/40 hover:bg-slate-900/60 text-white flex items-center justify-center transition-all cursor-pointer">
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
                        <h4 id="col1-title" class="text-sm font-bold uppercase tracking-wider text-slate-900 mb-2"></h4>
                        
                        <!-- Price Container -->
                        <div class="flex items-baseline gap-3 mb-6">
                            <span id="col1-oldprice" class="text-lg font-normal text-slate-400 line-through tracking-wide font-sans"></span>
                            <span id="col1-newprice" class="text-3xl font-bold text-primary-700 tracking-tight font-sans"></span>
                        </div>

                        <!-- Benefit Section -->
                        <h5 class="text-xs font-bold uppercase tracking-wider text-slate-800 mb-4">Benefit</h5>
                        <ul id="col1-features" class="space-y-3.5 text-xs font-medium text-slate-700 tracking-wide">
                            <!-- Dynamically loaded -->
                        </ul>
                    </div>

                    <!-- Column 2: Special Package / Gold Package -->
                    <div class="border-t border-slate-200 pt-4">
                        <h4 id="col2-title" class="text-sm font-bold uppercase tracking-wider text-slate-900 mb-2"></h4>
                        
                        <!-- Price Container -->
                        <div class="flex items-baseline gap-3 mb-6">
                            <span id="col2-oldprice" class="text-lg font-normal text-slate-400 line-through tracking-wide font-sans"></span>
                            <span id="col2-newprice" class="text-3xl font-bold text-primary-700 tracking-tight font-sans"></span>
                        </div>

                        <!-- Benefit Section -->
                        <h5 class="text-xs font-bold uppercase tracking-wider text-slate-800 mb-4">Benefit</h5>
                        <ul id="col2-features" class="space-y-3.5 text-xs font-medium text-slate-700 tracking-wide">
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

            <!-- Booking Now Button at the bottom center -->
            <div class="mt-12 flex justify-center border-t border-slate-200 pt-8">
                <button onclick="bookService()" class="bg-primary-950 hover:bg-primary-800 text-white font-black uppercase tracking-[0.2em] text-[10px] py-4 px-10 rounded-2xl transition-all shadow-lg shadow-primary-950/20 transform hover:-translate-y-0.5 active:scale-95 cursor-pointer">
                    Booking Now
                </button>
            </div>
        </div>
    </div>

    <!-- Booking Confirmation Toast -->
    <div id="booking-toast" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-500 pointer-events-none max-w-md w-full">
        <div class="bg-white/95 backdrop-blur-md text-slate-800 p-6 rounded-2xl border border-slate-200 shadow-2xl flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-green-50 text-green-700 border border-green-200 flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            </div>
            <div>
                <h4 class="text-xs font-black uppercase tracking-wider text-green-700">Pemesanan Diajukan!</h4>
                <p class="text-[11px] text-slate-700 font-semibold mt-1 leading-relaxed">
                    Permintaan pemesanan Anda untuk layanan <span id="toast-service-name" class="text-slate-900 font-black"></span> telah berhasil diajukan. Sesi foto Anda ditambahkan ke jadwal aktif.
                </p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
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

    function formatPriceDisplayJS(priceStr) {
        if (!priceStr) return '';
        let clean = priceStr.toLowerCase().trim();
        let val = 0;
        let isMulai = clean.includes('mulai');
        
        // Remove 'mulai' from clean for easier parsing
        clean = clean.replace('mulai', '').trim();
        
        if (clean.endsWith('k')) {
            let numberPart = clean.slice(0, -1);
            numberPart = numberPart.replace(/\./g, '').trim();
            val = parseFloat(numberPart) * 1000;
        } else if (clean.includes('juta') || clean.includes('jt')) {
            let numberPart = clean.replace(/rp|juta|jt/g, '').trim();
            numberPart = numberPart.replace(/,/g, '.');
            val = parseFloat(numberPart) * 1000000;
        } else if (clean.includes('ribu') || clean.includes('rb')) {
            let numberPart = clean.replace(/rp|ribu|rb/g, '').trim();
            numberPart = numberPart.replace(/,/g, '.');
            val = parseFloat(numberPart) * 1000;
        } else {
            let digits = clean.replace(/[^0-9]/g, '');
            val = parseInt(digits) || 0;
        }
        
        if (val === 0) return priceStr;
        
        let formatted = Math.round(val).toLocaleString('id-ID');
        if (isMulai) {
            return 'Mulai Rp ' + formatted;
        }
        return 'Rp ' + formatted;
    }

    function formatServiceNoteJS(noteStr) {
        if (!noteStr) return '';
        return noteStr.replace(/(\d+)k\b/gi, function(match, num) {
            let val = parseInt(num) * 1000;
            return 'Rp ' + val.toLocaleString('id-ID');
        });
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
            starting: formatPriceDisplayJS(svc.starting || ''),
            note: formatServiceNoteJS(svc.note || ''),
            slides: resolvedSlides,
            highlights: svc.highlights || [],
            col1: {
                title: svc.col1?.title || 'BASIC',
                oldPrice: formatPriceDisplayJS(svc.col1?.oldPrice || svc.col1?.old || ''),
                newPrice: formatPriceDisplayJS(svc.col1?.newPrice || svc.col1?.new || ''),
                features: svc.col1?.features || []
            },
            col2: {
                title: svc.col2?.title || 'PREMIUM',
                oldPrice: formatPriceDisplayJS(svc.col2?.oldPrice || svc.col2?.old || ''),
                newPrice: formatPriceDisplayJS(svc.col2?.newPrice || svc.col2?.new || ''),
                features: svc.col2?.features || []
            }
        };
    });

    function renderCustomerServices() {
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
                        <span class="text-[#D4AF37] font-extrabold">•</span> ${hl}
                    </li>
                `;
            });
            
            const card = document.createElement('div');
            card.className = "group bg-white border border-slate-200/80 rounded-[2rem] overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(12,74,110,0.08)] hover:border-primary-500/20 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative";
            card.innerHTML = `
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 rounded-full blur-2xl group-hover:bg-primary-500/10 transition-all duration-500"></div>
                <div class="relative z-10">
                    <div class="relative h-48 overflow-hidden">
                        <img src="${firstSlide}" alt="${svc.title}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-serif italic font-bold text-slate-900 mb-2 group-hover:text-primary-900 transition-colors">${svc.title}</h3>
                        <p class="text-xs text-slate-600 font-medium tracking-wide leading-relaxed mb-4">
                            ${svc.description}
                        </p>
                        <ul class="text-[9px] font-black uppercase tracking-widest text-slate-500 space-y-1.5 mb-2">
                            ${highlightsHtml}
                        </ul>
                    </div>
                </div>
                <div class="p-6 pt-0 flex justify-between items-center border-t border-slate-100 mt-auto relative z-10">
                    <span class="inline-flex items-center px-3.5 py-2 bg-primary-50 text-primary-900 text-[10px] font-black uppercase tracking-wider rounded-xl border border-primary-100/60 shadow-sm">${svc.starting}</span>
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

    let selectedService = '';
    let currentSlides = [];
    let activeSlideIndex = 0;

    function formatFeatureText(text) {
        if (text.includes('(berlaku')) {
            const parts = text.split(' (berlaku');
            return `${parts[0]}<br><strong class="font-bold text-primary-700">(berlaku ${parts[1].replace(')', '')})</strong>`;
        }
        if (text.includes('(tanpa frame)')) {
            return text.replace('(tanpa frame)', '<strong class="font-bold text-primary-700">(tanpa frame)</strong>');
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
                ? 'w-7 h-[2px] bg-slate-900 transition-all duration-300' 
                : 'w-3 h-[2px] bg-slate-400 transition-all duration-300';
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

    let currentServiceKey = '';

    // Logged-in User Context
    const loggedInUser = {
        name: "{{ Auth::user()->name }}",
        email: "{{ Auth::user()->email }}"
    };

    // Default Transactions for seeds
    const defaultTransactions = [
        { id: 'BOOK-1001', name: 'Budi Santoso', email: 'budi@gmail.com', service: 'Wedding & Pre-Wedding (EXCLUSIVE)', date: '2026-05-24 09:00', amount: 'Rp 3.200.000', status: 'Pending' },
        { id: 'BOOK-1002', name: 'Siti Aminah', email: 'siti@gmail.com', service: 'Wisuda & Akademik (BEST DEAL)', date: '2026-05-25 13:00', amount: 'Rp 850.000', status: 'Confirmed' },
        { id: 'BOOK-1003', name: 'Customer User', email: 'customer@gmail.com', service: 'Potret Pribadi & Branding (PREMIUM)', date: '2026-05-26 10:00', amount: 'Rp 1.100.000', status: 'Pending' },
        { id: 'BOOK-1004', name: 'Budi Santoso', email: 'budi@gmail.com', service: 'Keluarga & Maternity (SPECIAL)', date: '2026-05-28 15:00', amount: 'Rp 800.000', status: 'Completed' },
        { id: 'BOOK-1005', name: 'Siti Aminah', email: 'siti@gmail.com', service: 'Komersial & Produk (STARTER KIT)', date: '2026-05-30 11:00', amount: 'Rp 1.200.000', status: 'Cancelled' }
    ];

    // Renders time slots (09.00 - 22.00)
    const timeSlots = ["09.00 - 10.00", "11.30 - 12.30", "14.00 - 15.00", "16.30 - 17.30", "19.00 - 20.00", "21.00 - 22.00"];

    function loadCustomerBookings() {
        // Trigger Toast if redirecting back from booking completion
        const toastService = localStorage.getItem('booking_toast_service');
        if (toastService) {
            localStorage.removeItem('booking_toast_service');
            document.getElementById('toast-service-name').textContent = toastService;
            const toast = document.getElementById('booking-toast');
            toast.classList.remove('translate-y-20', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');
            setTimeout(() => {
                toast.classList.remove('translate-y-0', 'opacity-100');
                toast.classList.add('translate-y-20', 'opacity-0');
            }, 6000);
        }

        const transactions = @json($bookings);
        
        // Find bookings matching the logged-in user's email, sort by date (newest first)
        const myBookings = transactions.filter(tx => tx.email === loggedInUser.email);
        
        const detailEl = document.getElementById('upcoming-session-detail');
        const statusEl = document.getElementById('upcoming-session-status');

        if (myBookings.length > 0) {
            // Find active/newest booking (Pending or Confirmed)
            const activeBooking = myBookings.find(tx => tx.status === 'Pending' || tx.status === 'Confirmed') || myBookings[0];
            
            const paymentMethodText = activeBooking.payment_method === 'Cash' ? 'Cash' : 'Transfer';
            detailEl.innerHTML = `
                <span class="block font-black text-white text-xs">${activeBooking.service}</span>
                <span class="block font-sans text-[10px] text-slate-350 mt-1">${activeBooking.date}</span>
                <span class="block font-sans text-[10px] text-primary-400 font-extrabold mt-0.5">${activeBooking.amount} (${paymentMethodText})</span>
            `;
            
            // Set status badge class & text
            statusEl.textContent = activeBooking.status;
            statusEl.className = 'px-2.5 py-0.5 text-[8px] font-black uppercase tracking-widest rounded-lg border inline-block';
            if (activeBooking.status === 'Pending') {
                statusEl.className += ' bg-amber-500/10 text-amber-500 border-amber-500/20';
            } else if (activeBooking.status === 'Confirmed') {
                statusEl.className += ' bg-sky-500/10 text-sky-450 border-sky-500/20';
            } else if (activeBooking.status === 'Completed') {
                statusEl.className += ' bg-emerald-500/10 text-emerald-450 border-emerald-500/20';
            } else {
                statusEl.className += ' bg-rose-500/10 text-rose-450 border-rose-500/20';
            }
            statusEl.classList.remove('hidden');
        } else {
            detailEl.textContent = "Belum ada sesi pemotretan aktif.";
            statusEl.classList.add('hidden');
        }
    }

    // Call loadCustomerBookings and renderCustomerServices on initialization
    window.addEventListener('DOMContentLoaded', () => {
        loadCustomerBookings();
        renderCustomerServices();
    });

    function showServiceDetail(serviceKey) {
        currentServiceKey = serviceKey;
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
        const modalContent = modal.querySelector('.modal-card');

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
        const modalContent = modal.querySelector('.modal-card');

        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        }, 300);
    }

    function bookService() {
        closeServiceModal();
        window.location.href = `/booking/${currentServiceKey}`;
    }
</script>
@endsection

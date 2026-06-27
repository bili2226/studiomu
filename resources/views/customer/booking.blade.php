@extends('layouts.dashboard')

@section('title', 'Reservasi Sesi Foto')

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
    <a href="{{ url('/menu-utama') }}#gallery-card" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all">
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
    <div class="relative min-h-[80vh] flex items-center justify-center p-0 md:p-6 rounded-[2.5rem] overflow-hidden">
        <!-- Dynamic Blurred Background Container -->
        <div id="booking-bg-image" class="absolute inset-0 bg-cover bg-center filter blur-xl opacity-20 transition-all duration-500"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-slate-100 via-slate-50/90 to-slate-100 -z-10"></div>

        <!-- Booking Page pristine white card -->
        <div class="bg-white border-2 border-black rounded-[2rem] shadow-2xl w-full max-w-4xl overflow-hidden relative z-10 flex flex-col my-4">
            
            <!-- Header Hitam -->
            <div class="p-8 sm:p-10 bg-slate-900 border-b-[2.5px] border-amber-400">
                <nav class="text-xs font-semibold text-slate-400 mb-3 flex items-center gap-1.5 font-sans tracking-wide">
                    <a href="{{ url('/menu-utama') }}" class="hover:text-amber-400 transition-colors font-semibold text-slate-400">Dashboard</a>
                    <span class="text-slate-600 font-bold font-serif">&rsaquo;</span>
                    <span class="text-amber-400 font-black">Booking</span>
                </nav>
                
                <span class="inline-flex items-center px-3.5 py-1.5 bg-slate-800 text-slate-300 text-[8px] font-black uppercase tracking-[0.25em] rounded-lg mb-3 border border-slate-700 shadow-sm">
                    Form Reservasi Sesi Foto
                </span>
                <h2 id="booking-service-title" class="text-3xl font-serif italic font-bold text-amber-400 leading-tight">Pesan Sesi Foto</h2>
                <p class="text-xs text-slate-400 mt-1.5 font-medium tracking-wide">Silakan tentukan jadwal pemotretan Anda dan lengkapi detail pemesanan di bawah.</p>
            </div>

            <!-- Card Body (Two-Column Grid Layout) -->
            <div class="p-8 sm:p-10 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Operational & Location (Google Maps) with Bold Borders -->
                <div class="lg:col-span-5 space-y-6">
                    <!-- Jam Operasional Card -->
                    <div class="bg-slate-50 border border-slate-300 rounded-2xl p-5 relative overflow-hidden group shadow-sm text-slate-800">
                        <div class="absolute right-[-15px] top-[-15px] w-16 h-16 bg-primary-500/5 rounded-full blur-xl"></div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-primary-50 border border-primary-100 rounded-xl flex items-center justify-center text-primary-600 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-450">Jam Operasional</h4>
                                <p class="text-[16px] font-bold text-slate-800 font-sans mt-0.5">09.00 - 22.00 <span class="text-xs text-slate-500 font-semibold uppercase tracking-wider ml-1">WIB</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat Lengkap & Map Pin Card -->
                    <div class="bg-slate-50 border border-slate-300 rounded-2xl p-5 space-y-4 shadow-sm text-slate-800">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 bg-primary-50 border border-primary-100 rounded-xl flex items-center justify-center text-primary-600 flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25s-7.5-4.108-7.5-11.25a7.5 7.5 0 1 1 15 0Z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-450">Lokasi & Alamat</h4>
                                <p class="text-xs font-semibold text-slate-700 mt-1 leading-relaxed">
                                    {{ $mapAddress }}
                                </p>
                            </div>
                        </div>

                        <!-- Embedded Responsive Google Maps iframe -->
                        <div class="w-full h-40 rounded-xl overflow-hidden border border-slate-300 shadow-inner relative group bg-slate-100">
                            <iframe 
                                src="{{ $mapIframeUrl }}" 
                                class="absolute inset-0 w-full h-full border-none transition-opacity duration-300"
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <!-- Open Maps Link Button -->
                        <a href="{{ $mapLinkUrl }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 px-4 bg-white border border-slate-300 hover:border-slate-400 hover:bg-slate-50 text-slate-700 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm cursor-pointer">
                            <span>Buka di Google Maps</span>
                            <svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Column: Date & Time Picker inputs -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Package Tier Selection -->
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5">Pilih Paket Sesi</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <button type="button" onclick="selectBookingTier('col1')" id="tier-btn-col1" class="p-5 rounded-2xl border-2 text-left bg-white border-slate-300 hover:border-slate-400 hover:bg-slate-50/50 transition-all flex flex-col justify-between group relative overflow-hidden cursor-pointer shadow-sm duration-150">
                                <span id="booking-tier1-title" class="text-[10px] font-black uppercase tracking-widest text-slate-500 group-hover:text-slate-800 transition-colors">Basic/Starter</span>
                                <span id="booking-tier1-price" class="text-xl font-bold text-slate-900 mt-1.5 font-sans">Rp 0</span>
                                <div class="absolute right-4 top-4 w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center" id="tier-check-wrapper-col1">
                                    <div class="w-2.5 h-2.5 rounded-full bg-primary-600 hidden" id="tier-check-col1"></div>
                                </div>
                            </button>
                            <button type="button" onclick="selectBookingTier('col2')" id="tier-btn-col2" class="p-5 rounded-2xl border-2 text-left bg-white border-slate-300 hover:border-slate-400 hover:bg-slate-50/50 transition-all flex flex-col justify-between group relative overflow-hidden cursor-pointer shadow-sm duration-150">
                                <span id="booking-tier2-title" class="text-[10px] font-black uppercase tracking-widest text-slate-500 group-hover:text-slate-800 transition-colors">Premium/Exclusive</span>
                                <span id="booking-tier2-price" class="text-xl font-bold text-slate-900 mt-1.5 font-sans">Rp 0</span>
                                <div class="absolute right-4 top-4 w-5 h-5 rounded-full border-2 border-slate-300 flex items-center justify-center" id="tier-check-wrapper-col2">
                                    <div class="w-2.5 h-2.5 rounded-full bg-primary-600 hidden" id="tier-check-col2"></div>
                                </div>
                            </button>
                        </div>
                        <input type="hidden" id="booking-selected-tier" value="col1">
                        <input type="hidden" id="booking-selected-price" value="">
                    </div>

                    <!-- Addons/Layanan Tambahan Container -->
                    <div id="booking-addons-section" class="hidden mb-6">
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5">Layanan Tambahan (Opsional)</label>
                        <div id="booking-addons-list" class="space-y-4 bg-slate-50 border border-slate-200 rounded-2xl p-5 shadow-sm text-slate-850">
                            <!-- Dynamic addon items will be rendered here -->
                        </div>
                    </div>

                    <!-- Datepicker & Cek Button -->
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5">Pilih Tanggal Sesi</label>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1 relative bg-white border border-primary-300 rounded-2xl p-1 focus-within:border-primary-500/40 focus-within:ring-4 focus-within:ring-primary-500/5 transition-all shadow-sm">
                                <input type="date" id="booking-date" onchange="resetCheckedState()" class="w-full bg-transparent px-4 py-3 text-xs font-semibold focus:outline-none text-slate-800 cursor-pointer relative z-10" required>
                            </div>
                            <button type="button" onclick="checkDateAvailability()" class="px-6 py-3.5 bg-slate-900 hover:bg-slate-850 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm hover:shadow-md cursor-pointer border-none flex-shrink-0 active:scale-95 duration-150">
                                Cek Jadwal
                            </button>
                        </div>
                        <!-- Check Date Alert Container -->
                        <div id="check-alert-container" class="mt-3 hidden">
                            <!-- Dynamic Alert Banners will be rendered here -->
                        </div>
                    </div>

                    <!-- Sleek Time Slots Grid with disabled initial state -->
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5">Pilih Jam Sesi</label>
                        <div id="booking-time-wrapper" class="opacity-45 pointer-events-none transition-all duration-300">
                            <div class="grid grid-cols-3 gap-2.5" id="booking-time-grid">
                                <!-- Dynamically generated time slot buttons -->
                            </div>
                        </div>
                        <input type="hidden" id="booking-selected-time" value="">
                    </div>

                    <!-- Custom Requests -->
                    <div class="mb-4">
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5">Catatan Tambahan (Opsional)</label>
                        <textarea id="booking-custom-requests" placeholder="Misal: request konsep pakaian tertentu, properti tambahan, dll." rows="3" class="w-full bg-white border border-primary-300 focus:bg-white rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-800 focus:border-primary-500/40 focus:ring-4 focus:ring-primary-500/5 transition-all duration-300 placeholder-slate-450 shadow-sm"></textarea>
                    </div>

                    <!-- Payment Method Selection -->
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5">Pilih Metode Pembayaran</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label class="flex items-center gap-3.5 p-4 border-2 border-primary-300 rounded-2xl bg-white cursor-pointer hover:border-primary-500 hover:bg-slate-50 transition-all duration-150 has-[:checked]:border-primary-600 has-[:checked]:bg-primary-50/30 has-[:checked]:ring-4 has-[:checked]:ring-primary-500/10">
                                <input type="radio" name="payment_method" value="Transfer" checked class="accent-primary-650 w-4 h-4 cursor-pointer">
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Transfer (Midtrans)</p>
                                    <p class="text-[10px] text-slate-500 font-semibold mt-0.5">Bayar otomatis via VA, E-wallet, dll.</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3.5 p-4 border-2 border-primary-300 rounded-2xl bg-white cursor-pointer hover:border-primary-500 hover:bg-slate-50 transition-all duration-150 has-[:checked]:border-primary-600 has-[:checked]:bg-primary-50/30 has-[:checked]:ring-4 has-[:checked]:ring-primary-500/10">
                                <input type="radio" name="payment_method" value="Cash" class="accent-primary-650 w-4 h-4 cursor-pointer">
                                <div>
                                    <p class="text-xs font-bold text-slate-900">Cash (Tunai di Studio)</p>
                                    <p class="text-[10px] text-slate-500 font-semibold mt-0.5">Bayar langsung di kasir studio.</p>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Loyalty Reward Selection -->
                    <div class="mt-4">
                        <div class="flex justify-between items-center mb-2.5">
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400">Tukarkan Poin Loyalitas (Opsional)</label>
                            <span class="inline-flex items-center px-2.5 py-1 bg-amber-50 text-amber-800 text-[9px] font-black uppercase tracking-wider rounded-lg border border-amber-200 shadow-sm">
                                Poin Anda: {{ $userPoints }} pts
                            </span>
                        </div>
                        <div class="relative bg-white border border-primary-300 rounded-2xl p-1 focus-within:border-primary-500/40 focus-within:ring-4 focus-within:ring-primary-500/5 transition-all shadow-sm">
                            <select id="booking-reward" onchange="calculatePointsDiscount()" class="w-full bg-transparent px-4 py-3 text-xs font-semibold focus:outline-none text-slate-800 cursor-pointer relative z-10">
                                <option value="" data-discount="0" data-points="0">Tidak Menggunakan Reward (Kumpulkan Poin)</option>
                                @foreach($rewards as $reward)
                                    @php
                                        $canRedeem = $userPoints >= $reward->points_required;
                                    @endphp
                                    <option value="{{ $reward->id }}" 
                                            data-discount="{{ $reward->discount_amount }}" 
                                            data-points="{{ $reward->points_required }}"
                                            {{ !$canRedeem ? 'disabled' : '' }}>
                                        {{ $reward->name }} (Butuh {{ $reward->points_required }} Poin) - {{ $canRedeem ? 'Tersedia' : 'Poin Tidak Cukup' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-1.5 font-medium leading-relaxed" id="reward-benefit-note">Pilih reward untuk memotong harga tagihan sesi foto Anda.</p>
                    </div>

                    <!-- Visual Invoice Breakdown -->
                    <div id="booking-price-breakdown" class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-3 shadow-sm text-slate-800 mt-4">
                        <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-450 border-b border-slate-200/60 pb-2">Rincian Pembayaran</h4>
                        <div class="flex justify-between items-center text-xs font-semibold text-slate-650">
                            <span>Harga Sesi Paket</span>
                            <span id="breakdown-original-price">Rp 0</span>
                        </div>
                        <div id="breakdown-addons-row" class="flex justify-between items-center text-xs font-semibold text-slate-650 hidden">
                            <span>Layanan Tambahan (Add-ons)</span>
                            <span id="breakdown-addons-price">Rp 0</span>
                        </div>
                        <div id="breakdown-discount-row" class="flex justify-between items-center text-xs font-semibold text-emerald-650 hidden">
                            <span>Potongan Reward (Diskon)</span>
                            <span id="breakdown-discount-amount">-Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center text-sm font-bold text-slate-900 pt-2 border-t border-slate-200/60">
                            <span>Total Pembayaran</span>
                            <span id="breakdown-final-price" class="text-primary-700 font-sans font-bold text-sm">Rp 0</span>
                        </div>
                        <div class="flex justify-between items-center text-[10px] font-bold text-slate-500 pt-1">
                            <span>Poin Yang Akan Diperoleh</span>
                            <span id="breakdown-points-earned" class="text-amber-800 font-extrabold">+0 pts</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="p-8 sm:p-10 border-t-[2.5px] border-amber-400 flex flex-col sm:flex-row gap-4 justify-end bg-slate-900">
                <a href="{{ url('/menu-utama') }}" class="w-full sm:w-auto px-8 py-3.5 border border-slate-600 hover:border-slate-500 hover:bg-slate-800 text-slate-300 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all text-center flex items-center justify-center">
                    Batal
                </a>
                <button type="button" id="booking-confirm-btn" onclick="submitBooking()" class="w-full sm:w-auto px-10 py-3.5 bg-amber-500 hover:bg-amber-600 text-black rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-amber-500/20 transform active:scale-95 border-none cursor-pointer opacity-45 pointer-events-none">
                    Konfirmasi Booking Sesi
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    let isDateChecked = false;
    let selectedAddons = [];

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

    const loggedInUser = {
        name: "{{ Auth::user()->name }}",
        email: "{{ Auth::user()->email }}"
    };

    const defaultTransactions = [
        { id: 'BOOK-1001', name: 'Budi Santoso', email: 'budi@gmail.com', service: 'Wedding & Pre-Wedding (EXCLUSIVE)', date: '2026-05-24 09:00', amount: 'Rp 3.200.000', status: 'Pending' },
        { id: 'BOOK-1002', name: 'Siti Aminah', email: 'siti@gmail.com', service: 'Wisuda & Akademik (BEST DEAL)', date: '2026-05-25 13:00', amount: 'Rp 850.000', status: 'Confirmed' },
        { id: 'BOOK-1003', name: 'Customer User', email: 'customer@gmail.com', service: 'Potret Pribadi & Branding (PREMIUM)', date: '2026-05-26 10:00', amount: 'Rp 1.100.000', status: 'Pending' },
        { id: 'BOOK-1004', name: 'Budi Santoso', email: 'budi@gmail.com', service: 'Keluarga & Maternity (SPECIAL)', date: '2026-05-28 15:00', amount: 'Rp 800.000', status: 'Completed' },
        { id: 'BOOK-1005', name: 'Siti Aminah', email: 'siti@gmail.com', service: 'Komersial & Produk (STARTER KIT)', date: '2026-05-30 11:00', amount: 'Rp 1.200.000', status: 'Cancelled' }
    ];

    const timeSlots = @json($timeSlots);
    const holidays = @json($holidays);
    const serviceKey = "{{ $serviceKey }}";

    function initBookingPage() {
        const service = serviceData[serviceKey] || serviceData.wedding;

        // Set dynamic background
        if (service.slides && service.slides.length > 0) {
            document.getElementById('booking-bg-image').style.backgroundImage = `url('${service.slides[0]}')`;
        }

        // Set titles
        document.getElementById('booking-service-title').textContent = `Pesan Sesi: ${service.title}`;
        document.getElementById('booking-tier1-title').textContent = service.col1.title;
        document.getElementById('booking-tier1-price').textContent = service.col1.newPrice;
        document.getElementById('booking-tier2-title').textContent = service.col2.title;
        document.getElementById('booking-tier2-price').textContent = service.col2.newPrice;

        // Date min parameter
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('booking-date').min = today;

        // Render time slots
        const timeGrid = document.getElementById('booking-time-grid');
        timeGrid.innerHTML = '';
        timeSlots.forEach(slot => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'py-3 px-2 border border-slate-300 hover:border-primary-500 hover:bg-primary-50/10 text-center bg-white text-xs text-slate-800 font-bold rounded-xl transition-all cursor-pointer shadow-sm active:scale-95 duration-150';
            btn.textContent = slot;
            btn.onclick = () => selectBookingTime(slot, btn);
            timeGrid.appendChild(btn);
        });

        // Render Addons
        const activeService = dbServices.find(svc => getServiceKey(svc) === serviceKey) || dbServices[0];
        const addonsSection = document.getElementById('booking-addons-section');
        const addonsList = document.getElementById('booking-addons-list');
        addonsList.innerHTML = '';
        
        const addons = activeService ? activeService.addons : null;
        if (addons && addons.length > 0) {
            addonsSection.classList.remove('hidden');
            addons.forEach((addon, idx) => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'flex justify-between items-center pb-3 border-b border-slate-200/55 last:pb-0 last:border-b-0';
                
                const formattedPrice = formatRupiahJS(addon.price);
                
                itemDiv.innerHTML = `
                    <div class="flex-1 text-left">
                        <span class="text-xs font-bold text-slate-800">${addon.name}</span>
                        <span class="text-[10px] text-slate-500 font-semibold block mt-0.5">${formattedPrice}</span>
                    </div>
                    <div class="flex items-center gap-3.5 select-none">
                        <button type="button" onclick="changeAddonQty(${idx}, -1)" class="w-7 h-7 rounded-full border border-slate-350 flex items-center justify-center text-slate-700 bg-white hover:bg-slate-100/50 cursor-pointer active:scale-90 duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                            </svg>
                        </button>
                        <span id="addon-qty-${idx}" class="text-xs font-black w-4 text-center text-slate-900">0</span>
                        <button type="button" onclick="changeAddonQty(${idx}, 1)" class="w-7 h-7 rounded-full border border-slate-350 flex items-center justify-center text-slate-700 bg-white hover:bg-slate-100/50 cursor-pointer active:scale-90 duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </div>
                `;
                addonsList.appendChild(itemDiv);
            });
            
            selectedAddons = addons.map(addon => ({
                name: addon.name,
                price: addon.price,
                qty: 0
            }));
        } else {
            addonsSection.classList.add('hidden');
            selectedAddons = [];
        }

        // Default selection
        selectBookingTier('col1');
    }

    function changeAddonQty(index, change) {
        if (!selectedAddons[index]) return;
        const currentQty = selectedAddons[index].qty;
        const newQty = Math.max(0, currentQty + change);
        selectedAddons[index].qty = newQty;
        
        // Update UI counter
        document.getElementById(`addon-qty-${index}`).textContent = newQty;
        
        // Recalculate price
        calculatePointsDiscount();
    }

    function selectBookingTier(tier) {
        document.getElementById('booking-selected-tier').value = tier;
        
        const btnCol1 = document.getElementById('tier-btn-col1');
        const btnCol2 = document.getElementById('tier-btn-col2');
        const checkCol1 = document.getElementById('tier-check-col1');
        const checkCol2 = document.getElementById('tier-check-col2');
        const wrapperCol1 = document.getElementById('tier-check-wrapper-col1');
        const wrapperCol2 = document.getElementById('tier-check-wrapper-col2');

        if (tier === 'col1') {
            btnCol1.classList.add('border-primary-600', 'bg-primary-50/30', 'ring-4', 'ring-primary-500/10');
            btnCol1.classList.remove('border-slate-300', 'bg-white');
            checkCol1.classList.remove('hidden');
            if (wrapperCol1) wrapperCol1.classList.add('border-primary-600');

            btnCol2.classList.remove('border-primary-600', 'bg-primary-50/30', 'ring-4', 'ring-primary-500/10');
            btnCol2.classList.add('border-slate-300', 'bg-white');
            checkCol2.classList.add('hidden');
            if (wrapperCol2) wrapperCol2.classList.remove('border-primary-600');

            document.getElementById('booking-selected-price').value = document.getElementById('booking-tier1-price').textContent;
        } else {
            btnCol2.classList.add('border-primary-600', 'bg-primary-50/30', 'ring-4', 'ring-primary-500/10');
            btnCol2.classList.remove('border-slate-300', 'bg-white');
            checkCol2.classList.remove('hidden');
            if (wrapperCol2) wrapperCol2.classList.add('border-primary-600');

            btnCol1.classList.remove('border-primary-600', 'bg-primary-50/30', 'ring-4', 'ring-primary-500/10');
            btnCol1.classList.add('border-slate-300', 'bg-white');
            checkCol1.classList.add('hidden');
            if (wrapperCol1) wrapperCol1.classList.remove('border-primary-600');

            document.getElementById('booking-selected-price').value = document.getElementById('booking-tier2-price').textContent;
        }
        calculatePointsDiscount();
    }

    function selectBookingTime(time, element) {
        document.getElementById('booking-selected-time').value = time;
        
        // Clear slots styles
        const buttons = document.querySelectorAll('#booking-time-grid button');
        buttons.forEach(btn => {
            btn.classList.remove('border-primary-600', 'bg-primary-600', 'text-white', 'shadow-md', 'ring-4', 'ring-primary-500/15');
            btn.classList.add('border-slate-300', 'bg-white', 'text-slate-800');
        });

        // Set active slot style
        element.classList.add('border-primary-600', 'bg-primary-600', 'text-white', 'shadow-md', 'ring-4', 'ring-primary-500/15');
        element.classList.remove('border-slate-300', 'bg-white', 'text-slate-800');
    }

    function toggleTimeSlotsAndSubmit(enable) {
        const timeWrapper = document.getElementById('booking-time-wrapper');
        const confirmBtn = document.getElementById('booking-confirm-btn');

        if (enable) {
            timeWrapper.classList.remove('opacity-45', 'pointer-events-none');
            confirmBtn.classList.remove('opacity-45', 'pointer-events-none');
        } else {
            timeWrapper.classList.add('opacity-45', 'pointer-events-none');
            confirmBtn.classList.add('opacity-45', 'pointer-events-none');
        }
    }

    function resetCheckedState() {
        isDateChecked = false;
        
        // Hide alert container
        const alertContainer = document.getElementById('check-alert-container');
        alertContainer.classList.add('hidden');
        alertContainer.innerHTML = '';

        // Reset selected time
        document.getElementById('booking-selected-time').value = '';
        
        // Clear slots styles
        const buttons = document.querySelectorAll('#booking-time-grid button');
        buttons.forEach(btn => {
            btn.classList.remove('border-primary-600', 'bg-primary-600', 'text-white', 'shadow-md', 'ring-4', 'ring-primary-500/15');
            btn.classList.add('border-slate-300', 'bg-white', 'text-slate-800');
        });

        // Lock sessions & confirm button
        toggleTimeSlotsAndSubmit(false);
    }

    function checkDateAvailability() {
        const dateInput = document.getElementById('booking-date');
        const dateVal = dateInput.value;
        
        if (!dateVal) {
            alert('Silakan pilih tanggal terlebih dahulu!');
            return;
        }

        const alertContainer = document.getElementById('check-alert-container');
        alertContainer.classList.remove('hidden');

        // Check if dateVal is a holiday
        let isHoliday = false;
        let holidayDesc = "Studio Libur Rutin";

        const foundHoliday = holidays.find(h => {
            if (typeof h === 'string') {
                return h === dateVal;
            } else if (h && typeof h === 'object' && h.date) {
                return h.date === dateVal;
            }
            return false;
        });

        if (foundHoliday) {
            isHoliday = true;
            if (typeof foundHoliday === 'object' && foundHoliday.desc) {
                holidayDesc = foundHoliday.desc;
            }
        }

        if (isHoliday) {
            isDateChecked = false;
            toggleTimeSlotsAndSubmit(false);
            
            alertContainer.innerHTML = `
                <div class="flex items-center gap-3 p-4 bg-rose-50 border border-rose-200 text-rose-800 rounded-2xl shadow-sm text-xs font-semibold mt-1">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <p class="font-bold text-rose-900 uppercase tracking-wide">Studio Tutup / Libur</p>
                        <p class="text-rose-700 mt-0.5">${holidayDesc}. Silakan pilih tanggal operasional lainnya.</p>
                    </div>
                </div>
            `;
        } else {
            isDateChecked = true;
            toggleTimeSlotsAndSubmit(true);

            alertContainer.innerHTML = `
                <div class="flex items-center gap-3 p-4 bg-emerald-50 border border-emerald-250 text-emerald-800 rounded-2xl shadow-sm text-xs font-semibold mt-1">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0 1 18 0z"/>
                    </svg>
                    <div>
                        <p class="font-bold text-emerald-900 uppercase tracking-wide">Studio Tersedia</p>
                        <p class="text-emerald-700 mt-0.5">Jadwal tersedia! Silakan pilih jam sesi pemotretan Anda di bawah.</p>
                    </div>
                </div>
            `;
        }
    }

    function submitBooking() {
        if (!isDateChecked) {
            alert('Silakan pilih tanggal dan klik tombol "Cek Jadwal" terlebih dahulu untuk memastikan ketersediaan studio!');
            return;
        }

        const dateVal = document.getElementById('booking-date').value;
        const timeVal = document.getElementById('booking-selected-time').value;
        
        if (!dateVal) {
            alert('Silakan pilih tanggal booking terlebih dahulu!');
            return;
        }
        if (!timeVal) {
            alert('Silakan pilih jam sesi pemotretan terlebih dahulu!');
            return;
        }

        const tierVal = document.getElementById('booking-selected-tier').value;
        const priceVal = document.getElementById('booking-selected-price').value;
        const customRequests = document.getElementById('booking-custom-requests').value.trim();
        const service = serviceData[serviceKey] || serviceData.wedding;
        const packageName = tierVal === 'col1' ? service.col1.title : service.col2.title;

        const paymentMethodEl = document.querySelector('input[name="payment_method"]:checked');
        const paymentMethodVal = paymentMethodEl ? paymentMethodEl.value : 'Transfer';

        const rewardSelect = document.getElementById('booking-reward');
        const rewardIdVal = rewardSelect ? rewardSelect.value : '';

        // Disable confirm button to prevent double submission
        const confirmBtn = document.getElementById('booking-confirm-btn');
        confirmBtn.disabled = true;
        confirmBtn.textContent = 'Memproses...';

        fetch("{{ route('booking.store') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                service_key: serviceKey,
                service_title: service.title,
                package_name: packageName,
                date: dateVal,
                time: timeVal,
                price: priceVal,
                requests: customRequests,
                payment_method: paymentMethodVal,
                reward_id: rewardIdVal ? parseInt(rewardIdVal) : null,
                addons: selectedAddons.filter(a => a.qty > 0)
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
                if (data.snap_token) {
                    // Trigger Midtrans Snap payment popup
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            // Confirm payment in backend (for local testing without ngrok)
                            fetch(`/booking/${data.booking.id}/confirm-payment`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json'
                                }
                            })
                            .then(() => {
                                window.location.href = `/payment/finish?order_id=${data.booking.id}`;
                            })
                            .catch(() => {
                                window.location.href = `/payment/finish?order_id=${data.booking.id}`;
                            });
                        },
                        onPending: function(result) {
                            window.location.href = `{{ route('customer.history') }}?unpaid=1&pending_id=${data.booking.id}`;
                        },
                        onError: function(result) {
                            window.location.href = `/payment/error?order_id=${data.booking.id}`;
                        },
                        onClose: function() {
                            window.location.href = `{{ route('customer.history') }}?unpaid=1&pending_id=${data.booking.id}`;
                        }
                    });
                } else if (data.booking) {
                    if (parseInt(data.booking.amount) === 0 || data.booking.status === 'Confirmed') {
                        // Redirect for free/fully points-discounted booking
                        window.location.href = `{{ route('customer.history') }}?free_success=1&pending_id=${data.booking.id}`;
                    } else if (data.booking.payment_method === 'Cash') {
                        // Redirect for Cash booking
                        window.location.href = `{{ route('customer.history') }}?cash_success=1&pending_id=${data.booking.id}`;
                    } else {
                        alert(data.message || 'Booking berhasil dibuat.');
                        window.location.href = `{{ route('customer.history') }}`;
                    }
                } else {
                    alert(data.message || 'Terjadi kesalahan saat membuat booking.');
                    confirmBtn.disabled = false;
                    confirmBtn.textContent = 'Konfirmasi Booking Sesi';
                }
            } else {
                alert(data.message || 'Terjadi kesalahan saat membuat booking.');
                confirmBtn.disabled = false;
                confirmBtn.textContent = 'Konfirmasi Booking Sesi';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan sistem saat menghubungi server.');
            confirmBtn.disabled = false;
            confirmBtn.textContent = 'Konfirmasi Booking Sesi';
        });
    }

    function calculatePointsDiscount() {
        const priceVal = document.getElementById('booking-selected-price').value;
        const originalAmount = parsePriceToIntegerJS(priceVal);
        
        let addonsTotal = 0;
        selectedAddons.forEach(addon => {
            addonsTotal += addon.qty * addon.price;
        });

        const totalBeforeDiscount = originalAmount + addonsTotal;
        
        const rewardSelect = document.getElementById('booking-reward');
        if (!rewardSelect) return;
        const selectedOption = rewardSelect.options[rewardSelect.selectedIndex];
        
        const discountAmount = parseInt(selectedOption.getAttribute('data-discount') || 0);
        const pointsRequired = parseInt(selectedOption.getAttribute('data-points') || 0);
        
        const finalAmount = Math.max(0, totalBeforeDiscount - discountAmount);
        const pointsEarned = Math.floor(finalAmount / 10000);
        
        // Update visual breakdown
        document.getElementById('breakdown-original-price').textContent = formatRupiahJS(originalAmount);
        
        const addonsRow = document.getElementById('breakdown-addons-row');
        if (addonsTotal > 0) {
            document.getElementById('breakdown-addons-price').textContent = formatRupiahJS(addonsTotal);
            addonsRow.classList.remove('hidden');
        } else {
            addonsRow.classList.add('hidden');
        }

        const discountRow = document.getElementById('breakdown-discount-row');
        if (discountAmount > 0) {
            document.getElementById('breakdown-discount-amount').textContent = '-' + formatRupiahJS(discountAmount);
            discountRow.classList.remove('hidden');
        } else {
            discountRow.classList.add('hidden');
        }
        
        document.getElementById('breakdown-final-price').textContent = formatRupiahJS(finalAmount);
        document.getElementById('breakdown-points-earned').textContent = '+' + pointsEarned + ' pts';
        
        // Note display update
        const noteEl = document.getElementById('reward-benefit-note');
        if (discountAmount > 0) {
            noteEl.innerHTML = `<span class="text-emerald-600 font-bold">Reward diterapkan!</span> Potongan sebesar <strong>${formatRupiahJS(discountAmount)}</strong> berhasil digunakan (potong ${pointsRequired} poin).`;
        } else {
            noteEl.textContent = 'Pilih reward untuk memotong harga tagihan sesi foto Anda.';
        }
    }

    function parsePriceToIntegerJS(priceStr) {
        let clean = priceStr.toLowerCase().trim();
        
        // If it ends with "juta"
        if (clean.includes('juta') || clean.includes('jt')) {
            let numberPart = clean.replace('rp', '').replace('juta', '').replace('jt', '').trim();
            numberPart = numberPart.replace(',', '.');
            return parseFloat(numberPart) * 1000000;
        }
        
        // If it ends with "ribu"
        if (clean.includes('ribu') || clean.includes('rb')) {
            let numberPart = clean.replace('rp', '').replace('ribu', '').replace('rb', '').trim();
            numberPart = numberPart.replace(',', '.');
            return parseFloat(numberPart) * 1000;
        }

        // If it still ends with 'k'
        if (clean.slice(-1) === 'k') {
            let numberPart = clean.slice(0, -1);
            numberPart = numberPart.replace('rp', '').replace(/\./g, '').trim();
            return parseInt(numberPart) * 1000;
        }
        
        let digits = clean.replace(/[^0-9]/g, '');
        return parseInt(digits) || 0;
    }

    function formatRupiahJS(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    // Run init
    window.addEventListener('DOMContentLoaded', initBookingPage);
</script>
@endsection

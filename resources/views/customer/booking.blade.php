@extends('layouts.dashboard')

@section('title', 'Reservasi Sesi Foto')

@section('sidebar')
    <a href="{{ url('/menu-utama') }}" class="sidebar-item sidebar-item-active flex items-center px-5 py-3.5 transition-all text-white">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
        </svg>
        <span>Dashboard</span>
    </a>
    <a href="{{ url('/menu-utama') }}#booking-card" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all">
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
    <a href="{{ url('/menu-utama') }}#loyalty-card" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all">
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
        <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-4xl overflow-hidden relative z-10 flex flex-col my-4">
            
            <!-- Breadcrumbs Header inside card -->
            <div class="p-8 sm:p-10 border-b border-slate-100 bg-slate-50/50">
                <nav class="text-xs font-semibold text-slate-500 mb-3 flex items-center gap-1.5 font-sans tracking-wide">
                    <a href="{{ url('/menu-utama') }}" class="hover:text-primary-700 transition-colors font-semibold">Dashboard</a>
                    <span class="text-slate-400 font-bold font-serif">&rsaquo;</span>
                    <span class="text-slate-800 font-black">Booking</span>
                </nav>
                
                <span class="inline-flex items-center px-3.5 py-1.5 bg-primary-50 text-primary-700 text-[8px] font-black uppercase tracking-[0.25em] rounded-lg mb-3 border border-primary-100/60 shadow-sm">
                    Form Reservasi Sesi Foto
                </span>
                <h2 id="booking-service-title" class="text-3xl font-serif italic font-bold text-slate-900 leading-tight">Pesan Sesi Foto</h2>
                <p class="text-xs text-slate-500 mt-1.5 font-medium tracking-wide">Silakan tentukan jadwal pemotretan Anda dan lengkapi detail pemesanan di bawah.</p>
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
                                    Studio.mu Building, Jl. Sunset Boulevard No. 101, Jakarta Selatan, Indonesia
                                </p>
                            </div>
                        </div>

                        <!-- Embedded Responsive Google Maps iframe -->
                        <div class="w-full h-40 rounded-xl overflow-hidden border border-slate-300 shadow-inner relative group bg-slate-100">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.273617300705!2d106.81223961529528!3d-6.227561862725514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f15049cf525b%3A0x6b9d6287bc1a28a3!2sSenayan%20City!5e0!3m2!1sid!2sid!4v1652885955681!5m2!1sid!2sid" 
                                class="absolute inset-0 w-full h-full border-none transition-opacity duration-300"
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>

                        <!-- Open Maps Link Button -->
                        <a href="https://maps.google.com/?q=-6.227561,106.812239" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 px-4 bg-white border border-slate-300 hover:border-slate-400 hover:bg-slate-50 text-slate-700 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm cursor-pointer">
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

                    <!-- Datepicker & Cek Button -->
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5">Pilih Tanggal Sesi</label>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="flex-1 relative bg-white border border-slate-300 rounded-2xl p-1 focus-within:border-primary-500/40 focus-within:ring-4 focus-within:ring-primary-500/5 transition-all shadow-sm">
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
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-400 mb-2.5">Catatan Tambahan (Opsional)</label>
                        <textarea id="booking-custom-requests" placeholder="Misal: request konsep pakaian tertentu, properti tambahan, dll." rows="3" class="w-full bg-white border border-slate-300 focus:bg-white rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-800 focus:border-primary-500/40 focus:ring-4 focus:ring-primary-500/5 transition-all duration-300 placeholder-slate-450 shadow-sm"></textarea>
                    </div>
                </div>
            </div>

            <!-- Footer Buttons -->
            <div class="p-8 sm:p-10 border-t border-slate-100 flex flex-col sm:flex-row gap-4 justify-end bg-slate-50/50">
                <a href="{{ url('/menu-utama') }}" class="w-full sm:w-auto px-8 py-3.5 border border-slate-200 hover:border-slate-350 hover:bg-slate-50 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all text-center flex items-center justify-center">
                    Batal
                </a>
                <button type="button" id="booking-confirm-btn" onclick="submitBooking()" class="w-full sm:w-auto px-10 py-3.5 bg-gradient-to-r from-primary-600 to-primary-800 hover:from-primary-700 hover:to-primary-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-lg shadow-primary-500/20 transform active:scale-95 border-none cursor-pointer opacity-45 pointer-events-none">
                    Konfirmasi Booking Sesi
                </button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let isDateChecked = false;

    const serviceData = {
        wedding: {
            title: 'Wedding & Pre-Wedding',
            col1: { title: 'BASIC PREWEDD', newPrice: '1.500.000' },
            col2: { title: 'EXCLUSIVE WEDDING', newPrice: '3.200.000' },
            slides: [
                '{{ asset("img/prewedding_showcase.png") }}'
            ]
        },
        graduation: {
            title: 'Wisuda & Akademik',
            col1: { title: 'BEST DEAL', newPrice: '850.000' },
            col2: { title: 'SPECIAL PACKAGE', newPrice: '1.200.000' },
            slides: [
                '{{ asset("img/graduation_showcase.png") }}'
            ]
        },
        commercial: {
            title: 'Komersial & Produk',
            col1: { title: 'STARTER KIT', newPrice: '1.200.000' },
            col2: { title: 'BRAND CHAMPION', newPrice: '2.400.000' },
            slides: [
                '{{ asset("img/commercial_showcase.png") }}'
            ]
        },
        family: {
            title: 'Keluarga & Maternity',
            col1: { title: 'BEST DEAL', newPrice: '500.000' },
            col2: { title: 'SPECIAL PACKAGE', newPrice: '800.000' },
            slides: [
                '{{ asset("img/family_showcase.png") }}'
            ]
        },
        personal: {
            title: 'Potret Pribadi & Branding',
            col1: { title: 'BASIC PORTRAIT', newPrice: '650.000' },
            col2: { title: 'PREMIUM BRANDING', newPrice: '1.100.000' },
            slides: [
                '{{ asset("img/personal_showcase.png") }}'
            ]
        }
    };

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

    const timeSlots = ["09:00 WIB", "11:30 WIB", "14:00 WIB", "16:30 WIB", "19:00 WIB", "21:00 WIB"];
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
        document.getElementById('booking-tier1-price').textContent = `Rp ${service.col1.newPrice}`;
        document.getElementById('booking-tier2-title').textContent = service.col2.title;
        document.getElementById('booking-tier2-price').textContent = `Rp ${service.col2.newPrice}`;

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

        // Default selection
        selectBookingTier('col1');
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

        // Fetch holidays from localStorage
        const defaultHolidays = [
            { date: "2026-05-29", desc: "Hari Raya Waisak (Studio Libur)" },
            { date: "2026-06-01", desc: "Hari Lahir Pancasila (Studio Libur)" }
        ];
        let holidays = JSON.parse(localStorage.getItem('studio_holidays')) || defaultHolidays;

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

        const txId = 'BOOK-' + Math.floor(1000 + Math.random() * 9000);
        
        const newTx = {
            id: txId,
            name: loggedInUser.name,
            email: loggedInUser.email,
            service: `${service.title} (${packageName})`,
            date: `${dateVal} ${timeVal}`,
            amount: priceVal,
            status: 'Pending',
            requests: customRequests
        };

        // Save transaction to local storage
        let txList = JSON.parse(localStorage.getItem('studio_transactions')) || defaultTransactions;
        txList.unshift(newTx);
        localStorage.setItem('studio_transactions', JSON.stringify(txList));

        // Save toast flag for redirection display
        localStorage.setItem('booking_toast_service', service.title);

        // Redirect back to dashboard
        window.location.href = "{{ route('customer.dashboard') }}";
    }

    // Run init
    window.addEventListener('DOMContentLoaded', initBookingPage);
</script>
@endsection

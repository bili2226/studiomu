@extends('layouts.dashboard')

@section('title', 'Galeri Foto')

@section('sidebar')
    <a href="{{ url('/menu-utama') }}" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
        </svg>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('customer.history') }}" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008ZM0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
        </svg>
        <span>Riwayat Booking</span>
    </a>
    <a href="{{ route('customer.gallery') }}" class="sidebar-item sidebar-item-active flex items-center px-5 py-3.5 transition-all text-white font-black">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
        </svg>
        <span>Galeri Foto</span>
    </a>
    <a href="{{ route('customer.loyalty') }}" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
        </svg>
        <span>Poin Loyalitas</span>
    </a>
@endsection

@section('content')
    <!-- Gallery Banner -->
    <div class="bg-gradient-to-br from-primary-950 via-[#0c4a6e] to-primary-950 text-white p-8 sm:p-12 border border-primary-300 rounded-[2.5rem] shadow-2xl mb-8 relative overflow-hidden animate-fade-in-up">
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-10 -bottom-10 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-3xl">
            <span class="inline-flex items-center px-3 py-1 bg-white/10 backdrop-blur-md text-[#D4AF37] text-[8px] font-black uppercase tracking-[0.25em] rounded-md mb-4 border border-white/10">
                Galeri Foto Eksklusif Anda
            </span>
            <h2 class="text-3xl sm:text-5xl font-serif italic font-bold tracking-tight mb-4">Galeri Hasil Foto</h2>
            <p class="text-slate-350 text-xs sm:text-sm font-medium tracking-wide leading-relaxed">
                Temukan seluruh hasil dokumentasi visual dari momen berharga Anda di sini. Fotografer kami mengunggah hasil foto dalam bentuk tautan galeri eksternal yang aman dan mudah diakses.
            </p>
        </div>
    </div>

    <!-- Photo Gallery Grid Container -->
    <div class="mb-12">
        <div id="gallery-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Loaded dynamically via JS -->
        </div>
    </div>
@endsection

@section('scripts')
<script>
    const loggedInUser = {
        name: "{{ Auth::user()->name }}",
        email: "{{ Auth::user()->email }}"
    };

    function renderGallery() {
        const galleryGrid = document.getElementById('gallery-grid');
        if (!galleryGrid) return;
        
        galleryGrid.innerHTML = '';
        
        const transactions = @json($bookings);
        const myBookings = transactions.filter(tx => tx.email === loggedInUser.email);
        
        if (myBookings.length === 0) {
            galleryGrid.innerHTML = `
                <div class="col-span-full text-center py-16 bg-white border border-slate-200/85 rounded-[2rem] shadow-[0_8px_30px_rgb(0,0,0,0.02)]">
                    <div class="w-16 h-16 bg-slate-50 border border-slate-200 rounded-[1.2rem] flex items-center justify-center text-slate-400 mx-auto mb-4 shadow-sm">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                        </svg>
                    </div>
                    <p class="text-xs text-slate-800 font-black uppercase tracking-wider">Belum Ada Galeri Foto</p>
                    <p class="text-[10px] text-slate-500 font-semibold mt-1.5 max-w-xs mx-auto leading-relaxed">Pesan sesi foto pertama Anda untuk melihat hasil karya tim fotografer kami di sini.</p>
                </div>
            `;
            return;
        }

        myBookings.forEach(tx => {
            let statusBadgeClass = '';
            let statusText = tx.status;
            if (tx.status === 'Pending') {
                statusBadgeClass = 'bg-amber-50 text-amber-800 border-amber-200/80';
                statusText = 'Pending';
            } else if (tx.status === 'Confirmed') {
                statusBadgeClass = 'bg-sky-50 text-sky-850 border-sky-200/80';
                statusText = 'Terkonfirmasi';
            } else if (tx.status === 'Completed') {
                statusBadgeClass = 'bg-emerald-50 text-emerald-850 border-emerald-200/80';
                statusText = 'Selesai';
            } else {
                statusBadgeClass = 'bg-rose-50 text-rose-850 border-rose-200/80';
                statusText = 'Dibatalkan';
            }

            let actionBtnHtml = '';
            if (tx.result_link) {
                actionBtnHtml = `
                    <a href="${tx.result_link}" target="_blank" class="w-full inline-flex items-center justify-center px-4 py-3 bg-[#0c4a6e] hover:bg-[#075985] text-white font-black uppercase tracking-[0.2em] text-[9px] rounded-xl transition-all gap-1.5 shadow-md shadow-primary-500/10 transform hover:-translate-y-0.5 active:scale-95 border-none cursor-pointer text-center">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                        </svg>
                        Lihat Hasil Foto
                    </a>
                `;
            } else {
                if (tx.status === 'Completed') {
                    actionBtnHtml = `
                        <div class="w-full inline-flex items-center justify-center px-4 py-3 bg-slate-100 text-slate-500 font-black uppercase tracking-[0.18em] text-[9px] rounded-xl border border-slate-200/60 select-none text-center">
                            <svg class="w-3.5 h-3.5 mr-1.5 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Memproses Hasil Foto
                        </div>
                    `;
                } else if (tx.status === 'Cancelled') {
                    actionBtnHtml = `
                        <div class="w-full inline-flex items-center justify-center px-4 py-3 bg-red-50 text-red-700 font-black uppercase tracking-[0.18em] text-[9px] rounded-xl border border-red-100/60 select-none text-center">
                            Sesi Dibatalkan
                        </div>
                    `;
                } else {
                    actionBtnHtml = `
                        <div class="w-full inline-flex items-center justify-center px-4 py-3 bg-slate-50 text-slate-400 font-black uppercase tracking-[0.18em] text-[9px] rounded-xl border border-slate-200/40 select-none text-center">
                            Sesi Belum Terlaksana
                        </div>
                    `;
                }
            }

            const photographerName = tx.photographer_name || 'Belum Ditugaskan';

            const card = document.createElement('div');
            card.className = "group bg-white border border-slate-200/80 rounded-[2rem] overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:shadow-[0_20px_40px_rgba(12,74,110,0.08)] hover:border-primary-500/20 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between relative p-6";
            card.innerHTML = `
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary-500/5 rounded-full blur-2xl group-hover:bg-primary-500/10 transition-all duration-500"></div>
                <div class="relative z-10 flex-1 flex flex-col justify-between">
                    <div>
                        <div class="flex justify-between items-center mb-4">
                            <span class="inline-flex items-center px-2.5 py-1 text-[8px] font-black uppercase tracking-widest rounded-lg border ${statusBadgeClass}">${statusText}</span>
                            <span class="text-[9px] font-bold text-slate-400 font-mono">${tx.id}</span>
                        </div>
                        <h3 class="text-lg font-serif italic font-bold text-slate-900 mb-2 group-hover:text-primary-955 transition-colors leading-snug">${tx.service}</h3>
                        
                        <div class="space-y-2.5 my-4.5 border-t border-b border-slate-100/80 py-4 text-xs font-semibold text-slate-650 tracking-wide">
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Jadwal Foto</span>
                                <span class="text-slate-800 text-[11px] font-medium">${tx.date} WIB</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">Fotografer</span>
                                <span class="text-slate-800 text-[11px] font-bold">${photographerName}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        ${actionBtnHtml}
                    </div>
                </div>
            `;
            galleryGrid.appendChild(card);
        });
    }

    window.addEventListener('DOMContentLoaded', () => {
        renderGallery();
    });
</script>
@endsection

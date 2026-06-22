@extends('layouts.dashboard')

@section('title', 'Pembayaran Gagal / Dibatalkan')

@section('sidebar')
    <a href="{{ url('/menu-utama') }}" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
        </svg>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('customer.history') }}" class="sidebar-item sidebar-item-active flex items-center px-5 py-3.5 transition-all text-white font-black">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008ZM0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
        </svg>
        <span>Riwayat Booking</span>
    </a>
    <a href="{{ url('/menu-utama') }}#gallery-card" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
        </svg>
        <span>Galeri Foto</span>
    </a>
    <a href="{{ url('/menu-utama') }}#loyalty-card" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
        </svg>
        <span>Poin Loyalitas</span>
    </a>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto bg-white border-2 border-black rounded-[2.5rem] shadow-[0_12px_40px_rgba(0,0,0,0.06)] p-8 sm:p-12 text-center relative overflow-hidden animate-fade-in-up">
        <div class="absolute -right-10 -top-10 w-48 h-48 bg-rose-500/5 rounded-full blur-3xl"></div>

        <!-- Failure Icon -->
        <div class="w-20 h-20 bg-rose-50 border-2 border-black rounded-3xl flex items-center justify-center text-rose-600 mx-auto mb-6 shadow-inner relative">
            <div class="absolute inset-0 rounded-3xl bg-rose-400/10 animate-pulse"></div>
            <svg class="w-10 h-10 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0-10.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.75c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.249-8.25-3.286Zm0 13.036h.008v.008H12v-.008Z"/>
            </svg>
        </div>

        <!-- Title -->
        <span class="inline-flex items-center px-3 py-1 bg-black text-white text-[8px] font-black uppercase tracking-[0.25em] rounded-md mb-2 shadow-sm">
            Payment Failed / Cancelled
        </span>
        <h2 class="text-3xl sm:text-4xl font-serif italic font-bold tracking-tight text-black mb-2">
            Pembayaran Gagal!
        </h2>
        <p class="text-xs text-black font-bold mb-8">Mohon maaf, transaksi pembayaran Anda tidak berhasil diselesaikan atau telah dibatalkan.</p>

        <!-- Booking details block -->
        @if($booking)
            <div class="bg-slate-50 border-2 border-black rounded-2xl p-6 text-left space-y-4 mb-8">
                <div class="flex justify-between items-center border-b-2 border-black/5 pb-3">
                    <span class="text-[9px] font-black uppercase tracking-wider text-black">ID Booking</span>
                    <span class="text-sm font-bold text-black">{{ $booking->id }}</span>
                </div>
                <div class="flex justify-between items-start border-b-2 border-black/5 pb-3">
                    <span class="text-[9px] font-black uppercase tracking-wider text-black">Layanan</span>
                    <span class="text-xs font-black text-black text-right max-w-[70%]">{{ $booking->service_name }}</span>
                </div>
                <div class="flex justify-between items-center border-b-2 border-black/5 pb-3">
                    <span class="text-[9px] font-black uppercase tracking-wider text-black">Jadwal Sesi</span>
                    <span class="text-xs font-bold text-black">{{ $booking->booking_date->format('d M Y') }}, {{ $booking->booking_date->format('H.i') }} - {{ $booking->booking_date->copy()->addHour()->format('H.i') }} WIB</span>
                </div>
                <div class="flex justify-between items-center border-b-2 border-black/5 pb-3">
                    <span class="text-[9px] font-black uppercase tracking-wider text-black">Total Nominal</span>
                    <span class="text-sm font-black text-black">Rp {{ number_format($booking->amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-[9px] font-black uppercase tracking-wider text-black">Status Pembayaran</span>
                    <span class="px-2.5 py-0.5 text-[8px] font-black uppercase tracking-widest rounded-lg border-2 bg-rose-500/10 text-rose-600 border-rose-500/20">
                        Dibatalkan
                    </span>
                </div>
            </div>

            <!-- Information Alert Box -->
            <div class="flex items-start gap-3 p-4 bg-amber-50 border-2 border-amber-400 text-amber-800 rounded-2xl shadow-sm text-xs font-bold text-left mb-8">
                <svg class="w-5 h-5 text-amber-650 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376C1.83 15.002 2 10.684 2 9.75c0-5.592 3.824-10.29 9-11.622 5.176 1.332 9 6.03 9 11.622 0 .934.17 5.252-.697 6.376M12 18.75h.007v.008H12v-.008Z"/>
                </svg>
                <div>
                    <p class="font-bold text-amber-900 uppercase tracking-wide">Pembayaran Belum Diselesaikan</p>
                    <p class="text-black mt-0.5 leading-relaxed font-bold">
                        Anda dapat mencoba melakukan pembayaran ulang untuk pesanan ini melalui tombol **Bayar Sekarang** di halaman Riwayat Booking. Jika Anda mengalami kesulitan teknis, silakan hubungi admin studio.
                    </p>
                </div>
            </div>
        @else
            <div class="bg-slate-50 border-2 border-black rounded-2xl p-6 text-black text-xs font-bold mb-8">
                Rincian transaksi tidak ditemukan atau terjadi kesalahan dalam memproses respons Midtrans.
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('customer.history') }}?unpaid=1&pending_id={{ $booking ? $booking->id : '' }}" class="px-8 py-3.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-md active:scale-95 duration-150 flex items-center justify-center gap-1.5 border-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008ZM0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
                </svg>
                <span>Coba Bayar Lagi</span>
            </a>
            <a href="{{ url('/menu-utama') }}" class="px-8 py-3.5 border-2 border-black hover:bg-slate-100 text-black font-black rounded-xl text-[10px] font-black uppercase tracking-widest transition-all text-center flex items-center justify-center">
                Dashboard Utama
            </a>
        </div>
    </div>
@endsection

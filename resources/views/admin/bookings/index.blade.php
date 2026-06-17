@extends('layouts.dashboard')

@section('title', 'Kelola Transaksi')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')

{{-- Flash Messages --}}
@if (session('success'))
    <div class="mb-6 flex items-center gap-3 px-5 py-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-xs font-semibold">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
@endif

{{-- Page Header --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400 mb-1">Manajemen Transaksi</p>
        <h1 class="text-2xl font-serif italic font-bold text-slate-900">Kelola Transaksi</h1>
    </div>
</div>

{{-- Stats Cards / Filter Quick Links --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
    {{-- Card 1: Pending --}}
    <a href="{{ route('admin.bookings.index', ['status' => 'Pending', 'search' => $search]) }}"
        class="group bg-white border-2 {{ $status === 'Pending' ? 'border-amber-400 bg-amber-50/40' : 'border-amber-300 hover:border-amber-300' }} rounded-2xl p-4 text-center shadow-sm transition-all duration-300">
        <div class="w-8 h-8 rounded-xl bg-amber-50 border border-amber-200 flex items-center justify-center mx-auto mb-2 text-amber-700 group-hover:scale-105 transition-transform">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        </div>
        <p class="text-xl font-black {{ $status === 'Pending' ? 'text-amber-700' : 'text-slate-900' }}">{{ $totalPending }}</p>
        <p class="text-[9px] font-bold uppercase tracking-widest {{ $status === 'Pending' ? 'text-amber-500' : 'text-slate-400' }} mt-0.5">Pending</p>
    </a>

    {{-- Card 2: Confirmed --}}
    <a href="{{ route('admin.bookings.index', ['status' => 'Confirmed', 'search' => $search]) }}"
        class="group bg-white border-2 {{ $status === 'Confirmed' ? 'border-sky-400 bg-sky-50/40' : 'border-amber-300 hover:border-sky-300' }} rounded-2xl p-4 text-center shadow-sm transition-all duration-300">
        <div class="w-8 h-8 rounded-xl bg-sky-50 border border-sky-200 flex items-center justify-center mx-auto mb-2 text-sky-700 group-hover:scale-105 transition-transform">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z"/></svg>
        </div>
        <p class="text-xl font-black {{ $status === 'Confirmed' ? 'text-sky-700' : 'text-slate-900' }}">{{ $totalConfirmed }}</p>
        <p class="text-[9px] font-bold uppercase tracking-widest {{ $status === 'Confirmed' ? 'text-sky-500' : 'text-slate-400' }} mt-0.5">Terkonfirmasi</p>
    </a>

    {{-- Card 3: Completed --}}
    <a href="{{ route('admin.bookings.index', ['status' => 'Completed', 'search' => $search]) }}"
        class="group bg-white border-2 {{ $status === 'Completed' ? 'border-emerald-400 bg-emerald-50/40' : 'border-amber-300 hover:border-emerald-300' }} rounded-2xl p-4 text-center shadow-sm transition-all duration-300">
        <div class="w-8 h-8 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-center mx-auto mb-2 text-emerald-700 group-hover:scale-105 transition-transform">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        </div>
        <p class="text-xl font-black {{ $status === 'Completed' ? 'text-emerald-700' : 'text-slate-900' }}">{{ $totalCompleted }}</p>
        <p class="text-[9px] font-bold uppercase tracking-widest {{ $status === 'Completed' ? 'text-emerald-500' : 'text-slate-400' }} mt-0.5">Selesai</p>
    </a>

    {{-- Card 4: Cancelled --}}
    <a href="{{ route('admin.bookings.index', ['status' => 'Cancelled', 'search' => $search]) }}"
        class="group bg-white border-2 {{ $status === 'Cancelled' ? 'border-rose-400 bg-rose-50/40' : 'border-amber-300 hover:border-rose-300' }} rounded-2xl p-4 text-center shadow-sm transition-all duration-300">
        <div class="w-8 h-8 rounded-xl bg-rose-50 border border-rose-200 flex items-center justify-center mx-auto mb-2 text-rose-700 group-hover:scale-105 transition-transform">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
        </div>
        <p class="text-xl font-black {{ $status === 'Cancelled' ? 'text-rose-700' : 'text-slate-900' }}">{{ $totalCancelled }}</p>
        <p class="text-[9px] font-bold uppercase tracking-widest {{ $status === 'Cancelled' ? 'text-rose-500' : 'text-slate-400' }} mt-0.5">Dibatalkan</p>
    </a>
</div>

{{-- Main Control Panel --}}
<div class="bg-white border border-amber-300 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">
    
    {{-- Search & Filter Bar --}}
    <div class="p-5 sm:p-6 border-b border-slate-100 bg-slate-50/60">
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="flex flex-col sm:flex-row gap-3">
            {{-- Search bar --}}
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari ID booking, nama, email, atau layanan..."
                    class="w-full pl-10 pr-4 py-2.5 bg-white border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl text-xs font-semibold text-slate-900 focus:outline-none transition-all placeholder:font-normal placeholder:text-slate-400">
            </div>

            {{-- Status Filters --}}
            <div class="flex items-center gap-2 flex-wrap">
                @php
                    $statuses = [
                        '' => 'Semua',
                        'Pending' => 'Pending',
                        'Confirmed' => 'Terkonfirmasi',
                        'Completed' => 'Selesai',
                        'Cancelled' => 'Dibatalkan',
                    ];
                @endphp
                @foreach($statuses as $key => $label)
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="{{ $key }}" {{ $status === $key ? 'checked' : '' }} class="sr-only peer">
                        <span class="inline-flex items-center px-3.5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border transition-all cursor-pointer
                            peer-checked:bg-amber-800 peer-checked:text-white peer-checked:border-amber-800
                            {{ $status !== $key ? 'bg-white text-slate-600 border-amber-300 hover:border-amber-400 hover:text-amber-800' : '' }}">
                            {{ $label }}
                        </span>
                    </label>
                @endforeach
            </div>

            {{-- Submit and Reset --}}
            <button type="submit" class="bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] px-5 py-2.5 rounded-xl transition-all flex-shrink-0 active:scale-95 shadow-sm">
                Filter
            </button>
            @if ($search || $status)
                <a href="{{ route('admin.bookings.index') }}"
                    class="flex items-center gap-1.5 text-slate-500 hover:text-slate-800 font-bold text-[10px] px-3 py-2.5 rounded-xl border border-amber-300 hover:border-slate-400 transition-all flex-shrink-0">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Result Meta Info --}}
    <div class="px-6 pt-4 pb-2">
        <p class="text-[10px] font-semibold text-slate-400">
            Menampilkan <strong class="text-slate-700">{{ $bookings->count() }}</strong> transaksi
            @if ($search) • pencarian "<strong class="text-amber-805">{{ $search }}</strong>" @endif
            @if ($status) 
                • status "<strong class="text-amber-800">
                    @if($status === 'Confirmed')
                        Terkonfirmasi
                    @elseif($status === 'Completed')
                        Selesai
                    @elseif($status === 'Cancelled')
                        Dibatalkan
                    @else
                        {{ $status }}
                    @endif
                </strong>" 
            @endif
        </p>
    </div>

    {{-- Bookings Table --}}
    <div class="px-6 pb-6">
        @if ($bookings->isEmpty())
            <div class="text-center py-16 text-slate-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-5.625-12h17.25c.621 0 1.125.504 1.125 1.125v13.5c0 .621-.504 1.125-1.125 1.125H3.375a1.125 1.125 0 0 1-1.125-1.125V3.375c0-.621.504-1.125 1.125-1.125Z"/></svg>
                <p class="text-sm font-semibold mb-1">Tidak ada transaksi ditemukan</p>
                <p class="text-xs">Coba ganti kata kunci pencarian atau ubah filter status.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-400 pb-3 pr-4 pt-2">ID Booking</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-400 pb-3 pr-4 pt-2">Pelanggan</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-400 pb-3 pr-4 pt-2">Layanan & Sesi</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-400 pb-3 pr-4 pt-2">Metode</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-400 pb-3 pr-4 pt-2">Jadwal Sesi</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-400 pb-3 pr-4 pt-2">Total Biaya</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-400 pb-3 pr-4 pt-2">Status</th>
                            <th class="text-right text-[9px] font-black uppercase tracking-widest text-slate-400 pb-3 pt-2">Aksi Pengelolaan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50 font-semibold text-slate-800">
                        @foreach ($bookings as $booking)
                        <tr class="group hover:bg-slate-50/60 transition-colors">
                            {{-- ID Booking --}}
                            <td class="py-4 pr-4 font-bold text-slate-900 font-sans tracking-wide text-xs">
                                {{ $booking->id }}
                            </td>

                            {{-- Pelanggan --}}
                            <td class="py-4 pr-4">
                                <div>
                                    <p class="font-bold text-slate-900 text-[13px] leading-snug">{{ $booking->user->name ?? 'User Terhapus' }}</p>
                                    <p class="text-[10px] text-slate-500 font-bold tracking-wide mt-0.5">{{ $booking->user->email ?? '' }}</p>
                                </div>
                            </td>

                            {{-- Layanan & Sesi --}}
                            <td class="py-4 pr-4 text-slate-800 text-xs">
                                {{ $booking->service_name }}
                            </td>

                            {{-- Metode --}}
                            <td class="py-4 pr-4 text-slate-700 text-xs font-bold">
                                {{ $booking->payment_method ?? 'Transfer' }}
                            </td>

                            {{-- Jadwal Sesi --}}
                            <td class="py-4 pr-4 text-slate-600 font-sans text-xs">
                                {{ $booking->booking_date->format('d M Y, H:i') }}
                            </td>

                            {{-- Total Biaya --}}
                            <td class="py-4 pr-4 text-amber-850 font-sans text-xs font-bold">
                                Rp {{ number_format($booking->amount, 0, ',', '.') }}
                            </td>

                            {{-- Status Badge --}}
                            <td class="py-4 pr-4">
                                @php
                                    $badgeStyle = match($booking->status) {
                                        'Pending' => 'bg-amber-50 text-amber-800 border-amber-200',
                                        'Confirmed' => 'bg-sky-50 text-sky-800 border-sky-200',
                                        'Completed' => 'bg-emerald-50 text-emerald-800 border-emerald-200',
                                        'Cancelled' => 'bg-rose-50 text-rose-800 border-rose-200',
                                        default => 'bg-slate-50 text-slate-800 border-amber-300',
                                    };
                                @endphp
                                <span class="px-2.5 py-1 text-[9px] font-black uppercase tracking-widest rounded-full border {{ $badgeStyle }} inline-block leading-none shadow-sm">
                                    @if($booking->status === 'Confirmed')
                                        Terkonfirmasi
                                    @elseif($booking->status === 'Completed')
                                        Selesai
                                    @elseif($booking->status === 'Cancelled')
                                        Dibatalkan
                                    @else
                                        {{ $booking->status }}
                                    @endif
                                </span>
                            </td>

                            {{-- Aksi Pengelolaan --}}
                            <td class="py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    @if ($booking->status === 'Pending')
                                        <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="Confirmed">
                                            <button type="submit" class="px-3 py-1.5 bg-emerald-50 text-emerald-800 border border-emerald-200 hover:bg-emerald-600 hover:text-white font-black uppercase text-[9px] tracking-wider rounded-xl transition-all duration-300 active:scale-95 shadow-sm">
                                                Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="Cancelled">
                                            <button type="submit" class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-600 hover:text-white font-black uppercase text-[9px] tracking-wider rounded-xl transition-all duration-300 active:scale-95 shadow-sm"
                                                onsubmit="return confirm('Tolak booking {{ $booking->id }} ini?')">
                                                Tolak
                                            </button>
                                        </form>
                                    @elseif ($booking->status === 'Confirmed')
                                        <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="status" value="Completed">
                                            <button type="submit" class="px-3 py-1.5 bg-amber-600 text-white font-black uppercase text-[9px] tracking-wider rounded-xl hover:bg-amber-700 border border-amber-700 shadow-md shadow-amber-900/10 transition-all duration-300 active:scale-95">
                                                Selesaikan
                                            </button>
                                        </form>
                                    @endif

                                    <button type="button"
                                        onclick="showBill('{{ $booking->id }}', '{{ addslashes($booking->user->name ?? 'User Terhapus') }}', '{{ $booking->user->email ?? '' }}', '{{ addslashes($booking->service_name) }}', '{{ $booking->booking_date->format('d M Y, H:i') }}', 'Rp {{ number_format($booking->amount, 0, ',', '.') }}', '{{ $booking->status }}', '{{ $booking->payment_method ?? 'Transfer' }}', 'Rp {{ number_format($booking->discount, 0, ',', '.') }}')"
                                        class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 border border-amber-300 hover:border-slate-350 font-bold rounded-xl text-[9px] uppercase tracking-wider transition-all duration-300 active:scale-95">
                                        Tagihan
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

{{-- MODAL invoice/bill --}}
<div id="modal-bill" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
    <div class="modal-card bg-white border border-amber-300 rounded-[2.5rem] shadow-2xl w-full max-w-md overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col">
        {{-- Close button --}}
        <button onclick="closeBillModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-amber-300 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        
        <div class="bill-receipt bg-white p-2 text-left">
            <!-- Receipt Header -->
            <div class="text-center border-b-2 border-dashed border-amber-300 pb-6 mb-6">
                <h3 class="text-xl font-serif italic font-bold text-slate-900">Studio.mu</h3>
                <h4 class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-650 mt-1">Bukti Pemesanan Studio</h4>
                <p id="bill-booking-id" class="text-xs font-bold text-amber-850 uppercase tracking-widest mt-1.5 bg-amber-50 border border-amber-250 px-3 py-1 rounded-full inline-block">#BOOK-1001</p>
            </div>

            <!-- Receipt details -->
            <div class="space-y-4.5 text-xs font-semibold text-slate-800 pb-6 border-b border-amber-300">
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Nama Klien</span>
                    <span id="bill-client" class="text-slate-900 font-bold text-right truncate"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Email Klien</span>
                    <span id="bill-email" class="text-slate-900 font-bold text-right truncate text-[11px] font-sans"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Sesi & Paket</span>
                    <span id="bill-service" class="text-slate-900 font-bold text-right truncate"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Metode Pembayaran</span>
                    <span id="bill-payment-method" class="text-slate-900 font-bold text-right truncate"></span>
                </div>
                <div class="flex justify-between items-center gap-3" id="bill-discount-row">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Potongan Diskon</span>
                    <span id="bill-discount" class="text-emerald-600 font-bold text-right truncate"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Tanggal Pemotretan</span>
                    <span id="bill-date" class="text-slate-900 font-bold text-right font-sans text-[11px]"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Status</span>
                    <span id="bill-status" class="px-2.5 py-0.5 rounded-full text-[8px] font-black tracking-widest uppercase border inline-block leading-none"></span>
                </div>
            </div>

            <!-- Receipt totals -->
            <div class="pt-6 flex justify-between items-baseline mb-6">
                <span class="text-slate-700 font-black uppercase tracking-wider text-[10px]">Total Tagihan</span>
                <span id="bill-amount" class="text-3xl font-serif italic font-bold text-amber-850">Rp 0</span>
            </div>

            <div class="bg-slate-50 rounded-2xl p-4 border border-amber-300 text-[10px] text-slate-500 text-center uppercase tracking-wider font-bold leading-relaxed">
                Terima kasih telah mempercayakan momen Anda bersama Studio.mu Visual Art.
            </div>
        </div>
        
        <button onclick="window.print()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 border border-amber-200 active:scale-95 mt-8">
            CETAK INVOICE / BUKTI TAGIHAN
        </button>
    </div>
</div>

<!-- Print Styles -->
<style>
    @media print {
        /* Hide all dashboard/page elements */
        body * {
            visibility: hidden;
        }
        /* Show only the modal-bill and its children */
        #modal-bill, #modal-bill * {
            visibility: visible;
        }
        #modal-bill {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
            background: transparent;
            display: flex !important;
            justify-content: center;
            align-items: flex-start;
            opacity: 100 !important;
            pointer-events: auto !important;
            z-index: 9999;
        }
        #modal-bill .modal-card {
            border: none !important;
            box-shadow: none !important;
            transform: none !important;
            width: 100% !important;
            max-width: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        /* Hide close button and print button inside bill modal when printing */
        #modal-bill button {
            display: none !important;
        }
    }
</style>

@endsection

@section('scripts')
<script>
    // Modal Utils
    function showBill(id, client, email, service, date, amount, status, paymentMethod, discount) {
        document.getElementById('bill-booking-id').textContent = '#' + id;
        document.getElementById('bill-client').textContent = client;
        document.getElementById('bill-email').textContent = email;
        document.getElementById('bill-service').textContent = service;
        document.getElementById('bill-payment-method').textContent = paymentMethod || 'Transfer';
        
        const discRow = document.getElementById('bill-discount-row');
        const discVal = document.getElementById('bill-discount');
        if (discount && discount !== 'Rp 0') {
            discVal.textContent = '-' + discount;
            discRow.classList.remove('hidden');
        } else {
            discVal.textContent = 'Rp 0';
            discRow.classList.add('hidden');
        }

        document.getElementById('bill-date').textContent = date;
        document.getElementById('bill-amount').textContent = amount;
        
        const statusLabel = document.getElementById('bill-status');
        let displayStatus = status;
        if (status === 'Confirmed') displayStatus = 'Terkonfirmasi';
        else if (status === 'Completed') displayStatus = 'Selesai';
        else if (status === 'Cancelled') displayStatus = 'Dibatalkan';
        statusLabel.textContent = displayStatus;
        
        statusLabel.className = 'px-2.5 py-1 rounded text-[8px] font-black tracking-widest uppercase border ';
        if (status === 'Pending') statusLabel.className += 'bg-amber-50 text-amber-800 border-amber-200';
        else if (status === 'Confirmed') statusLabel.className += 'bg-sky-50 text-sky-800 border-sky-200';
        else if (status === 'Completed') statusLabel.className += 'bg-emerald-50 text-emerald-800 border-emerald-200';
        else if (status === 'Cancelled') statusLabel.className += 'bg-rose-50 text-rose-800 border-rose-200';

        openModal('modal-bill');
    }

    function closeBillModal() {
        closeModal('modal-bill');
    }

    function openModal(id) {
        const modal = document.getElementById(id);
        const modalContent = modal.querySelector('.modal-card');

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
        const modalContent = modal.querySelector('.modal-card');

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
</script>
@endsection

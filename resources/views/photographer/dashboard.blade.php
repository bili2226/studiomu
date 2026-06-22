@extends('layouts.dashboard')

@section('title', 'Jadwal Fotografi')

@section('sidebar')
    <a href="{{ url('/photographer/jadwal') }}" class="sidebar-item sidebar-item-active flex items-center px-6 py-4 rounded-2xl mx-2">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        Jadwal Saya
    </a>
@endsection

@section('content')
    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="mb-6 flex items-center gap-3 px-5 py-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-xs font-semibold animate-fade-in-up">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="mb-6 flex items-center gap-3 px-5 py-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-700 text-xs font-semibold animate-fade-in-up">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row gap-6 justify-between sm:items-center mb-12 animate-fade-in-up">
        <div>
            <h3 class="text-3xl font-serif italic font-bold tracking-tight text-slate-900">Jadwal Harian</h3>
            <p class="text-amber-700 text-[10px] font-black uppercase tracking-[0.3em] mt-2">{{ date('d F Y') }}</p>
        </div>
        <div class="flex flex-wrap gap-4">
            <span class="text-[10px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-800 px-4 py-2 rounded-xl border border-emerald-200 flex items-center gap-2">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                {{ $completedCount }} Selesai
            </span>
            <span class="text-[10px] font-black uppercase tracking-widest bg-amber-50 text-amber-800 px-4 py-2 rounded-xl border border-amber-200 flex items-center gap-2">
                <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                {{ $pendingCount }} Menunggu
            </span>
        </div>
    </div>

    <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.1s;">
        @if($bookings->isEmpty())
            <div class="bg-white border border-slate-200 rounded-[2rem] p-12 text-center text-slate-400 shadow-sm">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5"/></svg>
                <p class="text-sm font-semibold mb-1">Belum Ada Sesi Pemotretan</p>
                <p class="text-xs">Anda belum ditugaskan untuk sesi pemotretan apa pun oleh admin.</p>
            </div>
        @else
            @foreach($bookings as $booking)
                @php
                    $isCompleted = $booking->status === 'Completed';
                    $isCancelled = $booking->status === 'Cancelled';
                    $isPending = $booking->status === 'Pending';
                    $isConfirmed = $booking->status === 'Confirmed';
                @endphp

                @if($isCompleted || $isCancelled)
                    {{-- Completed/Cancelled Session Card (Dimmed/Grayed out) --}}
                    <div class="bg-slate-50 rounded-[2rem] p-6 sm:p-10 flex flex-col md:flex-row md:items-center justify-between shadow-sm border border-slate-200 opacity-60 grayscale gap-6 md:gap-0">
                        <div class="flex flex-col sm:flex-row items-center sm:text-left text-center gap-6 sm:gap-12 w-full md:w-auto">
                            <div class="sm:pr-12 sm:border-r border-slate-200 pb-4 sm:pb-0 border-b sm:border-b-0 w-full sm:w-auto">
                                <p class="text-xl font-black text-slate-600 font-sans">{{ $booking->booking_date->format('H.i') }} - {{ $booking->booking_date->copy()->addHour()->format('H.i') }}</p>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1 font-sans">{{ $booking->booking_date->format('d M Y') }}</p>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-black text-slate-600">{{ $booking->service_name }}</h4>
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 sm:gap-4 mt-2">
                                    <p class="text-[10px] font-bold text-slate-650 uppercase tracking-widest">Klien: <span class="text-slate-900 font-semibold">{{ $booking->user->name ?? 'User Terhapus' }}</span></p>
                                    @if($booking->requests)
                                        <span class="hidden sm:inline w-1 h-1 bg-slate-300 rounded-full"></span>
                                        <p class="text-[10px] text-slate-600 font-medium italic">"{{ Str::limit($booking->requests, 40) }}"</p>
                                    @endif
                                </div>
                                @if(!empty($booking->addons) && is_array($booking->addons))
                                    <div class="mt-2 flex flex-wrap gap-1 justify-center sm:justify-start">
                                        @foreach($booking->addons as $addon)
                                            @if(($addon['qty'] ?? 0) > 0)
                                                <span class="inline-flex items-center px-1.5 py-0.5 bg-slate-100 border border-slate-200 rounded text-[9px] text-slate-600 font-bold">
                                                    + {{ $addon['name'] }} ({{ $addon['qty'] }}x)
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 border-t border-slate-200 pt-4 md:pt-0 md:border-t-0 w-full md:w-auto">
                            <button onclick="showBookingDetail('{{ $booking->id }}', '{{ addslashes($booking->user->name ?? 'User Terhapus') }}', '{{ $booking->user->email ?? '' }}', '{{ addslashes($booking->service_name) }}', '{{ $booking->booking_date->format('d M Y') }}, {{ $booking->booking_date->format('H.i') }} - {{ $booking->booking_date->copy()->addHour()->format('H.i') }}', '{{ $booking->status }}', '{{ addslashes($booking->requests ?? '') }}', '{{ $booking->result_link ?? '' }}', '{{ e(json_encode($booking->addons ?? [])) }}')" 
                                class="text-[10px] font-black uppercase tracking-widest text-slate-600 hover:text-amber-800 transition-colors border-b-2 border-transparent hover:border-amber-800 pb-1 w-full sm:w-auto cursor-pointer">
                                Lihat Detail
                            </button>
                            <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border {{ $isCompleted ? 'bg-emerald-50 text-emerald-800 border-emerald-200' : 'bg-rose-50 text-rose-800 border-rose-200' }}">
                                {{ $isCompleted ? 'Selesai' : 'Dibatalkan' }}
                            </span>
                        </div>
                    </div>
                @else
                    {{-- Active Session Card (Vibrant/Colored) --}}
                    <div class="bg-white rounded-[2rem] p-6 sm:p-10 flex flex-col md:flex-row md:items-center justify-between border border-slate-200 shadow-md shadow-slate-100/80 hover:shadow-lg hover:shadow-slate-200/50 hover:-translate-y-1.5 transition-all duration-300 group gap-6 md:gap-0 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full blur-2xl group-hover:bg-amber-100/50 transition-all duration-500"></div>
                        <div class="flex flex-col sm:flex-row items-center sm:text-left text-center gap-6 sm:gap-12 relative z-10 w-full md:w-auto">
                            <div class="sm:pr-12 sm:border-r border-slate-200 pb-4 sm:pb-0 border-b sm:border-b-0 w-full sm:w-auto">
                                <p class="text-2xl font-black text-slate-900 font-sans">{{ $booking->booking_date->format('H.i') }} - {{ $booking->booking_date->copy()->addHour()->format('H.i') }}</p>
                                <p class="text-[9px] font-black text-amber-700 uppercase tracking-widest mt-1 font-sans">{{ $booking->booking_date->format('d M Y') }}</p>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-lg font-serif italic font-bold text-slate-900 group-hover:text-amber-800 transition-colors">{{ $booking->service_name }}</h4>
                                <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 sm:gap-4 mt-2">
                                    <p class="text-[10px] font-bold text-slate-650 uppercase tracking-widest">Klien: <span class="text-slate-900 font-semibold">{{ $booking->user->name ?? 'User Terhapus' }}</span></p>
                                    @if($booking->requests)
                                        <span class="hidden sm:inline w-1 h-1 bg-slate-300 rounded-full"></span>
                                        <p class="text-[10px] text-slate-600 font-medium italic">"{{ $booking->requests }}"</p>
                                    @endif
                                </div>
                                @if(!empty($booking->addons) && is_array($booking->addons))
                                    <div class="mt-2 flex flex-wrap gap-1 justify-center sm:justify-start">
                                        @foreach($booking->addons as $addon)
                                            @if(($addon['qty'] ?? 0) > 0)
                                                <span class="inline-flex items-center px-1.5 py-0.5 bg-slate-100 border border-slate-200 rounded text-[9px] text-slate-600 font-bold">
                                                    + {{ $addon['name'] }} ({{ $addon['qty'] }}x)
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 border-t border-slate-100 pt-4 md:pt-0 md:border-t-0 w-full md:w-auto relative z-10">
                            <button onclick="showBookingDetail('{{ $booking->id }}', '{{ addslashes($booking->user->name ?? 'User Terhapus') }}', '{{ $booking->user->email ?? '' }}', '{{ addslashes($booking->service_name) }}', '{{ $booking->booking_date->format('d M Y') }}, {{ $booking->booking_date->format('H.i') }} - {{ $booking->booking_date->copy()->addHour()->format('H.i') }}', '{{ $booking->status }}', '{{ addslashes($booking->requests ?? '') }}', '{{ $booking->result_link ?? '' }}', '{{ e(json_encode($booking->addons ?? [])) }}')" 
                                class="text-[10px] font-black uppercase tracking-widest text-slate-650 hover:text-amber-800 transition-colors border-b-2 border-transparent hover:border-amber-800 pb-1 w-full sm:w-auto cursor-pointer">
                                Lihat Detail
                            </button>
                            @if($isConfirmed)
                                <form action="{{ route('photographer.bookings.complete', $booking->id) }}" method="POST" class="w-full sm:w-auto" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan sesi pemotretan ini?')">
                                    @csrf
                                    <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white border border-amber-600 px-8 sm:px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all shadow-md shadow-amber-900/10 active:scale-95 w-full sm:w-auto cursor-pointer">
                                        Selesaikan Sesi
                                    </button>
                                </form>
                            @else
                                <span class="px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border bg-amber-50 text-amber-800 border-amber-250">
                                    {{ $booking->status }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>

    <div class="mt-24 animate-fade-in-up" style="animation-delay: 0.2s;">
        <h4 class="text-[11px] font-black uppercase tracking-[0.4em] mb-10 text-slate-650 text-center">Ringkasan Mingguan</h4>
        <div class="flex overflow-x-auto pb-4 gap-4 snap-x md:grid md:grid-cols-7 md:gap-6 md:pb-0 md:overflow-x-visible">
            @for ($i = 0; $i < 7; $i++)
                <div class="flex-shrink-0 snap-center min-w-[100px] md:min-w-0 md:flex-shrink-1 bg-gradient-to-b {{ $i == 0 ? 'from-amber-50 to-white border-amber-400 shadow-md shadow-amber-100' : 'from-white to-slate-50/50 border-slate-200 shadow-sm' }} p-6 md:p-8 rounded-3xl border text-center group hover-lift transition-all duration-300">
                    <p class="text-[10px] font-black {{ $i == 0 ? 'text-amber-800' : 'text-slate-600' }} uppercase tracking-widest">{{ date('D', strtotime("+$i days")) }}</p>
                    <p class="text-2xl font-black mt-3 {{ $i == 0 ? 'text-amber-900 font-extrabold' : 'text-slate-900' }}">{{ date('d', strtotime("+$i days")) }}</p>
                    @if($i == 0 || $i == 2)
                    <div class="flex justify-center mt-5 gap-1.5">
                        <div class="w-1.5 h-1.5 bg-amber-600 rounded-full shadow-sm shadow-amber-500/30 animate-pulse"></div>
                        <div class="w-1.5 h-1.5 bg-amber-600/60 rounded-full"></div>
                    </div>
                    @endif
                </div>
            @endfor
        </div>
    </div>
@endsection

{{-- MODAL Detail Booking Fotografer --}}
<div id="modal-photographer-detail" class="fixed inset-0 bg-slate-950/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
    <div class="modal-card bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-lg overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col">
        {{-- Close button --}}
        <button onclick="closeDetailModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        
        <div class="text-left">
            <div class="border-b border-slate-150 pb-6 mb-6">
                <span class="inline-flex items-center px-3 py-1 bg-amber-50 border border-amber-200 text-amber-800 text-[8px] font-black uppercase tracking-[0.25em] rounded-md mb-2">Detail Sesi Pemotretan</span>
                <h3 id="modal-booking-id" class="text-xl font-serif italic font-bold text-slate-900">#BOOK-XXXX</h3>
            </div>

            <div class="space-y-4 text-xs font-semibold text-slate-800 pb-6 border-b border-slate-100">
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Nama Klien</span>
                    <span id="modal-client-name" class="text-slate-900 font-bold text-right truncate"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Email Klien</span>
                    <span id="modal-client-email" class="text-slate-900 font-bold text-right truncate font-sans"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Layanan / Sesi</span>
                    <span id="modal-service-name" class="text-slate-900 font-bold text-right truncate"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Tanggal Sesi</span>
                    <span id="modal-booking-date" class="text-slate-900 font-bold text-right font-sans"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Status Sesi</span>
                    <span id="modal-booking-status" class="px-2.5 py-0.5 rounded-full text-[8px] font-black tracking-widest uppercase border inline-block leading-none"></span>
                </div>
                <div class="flex flex-col gap-2 pt-2">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px]">Catatan Khusus (Requests)</span>
                    <p id="modal-requests" class="bg-slate-50 border border-slate-200 rounded-xl p-3.5 italic text-slate-700 font-medium leading-relaxed"></p>
                </div>
                <div id="modal-addons-container" class="hidden flex flex-col gap-2 pt-2">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px]">Layanan Tambahan (Add-ons)</span>
                    <div id="modal-addons-list" class="bg-slate-50 border border-slate-200 rounded-xl p-3.5 flex flex-col gap-2 text-slate-700 font-medium"></div>
                </div>
            </div>

            <div class="pt-6" id="modal-link-section">
                <form id="modal-link-form" method="POST" action="">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="result_link_input" class="text-slate-700 font-black uppercase tracking-wider text-[10px]">Tautan Hasil Foto (Google Drive / Dropbox)</label>
                        <input type="url" name="result_link" id="result_link_input" placeholder="https://drive.google.com/drive/folders/..." required
                            class="w-full px-4 py-3 bg-white border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl text-xs font-semibold text-slate-950 focus:outline-none transition-all placeholder:font-normal placeholder:text-slate-400">
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-900/10 active:scale-95 mt-6 cursor-pointer border-none">
                        SIMPAN LINK HASIL FOTO
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function showBookingDetail(id, client, email, service, date, status, requests, link, addonsJson) {
        document.getElementById('modal-booking-id').textContent = '#' + id;
        document.getElementById('modal-client-name').textContent = client;
        document.getElementById('modal-client-email').textContent = email;
        document.getElementById('modal-service-name').textContent = service;
        document.getElementById('modal-booking-date').textContent = date;
        
        // Status Badge
        const statusLabel = document.getElementById('modal-booking-status');
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

        // Requests
        document.getElementById('modal-requests').textContent = requests ? requests : 'Tidak ada catatan tambahan.';

        // Render Addons
        const addonsContainer = document.getElementById('modal-addons-container');
        const addonsList = document.getElementById('modal-addons-list');
        addonsList.innerHTML = '';
        
        let addons = [];
        try {
            addons = JSON.parse(addonsJson || '[]');
        } catch (e) {
            console.error('Error parsing addons JSON:', e);
        }
        
        let hasActiveAddons = false;
        if (addons && addons.length > 0) {
            addons.forEach(addon => {
                if (addon.qty > 0) {
                    hasActiveAddons = true;
                    const item = document.createElement('div');
                    item.className = 'flex justify-between items-center text-xs font-bold text-slate-800';
                    item.innerHTML = `
                        <span>${addon.name} <span class="text-slate-500 font-medium">x${addon.qty}</span></span>
                        <span class="font-sans">Rp ${(addon.price * addon.qty).toLocaleString('id-ID')}</span>
                    `;
                    addonsList.appendChild(item);
                }
            });
        }
        
        if (hasActiveAddons) {
            addonsContainer.classList.remove('hidden');
        } else {
            addonsContainer.classList.add('hidden');
        }

        // Link Section Form Setup
        const linkSection = document.getElementById('modal-link-section');
        const form = document.getElementById('modal-link-form');
        const input = document.getElementById('result_link_input');

        if (status === 'Cancelled') {
            linkSection.classList.add('hidden');
        } else {
            linkSection.classList.remove('hidden');
            form.action = `/photographer/bookings/${id}/result-link`;
            input.value = link ? link : '';
        }

        openModal('modal-photographer-detail');
    }

    function closeDetailModal() {
        closeModal('modal-photographer-detail');
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

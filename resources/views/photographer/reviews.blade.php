@extends('layouts.dashboard')

@section('title', 'Ulasan Evaluasi Sesi')

@section('sidebar')
    <a href="{{ url('/photographer/jadwal') }}" class="sidebar-item flex items-center px-6 py-4 rounded-2xl mx-2 text-slate-500 hover:text-slate-900 transition-all">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <span class="font-bold">Jadwal Saya</span>
    </a>
    <a href="{{ route('photographer.reviews') }}" class="sidebar-item sidebar-item-active flex items-center px-6 py-4 rounded-2xl mx-2 mt-2">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
        </svg>
        <span class="font-bold">Ulasan Pelanggan</span>
    </a>
@endsection

@section('content')
<div class="bg-slate-900 rounded-[2rem] border-[3px] border-black shadow-2xl shadow-slate-900/50 mb-12 animate-fade-in-up overflow-hidden flex flex-col">
    <!-- Header Hitam -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-8 bg-slate-900 border-b-[2.5px] border-black">
        <div>
            <span class="inline-flex items-center px-3 py-1.5 bg-slate-800 text-slate-300 text-[9px] font-black uppercase tracking-[0.2em] rounded-lg mb-2 border border-slate-700">
                Evaluasi Kinerja
            </span>
            <h3 class="text-2xl font-serif italic font-bold tracking-tight text-amber-400">
                Ulasan Pelanggan Anda
            </h3>
        </div>
    </div>

    <!-- Konten Putih -->
    <div class="bg-white p-0 sm:p-0 flex-1 relative">
        @if ($reviews->isEmpty())
            <div class="text-center py-20 px-6">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z"/></svg>
                </div>
                <p class="text-xs font-black uppercase tracking-wider text-slate-900">Belum Ada Ulasan</p>
                <p class="text-[11px] font-medium mt-1 text-slate-500">Anda belum menerima ulasan apa pun dari pelanggan.</p>
            </div>
        @else
            <div class="overflow-x-auto w-full">
                <table class="w-full text-xs border-collapse">
                    <thead style="background-color: #000000 !important;">
                        <tr class="border-b" style="border-color: #000000 !important;">
                            <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-4 pl-8 w-32" style="color: #fbbf24 !important;">ID Sesi / Waktu</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-4" style="color: #fbbf24 !important;">Layanan & Pelanggan</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-8" style="color: #fbbf24 !important;">Ulasan / Masukan</th>
                        </tr>
                    </thead>
                    <tbody class="font-semibold text-slate-800">
                        @foreach ($reviews as $review)
                        <tr class="group hover:bg-slate-50/60 transition-colors border-b border-black last:border-0">
                            {{-- ID Sesi & Waktu --}}
                            <td class="py-4 pr-4 pl-8 align-top">
                                <p class="font-bold font-sans tracking-wide text-slate-900">BOOK-{{ $review->id }}</p>
                                <p class="mt-2 font-sans font-black text-slate-600">{{ $review->updated_at->format('d M Y') }}</p>
                                <p class="font-medium text-[10px] text-slate-500">{{ $review->updated_at->format('H.i') }} WIB</p>
                            </td>

                            {{-- Layanan & Pelanggan --}}
                            <td class="py-4 pr-4 align-top">
                                <p class="font-bold text-slate-900 text-xs leading-snug">{{ $review->service_name }}</p>
                                <p class="text-[10px] font-bold uppercase tracking-wider mt-1 text-slate-500">Klien: <span class="text-slate-800">{{ $review->user->name ?? 'User Terhapus' }}</span></p>
                            </td>

                            {{-- Ulasan --}}
                            <td class="py-4 pr-8 align-top">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 relative w-full">
                                    <div class="absolute -top-2 -left-2 w-6 h-6 bg-slate-900 rounded-full flex items-center justify-center shadow-md">
                                        <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    </div>
                                    <p class="text-xs font-medium text-slate-700 italic pl-2 leading-relaxed">"{{ $review->review }}"</p>
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
@endsection

@extends('layouts.dashboard')

@section('title', 'Kelola Refund')

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

@if (session('info'))
    <div class="mb-6 flex items-center gap-3 px-5 py-4 bg-sky-50 border border-sky-200 rounded-2xl text-sky-700 text-xs font-semibold">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('info') }}
    </div>
@endif

{{-- Page Header --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400 mb-1">Manajemen Keuangan</p>
        <h1 class="text-2xl font-serif italic font-bold text-slate-900">Kelola Refund</h1>
    </div>
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-2 px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl">
            <span class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
            <span class="text-xs font-black text-rose-700">{{ $pendingCount }} Refund Menunggu</span>
        </div>
    </div>
</div>

{{-- Refunds Table --}}
<div class="bg-white border-2 border-black rounded-[2rem] shadow-sm overflow-hidden">
    <div class="flex items-center justify-between p-6 bg-slate-900 border-b-2 border-amber-400">
        <div>
            <span class="inline-flex items-center px-3 py-1.5 bg-slate-800 text-slate-300 text-[9px] font-black uppercase tracking-[0.2em] rounded-lg mb-2 border border-slate-700">Daftar Permintaan</span>
            <h3 class="text-lg font-serif italic font-bold text-amber-400">Permintaan Refund Customer</h3>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-xs border-collapse">
            <thead>
                <tr class="border-b border-black">
                    <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-4 pl-6">Booking</th>
                    <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-4">Customer</th>
                    <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-4">Nominal Refund</th>
                    <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-4">Data Rekening</th>
                    <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-4">Tgl Pengajuan</th>
                    <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-4">Status</th>
                    <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-6 pt-4">Aksi</th>
                </tr>
            </thead>
            <tbody id="refunds-table-body">
                @forelse($refunds as $refund)
                <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors {{ $refund->status === 'pending' ? 'bg-rose-50/30' : '' }}">
                    {{-- Booking Info --}}
                    <td class="py-4 pr-4 pl-6">
                        <div class="font-black text-slate-900">#{{ $refund->booking_id }}</div>
                        @if($refund->booking)
                        <div class="text-[10px] text-slate-500 mt-0.5 max-w-[140px] truncate">{{ $refund->booking->service_name }}</div>
                        <div class="text-[10px] text-slate-400">{{ $refund->booking->booking_date->format('d M Y') }}</div>
                        @endif
                    </td>
                    {{-- Customer --}}
                    <td class="py-4 pr-4">
                        @if($refund->booking && $refund->booking->user)
                        <div class="font-bold text-slate-800">{{ $refund->booking->user->name }}</div>
                        <div class="text-[10px] text-slate-400">{{ $refund->booking->user->email }}</div>
                        @else
                        <span class="text-slate-400 italic">Customer tidak ditemukan</span>
                        @endif
                    </td>
                    {{-- Refund Amount --}}
                    <td class="py-4 pr-4">
                        <div class="font-black text-emerald-700 text-sm">Rp {{ number_format($refund->amount, 0, ',', '.') }}</div>
                        @if($refund->booking)
                        <div class="text-[10px] text-slate-400">(70% dari Rp {{ number_format($refund->booking->amount, 0, ',', '.') }})</div>
                        @endif
                    </td>
                    {{-- Bank Info --}}
                    <td class="py-4 pr-4">
                        <div class="font-bold text-slate-800 uppercase">{{ $refund->bank_name }}</div>
                        <div class="font-mono text-slate-700 text-[11px]">{{ $refund->account_number }}</div>
                        <div class="text-[10px] text-slate-500">a/n {{ $refund->account_holder }}</div>
                    </td>
                    {{-- Date --}}
                    <td class="py-4 pr-4">
                        <div class="text-slate-700">{{ $refund->created_at->format('d M Y') }}</div>
                        <div class="text-[10px] text-slate-400">{{ $refund->created_at->format('H:i') }} WIB</div>
                        @if($refund->processed_at)
                        <div class="text-[10px] text-emerald-600 font-bold mt-1">✓ Selesai {{ $refund->processed_at->format('d M Y') }}</div>
                        @endif
                    </td>
                    {{-- Status Badge --}}
                    <td class="py-4 pr-4">
                        @if($refund->status === 'pending')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-rose-50 border border-rose-200 text-rose-700 text-[9px] font-black uppercase tracking-wider rounded-xl">
                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 animate-pulse"></span>
                                Menunggu
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[9px] font-black uppercase tracking-wider rounded-xl">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Selesai
                            </span>
                        @endif
                    </td>
                    {{-- Action --}}
                    <td class="py-4 pr-6">
                        @if($refund->status === 'pending')
                            <form method="POST" action="{{ route('admin.refunds.process', $refund->id) }}"
                                onsubmit="return confirm('Konfirmasi bahwa Anda sudah mentransfer Rp {{ number_format($refund->amount, 0, ',', '.') }} ke rekening {{ $refund->account_holder }} ({{ $refund->bank_name }} {{ $refund->account_number }})?')">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-[9px] font-black uppercase tracking-wider rounded-xl transition-all active:scale-95 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                                    Tandai Selesai
                                </button>
                            </form>
                        @else
                            <span class="text-[10px] text-slate-400 font-semibold italic">Transfer selesai</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="py-16 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/></svg>
                            </div>
                            <p class="text-sm font-black text-slate-400 uppercase tracking-wider">Belum ada permintaan refund</p>
                            <p class="text-xs text-slate-300">Permintaan refund dari customer akan tampil di sini.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@extends('layouts.dashboard')

@section('title', 'Loyalty & Reward')

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
@if (session('error'))
    <div class="mb-6 flex items-center gap-3 px-5 py-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-700 text-xs font-semibold">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('error') }}
    </div>
@endif

{{-- Page Header --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400 mb-1">Program Loyalitas</p>
        <h1 class="text-2xl font-serif italic font-bold text-slate-900">Loyalty &amp; Reward</h1>
    </div>
    <a href="{{ route('admin.rewards.create') }}"
        class="inline-flex items-center gap-2 bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] py-3 px-6 rounded-2xl transition-all shadow-md active:scale-95">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
        Tambah Reward
    </a>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-3 gap-4 mb-6">
    <a href="{{ route('admin.rewards.index') }}"
        class="bg-white border-2 {{ !$status ? 'border-amber-400 bg-amber-50/30' : 'border-slate-200 hover:border-amber-300' }} rounded-2xl p-5 text-center shadow-sm transition-all">
        <p class="text-2xl font-black text-slate-900">{{ $totalActive + $totalInactive }}</p>
        <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">Total Reward</p>
    </a>
    <a href="{{ route('admin.rewards.index', ['status' => 'active']) }}"
        class="bg-white border-2 {{ $status === 'active' ? 'border-emerald-400 bg-emerald-50/30' : 'border-slate-200 hover:border-emerald-300' }} rounded-2xl p-5 text-center shadow-sm transition-all">
        <p class="text-2xl font-black {{ $status === 'active' ? 'text-emerald-700' : 'text-slate-900' }}">{{ $totalActive }}</p>
        <p class="text-[10px] font-bold uppercase tracking-widest {{ $status === 'active' ? 'text-emerald-500' : 'text-slate-400' }} mt-0.5">Aktif</p>
    </a>
    <a href="{{ route('admin.rewards.index', ['status' => 'inactive']) }}"
        class="bg-white border-2 {{ $status === 'inactive' ? 'border-slate-400 bg-slate-50' : 'border-slate-200 hover:border-slate-400' }} rounded-2xl p-5 text-center shadow-sm transition-all">
        <p class="text-2xl font-black {{ $status === 'inactive' ? 'text-slate-700' : 'text-slate-900' }}">{{ $totalInactive }}</p>
        <p class="text-[10px] font-bold uppercase tracking-widest {{ $status === 'inactive' ? 'text-slate-500' : 'text-slate-400' }} mt-0.5">Nonaktif</p>
    </a>
</div>

{{-- Main Panel --}}
<div class="bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">

    {{-- Search & Filter --}}
    <div class="p-5 sm:p-6 border-b border-slate-100 bg-slate-50/60">
        <form method="GET" action="{{ route('admin.rewards.index') }}" class="flex flex-col sm:flex-row gap-3">
            {{-- Search --}}
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" id="reward_search"
                    value="{{ $search }}"
                    placeholder="Cari nama atau kode reward..."
                    class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl text-xs font-semibold text-slate-900 focus:outline-none transition-all placeholder:font-normal placeholder:text-slate-400">
            </div>
            {{-- Status Filter --}}
            <div class="flex items-center gap-2">
                @foreach (['' => 'Semua', 'active' => 'Aktif', 'inactive' => 'Nonaktif'] as $val => $label)
                    <label class="cursor-pointer">
                        <input type="radio" name="status" value="{{ $val }}"
                            {{ $status === $val ? 'checked' : '' }} class="sr-only peer">
                        <span class="inline-flex items-center px-3.5 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border transition-all cursor-pointer
                            peer-checked:bg-amber-800 peer-checked:text-white peer-checked:border-amber-800
                            {{ $status !== $val ? 'bg-white text-slate-600 border-slate-200 hover:border-amber-400 hover:text-amber-800' : '' }}">
                            {{ $label }}
                        </span>
                    </label>
                @endforeach
            </div>
            <button type="submit" id="btn-filter-reward"
                class="bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] px-5 py-2.5 rounded-xl transition-all flex-shrink-0">
                Filter
            </button>
            @if ($search || $status)
                <a href="{{ route('admin.rewards.index') }}"
                    class="flex items-center gap-1.5 text-slate-500 hover:text-slate-800 font-bold text-[10px] px-3 py-2.5 rounded-xl border border-slate-200 hover:border-slate-400 transition-all flex-shrink-0">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Result Info --}}
    <div class="px-6 pt-4 pb-2">
        <p class="text-[10px] font-semibold text-slate-400">
            Menampilkan <strong class="text-slate-700">{{ $rewards->count() }}</strong> reward
            @if ($search) • pencarian "<strong class="text-amber-800">{{ $search }}</strong>" @endif
            @if ($status) • status "<strong class="text-amber-800">{{ ucfirst($status) }}</strong>" @endif
        </p>
    </div>

    {{-- Rewards Grid / Table --}}
    <div class="p-6">
        @if ($rewards->isEmpty())
            <div class="text-center py-16 text-slate-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/>
                </svg>
                <p class="text-sm font-semibold mb-1">Belum ada reward</p>
                <p class="text-xs mb-4">Mulai buat reward pertama untuk program loyalitas.</p>
                <a href="{{ route('admin.rewards.create') }}"
                    class="inline-flex items-center gap-2 bg-amber-800 text-white font-black uppercase tracking-widest text-[10px] py-2.5 px-6 rounded-xl">
                    + Tambah Reward
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @foreach ($rewards as $reward)
                @php
                    $typeLabel = match($reward->type) {
                        'discount'     => 'Diskon',
                        'free_session' => 'Sesi Gratis',
                        default        => 'Lainnya',
                    };
                    $typeColor = match($reward->type) {
                        'discount'     => 'bg-violet-100 text-violet-700 border-violet-200',
                        'free_session' => 'bg-sky-100 text-sky-700 border-sky-200',
                        default        => 'bg-slate-100 text-slate-600 border-slate-200',
                    };
                @endphp
                <div class="group relative bg-white border-2 {{ $reward->status === 'active' ? 'border-slate-200 hover:border-amber-300' : 'border-slate-100 opacity-70' }} rounded-2xl p-5 transition-all hover:shadow-lg hover:shadow-amber-100/50 flex flex-col gap-4">

                    {{-- Status badge + Type badge --}}
                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-xl border text-[9px] font-black uppercase tracking-widest {{ $typeColor }}">
                            {{ $typeLabel }}
                        </span>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-xl text-[9px] font-black uppercase tracking-widest border
                            {{ $reward->status === 'active'
                                ? 'bg-emerald-50 text-emerald-700 border-emerald-200'
                                : 'bg-slate-100 text-slate-500 border-slate-200' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $reward->status === 'active' ? 'bg-emerald-500' : 'bg-slate-400' }}"></span>
                            {{ $reward->status === 'active' ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>

                    {{-- Reward Name --}}
                    <div>
                        <h3 class="font-black text-slate-900 text-sm leading-snug mb-1">{{ $reward->name }}</h3>
                        @if ($reward->description)
                            <p class="text-[10px] text-slate-500 leading-relaxed">{{ $reward->description }}</p>
                        @endif
                    </div>

                    {{-- Points & Code --}}
                    <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                        <div class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <span class="font-black text-amber-800 text-sm">{{ number_format($reward->points_required) }}</span>
                            <span class="text-[10px] text-slate-400 font-semibold">poin</span>
                        </div>
                        <span class="px-2.5 py-1 bg-slate-50 border border-slate-200 rounded-lg text-[10px] font-black text-slate-700 tracking-widest">
                            {{ $reward->code }}
                        </span>
                    </div>

                    {{-- Diskon & Stok info --}}
                    <div class="flex flex-wrap gap-2">
                        @if ($reward->discount_amount)
                            <span class="text-[10px] font-semibold text-slate-500 bg-slate-50 px-2 py-1 rounded-lg border border-slate-100">
                                Diskon Rp {{ number_format($reward->discount_amount) }}
                            </span>
                        @endif
                        @if ($reward->stock !== null)
                            <span class="text-[10px] font-semibold text-slate-500 bg-slate-50 px-2 py-1 rounded-lg border border-slate-100">
                                Stok: {{ $reward->stock }}
                            </span>
                        @else
                            <span class="text-[10px] font-semibold text-slate-400 bg-slate-50 px-2 py-1 rounded-lg border border-slate-100">
                                Stok unlimited
                            </span>
                        @endif
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2 pt-1 border-t border-slate-100">
                        {{-- Toggle Status --}}
                        <form action="{{ route('admin.rewards.toggle', $reward->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit"
                                class="w-full py-2 rounded-xl text-[10px] font-black uppercase tracking-widest border transition-all
                                {{ $reward->status === 'active'
                                    ? 'bg-slate-50 hover:bg-slate-100 text-slate-600 border-slate-200'
                                    : 'bg-emerald-50 hover:bg-emerald-100 text-emerald-700 border-emerald-200' }}">
                                {{ $reward->status === 'active' ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </form>
                        <a href="{{ route('admin.rewards.edit', $reward->id) }}"
                            class="flex-1 py-2 text-center rounded-xl text-[10px] font-black uppercase tracking-widest bg-amber-50 hover:bg-amber-100 text-amber-800 border border-amber-200 transition-all">
                            Edit
                        </a>
                        <form action="{{ route('admin.rewards.destroy', $reward->id) }}" method="POST"
                            onsubmit="return confirm('Hapus reward \'{{ addslashes($reward->name) }}\'?')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                class="py-2 px-3 rounded-xl text-[10px] font-black bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

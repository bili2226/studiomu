@extends('layouts.dashboard')

@section('title', 'Tambah Reward')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="admin-card-gold bg-white border border-amber-300 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">

    {{-- Header --}}
    <div class="p-6 sm:p-8 border-b border-amber-300 bg-gradient-to-r from-amber-50/60 to-white flex items-center justify-between">
        <div>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-700 mb-1">Program Loyalitas</p>
            <h2 class="text-2xl font-serif italic font-bold text-slate-900">Tambah Reward Baru</h2>
        </div>
        <a href="{{ route('admin.rewards.index') }}"
            class="flex items-center gap-2 text-slate-500 hover:text-slate-800 font-bold text-xs transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.rewards.store') }}" method="POST" class="p-6 sm:p-8">
        @csrf

        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-xs font-semibold">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Nama Reward --}}
            <div class="md:col-span-2">
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Nama Reward <span class="text-rose-400">*</span></label>
                <input type="text" name="name" id="reward_name" value="{{ old('name') }}" required
                    class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all"
                    placeholder="Contoh: Voucher Diskon Rp 100.000">
            </div>

            {{-- Kode Voucher --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Kode Voucher <span class="text-rose-400">*</span></label>
                <input type="text" name="code" id="reward_code" value="{{ old('code') }}" required maxlength="50"
                    class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-black text-slate-900 tracking-widest uppercase transition-all"
                    placeholder="Contoh: DISC100K">
                <p class="text-[9px] text-slate-400 mt-1">Kode unik, akan diubah otomatis ke huruf kapital.</p>
            </div>

            {{-- Poin yang Diperlukan --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Poin Diperlukan <span class="text-rose-400">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <svg class="w-3.5 h-3.5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <input type="number" name="points_required" id="reward_points" value="{{ old('points_required') }}" required min="1"
                        class="w-full pl-10 pr-4 bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl py-3 text-xs focus:outline-none font-black text-amber-800 transition-all"
                        placeholder="Contoh: 100">
                </div>
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-6">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Deskripsi <span class="text-slate-400 font-normal normal-case tracking-normal">(opsional)</span></label>
            <textarea name="description" id="reward_description" rows="2"
                class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all placeholder:font-normal placeholder:text-slate-400"
                placeholder="Deskripsi singkat reward ini...">{{ old('description') }}</textarea>
        </div>

        {{-- Tipe & Status --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            {{-- Tipe Reward --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3">Tipe Reward <span class="text-rose-400">*</span></label>
                <div class="space-y-2">
                    @foreach (['discount' => ['label' => 'Diskon', 'desc' => 'Potongan harga (Rp)', 'color' => 'violet'], 'free_session' => ['label' => 'Sesi Gratis', 'desc' => 'Sesi foto gratis', 'color' => 'sky'], 'other' => ['label' => 'Lainnya', 'desc' => 'Hadiah lain', 'color' => 'slate']] as $val => $t)
                    <label class="flex items-center gap-3 p-3 border-2 rounded-xl cursor-pointer transition-all
                        {{ old('type', 'discount') === $val ? 'border-amber-500 bg-amber-50/60' : 'border-amber-300 hover:border-amber-300' }}">
                        <input type="radio" name="type" value="{{ $val }}"
                            {{ old('type', 'discount') === $val ? 'checked' : '' }}
                            class="accent-amber-700 w-3.5 h-3.5 flex-shrink-0">
                        <div>
                            <p class="text-[10px] font-black text-slate-800">{{ $t['label'] }}</p>
                            <p class="text-[9px] text-slate-400">{{ $t['desc'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- Nominal Diskon --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Nominal Diskon <span class="text-slate-400 font-normal normal-case tracking-normal">(opsional)</span></label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[10px] font-black text-slate-500 pointer-events-none">Rp</span>
                    <input type="number" name="discount_amount" id="reward_discount" value="{{ old('discount_amount') }}" min="0"
                        class="w-full pl-9 pr-4 bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all"
                        placeholder="100000">
                </div>
                <p class="text-[9px] text-slate-400 mt-1">Isi jika tipe Diskon.</p>

                {{-- Stok --}}
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2 mt-5">Stok <span class="text-slate-400 font-normal normal-case tracking-normal">(kosong = unlimited)</span></label>
                <input type="number" name="stock" id="reward_stock" value="{{ old('stock') }}" min="0"
                    class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all"
                    placeholder="Kosongkan untuk unlimited">
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3">Status <span class="text-rose-400">*</span></label>
                <div class="space-y-2">
                    <label class="flex items-center gap-3 p-3 border-2 rounded-xl cursor-pointer transition-all
                        {{ old('status', 'active') === 'active' ? 'border-emerald-400 bg-emerald-50/40' : 'border-amber-300 hover:border-emerald-300' }}">
                        <input type="radio" name="status" value="active"
                            {{ old('status', 'active') === 'active' ? 'checked' : '' }}
                            class="accent-emerald-600 w-3.5 h-3.5 flex-shrink-0">
                        <div>
                            <p class="text-[10px] font-black text-slate-800">Aktif</p>
                            <p class="text-[9px] text-slate-400">Bisa ditukar customer</p>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 p-3 border-2 rounded-xl cursor-pointer transition-all
                        {{ old('status') === 'inactive' ? 'border-slate-400 bg-slate-50' : 'border-amber-300 hover:border-slate-400' }}">
                        <input type="radio" name="status" value="inactive"
                            {{ old('status') === 'inactive' ? 'checked' : '' }}
                            class="accent-slate-600 w-3.5 h-3.5 flex-shrink-0">
                        <div>
                            <p class="text-[10px] font-black text-slate-800">Nonaktif</p>
                            <p class="text-[9px] text-slate-400">Disembunyikan dari customer</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 border-t border-slate-100 pt-6">
            <button type="submit" id="btn-simpan-reward"
                class="bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] py-3.5 px-8 rounded-2xl transition-all shadow-md active:scale-95">
                Simpan Reward
            </button>
            <a href="{{ route('admin.rewards.index') }}" class="text-slate-500 hover:text-slate-700 font-bold text-xs">Batal</a>
        </div>
    </form>
</div>
@endsection

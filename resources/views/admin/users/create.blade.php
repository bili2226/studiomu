@extends('layouts.dashboard')

@section('title', 'Tambah ' . ucfirst($role))

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="admin-card-gold bg-white border border-amber-300 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">

    {{-- Header --}}
    <div class="p-6 sm:p-8 border-b border-amber-300 bg-slate-50 flex items-center justify-between">
        <div>
            <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-500 mb-1">Tambah Akun Baru</h4>
            <h2 class="text-2xl font-serif italic font-bold text-slate-900">Tambah {{ ucfirst($role) }}</h2>
        </div>
        <a href="{{ route('admin.users.index', ['role' => $role]) }}"
            class="flex items-center gap-2 text-slate-500 hover:text-slate-800 font-bold text-xs transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 sm:p-8">
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

        {{-- Role selector (tersembunyi, tapi bisa dipilih) --}}
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3">Role Akun</label>
            <div class="grid grid-cols-3 gap-3">
                @foreach (['admin' => 'Admin', 'photographer' => 'Fotografer', 'customer' => 'Customer'] as $val => $label)
                <label class="flex items-center gap-3 p-4 border-2 rounded-2xl cursor-pointer transition-all
                    {{ old('role', $role) === $val
                        ? 'border-amber-500 bg-amber-50/60'
                        : 'border-amber-300 hover:border-amber-300 bg-white' }}">
                    <input type="radio" name="role" value="{{ $val }}"
                        {{ old('role', $role) === $val ? 'checked' : '' }}
                        class="accent-amber-700 w-4 h-4 flex-shrink-0">
                    <div>
                        @if ($val === 'admin')
                            <div class="w-6 h-6 rounded-full bg-violet-100 flex items-center justify-center mb-1">
                                <svg class="w-3 h-3 text-violet-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                        @elseif ($val === 'photographer')
                            <div class="w-6 h-6 rounded-full bg-sky-100 flex items-center justify-center mb-1">
                                <svg class="w-3 h-3 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                        @else
                            <div class="w-6 h-6 rounded-full bg-amber-100 flex items-center justify-center mb-1">
                                <svg class="w-3 h-3 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                        @endif
                        <p class="text-[10px] font-black text-slate-800">{{ $label }}</p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        {{-- Form Fields --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="user_name" value="{{ old('name') }}" required
                    class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all"
                    placeholder="Nama lengkap">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Email</label>
                <input type="email" name="email" id="user_email" value="{{ old('email') }}" required
                    class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all"
                    placeholder="email@example.com">
            </div>
        </div>

        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Password</label>
            <input type="password" name="password" id="user_password" required minlength="6"
                class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all"
                placeholder="Minimal 6 karakter">
            <p class="text-[10px] text-slate-400 mt-1.5">Pastikan password yang kuat dan mudah diingat oleh pengguna.</p>
        </div>

        <div class="flex items-center gap-4 border-t border-slate-100 pt-6">
            <button type="submit" id="btn-simpan-user"
                class="bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] py-3.5 px-8 rounded-2xl transition-all shadow-md active:scale-95">
                Tambah Akun
            </button>
            <a href="{{ route('admin.users.index', ['tab' => $role]) }}" class="text-slate-500 hover:text-slate-700 font-bold text-xs">Batal</a>
        </div>
    </form>
</div>
@endsection

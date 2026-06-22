@extends('layouts.dashboard')

@section('title', 'Kelola User')

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
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
        {{ session('error') }}
    </div>
@endif

{{-- Page Header --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400 mb-1">Manajemen Akun</p>
        <h1 class="text-2xl font-serif italic font-bold text-slate-900">Kelola User</h1>
    </div>
    <a href="{{ route('admin.users.create', ['role' => $role ?: 'customer']) }}"
        class="inline-flex items-center gap-2 bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] py-3 px-6 rounded-2xl transition-all shadow-md active:scale-95">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
        Tambah User
    </a>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-3 gap-4 mb-6">
    <a href="{{ route('admin.users.index', ['role' => 'admin', 'search' => $search]) }}"
        class="group bg-white border-2 {{ $role === 'admin' ? 'border-violet-400 bg-violet-50/40' : 'border-amber-300 hover:border-violet-300' }} rounded-2xl p-5 text-center shadow-sm transition-all">
        <div class="w-8 h-8 rounded-full bg-violet-100 flex items-center justify-center mx-auto mb-2">
            <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
        <p class="text-xl font-black {{ $role === 'admin' ? 'text-violet-700' : 'text-slate-900' }}">{{ $totalAdmins }}</p>
        <p class="text-[10px] font-bold uppercase tracking-widest {{ $role === 'admin' ? 'text-violet-500' : 'text-slate-400' }} mt-0.5">Admin</p>
    </a>
    <a href="{{ route('admin.users.index', ['role' => 'photographer', 'search' => $search]) }}"
        class="group bg-white border-2 {{ $role === 'photographer' ? 'border-sky-400 bg-sky-50/40' : 'border-amber-300 hover:border-sky-300' }} rounded-2xl p-5 text-center shadow-sm transition-all">
        <div class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center mx-auto mb-2">
            <svg class="w-4 h-4 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <p class="text-xl font-black {{ $role === 'photographer' ? 'text-sky-700' : 'text-slate-900' }}">{{ $totalPhotogs }}</p>
        <p class="text-[10px] font-bold uppercase tracking-widest {{ $role === 'photographer' ? 'text-sky-500' : 'text-slate-400' }} mt-0.5">Fotografer</p>
    </a>
    <a href="{{ route('admin.users.index', ['role' => 'customer', 'search' => $search]) }}"
        class="group bg-white border-2 {{ $role === 'customer' ? 'border-amber-400 bg-amber-50/40' : 'border-amber-300 hover:border-amber-300' }} rounded-2xl p-5 text-center shadow-sm transition-all">
        <div class="w-8 h-8 rounded-full bg-amber-100 flex items-center justify-center mx-auto mb-2">
            <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <p class="text-xl font-black {{ $role === 'customer' ? 'text-amber-700' : 'text-slate-900' }}">{{ $totalCustomers }}</p>
        <p class="text-[10px] font-bold uppercase tracking-widest {{ $role === 'customer' ? 'text-amber-500' : 'text-slate-400' }} mt-0.5">Customer</p>
    </a>
</div>

{{-- Main Panel --}}
<div class="bg-white border border-amber-300 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">

    {{-- Search & Filter Bar --}}
    <div class="p-5 sm:p-6 border-b border-slate-100 bg-slate-50/60">
        <form method="GET" action="{{ route('admin.users.index') }}" class="flex flex-col sm:flex-row gap-3">

            {{-- Searchbar --}}
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" name="search" id="user_search"
                    value="{{ $search }}"
                    placeholder="Cari nama atau email..."
                    class="w-full pl-10 pr-4 py-2.5 bg-white border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl text-xs font-semibold text-slate-900 focus:outline-none transition-all placeholder:font-normal placeholder:text-slate-400">
            </div>

            {{-- Role Filter --}}
            <div class="relative min-w-[12rem] flex-shrink-0">
                <select name="role" onchange="this.form.submit()"
                    class="w-full appearance-none bg-white border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl text-xs font-bold text-slate-800 pl-4 pr-10 py-2.5 focus:outline-none transition-all cursor-pointer">
                    <option value="">Semua Role</option>
                    <option value="admin" {{ $role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="photographer" {{ $role === 'photographer' ? 'selected' : '' }}>Fotografer</option>
                    <option value="customer" {{ $role === 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <svg class="w-3.5 h-3.5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit" id="btn-filter-user"
                class="bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] px-5 py-2.5 rounded-xl transition-all flex-shrink-0">
                Filter
            </button>
            @if ($search || $role)
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center gap-1.5 text-slate-500 hover:text-slate-800 font-bold text-[10px] px-3 py-2.5 rounded-xl border border-amber-300 hover:border-slate-400 transition-all flex-shrink-0">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- Result Info --}}
    <div class="px-6 pt-4 pb-2 flex items-center justify-between">
        <p class="text-[10px] font-semibold text-slate-900">
            Menampilkan <strong class="text-slate-900">{{ $users->count() }}</strong> user
            @if ($search) • pencarian "<strong class="text-amber-800">{{ $search }}</strong>" @endif
            @if ($role) • filter "<strong class="text-amber-800">{{ ucfirst($role) }}</strong>" @endif
        </p>
    </div>

    {{-- Table --}}
    <div class="px-6 pb-6">
        @if ($users->isEmpty())
            <div class="text-center py-16 text-slate-400">
                <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                </svg>
                <p class="text-sm font-semibold mb-1">Tidak ada user ditemukan</p>
                <p class="text-xs">Coba ubah kata kunci pencarian atau filter.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="border-b border-slate-100">
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-900 pb-3 pr-4 pt-2">Nama</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-900 pb-3 pr-4 pt-2">Email</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-900 pb-3 pr-4 pt-2">Role</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-900 pb-3 pr-4 pt-2">Poin</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest text-slate-900 pb-3 pr-4 pt-2">Bergabung</th>
                            <th class="text-right text-[9px] font-black uppercase tracking-widest text-slate-900 pb-3 pt-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($users as $user)
                        <tr class="group hover:bg-slate-50/60 transition-colors">
                            {{-- Nama --}}
                            <td class="py-3.5 pr-4">
                                <div class="flex items-center gap-3">
                                    @php
                                        $avatarColor = match($user->role) {
                                            'admin'        => 'bg-violet-100 text-violet-700',
                                            'photographer' => 'bg-sky-100 text-sky-700',
                                            default        => 'bg-amber-100 text-amber-800',
                                        };
                                    @endphp
                                    <div class="w-8 h-8 rounded-full {{ $avatarColor }} flex items-center justify-center flex-shrink-0 text-[10px] font-black">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900 leading-tight">{{ $user->name }}</p>
                                        @if ($user->id === Auth::id())
                                            <span class="text-[8px] font-black uppercase tracking-wider text-amber-600 bg-amber-50 px-1.5 py-0.5 rounded-full">Anda</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="py-3.5 pr-4 text-slate-900 font-medium">{{ $user->email }}</td>

                            {{-- Role Badge --}}
                            <td class="py-3.5 pr-4">
                                @php
                                    $badgeClass = match($user->role) {
                                        'admin'        => 'bg-violet-100 text-violet-700 border-violet-200',
                                        'photographer' => 'bg-sky-100 text-sky-700 border-sky-200',
                                        default        => 'bg-amber-100 text-amber-800 border-amber-200',
                                    };
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-xl border text-[9px] font-black uppercase tracking-widest {{ $badgeClass }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            {{-- Poin --}}
                            <td class="py-3.5 pr-4">
                                @if ($user->role === 'customer')
                                    <span class="inline-flex items-center gap-1 text-amber-800 font-black text-[10px]">
                                        <svg class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        {{ number_format($user->points) }}
                                    </span>
                                @else
                                    <span class="text-slate-900 text-[10px]">—</span>
                                @endif
                            </td>

                            {{-- Bergabung --}}
                            <td class="py-3.5 pr-4 text-slate-900 text-[10px] font-medium">{{ $user->created_at?->format('d M Y') }}</td>

                            {{-- Aksi --}}
                            <td class="py-3.5 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    @if ($user->role === 'customer')
                                        <button onclick="document.getElementById('points-modal-{{ $user->id }}').showModal()"
                                            class="px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-800 font-bold rounded-xl text-[10px] transition-all border border-amber-200">
                                            ★ Poin
                                        </button>
                                    @endif
                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                        class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-[10px] transition-all">
                                        Edit
                                    </a>
                                    @if ($user->id !== Auth::id())
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus akun {{ addslashes($user->name) }}?')">
                                            @csrf @method('DELETE')
                                            <button class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold rounded-xl text-[10px] transition-all">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        {{-- Poin Modal (native dialog, hanya untuk customer) --}}
                        @if ($user->role === 'customer')
                        <tr class="hidden">
                            <td colspan="6">
                                <dialog id="points-modal-{{ $user->id }}"
                                    class="rounded-3xl shadow-2xl border border-amber-300 p-0 w-full max-w-sm backdrop:bg-slate-900/40 backdrop:backdrop-blur-sm">
                                    <div class="bg-white rounded-3xl overflow-hidden">
                                        <div class="p-6 border-b border-slate-100 bg-amber-50/50 flex items-center justify-between">
                                            <div>
                                                <p class="text-[10px] font-black uppercase tracking-widest text-amber-700 mb-0.5">Kelola Poin</p>
                                                <p class="font-bold text-slate-900 text-sm">{{ $user->name }}</p>
                                                <p class="text-[10px] text-slate-500 mt-0.5">Poin saat ini: <strong class="text-amber-800">{{ number_format($user->points) }}</strong></p>
                                            </div>
                                            <form method="dialog">
                                                <button class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-slate-100 text-slate-400 hover:text-slate-700 transition-all text-lg font-bold">&times;</button>
                                            </form>
                                        </div>
                                        <form action="{{ route('admin.users.points', $user->id) }}" method="POST" class="p-6 space-y-4">
                                            @csrf
                                            <div>
                                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Jumlah Poin</label>
                                                <input type="number" name="points" min="1" max="99999" required
                                                    class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-sm focus:outline-none font-bold text-slate-900 transition-all"
                                                    placeholder="Contoh: 500">
                                            </div>
                                            <div>
                                                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Tindakan</label>
                                                <div class="grid grid-cols-2 gap-3">
                                                    <label class="flex items-center gap-2 p-3 border border-amber-300 rounded-xl cursor-pointer hover:border-amber-400 transition-all has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50">
                                                        <input type="radio" name="action" value="add" checked class="accent-amber-700">
                                                        <div>
                                                            <p class="text-[10px] font-black text-slate-700">Tambah</p>
                                                            <p class="text-[9px] text-slate-400">+X ke poin</p>
                                                        </div>
                                                    </label>
                                                    <label class="flex items-center gap-2 p-3 border border-amber-300 rounded-xl cursor-pointer hover:border-amber-400 transition-all has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50">
                                                        <input type="radio" name="action" value="set" class="accent-amber-700">
                                                        <div>
                                                            <p class="text-[10px] font-black text-slate-700">Set</p>
                                                            <p class="text-[9px] text-slate-400">Atur jadi X</p>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="flex gap-3 pt-2">
                                                <button type="submit"
                                                    class="flex-1 bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] py-3 rounded-2xl transition-all">
                                                    Simpan Poin
                                                </button>
                                                <form method="dialog" class="flex-1">
                                                    <button type="submit" class="w-full border border-amber-300 hover:bg-slate-50 text-slate-600 font-bold text-[10px] py-3 rounded-2xl transition-all">
                                                        Batal
                                                    </button>
                                                </form>
                                            </div>
                                        </form>
                                    </div>
                                </dialog>
                            </td>
                        </tr>
                        @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('title', 'Kelola Layanan')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">
    <div class="p-6 sm:p-8 border-b border-slate-200 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-slate-50">
        <div>
            <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-1">Layanan Studio.mu</h4>
            <h2 class="text-2xl font-serif italic font-bold text-slate-900">Daftar Paket & Layanan Kreatif</h2>
        </div>
        <a href="{{ route('admin.services.create') }}" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-3.5 px-6 rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 flex items-center gap-1.5 hover:shadow-lg hover:shadow-amber-500/20 border border-amber-200">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
            TAMBAH LAYANAN BARU
        </a>
    </div>
    
    @if(session('success'))
    <div class="p-4 mx-6 mt-6 bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-xl font-semibold text-xs">
        {{ session('success') }}
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-700 bg-slate-50">
                    <th class="px-6 py-4">Foto / Layanan</th>
                    <th class="px-6 py-4">Mulai Harga</th>
                    <th class="px-6 py-4">Deskripsi Singkat</th>
                    <th class="px-6 py-4">Paket 1 (Silver/Basic)</th>
                    <th class="px-6 py-4">Paket 2 (Gold/Special)</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-800 bg-white">
                @forelse($services as $svc)
                <tr class="hover:bg-slate-50 transition-all duration-350 border-b border-slate-200">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3.5">
                            <div class="w-12 h-12 bg-amber-50 border border-amber-200 rounded-2xl flex items-center justify-center font-serif text-[11px] font-black uppercase text-amber-800 shadow-md shadow-amber-100/50 flex-shrink-0 tracking-wider leading-none p-1 text-center">
                                {{ strtoupper(substr($svc->title, 0, 3)) }}
                            </div>
                            <div>
                                <p class="font-serif italic font-bold text-slate-900 text-[14px] leading-tight">{{ $svc->title }}</p>
                                <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.18em] mt-1">{{ $svc->category }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 font-bold text-amber-800 font-sans text-xs">{{ \App\Models\Service::formatPrice($svc->starting) }}</td>
                    <td class="px-6 py-5 text-slate-700 text-[11px] leading-relaxed max-w-xs font-semibold">{{ Str::limit($svc->description, 50) }}</td>
                    <td class="px-6 py-5 font-semibold text-slate-800">
                        <span class="text-[9px] font-black uppercase tracking-wider block text-slate-500 mb-1">{{ $svc->col1['title'] ?? '' }}</span>
                        <span class="text-xs font-bold text-slate-900 bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1 inline-block">{{ \App\Models\Service::formatPrice($svc->col1['new'] ?? '') }} <span class="text-[10px] text-slate-400 font-semibold line-through ml-1">({{ \App\Models\Service::formatPrice($svc->col1['old'] ?? '') }})</span></span>
                    </td>
                    <td class="px-6 py-5 font-semibold text-slate-800">
                        <span class="text-[9px] font-black uppercase tracking-wider block text-slate-500 mb-1">{{ $svc->col2['title'] ?? '' }}</span>
                        <span class="text-xs font-bold text-slate-900 bg-slate-50 border border-slate-200 rounded-lg px-2.5 py-1 inline-block">{{ \App\Models\Service::formatPrice($svc->col2['new'] ?? '') }} <span class="text-[10px] text-slate-400 font-semibold line-through ml-1">({{ \App\Models\Service::formatPrice($svc->col2['old'] ?? '') }})</span></span>
                    </td>
                    <td class="px-6 py-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.services.edit', $svc->id) }}" class="px-4 py-2 bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm inline-block">Edit</a>
                            <form action="{{ route('admin.services.destroy', $svc->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-slate-500 font-semibold text-xs">Belum ada layanan yang ditambahkan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

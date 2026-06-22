@extends('layouts.dashboard')

@section('title', 'Tambah Layanan Baru')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="bg-white border border-amber-300 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">
    <div class="p-6 sm:p-8 border-b border-amber-300 bg-slate-50">
        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-1">Formulir Layanan</h4>
        <h2 class="text-2xl font-serif italic font-bold text-slate-900">Tambah Layanan Baru</h2>
    </div>

    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
        @csrf
        
        @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-xs font-semibold">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Nama Layanan & Harga --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Nama Layanan</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Harga Mulai Dari</label>
                <input type="text" name="starting" id="starting" value="{{ old('starting', 'Mulai Rp 500.000') }}" required class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all">
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Deskripsi Singkat</label>
            <textarea name="description" id="description" rows="3" class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all">{{ old('description') }}</textarea>
        </div>

        {{-- Catatan Opsional --}}
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">
                Catatan Tambahan <span class="text-slate-400 font-normal normal-case tracking-normal">(opsional)</span>
            </label>
            <textarea name="note" id="note" rows="3" placeholder="Contoh: *Harga belum termasuk cetak. Booking minimal 3 hari sebelumnya." class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all placeholder:font-normal placeholder:text-slate-400">{{ old('note') }}</textarea>
        </div>

        {{-- Foto Slides per Slot --}}
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3">
                Foto / Slides Layanan <span class="text-slate-400 font-normal normal-case tracking-normal">(maks. 4MB per foto · JPG, PNG, WebP)</span>
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @for ($i = 1; $i <= 5; $i++)
                <div class="flex flex-col gap-2 p-4 bg-slate-50 border border-amber-300 rounded-2xl">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">Foto {{ $i }}</span>
                    <input type="file" name="slide_{{ $i }}" id="slide_create_{{ $i }}" accept="image/*"
                        class="text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 cursor-pointer w-full">
                    <p class="text-[9px] text-slate-400">Opsional</p>
                </div>
                @endfor
            </div>
        </div>


        {{-- Highlights --}}
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Highlights / Keunggulan (pisah per baris)</label>
            <textarea name="highlights" id="highlights" rows="4" placeholder="Contoh:&#10;Fotografer profesional berpengalaman&#10;Editing premium" class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all placeholder:font-normal placeholder:text-slate-400">{{ old('highlights') }}</textarea>
        </div>

        {{-- Paket --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="p-6 bg-slate-50 border border-amber-300 rounded-2xl">
                <h5 class="text-[11px] font-black uppercase tracking-widest text-slate-800 mb-4 pb-2 border-b border-amber-300">Paket 1 (Basic / Silver)</h5>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1">Judul Paket</label>
                        <input type="text" name="col1_title" value="{{ old('col1_title', 'BASIC DEALS') }}" class="w-full bg-white border border-amber-300 rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1">Harga Coret (Lama)</label>
                            <input type="text" name="col1_old" value="{{ old('col1_old') }}" class="w-full bg-white border border-amber-300 rounded-xl px-3 py-2 text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1">Harga Baru</label>
                            <input type="text" name="col1_new" value="{{ old('col1_new') }}" class="w-full bg-white border border-amber-300 rounded-xl px-3 py-2 text-xs">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1">Fitur Paket (Pisah per baris)</label>
                        <textarea name="col1_features" rows="5" class="w-full bg-white border border-amber-300 rounded-xl px-3 py-2 text-xs">{{ old('col1_features') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-amber-50/50 border border-amber-200 rounded-2xl">
                <h5 class="text-[11px] font-black uppercase tracking-widest text-amber-900 mb-4 pb-2 border-b border-amber-200/50">Paket 2 (Premium / Gold)</h5>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-amber-700 mb-1">Judul Paket</label>
                        <input type="text" name="col2_title" value="{{ old('col2_title', 'PREMIUM CHOICES') }}" class="w-full bg-white border border-amber-200 rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-amber-700 mb-1">Harga Coret (Lama)</label>
                            <input type="text" name="col2_old" value="{{ old('col2_old') }}" class="w-full bg-white border border-amber-200 rounded-xl px-3 py-2 text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-amber-700 mb-1">Harga Baru</label>
                            <input type="text" name="col2_new" value="{{ old('col2_new') }}" class="w-full bg-white border border-amber-200 rounded-xl px-3 py-2 text-xs">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-amber-700 mb-1">Fitur Paket (Pisah per baris)</label>
                        <textarea name="col2_features" rows="5" class="w-full bg-white border border-amber-200 rounded-xl px-3 py-2 text-xs">{{ old('col2_features') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Addons / Layanan Tambahan --}}
        <div class="mb-8 p-6 bg-slate-50 border border-amber-300 rounded-2xl">
            <h5 class="text-[11px] font-black uppercase tracking-widest text-slate-800 mb-4 pb-2 border-b border-amber-300">Layanan Tambahan (Add-ons)</h5>
            <p class="text-[10px] text-slate-500 mb-4">Tambahkan item opsional yang dapat dipilih pelanggan saat memesan layanan ini (contoh: Makeup, Hairdo, Cetak Foto, dll.).</p>
            
            <div id="addons-container" class="space-y-3">
                <!-- Addon rows will be appended here dynamically -->
            </div>
            
            <button type="button" onclick="addAddonRow()" class="mt-4 inline-flex items-center gap-1.5 bg-white border border-amber-300 hover:border-amber-400 hover:bg-amber-50/50 text-amber-800 px-4 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all cursor-pointer">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span>Tambah Add-on</span>
            </button>
        </div>

        <div class="flex items-center gap-4 border-t border-amber-300 pt-6">
            <button type="submit" id="btn-simpan-layanan" class="bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] py-3.5 px-8 rounded-2xl transition-all shadow-md active:scale-95">Simpan Layanan</button>
            <a href="{{ route('admin.services.index') }}" class="text-slate-500 hover:text-slate-700 font-bold text-xs">Batal</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    let addonIndex = 0;

    function addAddonRow(name = '', price = '') {
        const container = document.getElementById('addons-container');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-3 bg-white p-3 border border-amber-250 rounded-xl addon-row';
        div.innerHTML = `
            <div class="flex-1">
                <input type="text" name="addons[${addonIndex}][name]" value="${name}" placeholder="Nama Add-on (misal: Makeup)" required class="w-full bg-slate-50 border border-amber-250 rounded-lg px-3 py-2.5 text-xs font-semibold text-slate-800">
            </div>
            <div class="w-1/3">
                <input type="number" name="addons[${addonIndex}][price]" value="${price}" placeholder="Harga (Rp)" required class="w-full bg-slate-50 border border-amber-250 rounded-lg px-3 py-2.5 text-xs font-semibold text-slate-800">
            </div>
            <button type="button" onclick="this.closest('.addon-row').remove()" class="text-rose-600 hover:text-rose-800 p-2 cursor-pointer transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                </svg>
            </button>
        `;
        container.appendChild(div);
        addonIndex++;
    }
</script>
@endsection

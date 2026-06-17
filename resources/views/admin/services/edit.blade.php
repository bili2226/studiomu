@extends('layouts.dashboard')

@section('title', 'Edit Layanan')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
<div class="bg-white border border-amber-300 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">
    <div class="p-6 sm:p-8 border-b border-amber-300 bg-slate-50">
        <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-1">Formulir Layanan</h4>
        <h2 class="text-2xl font-serif italic font-bold text-slate-900">Edit Layanan: {{ $service->title }}</h2>
    </div>

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8">
        @csrf
        @method('PUT')
        
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
                <input type="text" name="title" id="edit_title" value="{{ old('title', $service->title) }}" required class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Harga Mulai Dari</label>
                <input type="text" name="starting" id="edit_starting" value="{{ old('starting', $service->starting) }}" required class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all">
            </div>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Deskripsi Singkat</label>
            <textarea name="description" id="edit_description" rows="3" class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all">{{ old('description', $service->description) }}</textarea>
        </div>

        {{-- Catatan Opsional --}}
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">
                Catatan Tambahan <span class="text-slate-400 font-normal normal-case tracking-normal">(opsional)</span>
            </label>
            <textarea name="note" id="edit_note" rows="3" placeholder="Contoh: *Harga belum termasuk cetak. Booking minimal 3 hari sebelumnya." class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all placeholder:font-normal placeholder:text-slate-400">{{ old('note', $service->note) }}</textarea>
        </div>

        {{-- Foto Slides per Slot --}}
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3">
                Foto / Slides Layanan <span class="text-slate-400 font-normal normal-case tracking-normal">(maks. 4MB per foto · JPG, PNG, WebP)</span>
            </label>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @for ($i = 1; $i <= 5; $i++)
                @php $existingSlide = $service->slides[$i - 1] ?? null; @endphp
                <div class="flex flex-col gap-3 p-4 bg-slate-50 border border-amber-300 rounded-2xl">
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-600">Foto {{ $i }}</span>

                    {{-- Thumbnail foto saat ini --}}
                    @if ($existingSlide)
                        <img src="{{ Storage::url($existingSlide) }}"
                             alt="Foto {{ $i }}"
                             class="w-full h-32 object-cover rounded-xl border border-amber-300 shadow-sm">
                        <p class="text-[9px] text-amber-600 font-semibold">↑ Foto saat ini. Upload baru untuk mengganti.</p>
                    @else
                        <div class="w-full h-32 rounded-xl border-2 border-dashed border-amber-300 flex items-center justify-center text-slate-300">
                            <span class="text-[10px] font-semibold">Kosong</span>
                        </div>
                    @endif

                    <input type="file" name="slide_{{ $i }}" id="slide_edit_{{ $i }}" accept="image/*"
                        class="text-xs text-slate-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-bold file:bg-amber-50 file:text-amber-800 hover:file:bg-amber-100 cursor-pointer w-full">
                    <p class="text-[9px] text-slate-400">Biarkan kosong jika tidak ingin mengubah.</p>
                </div>
                @endfor
            </div>
        </div>

        {{-- Highlights --}}
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Highlights / Keunggulan (pisah per baris)</label>
            <textarea name="highlights" id="edit_highlights" rows="4" class="w-full bg-slate-50 border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all">{{ old('highlights', is_array($service->highlights) ? implode("\n", $service->highlights) : '') }}</textarea>
        </div>

        {{-- Paket --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="p-6 bg-slate-50 border border-amber-300 rounded-2xl">
                <h5 class="text-[11px] font-black uppercase tracking-widest text-slate-800 mb-4 pb-2 border-b border-amber-300">Paket 1 (Basic / Silver)</h5>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1">Judul Paket</label>
                        <input type="text" name="col1_title" value="{{ old('col1_title', $service->col1['title'] ?? '') }}" class="w-full bg-white border border-amber-300 rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1">Harga Coret (Lama)</label>
                            <input type="text" name="col1_old" value="{{ old('col1_old', $service->col1['old'] ?? '') }}" class="w-full bg-white border border-amber-300 rounded-xl px-3 py-2 text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-slate-500 mb-1">Harga Baru</label>
                            <input type="text" name="col1_new" value="{{ old('col1_new', $service->col1['new'] ?? '') }}" class="w-full bg-white border border-amber-300 rounded-xl px-3 py-2 text-xs">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-slate-500 mb-1">Fitur Paket (Pisah per baris)</label>
                        <textarea name="col1_features" rows="5" class="w-full bg-white border border-amber-300 rounded-xl px-3 py-2 text-xs">{{ old('col1_features', isset($service->col1['features']) && is_array($service->col1['features']) ? implode("\n", $service->col1['features']) : '') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="p-6 bg-amber-50/50 border border-amber-200 rounded-2xl">
                <h5 class="text-[11px] font-black uppercase tracking-widest text-amber-900 mb-4 pb-2 border-b border-amber-200/50">Paket 2 (Premium / Gold)</h5>
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-amber-700 mb-1">Judul Paket</label>
                        <input type="text" name="col2_title" value="{{ old('col2_title', $service->col2['title'] ?? '') }}" class="w-full bg-white border border-amber-200 rounded-xl px-3 py-2 text-xs">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold text-amber-700 mb-1">Harga Coret (Lama)</label>
                            <input type="text" name="col2_old" value="{{ old('col2_old', $service->col2['old'] ?? '') }}" class="w-full bg-white border border-amber-200 rounded-xl px-3 py-2 text-xs">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-amber-700 mb-1">Harga Baru</label>
                            <input type="text" name="col2_new" value="{{ old('col2_new', $service->col2['new'] ?? '') }}" class="w-full bg-white border border-amber-200 rounded-xl px-3 py-2 text-xs">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-amber-700 mb-1">Fitur Paket (Pisah per baris)</label>
                        <textarea name="col2_features" rows="5" class="w-full bg-white border border-amber-200 rounded-xl px-3 py-2 text-xs">{{ old('col2_features', isset($service->col2['features']) && is_array($service->col2['features']) ? implode("\n", $service->col2['features']) : '') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-4 border-t border-amber-300 pt-6">
            <button type="submit" id="btn-update-layanan" class="bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] py-3.5 px-8 rounded-2xl transition-all shadow-md active:scale-95">Update Layanan</button>
            <a href="{{ route('admin.services.index') }}" class="text-slate-500 hover:text-slate-700 font-bold text-xs">Batal</a>
        </div>
    </form>
</div>
@endsection

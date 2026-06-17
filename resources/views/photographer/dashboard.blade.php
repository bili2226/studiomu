@extends('layouts.dashboard')

@section('title', 'Jadwal Fotografi')

@section('sidebar')
    <a href="{{ url('/photographer/jadwal') }}" class="sidebar-item sidebar-item-active flex items-center px-6 py-4 rounded-2xl mx-2">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        Jadwal Saya
    </a>
@endsection

@section('content')
    <div class="flex flex-col sm:flex-row gap-6 justify-between sm:items-center mb-12 animate-fade-in-up">
        <div>
            <h3 class="text-3xl font-serif italic font-bold tracking-tight text-slate-900">Jadwal Harian</h3>
            <p class="text-amber-700 text-[10px] font-black uppercase tracking-[0.3em] mt-2">{{ date('d F Y') }}</p>
        </div>
        <div class="flex flex-wrap gap-4">
            <span class="text-[10px] font-black uppercase tracking-widest bg-emerald-50 text-emerald-800 px-4 py-2 rounded-xl border border-emerald-200 flex items-center gap-2">
                <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                3 Selesai
            </span>
            <span class="text-[10px] font-black uppercase tracking-widest bg-amber-50 text-amber-800 px-4 py-2 rounded-xl border border-amber-200 flex items-center gap-2">
                <span class="w-2 h-2 bg-amber-500 rounded-full"></span>
                2 Tertunda
            </span>
        </div>
    </div>

    <div class="space-y-6 animate-fade-in-up" style="animation-delay: 0.1s;">
        <!-- Session Card -->
        <div class="bg-white rounded-[2rem] p-6 sm:p-10 flex flex-col md:flex-row md:items-center justify-between border border-slate-200 shadow-md shadow-slate-100/80 hover:shadow-lg hover:shadow-slate-200/50 hover:-translate-y-1.5 transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between group gap-6 md:gap-0 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-full blur-2xl group-hover:bg-amber-100/50 transition-all duration-500"></div>
            <div class="flex flex-col sm:flex-row items-center sm:text-left text-center gap-6 sm:gap-12 relative z-10">
                <div class="sm:pr-12 sm:border-r border-slate-200 pb-4 sm:pb-0 border-b sm:border-b-0 w-full sm:w-auto">
                    <p class="text-2xl font-black text-slate-900 font-sans">14:00</p>
                    <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest mt-1">60 MENIT</p>
                </div>
                <div class="flex-1">
                    <h4 class="text-lg font-serif italic font-bold text-slate-900 group-hover:text-amber-800 transition-colors">Graduation Session</h4>
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 sm:gap-4 mt-2">
                        <p class="text-[10px] font-bold text-slate-650 uppercase tracking-widest">Klien: <span class="text-slate-900 font-semibold">Siti Aminah</span></p>
                        <span class="hidden sm:inline w-1 h-1 bg-slate-300 rounded-full"></span>
                        <p class="text-[10px] font-black text-amber-800 uppercase tracking-widest bg-amber-50 px-3 py-1 rounded-lg border border-amber-200">Studio A</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 border-t border-slate-100 pt-4 md:pt-0 md:border-t-0 w-full md:w-auto relative z-10">
                <button class="text-[10px] font-black uppercase tracking-widest text-slate-650 hover:text-amber-800 transition-colors border-b-2 border-transparent hover:border-amber-800 pb-1 w-full sm:w-auto">Lihat Detail</button>
                <button class="bg-amber-600 hover:bg-amber-700 text-white border border-amber-600 px-8 sm:px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all shadow-md shadow-amber-900/10 active:scale-95 w-full sm:w-auto">Mulai Sesi</button>
            </div>
        </div>

        <!-- Session Card -->
        <div class="bg-slate-50 rounded-[2rem] p-6 sm:p-10 flex flex-col md:flex-row md:items-center justify-between shadow-sm border border-slate-200 opacity-60 grayscale gap-6 md:gap-0">
            <div class="flex flex-col sm:flex-row items-center sm:text-left text-center gap-6 sm:gap-12">
                <div class="sm:pr-12 sm:border-r border-slate-200 pb-4 sm:pb-0 border-b sm:border-b-0 w-full sm:w-auto">
                    <p class="text-2xl font-black text-slate-600">16:30</p>
                    <p class="text-[10px] font-black text-slate-650 uppercase tracking-widest mt-1">90 MENIT</p>
                </div>
                <div class="flex-1">
                    <h4 class="text-lg font-black text-slate-600">Family Session</h4>
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-3 sm:gap-4 mt-2">
                        <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Klien: Bapak Heru</p>
                        <span class="hidden sm:inline w-1 h-1 bg-slate-300 rounded-full"></span>
                        <p class="text-[10px] font-black text-slate-600 uppercase tracking-widest border border-slate-300 px-3 py-1 rounded-lg">Studio B</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 sm:gap-8 border-t border-slate-200 pt-4 md:pt-0 md:border-t-0 w-full md:w-auto">
                <button class="text-[10px] font-black uppercase tracking-widest text-slate-600 border-b-2 border-transparent pb-1 w-full sm:w-auto cursor-not-allowed" disabled>Lihat Detail</button>
                <button class="bg-slate-100 text-slate-400 border border-slate-200 px-8 sm:px-10 py-4 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] cursor-not-allowed w-full sm:w-auto" disabled>Belum Siap</button>
            </div>
        </div>
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

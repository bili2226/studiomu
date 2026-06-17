@extends('layouts.auth')

@section('title', 'Lupa Sandi')

@section('content')
    <!-- Floating High-Contrast White Card Container -->
    <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-xl p-8 sm:p-10 relative overflow-hidden">
        <!-- Decorative subtle background bloom -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-amber-500/5 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-slate-500/5 rounded-full blur-2xl pointer-events-none"></div>

        {{-- Title --}}
        <div class="mb-8 relative z-10">
            <h2 class="text-3xl font-black tracking-tight text-slate-950 mb-1.5">Lupa Sandi?</h2>
            <p class="text-xs text-slate-600 font-semibold">Masukkan alamat email terdaftar Anda. Kami akan mengirimkan tautan untuk mengatur ulang kata sandi.</p>
        </div>

        @if (session('status'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl relative z-10">
                <p class="text-xs font-bold text-emerald-700 flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    {{ session('status') }}
                </p>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl relative z-10">
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-xs font-bold text-red-600 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-5 relative z-10">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-[11px] font-black uppercase tracking-[0.18em] text-slate-700 mb-2">
                    Alamat Email
                </label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-600 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                        </svg>
                    </span>
                    <input type="email" name="email" id="email" required value="{{ old('email', request()->email) }}"
                        placeholder="nama@email.com"
                        class="auth-input">
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full py-3.5 px-6 rounded-xl font-black text-[11px] uppercase tracking-[0.18em] text-white flex items-center justify-center gap-2.5 transition-all transform hover:scale-[1.015] active:scale-[0.98] shadow-lg mt-2"
                style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%); box-shadow: 0 8px 24px rgba(180,83,9,0.15);">
                Kirim Tautan Reset
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </button>
        </form>

        {{-- Switch to Login --}}
        <div class="mt-8 text-center relative z-10 border-t border-slate-200 pt-6">
            <a href="{{ route('login') }}"
                class="w-full inline-flex items-center justify-center gap-2 py-3 px-6 rounded-xl border-2 border-slate-300 text-slate-700 font-black text-[11px] uppercase tracking-[0.18em] hover:bg-slate-50 hover:text-slate-950 hover:border-slate-400 transition-all duration-200">
                Kembali ke Login
            </a>
        </div>
    </div>
@endsection

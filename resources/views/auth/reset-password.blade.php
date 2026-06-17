@extends('layouts.auth')

@section('title', 'Reset Kata Sandi')

@section('content')
    <!-- Floating High-Contrast White Card Container -->
    <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-xl p-8 sm:p-10 relative overflow-hidden">
        <!-- Decorative subtle background bloom -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-amber-500/5 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-slate-500/5 rounded-full blur-2xl pointer-events-none"></div>

        {{-- Title --}}
        <div class="mb-8 relative z-10">
            <h2 class="text-3xl font-black tracking-tight text-slate-950 mb-1.5">Reset Sandi</h2>
            <p class="text-xs text-slate-650 font-semibold">Silakan masukkan kata sandi baru Anda untuk memperbarui akses akun.</p>
        </div>

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

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4 relative z-10">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $token }}">

            {{-- Alamat Email --}}
            <div>
                <label for="email" class="block text-[11px] font-black uppercase tracking-[0.18em] text-slate-700 mb-1.5">
                    Alamat Email
                </label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-600 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                        </svg>
                    </span>
                    <input type="email" name="email" id="email" required value="{{ old('email', $email) }}"
                        placeholder="nama@email.com" readonly
                        class="auth-input bg-slate-50 text-slate-500 cursor-not-allowed">
                </div>
            </div>

            {{-- Kata Sandi Baru --}}
            <div>
                <label for="password" class="block text-[11px] font-black uppercase tracking-[0.18em] text-slate-700 mb-1.5">
                    Kata Sandi Baru
                </label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-600 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" required
                        placeholder="Minimal 8 karakter"
                        class="auth-input auth-input-pr">
                    <button type="button" onclick="togglePassword('password', 'eye-pw')"
                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800 transition-colors p-0.5">
                        <svg id="eye-pw" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.301 8.844 6.136 6 10.15 6c3.992 0 6.827 2.844 8.09 6.322a1.012 1.012 0 0 1 0 .644C16.927 15.156 14.092 18 10.15 18c-3.992 0-6.827-2.844-8.09-6.322Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Konfirmasi Kata Sandi Baru --}}
            <div>
                <label for="password_confirmation" class="block text-[11px] font-black uppercase tracking-[0.18em] text-slate-700 mb-1.5">
                    Konfirmasi Sandi Baru
                </label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-600 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/>
                        </svg>
                    </span>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        placeholder="Ulangi kata sandi baru"
                        class="auth-input auth-input-pr">
                    <button type="button" onclick="togglePassword('password_confirmation', 'eye-confirm')"
                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800 transition-colors p-0.5">
                        <svg id="eye-confirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.301 8.844 6.136 6 10.15 6c3.992 0 6.827 2.844 8.09 6.322a1.012 1.012 0 0 1 0 .644C16.927 15.156 14.092 18 10.15 18c-3.992 0-6.827-2.844-8.09-6.322Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Submit Button --}}
            <button type="submit"
                class="w-full py-3.5 px-6 rounded-xl font-black text-[11px] uppercase tracking-[0.18em] text-white flex items-center justify-center gap-2.5 transition-all transform hover:scale-[1.015] active:scale-[0.98] shadow-lg mt-2"
                style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%); box-shadow: 0 8px 24px rgba(180,83,9,0.15);">
                Perbarui Kata Sandi
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </button>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>`;
        } else {
            input.type = 'password';
            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.301 8.844 6.136 6 10.15 6c3.992 0 6.827 2.844 8.09 6.322a1.012 1.012 0 0 1 0 .644C16.927 15.156 14.092 18 10.15 18c-3.992 0-6.827-2.844-8.09-6.322Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>`;
        }
    }
</script>
@endsection

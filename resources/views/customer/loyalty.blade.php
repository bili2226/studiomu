@extends('layouts.dashboard')

@section('title', 'Poin Loyalitas')

@section('sidebar')
    <a href="{{ url('/menu-utama') }}" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
        </svg>
        <span>Dashboard</span>
    </a>
    <a href="{{ route('customer.history') }}" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008ZM0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
        </svg>
        <span>Riwayat Booking</span>
    </a>
    <a href="{{ route('customer.gallery') }}" class="sidebar-item flex items-center px-5 py-3.5 text-slate-500 hover:text-slate-900 transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
        </svg>
        <span>Galeri Foto</span>
    </a>
    <a href="{{ route('customer.loyalty') }}" class="sidebar-item sidebar-item-active flex items-center px-5 py-3.5 transition-all text-white font-black">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
        </svg>
        <span>Poin Loyalitas</span>
    </a>
@endsection

@section('content')
    @php
        $target = 500;
        $pct = min(100, round(($points / $target) * 100));
        $remaining = max(0, $target - $points);
        $tier = 'BRONZE MEMBER';
        $tierColor = 'from-orange-400 to-amber-600';
        $tierClass = 'text-orange-500 bg-orange-50 border-orange-100';
        if ($points >= 400) {
            $tier = 'GOLD MEMBER';
            $tierColor = 'from-yellow-400 to-amber-500';
            $tierClass = 'text-amber-600 bg-amber-50 border-amber-100';
        } elseif ($points >= 150) {
            $tier = 'SILVER MEMBER';
            $tierColor = 'from-slate-300 to-slate-500';
            $tierClass = 'text-slate-600 bg-slate-50 border-slate-200';
        }
    @endphp

    <!-- Loyalty Banner -->
    <div class="bg-gradient-to-br from-primary-950 via-[#0c4a6e] to-primary-950 text-white p-8 sm:p-12 border border-primary-300 rounded-[2.5rem] shadow-2xl mb-8 relative overflow-hidden animate-fade-in-up">
        <div class="absolute -right-10 -top-10 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-10 -bottom-10 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-3xl">
            <span class="inline-flex items-center px-3 py-1 bg-white/10 backdrop-blur-md text-[#D4AF37] text-[8px] font-black uppercase tracking-[0.25em] rounded-md mb-4 border border-white/10">
                Program Loyalitas Klien
            </span>
            <h2 class="text-3xl sm:text-5xl font-serif italic font-bold tracking-tight mb-4">Poin Loyalitas Anda</h2>
            <p class="text-slate-350 text-xs sm:text-sm font-medium tracking-wide leading-relaxed">
                Setiap kali Anda memesan sesi foto di Studio.mu, Anda mengumpulkan poin loyalitas yang dapat ditukarkan dengan berbagai voucher potongan harga menarik untuk pemesanan berikutnya.
            </p>
        </div>
    </div>

    <!-- Points Summary Card & Tiers Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-stretch">
        <!-- Summary Points Box -->
        <div class="lg:col-span-5 bg-white border border-primary-300 rounded-[2.2rem] p-8 shadow-md flex flex-col justify-between relative overflow-hidden">
            <div class="absolute right-[-15px] top-[-15px] w-24 h-24 bg-primary-500/5 rounded-full blur-xl"></div>
            <div>
                <div class="flex justify-between items-center mb-6">
                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-400">Total Akumulasi Poin</span>
                    <span class="px-3 py-1 bg-gradient-to-r {{ $tierColor }} text-white text-[8px] font-black uppercase tracking-widest rounded shadow-sm">{{ $tier }}</span>
                </div>
                <div class="flex items-baseline gap-1">
                    <h3 class="text-6xl font-serif italic font-bold text-slate-900">{{ number_format($points) }}</h3>
                    <span class="text-slate-400 text-xs font-black uppercase tracking-widest font-sans">pts</span>
                </div>
                <p class="text-[11px] text-slate-500 font-semibold mt-2 leading-relaxed">Tingkatkan terus pemesanan Anda untuk mencapai level keanggotaan yang lebih tinggi!</p>
            </div>
            <div class="mt-8">
                <div class="flex justify-between text-[9px] font-black uppercase tracking-wider text-slate-500 mb-2">
                    <span>{{ $pct }}% Menuju Free Booking Target</span>
                    <span class="text-primary-600 font-black">{{ $remaining }} Pts Lagi</span>
                </div>
                <div class="w-full bg-slate-100 h-2 rounded-full overflow-hidden border border-slate-200">
                    <div class="bg-gradient-to-r from-primary-500 to-[#0c4a6e] h-full rounded-full" style="width: {{ $pct }}%"></div>
                </div>
            </div>
        </div>

        <!-- Member Tiers Info -->
        <div class="lg:col-span-7 bg-white border border-primary-300 rounded-[2.2rem] p-8 shadow-md flex flex-col justify-between">
            <div>
                <h4 class="text-xs font-black uppercase tracking-widest text-slate-500 mb-4 pb-2 border-b border-slate-100">Level Keanggotaan & Keuntungan</h4>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <!-- Bronze -->
                    <div class="p-4 rounded-2xl border {{ $points < 150 ? 'border-primary-500 bg-primary-50/20' : 'border-slate-100 bg-slate-50/50' }} flex flex-col justify-between">
                        <div>
                            <span class="inline-flex px-2 py-0.5 text-[8px] font-black uppercase tracking-wider bg-orange-50 text-orange-600 border border-orange-100 rounded mb-2">Bronze</span>
                            <h5 class="text-xs font-bold text-slate-900 tracking-wide uppercase">0 - 149 Pts</h5>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-2 font-medium leading-relaxed">Status dasar. Kumpulkan poin dari setiap transaksi pemesanan sesi foto pertama Anda.</p>
                    </div>
                    <!-- Silver -->
                    <div class="p-4 rounded-2xl border {{ ($points >= 150 && $points < 400) ? 'border-primary-500 bg-primary-50/20' : 'border-slate-100 bg-slate-50/50' }} flex flex-col justify-between">
                        <div>
                            <span class="inline-flex px-2 py-0.5 text-[8px] font-black uppercase tracking-wider bg-slate-100 text-slate-600 border border-slate-200 rounded mb-2">Silver</span>
                            <h5 class="text-xs font-bold text-slate-900 tracking-wide uppercase">150 - 399 Pts</h5>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-2 font-medium leading-relaxed">Keanggotaan menengah. Mulai dapat menukarkan poin dengan voucher diskon sedang.</p>
                    </div>
                    <!-- Gold -->
                    <div class="p-4 rounded-2xl border {{ $points >= 400 ? 'border-primary-500 bg-primary-50/20' : 'border-slate-100 bg-slate-50/50' }} flex flex-col justify-between">
                        <div>
                            <span class="inline-flex px-2 py-0.5 text-[8px] font-black uppercase tracking-wider bg-amber-50 text-amber-700 border border-amber-100 rounded mb-2">Gold Member</span>
                            <h5 class="text-xs font-bold text-slate-900 tracking-wide uppercase">400+ Pts</h5>
                        </div>
                        <p class="text-[10px] text-slate-500 mt-2 font-medium leading-relaxed">Keanggotaan eksklusif tertinggi. Tukarkan poin dengan potongan harga besar atau gratis sesi foto.</p>
                    </div>
                </div>
            </div>
            <p class="text-[10px] text-slate-400 mt-4 leading-relaxed font-semibold">Catatan: Penghitungan poin didasarkan pada total nilai transaksi yang diselesaikan. Nilai kelipatan poin dapat dikonfigurasi oleh admin.</p>
        </div>
    </div>

    <!-- Point History & Reward Catalog Tabs/Sections -->
    <div class="grid grid-cols-1 xl:grid-cols-12 gap-8 items-start mb-12">
        <!-- Point Transactions History -->
        <div class="xl:col-span-5 bg-white border border-primary-300 rounded-[2.2rem] p-7 shadow-md">
            <h4 class="text-xs font-black uppercase tracking-widest text-slate-800 mb-6 pb-2.5 border-b border-slate-100">Riwayat Mutasi Poin</h4>
            
            @if($bookings->isEmpty())
                <div class="text-center py-16 text-slate-400">
                    <div class="w-12 h-12 rounded-2xl bg-slate-50 border border-slate-200 flex items-center justify-center mx-auto mb-4 text-slate-400 shadow-sm">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"/>
                        </svg>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider">Belum Ada Riwayat Poin</p>
                    <p class="text-[10px] text-slate-400 mt-1.5 leading-relaxed">Poin yang Anda dapatkan atau gunakan akan terdaftar di sini secara rinci.</p>
                </div>
            @else
                <div class="space-y-4 max-h-[400px] overflow-y-auto pr-1">
                    @foreach($bookings as $booking)
                        <!-- Points Earned -->
                        @if($booking->points_earned > 0)
                            <div class="flex items-start justify-between gap-4 p-3.5 bg-emerald-50/20 border border-emerald-100 rounded-2xl transition-all hover:bg-emerald-50/45">
                                <div class="flex gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="text-[11px] font-bold text-slate-900 leading-snug">Poin Didapat</h5>
                                        <p class="text-[9px] text-slate-400 uppercase tracking-widest mt-0.5">{{ $booking->booking_date->format('d M Y') }} • ID: {{ $booking->id }}</p>
                                        <p class="text-[10px] text-slate-500 font-semibold mt-1">Sesi: {{ $booking->service_name }}</p>
                                    </div>
                                </div>
                                <span class="text-emerald-700 font-black text-xs flex-shrink-0 font-sans">+{{ $booking->points_earned }} pts</span>
                            </div>
                        @endif

                        <!-- Points Used -->
                        @if($booking->points_used > 0)
                            <div class="flex items-start justify-between gap-4 p-3.5 bg-amber-50/20 border border-amber-100 rounded-2xl transition-all hover:bg-amber-50/45">
                                <div class="flex gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-800 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h5 class="text-[11px] font-bold text-slate-900 leading-snug">Poin Ditukarkan</h5>
                                        <p class="text-[9px] text-slate-400 uppercase tracking-widest mt-0.5">{{ $booking->booking_date->format('d M Y') }} • ID: {{ $booking->id }}</p>
                                        <p class="text-[10px] text-slate-500 font-semibold mt-1">Redeem diskon voucher belanja sesi foto.</p>
                                    </div>
                                </div>
                                <span class="text-amber-700 font-black text-xs flex-shrink-0 font-sans">-{{ $booking->points_used }} pts</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>

        <!-- Reward Catalog list -->
        <div class="xl:col-span-7 bg-white border border-primary-300 rounded-[2.2rem] p-7 shadow-md">
            <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3 mb-6 pb-2.5 border-b border-slate-100">
                <h4 class="text-xs font-black uppercase tracking-widest text-slate-800">Katalog Voucher Reward</h4>
                <span class="inline-flex px-2 py-0.5 text-[9px] font-bold text-slate-500 uppercase tracking-widest">Tukarkan Poin Saat Reservasi</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @forelse($rewards as $reward)
                    @php
                        $canClaim = $points >= $reward->points_required;
                    @endphp
                    <div class="bg-white border border-primary-300 rounded-[1.8rem] p-5 hover:shadow-md transition-all duration-300 relative overflow-hidden flex flex-col justify-between group">
                        <div class="absolute right-[-10px] top-[-10px] w-16 h-16 bg-primary-500/5 rounded-full blur-xl group-hover:bg-primary-500/10 transition-all"></div>
                        <div>
                            <div class="flex justify-between items-start mb-4.5">
                                <span class="inline-flex items-center px-2.5 py-1 bg-amber-50 text-amber-800 text-[8px] font-black uppercase tracking-wider rounded border border-amber-100 shadow-sm">
                                    {{ $reward->points_required }} Pts
                                </span>
                                @if($canClaim)
                                    <span class="px-2 py-0.5 bg-emerald-50 text-emerald-800 text-[8px] font-black uppercase tracking-wider rounded border border-emerald-100 flex items-center gap-1 shadow-sm font-semibold">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 bg-slate-50 text-slate-400 text-[8px] font-black uppercase tracking-wider rounded border border-slate-200 shadow-sm">
                                        Poin Kurang
                                    </span>
                                @endif
                            </div>
                            <h5 class="text-[13px] font-black text-slate-900 leading-snug uppercase tracking-wide group-hover:text-primary-700 transition-colors">{{ $reward->name }}</h5>
                            <p class="text-[10px] text-slate-500 font-semibold leading-relaxed mt-1.5">{{ $reward->description ?: 'Tukarkan poin loyalitas Anda untuk memotong biaya sesi booking foto Anda.' }}</p>
                        </div>
                        <div class="mt-6 pt-3.5 border-t border-slate-100 flex justify-between items-baseline">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Nilai Diskon</span>
                            <span class="text-lg font-black text-amber-800 font-sans">Rp {{ number_format($reward->discount_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Belum Ada Voucher Reward</p>
                        <p class="text-[10px] text-slate-400 mt-1">Nantikan info promo penawaran diskon menarik lainnya dari kami!</p>
                    </div>
                @endforelse
            </div>

            <!-- Redemption Tutorial Box -->
            <div class="mt-6 p-4 bg-sky-50 border border-primary-300 rounded-2xl flex items-start gap-3 text-left">
                <svg class="w-5 h-5 text-primary-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 1 1 .512 1.35h-.487a.75.75 0 0 1-.512-1.35M12 9v.008h-.008V9H12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <div>
                    <h5 class="text-[11px] font-black text-slate-900 uppercase tracking-wide">Cara Menukarkan Reward</h5>
                    <p class="text-[10px] text-slate-500 font-semibold leading-relaxed mt-1">
                        Reward tidak ditukarkan secara manual di sini. Saat Anda melakukan checkout di form pemesanan sesi foto (Booking), Anda dapat memilih voucher diskon yang tersedia untuk langsung memotong harga tagihan sesi foto Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

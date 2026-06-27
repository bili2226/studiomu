@forelse($recentBookings as $booking)
    <div class="relative">
        @php
            $statusColors = [
                'Pending' => 'bg-amber-400 ring-amber-100',
                'Confirmed' => 'bg-blue-500 ring-blue-100',
                'Completed' => 'bg-emerald-500 ring-emerald-100',
                'Cancelled' => 'bg-rose-500 ring-rose-100',
            ];
            $color = $statusColors[$booking->status] ?? 'bg-slate-400 ring-slate-100';
        @endphp
        <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full border-4 border-white ring-4 {{ $color }}"></div>
        <p class="text-[9px] font-bold text-slate-700 uppercase tracking-widest">{{ $booking->created_at->diffForHumans() }}</p>
        <h5 class="text-xs font-bold text-slate-900 mt-1 uppercase tracking-wide">{{ $booking->user->name ?? 'User Terhapus' }}</h5>
        <p class="text-[11px] text-slate-800 mt-0.5 font-medium leading-relaxed">{{ $booking->service_name }} ({{ $booking->status }})</p>
    </div>
@empty
    <p class="text-sm text-white italic">Belum ada aktivitas booking.</p>
@endforelse

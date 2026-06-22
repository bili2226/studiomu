@php
    $currentRoute = request()->path();
    $isServices  = str_starts_with($currentRoute, 'admin/services');
    $isUsers     = str_starts_with($currentRoute, 'admin/users');
    $isBookings  = str_starts_with($currentRoute, 'admin/bookings');
    $isRewards   = str_starts_with($currentRoute, 'admin/rewards');
    $isHolidays  = str_starts_with($currentRoute, 'admin/holidays');
    $isLoyalty   = str_starts_with($currentRoute, 'admin/loyalty');
    $isDashboard = $currentRoute === 'admin/dashboard';
@endphp

<a href="/admin/dashboard" id="btn-overview" class="sidebar-item {{ $isDashboard ? 'sidebar-item-active text-white' : 'text-slate-700 hover:text-slate-900' }} flex items-center w-full px-5 py-3.5 transition-all text-left font-sans text-xs uppercase tracking-[0.18em] font-black mt-1">
    <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
    </svg>
    <span>Overview</span>
</a>

<a href="{{ route('admin.services.index') }}" class="sidebar-item {{ $isServices ? 'sidebar-item-active text-white' : 'text-slate-700 hover:text-slate-900' }} flex items-center w-full px-5 py-3.5 transition-all text-left font-sans text-xs uppercase tracking-[0.18em] font-black mt-1">
    <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
    </svg>
    <span>Kelola Layanan</span>
</a>

<a href="{{ route('admin.bookings.index') }}" class="sidebar-item {{ $isBookings ? 'sidebar-item-active text-white' : 'text-slate-700 hover:text-slate-900' }} flex items-center w-full px-5 py-3.5 transition-all text-left font-sans text-xs uppercase tracking-[0.18em] font-black mt-1">
    <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-5.625-12h17.25c.621 0 1.125.504 1.125 1.125v13.5c0 .621-.504 1.125-1.125 1.125H3.375a1.125 1.125 0 0 1-1.125-1.125V3.375c0-.621.504-1.125 1.125-1.125Z" />
    </svg>
    <span>Kelola Transaksi</span>
</a>

<a href="{{ route('admin.users.index') }}" class="sidebar-item {{ $isUsers ? 'sidebar-item-active text-white' : 'text-slate-700 hover:text-slate-900' }} flex items-center w-full px-5 py-3.5 transition-all text-left font-sans text-xs uppercase tracking-[0.18em] font-black mt-1">
    <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0 1 10.089 18M15 12.75a3.375 3.375 0 1 0 0-6.75 3.375 3.375 0 0 0 0 6.75Zm-8.907 4.966A9.28 9.28 0 0 1 10.09 18c.983 0 1.937-.153 2.836-.435a4.125 4.125 0 0 0-7.833-2.316ZM10.5 12.75a3.375 3.375 0 1 1 0-6.75 3.375 3.375 0 0 1 0 6.75Z" />
    </svg>
    <span>Kelola User</span>
</a>

<a href="{{ route('admin.loyalty.index') }}" class="sidebar-item {{ ($isLoyalty || $isRewards) ? 'sidebar-item-active text-white' : 'text-slate-700 hover:text-slate-900' }} flex items-center w-full px-5 py-3.5 transition-all text-left font-sans text-xs uppercase tracking-[0.18em] font-black mt-1">
    <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0V10.5m-2.25 13.5h13.5c.621 0 1.125-.504 1.125-1.125V11.25c0-.621-.504-1.125-1.125-1.125H5.25c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125Z" />
    </svg>
    <span>Loyalty & Reward</span>
</a>

<a href="{{ route('admin.holidays.index') }}" class="sidebar-item {{ $isHolidays ? 'sidebar-item-active text-white' : 'text-slate-700 hover:text-slate-900' }} flex items-center w-full px-5 py-3.5 transition-all text-left font-sans text-xs uppercase tracking-[0.18em] font-black mt-1">
    <svg class="w-4 h-4 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5" />
    </svg>
    <span>Kelola Hari Libur</span>
</a>

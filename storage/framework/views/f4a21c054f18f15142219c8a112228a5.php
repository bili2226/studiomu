<?php $__env->startSection('title', 'Jadwal Fotografi'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(url('/photographer/jadwal')); ?>" class="sidebar-item sidebar-item-active flex items-center px-6 py-4 rounded-2xl mx-2">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        <span class="font-bold">Jadwal Saya</span>
    </a>
    <a href="<?php echo e(route('photographer.reviews')); ?>" class="sidebar-item flex items-center px-6 py-4 rounded-2xl mx-2 mt-2 text-slate-500 hover:text-slate-900 transition-all">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
        </svg>
        <span class="font-bold">Ulasan Pelanggan</span>
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <?php if(session('success')): ?>
        <div class="mb-6 flex items-center gap-3 px-5 py-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-xs font-semibold animate-fade-in-up">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="mb-6 flex items-center gap-3 px-5 py-4 bg-rose-50 border border-rose-200 rounded-2xl text-rose-700 text-xs font-semibold animate-fade-in-up">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-slate-900 rounded-[2rem] border-[3px] border-black shadow-2xl shadow-slate-900/50 mb-12 animate-fade-in-up overflow-hidden flex flex-col" style="animation-delay: 0.1s;">
        <!-- Header Hitam -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-8 bg-slate-900 border-b-[2.5px] border-black">
            <div>
                <span class="inline-flex items-center px-3 py-1.5 bg-slate-800 text-slate-300 text-[9px] font-black uppercase tracking-[0.2em] rounded-lg mb-2 border border-slate-700">
                    Tugas & Jadwal
                </span>
                <h3 class="text-2xl font-serif italic font-bold tracking-tight text-amber-400">
                    Daftar Sesi Pemotretan
                </h3>
            </div>
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 text-xs font-black text-slate-300">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-amber-500 border border-amber-600"></span>
                        <span class="text-[10px]">Menunggu</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 border border-emerald-600"></span>
                        <span class="text-[10px]">Selesai</span>
                    </div>
                </div>
                <div class="relative w-full sm:w-auto ml-0 sm:ml-2">
                    <select id="booking-time-filter" onchange="filterBookings(this.value)" class="appearance-none w-full sm:w-36 bg-slate-800 border border-slate-700 text-amber-400 text-[9px] font-bold rounded-lg pl-3 pr-8 py-1.5 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/20 cursor-pointer shadow-sm uppercase tracking-wider">
                        <option value="all">Semua Waktu</option>
                        <option value="today">Hari Ini</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="this_year">Tahun Ini</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-amber-500">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="flex-1 w-full" style="background-color: #ffffff !important;">
            <?php if($bookings->isEmpty()): ?>
                <div class="text-center py-16 px-8">
                    <div class="w-16 h-16 border border-slate-200 rounded-[1.2rem] flex items-center justify-center mx-auto mb-4 shadow-sm" style="background-color: #ffffff !important; color: #94a3b8 !important;">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                        </svg>
                    </div>
                    <p class="text-xs font-black uppercase tracking-wider" style="color: #0f172a !important;">Belum Ada Sesi Pemotretan</p>
                    <p class="text-[11px] font-medium mt-1" style="color: #64748b !important;">Anda belum ditugaskan untuk sesi pemotretan apa pun oleh admin.</p>
                </div>
            <?php else: ?>
                <div class="overflow-x-auto w-full">
                    <table class="w-full text-xs border-collapse">
                        <thead style="background-color: #000000 !important;">
                            <tr class="border-b" style="border-color: #000000 !important;">
                                <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-4 pl-8" style="color: #fbbf24 !important;">ID / Waktu</th>
                                <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-4" style="color: #fbbf24 !important;">Layanan & Klien</th>
                                <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-4" style="color: #fbbf24 !important;">Catatan Tambahan</th>
                                <th class="text-center text-[9px] font-black uppercase tracking-widest py-4 pr-4" style="color: #fbbf24 !important;">Status</th>
                                <th class="text-right text-[9px] font-black uppercase tracking-widest py-4 pr-8" style="color: #fbbf24 !important;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="font-semibold">
                            <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $isCompleted = $booking->status === 'Completed';
                                    $isCancelled = $booking->status === 'Cancelled';
                                    $isPending = $booking->status === 'Pending';
                                    $isConfirmed = $booking->status === 'Confirmed';
                                    
                                    $statusClass = 'px-3 py-1 text-[9px] font-black uppercase tracking-widest rounded-full inline-block leading-none shadow-sm';
                                    $statusText = $booking->status;
                                    
                                    if ($isPending) {
                                        $statusClass .= ' bg-amber-500 text-white border-transparent';
                                        $statusText = 'Pending';
                                    } elseif ($isConfirmed) {
                                        $statusClass .= ' bg-sky-500 text-white border-transparent';
                                        $statusText = 'Terkonfirmasi';
                                    } elseif ($isCompleted) {
                                        $statusClass .= ' bg-emerald-500 text-white border-transparent';
                                        $statusText = 'Selesai';
                                    } else {
                                        $statusClass .= ' bg-rose-600 text-white border-transparent';
                                        $statusText = 'Dibatalkan';
                                    }
                                ?>
                                <tr class="group transition-colors border-b" style="border-color: #000000 !important; background-color: <?php echo e($isCompleted || $isCancelled ? '#f8fafc' : '#ffffff'); ?> !important;" data-date="<?php echo e($booking->booking_date->format('Y-m-d')); ?>">
                                    <td class="py-4 pr-4 pl-8 text-xs align-top">
                                        <p class="font-bold font-sans tracking-wide" style="color: #0f172a !important;">BOOK-<?php echo e($booking->id); ?></p>
                                        <p class="mt-2 font-sans font-black" style="color: #475569 !important;"><?php echo e($booking->booking_date->format('d M Y')); ?></p>
                                        <p class="font-medium text-[10px]" style="color: #64748b !important;"><?php echo e($booking->booking_date->format('H.i')); ?> - <?php echo e($booking->booking_date->copy()->addHour()->format('H.i')); ?> WIB</p>
                                    </td>
                                    <td class="py-4 pr-4 text-xs align-top">
                                        <p class="font-bold leading-snug" style="color: #0f172a !important;"><?php echo e($booking->service_name); ?></p>
                                        <p class="text-[10px] font-bold uppercase tracking-wider mt-1" style="color: #64748b !important;">Klien: <span style="color: #1e293b !important;"><?php echo e($booking->user->name ?? 'User Terhapus'); ?></span></p>
                                    </td>
                                    <td class="py-4 pr-4 text-xs align-top">
                                        <?php if($booking->requests): ?>
                                            <p class="text-[10px] font-medium italic mb-1" style="color: #475569 !important;">"<?php echo e($booking->requests); ?>"</p>
                                        <?php endif; ?>
                                        <?php if(!empty($booking->addons) && is_array($booking->addons)): ?>
                                            <div class="flex flex-wrap gap-1 mt-1">
                                                <?php $__currentLoopData = $booking->addons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $addon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php if(($addon['qty'] ?? 0) > 0): ?>
                                                        <span class="inline-flex items-center px-1.5 py-0.5 border rounded text-[9px] font-bold" style="background-color: #f1f5f9 !important; border-color: #e2e8f0 !important; color: #475569 !important;">
                                                            + <?php echo e($addon['name']); ?> (<?php echo e($addon['qty']); ?>x)
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(!$booking->requests && empty($booking->addons)): ?>
                                            <span class="italic text-[10px]" style="color: #94a3b8 !important;">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 pr-4 text-center align-middle">
                                        <span class="<?php echo e($statusClass); ?>"><?php echo e($statusText); ?></span>
                                    </td>
                                    <td class="py-4 text-right pr-8 align-middle">
                                        <div class="flex items-center justify-end gap-2">
                                            <button onclick="showBookingDetail('<?php echo e($booking->id); ?>', '<?php echo e(addslashes($booking->user->name ?? 'User Terhapus')); ?>', '<?php echo e($booking->user->email ?? ''); ?>', '<?php echo e(addslashes($booking->service_name)); ?>', '<?php echo e($booking->booking_date->format('d M Y')); ?>, <?php echo e($booking->booking_date->format('H.i')); ?> - <?php echo e($booking->booking_date->copy()->addHour()->format('H.i')); ?>', '<?php echo e($booking->status); ?>', '<?php echo e(addslashes($booking->requests ?? '')); ?>', '<?php echo e($booking->result_link ?? ''); ?>', '<?php echo e(e(json_encode($booking->addons ?? []))); ?>', '<?php echo e(addslashes($booking->review ?? '')); ?>')" 
                                                class="px-4 py-2 hover:bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-colors cursor-pointer shadow-sm" style="background-color: #1e293b !important;">
                                                Detail
                                            </button>
                                            
                                            <?php if($isConfirmed): ?>
                                                <form action="<?php echo e(route('photographer.bookings.complete', $booking->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan sesi pemotretan ini?')">
                                                    <?php echo csrf_field(); ?>
                                                    <button type="submit" class="px-4 py-2 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-[9px] rounded-full shadow-sm transition-all active:scale-95 cursor-pointer border-none flex items-center gap-1" style="background-color: #10b981 !important;">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/></svg>
                                                        Selesaikan
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Footer Hitam -->
        <div class="h-10 bg-slate-900 border-t-[2.5px] border-black w-full"></div>
    </div>
<?php $__env->stopSection(); ?>


<div id="modal-photographer-detail" class="fixed inset-0 bg-slate-950/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
    <div class="modal-card bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-lg overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col">
        
        <button onclick="closeDetailModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        
        <div class="text-left">
            <div class="border-b border-slate-150 pb-6 mb-6">
                <span class="inline-flex items-center px-3 py-1 bg-amber-50 border border-amber-200 text-amber-800 text-[8px] font-black uppercase tracking-[0.25em] rounded-md mb-2">Detail Sesi Pemotretan</span>
                <h3 id="modal-booking-id" class="text-xl font-serif italic font-bold text-slate-900">#BOOK-XXXX</h3>
            </div>

            <div class="space-y-4 text-xs font-semibold text-slate-800 pb-6 border-b border-slate-100">
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Nama Klien</span>
                    <span id="modal-client-name" class="text-slate-900 font-bold text-right truncate"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Email Klien</span>
                    <span id="modal-client-email" class="text-slate-900 font-bold text-right truncate font-sans"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Layanan / Sesi</span>
                    <span id="modal-service-name" class="text-slate-900 font-bold text-right truncate"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Tanggal Sesi</span>
                    <span id="modal-booking-date" class="text-slate-900 font-bold text-right font-sans"></span>
                </div>
                <div class="flex justify-between items-center gap-3">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px] flex-shrink-0">Status Sesi</span>
                    <span id="modal-booking-status" class="px-2.5 py-0.5 rounded-full text-[8px] font-black tracking-widest uppercase border inline-block leading-none"></span>
                </div>
                <div class="flex flex-col gap-2 pt-2">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px]">Catatan Khusus (Requests)</span>
                    <p id="modal-requests" class="bg-slate-50 border border-slate-200 rounded-xl p-3.5 italic text-slate-700 font-medium leading-relaxed"></p>
                </div>
                <div id="modal-addons-container" class="hidden flex flex-col gap-2 pt-2">
                    <span class="text-slate-500 uppercase tracking-wider text-[9px]">Layanan Tambahan (Add-ons)</span>
                    <div id="modal-addons-list" class="bg-slate-50 border border-slate-200 rounded-xl p-3.5 flex flex-col gap-2 text-slate-700 font-medium"></div>
                </div>
                <div id="modal-review-container" class="hidden flex flex-col gap-2 pt-2">
                    <span class="text-emerald-600 uppercase tracking-wider text-[9px] font-black">Ulasan Evaluasi Klien</span>
                    <p id="modal-review" class="bg-emerald-50 border border-emerald-200 rounded-xl p-3.5 italic text-emerald-800 font-medium leading-relaxed text-xs"></p>
                </div>
            </div>

            <div class="pt-6" id="modal-link-section">
                <form id="modal-link-form" method="POST" action="">
                    <?php echo csrf_field(); ?>
                    <div class="flex flex-col gap-2">
                        <label for="result_link_input" class="text-slate-700 font-black uppercase tracking-wider text-[10px]">Tautan Hasil Foto (Google Drive / Dropbox)</label>
                        <input type="url" name="result_link" id="result_link_input" placeholder="https://drive.google.com/drive/folders/..." required
                            class="w-full px-4 py-3 bg-white border border-amber-300 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 rounded-xl text-xs font-semibold text-slate-950 focus:outline-none transition-all placeholder:font-normal placeholder:text-slate-400">
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-700 hover:to-amber-800 text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-900/10 active:scale-95 mt-6 cursor-pointer border-none">
                        SIMPAN LINK HASIL FOTO
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('scripts'); ?>
<script>
    function showBookingDetail(id, client, email, service, date, status, requests, link, addonsJson, reviewText) {
        document.getElementById('modal-booking-id').textContent = '#' + id;
        document.getElementById('modal-client-name').textContent = client;
        document.getElementById('modal-client-email').textContent = email;
        document.getElementById('modal-service-name').textContent = service;
        document.getElementById('modal-booking-date').textContent = date;
        
        // Status Badge
        const statusLabel = document.getElementById('modal-booking-status');
        let displayStatus = status;
        if (status === 'Confirmed') displayStatus = 'Terkonfirmasi';
        else if (status === 'Completed') displayStatus = 'Selesai';
        else if (status === 'Cancelled') displayStatus = 'Dibatalkan';
        statusLabel.textContent = displayStatus;
        
        statusLabel.className = 'px-2.5 py-1 rounded text-[8px] font-black tracking-widest uppercase border ';
        if (status === 'Pending') statusLabel.className += 'bg-amber-50 text-amber-800 border-amber-200';
        else if (status === 'Confirmed') statusLabel.className += 'bg-sky-50 text-sky-800 border-sky-200';
        else if (status === 'Completed') statusLabel.className += 'bg-emerald-50 text-emerald-800 border-emerald-200';
        else if (status === 'Cancelled') statusLabel.className += 'bg-rose-50 text-rose-800 border-rose-200';

        // Requests
        document.getElementById('modal-requests').textContent = requests ? requests : 'Tidak ada catatan tambahan.';

        // Render Addons
        const addonsContainer = document.getElementById('modal-addons-container');
        const addonsList = document.getElementById('modal-addons-list');
        addonsList.innerHTML = '';
        
        let addons = [];
        try {
            addons = JSON.parse(addonsJson || '[]');
        } catch (e) {
            console.error('Error parsing addons JSON:', e);
        }
        
        let hasActiveAddons = false;
        if (addons && addons.length > 0) {
            addons.forEach(addon => {
                if (addon.qty > 0) {
                    hasActiveAddons = true;
                    const item = document.createElement('div');
                    item.className = 'flex justify-between items-center text-xs font-bold text-slate-800';
                    item.innerHTML = `
                        <span>${addon.name} <span class="text-slate-500 font-medium">x${addon.qty}</span></span>
                        <span class="font-sans">Rp ${(addon.price * addon.qty).toLocaleString('id-ID')}</span>
                    `;
                    addonsList.appendChild(item);
                }
            });
        }
        
        if (hasActiveAddons) {
            addonsContainer.classList.remove('hidden');
        } else {
            addonsContainer.classList.add('hidden');
        }

        // Review Section Setup
        const reviewContainer = document.getElementById('modal-review-container');
        const reviewTextEl = document.getElementById('modal-review');
        if (reviewText) {
            reviewContainer.classList.remove('hidden');
            reviewTextEl.textContent = '"' + reviewText + '"';
        } else {
            reviewContainer.classList.add('hidden');
        }

        // Link Section Form Setup
        const linkSection = document.getElementById('modal-link-section');
        const form = document.getElementById('modal-link-form');
        const input = document.getElementById('result_link_input');

        if (status === 'Cancelled') {
            linkSection.classList.add('hidden');
        } else {
            linkSection.classList.remove('hidden');
            form.action = `/photographer/bookings/${id}/result-link`;
            input.value = link ? link : '';
        }

        openModal('modal-photographer-detail');
    }

    function closeDetailModal() {
        closeModal('modal-photographer-detail');
    }

    function openModal(id) {
        const modal = document.getElementById(id);
        const modalContent = modal.querySelector('.modal-card');

        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');

        setTimeout(() => {
            if (modalContent) {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }
        }, 10);

        document.body.style.overflow = 'hidden';
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        const modalContent = modal.querySelector('.modal-card');

        if (modalContent) {
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
        }

        setTimeout(() => {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        }, 300);
    }
    function filterBookings(filter) {
        const rows = document.querySelectorAll('tbody tr');
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // Calculate start of week (Sunday)
        const startOfWeek = new Date(today);
        startOfWeek.setDate(today.getDate() - today.getDay());
        
        // Calculate end of week (Saturday)
        const endOfWeek = new Date(startOfWeek);
        endOfWeek.setDate(startOfWeek.getDate() + 6);

        rows.forEach(row => {
            const dateStr = row.getAttribute('data-date');
            if (!dateStr) return;

            const rowDate = new Date(dateStr);
            rowDate.setHours(0, 0, 0, 0);
            
            let show = false;

            if (filter === 'all') {
                show = true;
            } else if (filter === 'today') {
                show = rowDate.getTime() === today.getTime();
            } else if (filter === 'this_week') {
                show = rowDate >= startOfWeek && rowDate <= endOfWeek;
            } else if (filter === 'this_month') {
                show = rowDate.getMonth() === today.getMonth() && rowDate.getFullYear() === today.getFullYear();
            } else if (filter === 'this_year') {
                show = rowDate.getFullYear() === today.getFullYear();
            }

            if (show) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/photographer/dashboard.blade.php ENDPATH**/ ?>
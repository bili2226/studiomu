<?php $__env->startSection('title', 'Ulasan Evaluasi'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(url('/menu-utama')); ?>" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
        </svg>
        <span>Dashboard</span>
    </a>
    <a href="<?php echo e(route('customer.history')); ?>" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008ZM0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z"/>
        </svg>
        <span>Riwayat Booking</span>
    </a>
    <a href="<?php echo e(route('customer.gallery')); ?>" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
        </svg>
        <span>Galeri Foto</span>
    </a>
    <a href="<?php echo e(route('customer.loyalty')); ?>" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>
        </svg>
        <span>Poin Loyalitas</span>
    </a>
    <a href="<?php echo e(route('customer.reviews')); ?>" class="sidebar-item sidebar-item-active flex items-center px-5 py-3.5 transition-all text-white font-black">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
        </svg>
        <span>Ulasan Evaluasi</span>
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
    <div>
        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400 mb-1">Evaluasi Anda</p>
        <h1 class="text-2xl font-serif italic font-bold text-slate-900">Ulasan Sesi Pemotretan</h1>
    </div>
    <?php if(!$reviews->isEmpty()): ?>
    <div class="flex items-center gap-2 px-4 py-2 bg-amber-50 border border-amber-200 rounded-xl">
        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
        </svg>
        <span class="text-xs font-black text-amber-800"><?php echo e($reviews->count()); ?> Ulasan Diberikan</span>
    </div>
    <?php endif; ?>
</div>


<div class="bg-white border-2 border-black rounded-[2rem] shadow-[0_12px_40px_rgba(0,0,0,0.03)] mb-12 animate-fade-in-up overflow-hidden flex flex-col">

    
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-8 bg-slate-900 border-b-[2.5px] border-amber-400">
        <div>
            <span class="inline-flex items-center px-3 py-1.5 bg-slate-800 text-slate-300 text-[9px] font-black uppercase tracking-[0.2em] rounded-lg mb-2 shadow-sm border border-slate-700">
                Riwayat Ulasan Anda
            </span>
            <h3 class="text-2xl font-serif italic font-bold tracking-tight text-amber-400">
                Catatan Evaluasi Sesi Foto
            </h3>
        </div>
        <div class="text-[10px] font-black text-slate-400 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
            Ulasan yang sudah Anda kirim
        </div>
    </div>

    
    <div class="p-8 bg-white flex-1">
        <?php if($reviews->isEmpty()): ?>
            
            <div class="text-center py-20 flex flex-col items-center">
                <div class="w-16 h-16 bg-white border-2 border-slate-100 rounded-[1.2rem] flex items-center justify-center text-slate-300 mx-auto mb-5 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                    </svg>
                </div>
                <p class="text-xs text-slate-900 font-black uppercase tracking-wider mb-1">Belum Ada Ulasan</p>
                <p class="text-[11px] text-slate-500 font-medium max-w-xs leading-relaxed">Ulasan yang telah Anda kirimkan melalui halaman Riwayat Booking untuk sesi yang sudah selesai akan muncul di sini.</p>
                <a href="<?php echo e(route('customer.history')); ?>" class="mt-6 inline-flex items-center gap-2 px-5 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-sm active:scale-95">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                    Lihat Riwayat Booking
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="group bg-white border-2 border-slate-100 hover:border-amber-300 rounded-2xl overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300">

                    
                    <div class="bg-slate-900 px-5 py-4 flex items-center justify-between">
                        <div>
                            <span class="inline-block px-2.5 py-1 bg-amber-400/20 text-amber-400 text-[9px] font-black tracking-widest uppercase rounded-lg border border-amber-400/30">#<?php echo e($review->id); ?></span>
                        </div>
                        <div class="text-right">
                            <span class="text-[9px] text-slate-500 block">Dikirim</span>
                            <span class="text-[10px] font-black text-emerald-400 block"><?php echo e($review->updated_at->format('d M Y')); ?></span>
                        </div>
                    </div>

                    
                    <div class="p-5 space-y-4">
                        
                        <div class="border-b border-slate-100 pb-4">
                            <h3 class="font-black text-slate-900 text-sm leading-snug"><?php echo e($review->service_name); ?></h3>
                            <div class="flex flex-wrap items-center gap-3 mt-2">
                                <div class="flex items-center gap-1.5 text-[10px] text-slate-500 font-semibold">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5"/></svg>
                                    <?php echo e($review->booking_date->format('d M Y, H:i')); ?> WIB
                                </div>
                                <div class="flex items-center gap-1.5 text-[10px] text-slate-500 font-semibold">
                                    <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                                    <?php echo e($review->photographer->name ?? 'Belum Ditugaskan'); ?>

                                </div>
                            </div>
                        </div>

                        
                        <div class="relative bg-slate-50 border border-slate-200 rounded-xl p-4 group-hover:border-amber-200 group-hover:bg-amber-50/30 transition-colors duration-300">
                            
                            <div class="absolute -top-3 left-4 w-6 h-6 bg-slate-900 rounded-full flex items-center justify-center shadow-md">
                                <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-slate-700 italic leading-relaxed pt-1">"<?php echo e($review->review); ?>"</p>
                        </div>

                        
                        <div class="flex items-center justify-between pt-1">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[9px] font-black uppercase tracking-wider rounded-xl">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Sesi Selesai
                            </span>
                            <span class="text-[10px] text-slate-400 font-semibold">
                                Rp <?php echo e(number_format($review->amount, 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="h-10 bg-slate-900 border-t-[2.5px] border-amber-400 w-full"></div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/customer/reviews.blade.php ENDPATH**/ ?>
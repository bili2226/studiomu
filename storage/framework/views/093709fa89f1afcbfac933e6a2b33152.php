<?php $__env->startSection('title', 'Ulasan Pelanggan'); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-slate-900 rounded-[2rem] border-[3px] border-black shadow-2xl shadow-slate-900/50 mb-12 animate-fade-in-up overflow-hidden flex flex-col">
    <!-- Header Hitam -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-8 bg-slate-900 border-b-[2.5px] border-black">
        <div>
            <span class="inline-flex items-center px-3 py-1.5 bg-slate-800 text-slate-300 text-[9px] font-black uppercase tracking-[0.2em] rounded-lg mb-2 border border-slate-700">
                Manajemen Evaluasi
            </span>
            <h3 class="text-2xl font-serif italic font-bold tracking-tight text-amber-400">
                Daftar Ulasan Pelanggan
            </h3>
        </div>
    </div>

    <!-- Konten Putih -->
    <div class="bg-white p-0 sm:p-0 flex-1 relative">
        <?php if($reviews->isEmpty()): ?>
            <div class="text-center py-20 px-6">
                <div class="w-16 h-16 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z"/></svg>
                </div>
                <p class="text-xs font-black uppercase tracking-wider text-slate-900">Belum Ada Ulasan</p>
                <p class="text-[11px] font-medium mt-1 text-slate-500">Ulasan akan muncul di sini setelah pelanggan menyelesaikan sesi dan mengirim evaluasi.</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto w-full">
                <table class="w-full text-xs border-collapse">
                    <thead style="background-color: #000000 !important;">
                        <tr class="border-b" style="border-color: #000000 !important;">
                            <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-4 pl-8 w-32" style="color: #fbbf24 !important;">ID Sesi / Waktu</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-4" style="color: #fbbf24 !important;">Layanan & Pelanggan</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-4" style="color: #fbbf24 !important;">Fotografer</th>
                            <th class="text-left text-[9px] font-black uppercase tracking-widest py-4 pr-8" style="color: #fbbf24 !important;">Ulasan / Masukan</th>
                        </tr>
                    </thead>
                    <tbody class="font-semibold text-slate-800">
                        <?php $__currentLoopData = $reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="group hover:bg-slate-50/60 transition-colors border-b border-black last:border-0">
                            
                            <td class="py-4 pr-4 pl-8 align-top">
                                <p class="font-bold font-sans tracking-wide text-slate-900">BOOK-<?php echo e($review->id); ?></p>
                                <p class="mt-2 font-sans font-black text-slate-600"><?php echo e($review->updated_at->format('d M Y')); ?></p>
                                <p class="font-medium text-[10px] text-slate-500"><?php echo e($review->updated_at->format('H.i')); ?> WIB</p>
                            </td>

                            
                            <td class="py-4 pr-4 align-top">
                                <p class="font-bold text-slate-900 text-xs leading-snug"><?php echo e($review->service_name); ?></p>
                                <div class="mt-2 flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-amber-100 text-amber-700 flex items-center justify-center text-[10px] font-bold">
                                        <?php echo e(strtoupper(substr($review->user->name ?? '?', 0, 1))); ?>

                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-700 text-[11px] leading-snug"><?php echo e($review->user->name ?? 'User Terhapus'); ?></p>
                                        <p class="text-[9px] text-slate-400 tracking-wide"><?php echo e($review->user->email ?? ''); ?></p>
                                    </div>
                                </div>
                            </td>

                            
                            <td class="py-4 pr-4 align-top">
                                <p class="font-bold text-slate-900 text-[11px]"><?php echo e($review->photographer->name ?? 'Belum Ditugaskan'); ?></p>
                            </td>

                            
                            <td class="py-4 pr-8 align-top">
                                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 relative w-full sm:w-[350px]">
                                    <div class="absolute -top-2 -left-2 w-6 h-6 bg-slate-900 rounded-full flex items-center justify-center shadow-md">
                                        <svg class="w-3 h-3 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                                    </div>
                                    <p class="text-xs font-medium text-slate-700 italic pl-2 leading-relaxed">"<?php echo e($review->review); ?>"</p>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/admin/reviews/index.blade.php ENDPATH**/ ?>
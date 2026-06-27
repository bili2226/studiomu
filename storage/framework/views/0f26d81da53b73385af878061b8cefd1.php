<?php $__empty_1 = true; $__currentLoopData = $recentBookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="relative">
        <?php
            $statusColors = [
                'Pending' => 'bg-amber-400 ring-amber-100',
                'Confirmed' => 'bg-blue-500 ring-blue-100',
                'Completed' => 'bg-emerald-500 ring-emerald-100',
                'Cancelled' => 'bg-rose-500 ring-rose-100',
            ];
            $color = $statusColors[$booking->status] ?? 'bg-slate-400 ring-slate-100';
        ?>
        <div class="absolute -left-[31px] top-0.5 w-4 h-4 rounded-full border-4 border-white ring-4 <?php echo e($color); ?>"></div>
        <p class="text-[9px] font-bold text-slate-700 uppercase tracking-widest"><?php echo e($booking->created_at->diffForHumans()); ?></p>
        <h5 class="text-xs font-bold text-slate-900 mt-1 uppercase tracking-wide"><?php echo e($booking->user->name ?? 'User Terhapus'); ?></h5>
        <p class="text-[11px] text-slate-800 mt-0.5 font-medium leading-relaxed"><?php echo e($booking->service_name); ?> (<?php echo e($booking->status); ?>)</p>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <p class="text-sm text-white italic">Belum ada aktivitas booking.</p>
<?php endif; ?>
<?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/admin/partials/recent_bookings.blade.php ENDPATH**/ ?>
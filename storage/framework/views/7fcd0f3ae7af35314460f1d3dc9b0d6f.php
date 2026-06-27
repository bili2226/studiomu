<?php $__env->startSection('title', 'Tambah ' . ucfirst($role)); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12" style="border: 4px solid black !important;">

    
    <div class="p-6 sm:p-8 border-b border-slate-200 bg-slate-900 flex items-center justify-between">
        <div>
            <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-400 mb-1">Tambah Akun Baru</h4>
            <h2 class="text-2xl font-serif italic font-bold text-amber-400">Tambah Akun Pengguna</h2>
        </div>
        <a href="<?php echo e(route('admin.users.index', ['role' => $role])); ?>"
            class="flex items-center gap-2 text-slate-400 hover:text-white font-bold text-xs transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
            Kembali
        </a>
    </div>

    <form action="<?php echo e(route('admin.users.store')); ?>" method="POST" class="p-6 sm:p-8">
        <?php echo csrf_field(); ?>

        <?php if($errors->any()): ?>
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-700 text-xs font-semibold">
                <ul class="list-disc pl-5 space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <div class="mb-8">
            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-3">Role Akun</label>
            <div class="grid grid-cols-3 gap-3">
                <?php $__currentLoopData = ['admin' => 'Admin', 'photographer' => 'Fotografer', 'customer' => 'Customer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="flex items-center gap-3 p-4 rounded-2xl cursor-pointer transition-all
                    <?php echo e(old('role', $role) === $val
                        ? 'bg-slate-100 ring-2 ring-black/10'
                        : 'bg-white hover:bg-slate-50'); ?>"
                    style="border: 2px solid black !important;">
                    <input type="radio" name="role" value="<?php echo e($val); ?>"
                        <?php echo e(old('role', $role) === $val ? 'checked' : ''); ?>

                        class="accent-slate-900 w-4 h-4 flex-shrink-0">
                    <div>
                        <?php if($val === 'admin'): ?>
                            <div class="w-6 h-6 rounded-full bg-violet-100 flex items-center justify-center mb-1">
                                <svg class="w-3 h-3 text-violet-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            </div>
                        <?php elseif($val === 'photographer'): ?>
                            <div class="w-6 h-6 rounded-full bg-sky-100 flex items-center justify-center mb-1">
                                <svg class="w-3 h-3 text-sky-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                        <?php else: ?>
                            <div class="w-6 h-6 rounded-full bg-amber-100 flex items-center justify-center mb-1">
                                <svg class="w-3 h-3 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                        <?php endif; ?>
                        <p class="text-[10px] font-black text-slate-800"><?php echo e($label); ?></p>
                    </div>
                </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Nama Lengkap</label>
                <input type="text" name="name" id="user_name" value="<?php echo e(old('name')); ?>" required
                    class="w-full bg-white shadow-sm rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all focus:ring-4 focus:ring-black/10"
                    style="border: 2px solid black !important;"
                    placeholder="Nama lengkap">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Email</label>
                <input type="email" name="email" id="user_email" value="<?php echo e(old('email')); ?>" required
                    class="w-full bg-white shadow-sm rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all focus:ring-4 focus:ring-black/10"
                    style="border: 2px solid black !important;"
                    placeholder="email@example.com">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Password</label>
                <input type="password" name="password" id="user_password" required minlength="6"
                    class="w-full bg-white shadow-sm rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all focus:ring-4 focus:ring-black/10"
                    style="border: 2px solid black !important;"
                    placeholder="Minimal 6 karakter">
                <p class="text-[10px] text-slate-400 mt-1.5">Pastikan password kuat dan mudah diingat.</p>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-2">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required minlength="6"
                    class="w-full bg-white shadow-sm rounded-xl px-4 py-3 text-xs focus:outline-none font-semibold text-slate-900 transition-all focus:ring-4 focus:ring-black/10"
                    style="border: 2px solid black !important;"
                    placeholder="Ketik ulang password">
            </div>
        </div>

        <div class="flex items-center gap-4 border-t border-slate-800 bg-slate-900 p-6 sm:p-8 -mx-6 sm:-mx-8 -mb-6 sm:-mb-8 mt-8">
            <button type="submit" id="btn-simpan-user"
                class="bg-amber-400 hover:bg-amber-500 text-slate-900 font-black uppercase tracking-widest text-[10px] py-3.5 px-8 rounded-2xl transition-all shadow-md active:scale-95">
                Tambah Akun
            </button>
            <a href="<?php echo e(route('admin.users.index', ['tab' => $role])); ?>" class="text-slate-400 hover:text-white font-bold text-xs">Batal</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/admin/users/create.blade.php ENDPATH**/ ?>
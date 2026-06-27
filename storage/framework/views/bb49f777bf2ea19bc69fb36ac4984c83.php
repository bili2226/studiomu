<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Floating High-Contrast White Card Container -->
    <div class="bg-white border border-slate-200 rounded-[2.5rem] shadow-xl p-8 sm:p-10 relative overflow-hidden">
        <!-- Decorative subtle background bloom -->
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-amber-500/5 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-slate-500/5 rounded-full blur-2xl pointer-events-none"></div>

        
        <div class="mb-8 relative z-10">
            <h2 class="text-3xl font-black tracking-tight text-slate-950 mb-1.5">Selamat Datang</h2>
            <p class="text-xs text-slate-650 font-semibold">Masuk ke akun Studio.mu Anda untuk melanjutkan.</p>
        </div>

        <?php if(session('status')): ?>
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl relative z-10">
                <p class="text-xs font-bold text-emerald-700 flex items-center gap-2">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                    <?php echo e(session('status')); ?>

                </p>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl relative z-10">
                <ul class="space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="text-xs font-bold text-red-600 flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            <?php echo e($error); ?>

                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-5 relative z-10">
            <?php echo csrf_field(); ?>

            
            <div>
                <label for="email" class="block text-[11px] font-black uppercase tracking-[0.18em] text-slate-750 mb-2">
                    Alamat Email
                </label>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-600 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/>
                        </svg>
                    </span>
                    <input type="email" name="email" id="email" required value="<?php echo e(old('email')); ?>"
                        placeholder="nama@email.com"
                        class="auth-input">
                </div>
            </div>

            
            <div>
                <div class="flex justify-between items-center mb-2">
                    <label for="password" class="block text-[11px] font-black uppercase tracking-[0.18em] text-slate-750">
                        Kata Sandi
                    </label>
                    <a href="<?php echo e(route('password.request')); ?>" class="text-[10px] font-black text-amber-700 hover:text-amber-800 transition-colors uppercase tracking-wide">
                        Lupa Sandi?
                    </a>
                </div>
                <div class="relative">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-600 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"/>
                        </svg>
                    </span>
                    <input type="password" name="password" id="password" required
                        placeholder="••••••••"
                        class="auth-input pr-12">
                    <button type="button" onclick="togglePassword('password', 'eye-login')"
                        class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800 transition-colors p-0.5">
                        <svg id="eye-login" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.301 8.844 6.136 6 10.15 6c3.992 0 6.827 2.844 8.09 6.322a1.012 1.012 0 0 1 0 .644C16.927 15.156 14.092 18 10.15 18c-3.992 0-6.827-2.844-8.09-6.322Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </button>
                </div>
            </div>

            
            <div class="flex items-center">
                <label class="flex items-center gap-2.5 cursor-pointer group">
                    <input type="checkbox" name="remember"
                        class="w-4 h-4 rounded border-slate-350 bg-white text-amber-600 focus:ring-2 focus:ring-amber-500/30 transition-all cursor-pointer accent-amber-600">
                    <span class="text-[11px] font-extrabold text-slate-700 group-hover:text-slate-950 transition-colors uppercase tracking-wide">Ingat Sesi Saya</span>
                </label>
            </div>

            
            <button type="submit"
                class="w-full py-3.5 px-6 rounded-xl font-black text-[11px] uppercase tracking-[0.18em] text-white flex items-center justify-center gap-2.5 transition-all transform hover:scale-[1.015] active:scale-[0.98] shadow-lg mt-2"
                style="background: linear-gradient(135deg, #d97706 0%, #b45309 100%); box-shadow: 0 8px 24px rgba(180,83,9,0.15);">
                Masuk
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </button>
        </form>

        
        <div class="mt-8 text-center relative z-10 border-t border-slate-200 pt-6">
            <p class="text-[11px] text-slate-650 font-bold mb-4">Belum punya akun?</p>
            <a href="<?php echo e(route('register')); ?>"
                class="w-full inline-flex items-center justify-center gap-2 py-3.5 px-6 rounded-xl border-2 border-slate-300 text-slate-750 font-black text-[11px] uppercase tracking-[0.18em] hover:bg-slate-50 hover:text-slate-950 hover:border-slate-400 transition-all duration-200">
                Daftar Akun Baru
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                </svg>
            </a>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88"/>';
        } else {
            input.type = 'password';
            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.301 8.844 6.136 6 10.15 6c3.992 0 6.827 2.844 8.09 6.322a1.012 1.012 0 0 1 0 .644C16.927 15.156 14.092 18 10.15 18c-3.992 0-6.827-2.844-8.09-6.322Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>';
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/auth/login.blade.php ENDPATH**/ ?>
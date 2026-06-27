<?php $__env->startSection('title', 'Admin Workspace'); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div id="tab-panel-overview" class="tab-panel transition-opacity duration-300 opacity-100 block">
        <div class="flex justify-between items-end mb-6">
            <div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight">Ringkasan Studio</h2>
                <p class="text-sm font-medium text-slate-500 mt-1">Performa bisnis secara keseluruhan</p>
            </div>
            <div>
                <select id="timeFilter" onchange="updateFilter(this.value)" class="bg-white border-2 border-slate-300 text-slate-700 text-sm font-bold rounded-xl focus:ring-amber-500 focus:border-amber-500 block w-full p-2.5 shadow-sm cursor-pointer hover:bg-slate-50 transition-colors">
                    <option value="month" <?php echo e(request('filter', 'month') == 'month' ? 'selected' : ''); ?>>Bulan Ini</option>
                    <option value="quarter" <?php echo e(request('filter') == 'quarter' ? 'selected' : ''); ?>>Triwulan Ini</option>
                    <option value="year" <?php echo e(request('filter') == 'year' ? 'selected' : ''); ?>>Tahun Ini (<?php echo e(date('Y')); ?>)</option>
                    <option value="2025" <?php echo e(request('filter') == '2025' ? 'selected' : ''); ?>>Tahun 2025</option>
                    <option value="2024" <?php echo e(request('filter') == '2024' ? 'selected' : ''); ?>>Tahun 2024</option>
                    <option value="2023" <?php echo e(request('filter') == '2023' ? 'selected' : ''); ?>>Tahun 2023</option>
                    <option value="all" <?php echo e(request('filter') == 'all' ? 'selected' : ''); ?>>Semua Waktu</option>
                </select>
            </div>
        </div>
        <!-- Cards Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 mb-12">
            
            <div class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-md shadow-slate-100 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between group">
                <div class="flex justify-between items-start mb-3 relative z-10">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.25em] text-[#D4AF37]">Total Pendapatan</p>
                        <h3 id="stat-revenue" class="text-2xl font-serif italic font-bold mt-2 text-amber-400">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 text-amber-800 flex items-center justify-center border border-amber-200 shadow-sm">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a2.25 2.25 0 0 0-2.25-2.25H15a3 3 0 1 1-6 0H5.25A2.25 2.25 0 0 0 3 12m18 0v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6m18 0V9M3 12V9m18 0a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 9m18 0V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v3" />
                        </svg>
                    </div>
                </div>
            </div>
            
            
            <div class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-md shadow-slate-100 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between group">
                <div class="flex justify-between items-start mb-3 relative z-10">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.25em] text-[#D4AF37]">Booking Pending</p>
                        <h3 id="stat-pending" class="text-2xl font-serif italic font-bold mt-2 text-amber-400"><?php echo e($pendingBookingsCount); ?></h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 text-amber-800 flex items-center justify-center border border-amber-200 shadow-sm">
                        <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </div>
            
            
            <div class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-md shadow-slate-100 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between group">
                <div class="flex justify-between items-start mb-3 relative z-10">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.25em] text-[#D4AF37]">Layanan Aktif</p>
                        <h3 id="stat-services" class="text-2xl font-serif italic font-bold mt-2 text-amber-400"><?php echo e($services->count()); ?></h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 text-amber-800 flex items-center justify-center border border-amber-200 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316A2.192 2.192 0 0 0 14.51 3.75h-5.02a2.192 2.192 0 0 0-1.841.982l-.822 1.316Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5a3.75 3.75 0 1 0 0-7.5 3.75 3.75 0 0 0 0 7.5Z" />
                        </svg>
                    </div>
                </div>
            </div>
            
            
            <div class="bg-white p-7 rounded-[2rem] border border-slate-200 shadow-md shadow-slate-100 hover:shadow-xl hover:shadow-slate-200/60 hover:-translate-y-1.5 transition-all duration-300 relative overflow-hidden flex flex-col justify-between group">
                <div class="flex justify-between items-start mb-3 relative z-10">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.25em] text-[#D4AF37]">Total Poin Beredar</p>
                        <h3 class="text-2xl font-serif italic font-bold mt-2 text-amber-400"><?php echo e(number_format($totalPointsInCirculation, 0, ',', '.')); ?></h3>
                    </div>
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-50 to-violet-100 text-violet-850 flex items-center justify-center border border-violet-200 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-12">
            <!-- Line Chart: Tren Pendapatan -->
            <div class="lg:col-span-8 admin-card-dark bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <p class="text-[9px] font-black uppercase tracking-[0.2em] text-slate-700">Analisis Pendapatan</p>
                        <h4 class="text-lg font-serif italic font-bold text-slate-900 mt-1">Tren Bulanan (<?php echo e(date('Y')); ?>)</h4>
                    </div>
                </div>
                <div class="w-full h-72 relative">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
 
            <!-- Activity Logs Feed -->
            <div class="lg:col-span-4 admin-card-dark bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100 h-full">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] mb-6 text-slate-900">Aktivitas Booking Terbaru</h4>
                <div id="recent-bookings-list" class="space-y-6 relative border-l-2 border-slate-200 pl-6 ml-2">
                    <?php echo $__env->make('admin.partials.recent_bookings', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <!-- Pie Chart: Status Booking -->
            <div class="admin-card-dark bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100">
                <div class="mb-6 text-center">
                    <h4 class="text-sm font-black uppercase tracking-[0.1em] text-slate-900">Distribusi Status</h4>
                </div>
                <div class="w-full h-56 relative flex justify-center">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>

            <!-- Bar Chart: Layanan Terpopuler -->
            <div class="admin-card-dark bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100">
                <div class="mb-6 text-center">
                    <h4 class="text-sm font-black uppercase tracking-[0.1em] text-slate-900">Layanan Terpopuler</h4>
                </div>
                <div class="w-full h-56 relative flex justify-center">
                    <canvas id="serviceChart"></canvas>
                </div>
            </div>

            <!-- Bar Chart: Beban Fotografer -->
            <div class="admin-card-dark bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100">
                <div class="mb-6 text-center">
                    <h4 class="text-sm font-black uppercase tracking-[0.1em] text-slate-900">Kinerja Fotografer</h4>
                </div>
                <div class="w-full h-56 relative flex justify-center">
                    <canvas id="photographerChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div>


    
    <div id="tab-panel-users" class="tab-panel transition-opacity duration-300 opacity-0 hidden">
        <div class="bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12">
            <div class="p-8 sm:p-12 flex flex-col items-center justify-center text-center gap-6 min-h-[320px]">
                <div class="w-16 h-16 rounded-3xl bg-amber-50 border border-amber-200 flex items-center justify-center">
                    <svg class="w-8 h-8 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.109A11.386 11.386 0 0 1 10.089 18M15 12.75a3.375 3.375 0 1 0 0-6.75 3.375 3.375 0 0 0 0 6.75Zm-8.907 4.966A9.28 9.28 0 0 1 10.09 18c.983 0 1.937-.153 2.836-.435a4.125 4.125 0 0 0-7.833-2.316ZM10.5 12.75a3.375 3.375 0 1 1 0-6.75 3.375 3.375 0 0 1 0 6.75Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-serif italic font-bold text-slate-900 mb-2">Kelola User</h2>
                    <p class="text-sm text-slate-500 font-medium max-w-sm">
                        Manajemen akun admin, fotografer, dan customer — termasuk kelola poin loyalty — kini tersedia di halaman tersendiri.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row items-center gap-3">
                    <a href="<?php echo e(route('admin.users.index')); ?>"
                        class="inline-flex items-center gap-2 bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[10px] py-3.5 px-8 rounded-2xl transition-all shadow-md active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
                        Buka Halaman Kelola User
                    </a>
                    <a href="<?php echo e(route('admin.users.create')); ?>"
                        class="inline-flex items-center gap-2 border border-slate-200 hover:border-amber-400 text-slate-600 hover:text-amber-800 font-bold text-[10px] py-3.5 px-6 rounded-2xl transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Tambah User Baru
                    </a>
                </div>
                <div class="grid grid-cols-3 gap-4 w-full max-w-sm mt-2">
                    <div class="text-center p-3 bg-slate-50 rounded-2xl border border-slate-200">
                        <p class="text-xl font-black text-slate-900"><?php echo e($totalUsers); ?></p>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">Total</p>
                    </div>
                    <div class="text-center p-3 bg-slate-50 rounded-2xl border border-slate-200">
                        <p class="text-xl font-black text-slate-900"><?php echo e($totalPhotographers); ?></p>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">Fotografer</p>
                    </div>
                    <div class="text-center p-3 bg-slate-50 rounded-2xl border border-slate-200">
                        <p class="text-xl font-black text-slate-900"><?php echo e($totalCustomers); ?></p>
                        <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400 mt-0.5">Customer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>




    

    
    <div id="modal-user" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="modal-card bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-lg overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col">
            <button onclick="closeUserModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 id="modal-user-title" class="text-2xl font-serif italic font-bold text-slate-900 mb-7">Tambah User Baru</h3>
            <input type="hidden" id="form-user-index">
            <div class="space-y-5">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Nama Pengguna</label>
                    <input type="text" id="form-user-name" class="w-full bg-white shadow-sm border border-slate-200 focus:border-slate-800 focus:ring-4 focus:ring-slate-800/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Email Address</label>
                    <input type="email" id="form-user-email" class="w-full bg-white shadow-sm border border-slate-200 focus:border-slate-800 focus:ring-4 focus:ring-slate-800/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Peran (Role)</label>
                    <select id="form-user-role" class="w-full bg-white shadow-sm border border-slate-200 focus:border-slate-800 focus:ring-4 focus:ring-slate-800/10 rounded-2xl px-4 py-3.5 text-xs font-black uppercase tracking-wider text-slate-750 focus:outline-none cursor-pointer transition-all duration-300">
                        <option value="admin">ADMIN</option>
                        <option value="photographer">PHOTOGRAPHER</option>
                        <option value="customer">CUSTOMER</option>
                    </select>
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Password</label>
                    <input type="password" id="form-user-password" placeholder="Kosongkan jika tidak ingin diubah (default: password)" class="w-full bg-white shadow-sm border border-slate-200 focus:border-slate-800 focus:ring-4 focus:ring-slate-800/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Konfirmasi Password</label>
                    <input type="password" id="form-user-password-confirmation" placeholder="Ulangi password di atas" class="w-full bg-white shadow-sm border border-slate-200 focus:border-slate-800 focus:ring-4 focus:ring-slate-800/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                </div>
            </div>
            <button onclick="saveUser()" class="bg-slate-900 hover:bg-slate-800 text-white font-black uppercase tracking-widest text-[10px] py-4 w-full rounded-2xl transition-all shadow-md shadow-slate-900/10 active:scale-95 mt-8 border border-slate-800">
                SIMPAN DATA USER
            </button>
        </div>
    </div>

    
    <div id="modal-service" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="modal-card bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-3xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col max-h-[90vh] overflow-y-auto">
            <button onclick="closeServiceModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 id="modal-service-title" class="text-2xl font-serif italic font-bold text-slate-900 mb-7">Ubah Detail Layanan</h3>
            <input type="hidden" id="form-service-key">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Form Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Nama Layanan</label>
                        <input type="text" id="form-service-title" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Kategori</label>
                        <input type="text" id="form-service-category" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Mulai Dari Harga (Contoh: "Mulai Rp 850.000")</label>
                        <input type="text" id="form-service-starting" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Deskripsi Layanan</label>
                        <textarea id="form-service-description" rows="2" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Slides Gambar (Satu URL per baris)</label>
                        <textarea id="form-service-slides" rows="2" placeholder="Contoh:&#10;/img/prewedding_showcase.png&#10;https://images.unsplash.com/photo-..." class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Sorotan Utama / Bullet Card (Satu per baris)</label>
                        <textarea id="form-service-highlights" rows="2" placeholder="Contoh:&#10;Full Day Coverage&#10;Cinematic Highlight" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Catatan Layanan (Teks / HTML)</label>
                        <textarea id="form-service-note" rows="2" placeholder="Contoh:&#10;* Reservasi H-1 bulan&#10;* DP minimal 30%" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                </div>

                <!-- Right Form Fields (Packages detail) -->
                <div class="space-y-4 border-t md:border-t-0 md:border-l border-slate-100 pt-4 md:pt-0 md:pl-6">
                    <h4 class="text-[10px] font-black uppercase tracking-[0.15em] text-slate-800 border-b border-slate-100 pb-3 mb-2">Konfigurasi Detail Paket</h4>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-650 uppercase tracking-widest mb-1.5">Judul Paket 1 (Silver)</label>
                        <input type="text" id="form-service-col1-title" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-2">
                        <div>
                            <label class="block text-[9px] font-bold text-slate-650 uppercase tracking-widest mb-1.5">Harga Lama P1 (k)</label>
                            <input type="text" id="form-service-col1-old" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                        </div>
                        <div>
                            <label class="block text-[9px] font-bold text-slate-655 uppercase tracking-widest mb-1.5">Harga Baru P1 (k)</label>
                            <input type="text" id="form-service-col1-new" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-650 uppercase tracking-widest mb-1.5">Fitur/Benefit Paket 1 (Satu per baris)</label>
                        <textarea id="form-service-col1-features" rows="2" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                    
                    <div class="border-t border-slate-100 pt-2">
                        <label class="block text-[9px] font-bold text-slate-650 uppercase tracking-widest mb-1.5">Judul Paket 2 (Gold)</label>
                        <input type="text" id="form-service-col2-title" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                    </div>
                    <div class="grid grid-cols-2 gap-3 mb-2">
                        <div>
                            <label class="block text-[9px] font-bold text-slate-655 uppercase tracking-widest mb-1.5">Harga Lama P2 (k)</label>
                            <input type="text" id="form-service-col2-old" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                        </div>
                        <div>
                            <label class="block text-[9px] font-bold text-slate-655 uppercase tracking-widest mb-1.5">Harga Baru P2 (k)</label>
                            <input type="text" id="form-service-col2-new" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[9px] font-bold text-slate-655 uppercase tracking-widest mb-1.5">Fitur/Benefit Paket 2 (Satu per baris)</label>
                        <textarea id="form-service-col2-features" rows="2" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300"></textarea>
                    </div>
                </div>
            </div>

            <button onclick="saveService()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                SIMPAN DETAIL LAYANAN
            </button>
        </div>
    </div>

    

    
    <div id="alert-toast" class="fixed bottom-6 right-6 z-50 transform translate-y-20 opacity-0 transition-all duration-500 pointer-events-none max-w-sm w-full">
        <div class="bg-white/95 backdrop-blur-md text-slate-900 p-5 rounded-2xl border border-slate-200 shadow-2xl flex items-center gap-4">
            <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
            </div>
            <div>
                <p id="alert-toast-message" class="text-xs font-black uppercase tracking-wider text-slate-800">Perubahan Berhasil Disimpan!</p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    let revenueChart, statusChart, serviceChart, photographerChart;

    // --- CHART INITIALIZATION ---
    function initCharts() {
        try {
            console.log("initCharts started. Chart object:", typeof Chart !== 'undefined' ? Chart : 'undefined');
            
            if (typeof Chart === 'undefined') {
                console.error("Chart.js is not loaded!");
                alert("Gagal memuat Chart.js dari CDN. Pastikan koneksi internet aktif atau CDN tidak diblokir.");
                return;
            }

            // Shared Chart Options
            Chart.defaults.font.family = "'Inter', sans-serif";
            Chart.defaults.color = '#64748b'; // slate-500
            
            if (Chart.defaults.plugins && Chart.defaults.plugins.tooltip) {
                Chart.defaults.plugins.tooltip.backgroundColor = '#1e293b';
                Chart.defaults.plugins.tooltip.padding = 10;
                Chart.defaults.plugins.tooltip.cornerRadius = 8;
            }
            
            console.log("Initializing Revenue Chart...");
            const revElement = document.getElementById('revenueChart');
            if (!revElement) console.error("revenueChart canvas not found!");
            
            // 1. Revenue Chart (Line)
            const ctxRevenue = revElement.getContext('2d');
            const gradientRevenue = ctxRevenue.createLinearGradient(0, 0, 0, 300);
            gradientRevenue.addColorStop(0, 'rgba(217, 119, 6, 0.2)'); // amber-600/20
            gradientRevenue.addColorStop(1, 'rgba(217, 119, 6, 0)');

            revenueChart = new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($monthlyRevenueLabels); ?>,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: <?php echo json_encode($monthlyRevenueData); ?>,
                        borderColor: '#d97706', // amber-600
                        backgroundColor: gradientRevenue,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#d97706',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9', drawBorder: false },
                            ticks: {
                                callback: function(value) {
                                    if (value >= 1000000) return (value / 1000000) + 'Jt';
                                    if (value >= 1000) return (value / 1000) + 'Rb';
                                    return value;
                                }
                            }
                        },
                        x: {
                            grid: { display: false, drawBorder: false }
                        }
                    }
                }
            });

            console.log("Initializing Status Chart...");
            // 2. Status Chart (Doughnut)
            const statusElement = document.getElementById('statusChart');
            if (!statusElement) console.error("statusChart canvas not found!");
            const ctxStatus = statusElement.getContext('2d');
            statusChart = new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($statusLabels ?? []); ?>,
                    datasets: [{
                        data: <?php echo json_encode($statusData ?? []); ?>,
                        backgroundColor: [
                            '#fbbf24', // amber-400 (Pending)
                            '#3b82f6', // blue-500 (Confirmed)
                            '#10b981', // emerald-500 (Completed)
                            '#f43f5e'  // rose-500 (Cancelled)
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
                    }
                }
            });

            console.log("Initializing Service Chart...");
            // 3. Service Popularity (Pie)
            const serviceElement = document.getElementById('serviceChart');
            if (!serviceElement) console.error("serviceChart canvas not found!");
            const ctxService = serviceElement.getContext('2d');
            serviceChart = new Chart(ctxService, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($serviceLabels ?? []); ?>,
                    datasets: [{
                        label: 'Jumlah Booking',
                        data: <?php echo json_encode($serviceData ?? []); ?>,
                        backgroundColor: [
                            '#8b5cf6', // violet-500
                            '#d946ef', // fuchsia-500
                            '#ec4899', // pink-500
                            '#f43f5e', // rose-500
                            '#f97316', // orange-500
                            '#eab308', // yellow-500
                            '#84cc16', // lime-500
                            '#10b981', // emerald-500
                            '#06b6d4', // cyan-500
                            '#3b82f6', // blue-500
                        ],
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20 } }
                    }
                }
            });

            console.log("Initializing Photographer Chart...");
            // 4. Photographer Workload (Bar)
            const photoElement = document.getElementById('photographerChart');
            if (!photoElement) console.error("photographerChart canvas not found!");
            const ctxPhoto = photoElement.getContext('2d');
            photographerChart = new Chart(ctxPhoto, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($photographerLabels ?? []); ?>,
                    datasets: [{
                        label: 'Sesi Diselesaikan',
                        data: <?php echo json_encode($photographerData ?? []); ?>,
                        backgroundColor: '#0ea5e9', // sky-500
                        borderRadius: 6,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    indexAxis: 'y', // Horizontal bar
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        x: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { stepSize: 1 } },
                        y: { grid: { display: false } }
                    }
                }
            });

            console.log("All charts initialized successfully.");
        } catch (error) {
            console.error("Error in initCharts:", error);
            alert("Gagal memuat grafik: " + error.message);
        }
    }        


    // Tab switching engine
    function switchTab(tabId) {
        // Toggle tab panels display
        document.querySelectorAll('.tab-panel').forEach(panel => {
            panel.classList.remove('opacity-100', 'block');
            panel.classList.add('opacity-0', 'hidden');
        });

        const activePanel = document.getElementById(`tab-panel-${tabId}`);
        activePanel.classList.remove('hidden');
        setTimeout(() => {
            activePanel.classList.remove('opacity-0');
            activePanel.classList.add('opacity-100', 'block');
        }, 50);

        // Update active class in sidebar button
        document.querySelectorAll('.sidebar-item').forEach(btn => {
            btn.classList.remove('sidebar-item-active', 'text-white');
            btn.classList.add('text-slate-500');
        });

        const activeBtn = document.getElementById(`btn-${tabId}`);
        if (activeBtn) {
            activeBtn.classList.add('sidebar-item-active', 'text-white');
            activeBtn.classList.remove('text-slate-500');
        }
    }

    // Default Seed Data
    const defaultUsers = [
        { name: 'Admin Studio', email: 'admin@studio.mu', role: 'admin', joined: '2026-01-10' },
        { name: 'Photographer One', email: 'photo@studio.mu', role: 'photographer', joined: '2026-02-15' },
        { name: 'Customer User', email: 'customer@gmail.com', role: 'customer', joined: '2026-03-20' },
        { name: 'Budi Santoso', email: 'budi@gmail.com', role: 'customer', joined: '2026-04-05' },
        { name: 'Siti Aminah', email: 'siti@gmail.com', role: 'customer', joined: '2026-04-12' },
        { name: 'Photographer Two', email: 'photo2@studio.mu', role: 'photographer', joined: '2026-04-18' }
    ];

    const defaultServices = {
        wedding: {
            title: 'Wedding & Pre-Wedding',
            category: 'Wedding & Pre-Wedding',
            starting: 'Mulai Rp 1.500.000',
            description: 'Abadikan janji suci dan kebahagiaan tak ternilai di hari pernikahan Anda dengan sentuhan artistik kami.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Reservasi disarankan dilakukan minimal 1 bulan sebelum hari H</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Biaya transport & akomodasi luar kota :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Ditanggung sepenuhnya oleh klien</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> H-3 konfirmasi rincian akomodasi</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> DP minimal 30% untuk penguncian tanggal jadwal</li>
                </ul>
            `,
            slides: [
                '/img/prewedding_showcase.png',
                'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2069&auto=format&fit=crop'
            ],
            highlights: [
                'Full Day Coverage',
                'Cinematic Highlight',
                'Premium Photo Book'
            ],
            col1: {
                title: 'BASIC PREWEDD',
                old: '1.999k',
                new: '1.500k',
                features: [
                    '2 Background Indoor Studio',
                    '2 Jam Sesi Photo',
                    'Sudah termasuk Photographer & Crew',
                    'Free 20 Edited Photos',
                    'Foto unlimited / sepuasnya',
                    'All Softcopy on Google Drive'
                ]
            },
            col2: {
                title: 'EXCLUSIVE WEDDING',
                old: '3.999k',
                new: '3.200k',
                features: [
                    'Full Day Coverage (10 Jam)',
                    '2 Professional Photographers',
                    'Cinematic Highlight Video (1-3 Min)',
                    '1 Premium Photo Book Exclusive (10R, 20 Halaman)',
                    '50 Edited Photos Pilihan',
                    'All Softcopy in Exclusive USB Drive'
                ]
            }
        },
        graduation: {
            title: 'Wisuda & Akademik',
            category: 'Wisuda & Akademik',
            starting: 'Mulai Rp 850.000',
            description: 'Rayakan pencapaian akademik Anda dengan sesi foto studio yang elegan dan penuh kebanggaan.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Bisa untuk 1 - 2 busana (bawa sendiri)</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Penambahan orang :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Dewasa : 50k</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Anak-anak : 35k</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Diatas 14 orang pakai studio 3 (di lantai atas)</li>
                </ul>
            `,
            slides: [
                '/img/graduation_showcase.png',
                'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop'
            ],
            highlights: [
                'Studio & Outdoor',
                'Family Grouping',
                'Fast Editing'
            ],
            col1: {
                title: 'BEST DEAL',
                old: '1.199k',
                new: '850k',
                features: [
                    '2 Background Studio',
                    '1 Jam Sesi Foto',
                    'Sudah termasuk Photographer',
                    'Max 6 orang (Keluarga Inti)',
                    'Free 15 Edited Photos, edit tone warna',
                    'Foto unlimited / sepuasnya',
                    'All Softcopy on Google drive (berlaku 2 Minggu)'
                ]
            },
            col2: {
                title: 'SPECIAL PACKAGE',
                old: '1.599k',
                new: '1.200k',
                features: [
                    '3 Background Studio + Outdoor Sesi',
                    '2 Jam Sesi Foto',
                    'Sudah termasuk Photographer & Asisten',
                    'Max 10 orang (Keluarga Besar)',
                    '1 Cetak Frame ukuran 16R',
                    '5 pcs Cetak ukuran 5R (tanpa frame)',
                    'Free 25 Edited Photos, edit tone warna',
                    'Foto unlimited / sepuasnya',
                    'All softcopy on Google drive (berlaku 1 Bulan)'
                ]
            }
        },
        commercial: {
            title: 'Komersial & Produk',
            category: 'Komersial & Produk',
            starting: 'Mulai Rp 1.200.000',
            description: 'Tingkatkan nilai brand Anda dengan visual produk yang profesional dan menarik perhatian audiens.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Pengiriman sampel produk minimal H-3 sesi pemotretan</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Penambahan Properti khusus :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Custom backdrop & model : Hubungi admin</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Makanan/Minuman segar disiapkan oleh klien</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Retouching di luar batas revisi dikenakan biaya tambahan</li>
                </ul>
            `,
            slides: [
                '/img/commercial_showcase.png',
                'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=2071&auto=format&fit=crop'
            ],
            highlights: [
                'High-End Retouching',
                'Concept Styling',
                'Professional Lighting'
            ],
            col1: {
                title: 'STARTER KIT',
                old: '1.599k',
                new: '1.200k',
                features: [
                    'Minimalist Concept Styling',
                    '15 Produk Unggulan Sesi',
                    'Sudah termasuk Product Photographer',
                    'High-End Retouching (10 Foto)',
                    'Background Solid / Polos',
                    'All Softcopy via Google Drive'
                ]
            },
            col2: {
                title: 'BRAND CHAMPION',
                old: '2.999k',
                new: '2.400k',
                features: [
                    'Premium Concept & Storyboard',
                    'Unlimited Produk Sesi (4 Jam)',
                    'Model & Talent Friendly Setup',
                    'High-End Retouching (30 Foto)',
                    'Professional Lighting & Studio Rent',
                    'Siap untuk Banner & E-Commerce'
                ]
            }
        },
        family: {
            title: 'Keluarga & Maternity',
            category: 'Family Package',
            starting: 'Mulai Rp 500.000',
            description: 'Abadikan kehangatan kasih sayang keluarga dan perjalanan berharga kehamilan Anda dalam potret penuh makna.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-650 font-bold">•</span> Sesi foto maternity disarankan usia kehamilan 28-34 minggu</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-650 font-bold">•</span> Penambahan orang :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/85 font-bold">›</span> Dewasa : 50k</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/85 font-bold">›</span> Anak-anak : 35k</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-655 font-bold">•</span> Kostum bebas rapi (bawa sendiri)</li>
                </ul>
            `,
            slides: [
                '/img/family_showcase.png',
                'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1609234656388-0ff363383899?q=80&w=2070&auto=format&fit=crop'
            ],
            highlights: [
                'Studio & Home Session',
                'Wardrobe Consultation',
                'High-Res Digital Files'
            ],
            col1: {
                title: 'BEST DEAL',
                old: '699k',
                new: '500k',
                features: [
                    '2 Background Photo',
                    '1 jam Photo Session',
                    'Sudah termasuk Photographer',
                    'Max 6 orang',
                    'Free 10-15 Photo, edit tone warna',
                    'Foto unlimited / sepuasnya',
                    'All Softcopy on Google drive (berlaku 2 Minggu)'
                ]
            },
            col2: {
                title: 'SPECIAL PACKAGE',
                old: '999k',
                new: '800k',
                features: [
                    '2 Background Photo',
                    '1 jam Photo Session',
                    'Sudah termasuk Photographer',
                    'Max 8 orang',
                    '1 cetak Canvas + Frame ukuran 17R / kalau sudah di pasang frame ukurannya 40cm x 50 cm',
                    '5 pcs cetak ukuran 5R (tanpa frame)',
                    'Free 10-20 Photo, edit tone warna',
                    'Foto unlimited / sepuasnya',
                    'All softcopy on drive (berlaku 2 Minggu)'
                ]
            }
        },
        personal: {
            title: 'Potret Pribadi & Branding',
            category: 'Potret Pribadi & Branding',
            starting: 'Mulai Rp 650.000',
            description: 'Tampilkan versi terbaik diri Anda untuk profil profesional, CV, LinkedIn, portofolio model, atau personal branding.',
            note: `
                <ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Sudah termasuk konsultasi pose standar</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Pakaian & Busana ganti :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Klien membawa jas/pakaian formal sendiri</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Disediakan ruang ganti privat yang nyaman</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Tambahan make-up artist profesional disarankan konfirmasi H-3</li>
                </ul>
            `,
            slides: [
                '/img/personal_showcase.png',
                'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2070&auto=format&fit=crop',
                'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=2070&auto=format&fit=crop'
            ],
            highlights: [
                'Corporate Headshot',
                'Model Portfolio',
                'Custom Backdrop'
            ],
            col1: {
                title: 'BASIC PORTRAIT',
                old: '899k',
                new: '650k',
                features: [
                    '1 Background Pilihan',
                    '45 Menit Sesi Foto',
                    'Sudah termasuk Portrait Photographer',
                    'Max 1 orang (Personal)',
                    'Free 5 Edited Photos (LinkedIn Standard)',
                    '1x Pergantian Pakaian',
                    'All Softcopy on Google Drive'
                ]
            },
            col2: {
                title: 'PREMIUM BRANDING',
                old: '1.499k',
                new: '1.100k',
                features: [
                    '3 Pilihan Background',
                    '1.5 Jam Sesi Foto',
                    'Sudah termasuk Senior Photographer',
                    'Max 2 orang',
                    'Free 15 Edited Photos (Premium Retouch)',
                    '3x Pergantian Pakaian',
                    'All softcopy on Google drive'
                ]
            }
        }
    };

    const defaultTransactions = [
        { id: 'BOOK-1001', name: 'Budi Santoso', email: 'budi@gmail.com', service: 'Wedding & Pre-Wedding (EXCLUSIVE)', date: '2026-05-24 09:00', amount: 'Rp 3.200.000', status: 'Pending' },
        { id: 'BOOK-1002', name: 'Siti Aminah', email: 'siti@gmail.com', service: 'Wisuda & Akademik (BEST DEAL)', date: '2026-05-25 13:00', amount: 'Rp 850.000', status: 'Confirmed' },
        { id: 'BOOK-1003', name: 'Customer User', email: 'customer@gmail.com', service: 'Potret Pribadi & Branding (PREMIUM)', date: '2026-05-26 10:00', amount: 'Rp 1.100.000', status: 'Pending' },
        { id: 'BOOK-1004', name: 'Budi Santoso', email: 'budi@gmail.com', service: 'Keluarga & Maternity (SPECIAL)', date: '2026-05-28 15:00', amount: 'Rp 800.000', status: 'Completed' },
        { id: 'BOOK-1005', name: 'Siti Aminah', email: 'siti@gmail.com', service: 'Komersial & Produk (STARTER KIT)', date: '2026-05-30 11:00', amount: 'Rp 1.200.000', status: 'Cancelled' }
    ];

    // Database State Loader
    let users = <?php echo json_encode($allUsers, 15, 512) ?>;
    let transactions = <?php echo json_encode($bookings, 15, 512) ?>;
    let dbRewards = <?php echo json_encode($rewards->where('status', 'active')->values(), 512) ?>;

    // Toast Alert Trigger
    function triggerToast(message) {
        document.getElementById('alert-toast-message').textContent = message;
        const toast = document.getElementById('alert-toast');
        toast.classList.remove('translate-y-20', 'opacity-0');
        toast.classList.add('translate-y-0', 'opacity-100');

        setTimeout(() => {
            toast.classList.remove('translate-y-0', 'opacity-100');
            toast.classList.add('translate-y-20', 'opacity-0');
        }, 3500);
    }

    function updateFilter(val) {
        const url = new URL(window.location.href);
        url.searchParams.set('filter', val);
        window.history.pushState({}, '', url);
        fetchDashboardData();
    }

    // Fetch real-time dashboard data (AJAX Polling)
    function fetchDashboardData() {
        const urlParams = new URLSearchParams(window.location.search);
        const currentFilter = urlParams.get('filter') || document.getElementById('timeFilter').value || 'month';
        
        fetch('/admin/dashboard/data?filter=' + currentFilter)
            .then(res => res.json())
            .then(data => {
                // Update Top Stats
                if (document.getElementById('stat-revenue')) document.getElementById('stat-revenue').textContent = 'Rp ' + Number(data.totalRevenue).toLocaleString('id-ID');
                if (document.getElementById('stat-pending')) document.getElementById('stat-pending').textContent = data.pendingBookingsCount;
                if (document.getElementById('stat-services')) document.getElementById('stat-services').textContent = data.services.length;

                // Update Recent Bookings Feed
                if (document.getElementById('recent-bookings-list') && data.recentBookingsHtml) {
                    document.getElementById('recent-bookings-list').innerHTML = data.recentBookingsHtml;
                }

                // Update Charts
                if (revenueChart) {
                    revenueChart.data.labels = data.monthlyRevenueLabels;
                    revenueChart.data.datasets[0].data = data.monthlyRevenueData;
                    revenueChart.update();
                }
                if (statusChart) {
                    statusChart.data.labels = data.statusLabels;
                    statusChart.data.datasets[0].data = data.statusData;
                    statusChart.update();
                }
                if (serviceChart) {
                    serviceChart.data.labels = data.serviceLabels;
                    serviceChart.data.datasets[0].data = data.serviceData;
                    serviceChart.update();
                }
                if (photographerChart) {
                    photographerChart.data.labels = data.photographerLabels;
                    photographerChart.data.datasets[0].data = data.photographerData;
                    photographerChart.update();
                }
            })
            .catch(err => console.error("Error polling dashboard data:", err));
    }

    // Save functions to Local Storage
    function persistData(key, data) {
        localStorage.setItem(key, JSON.stringify(data));
    }

    // Update Overview Stats values
    function updateOverviewStats() {
        
    }





    /* ─── TAB 4: MANAGE USERS FUNCTIONS ─── */
    function renderUsers() {
        const tbody = document.getElementById('users-table-body');
        if (!tbody) return;
        tbody.innerHTML = '';

        const searchUsersEl = document.getElementById('search-users');
        const searchQuery = searchUsersEl ? searchUsersEl.value.toLowerCase() : '';
        const filterRoleEl = document.getElementById('filter-role');
        const roleFilter = filterRoleEl ? filterRoleEl.value : 'ALL';

        users.forEach((usr, idx) => {
            const matchesSearch = usr.name.toLowerCase().includes(searchQuery) || usr.email.toLowerCase().includes(searchQuery);
            const matchesRole = roleFilter === 'ALL' || usr.role === roleFilter;

            if (matchesSearch && matchesRole) {
                const tr = document.createElement('tr');
                tr.className = 'hover:bg-slate-50 transition-all duration-350 border-b border-black';

                // Unique color badges for roles
                let badgeClass = '';
                let avatarClass = '';
                if (usr.role === 'admin') {
                    badgeClass = 'bg-amber-50 text-amber-800 border-amber-200';
                    avatarClass = 'bg-amber-50 text-amber-800 border border-amber-200 shadow-sm';
                } else if (usr.role === 'photographer') {
                    badgeClass = 'bg-sky-50 text-sky-800 border-sky-200';
                    avatarClass = 'bg-sky-50 text-sky-800 border border-sky-200 shadow-sm';
                } else if (usr.role === 'customer') {
                    badgeClass = 'bg-emerald-50 text-emerald-800 border-emerald-200';
                    avatarClass = 'bg-emerald-50 text-emerald-800 border border-emerald-200 shadow-sm';
                }

                tr.innerHTML = `
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-2xl flex items-center justify-center font-black uppercase text-[12px] ${avatarClass}">
                                ${(usr.name || '').substring(0, 1)}
                            </div>
                            <span class="font-bold text-slate-900 text-[13px] leading-snug">${usr.name}</span>
                        </div>
                    </td>
                    <td class="px-6 py-5 font-semibold text-slate-700 font-sans text-xs">${usr.email}</td>
                    <td class="px-6 py-5">
                        <span class="px-3 py-1.5 text-[9px] font-black uppercase tracking-widest rounded-full border ${badgeClass} inline-block leading-none shadow-sm">
                            ${usr.role}
                        </span>
                    </td>
                    <td class="px-6 py-5 font-semibold text-slate-700 font-sans text-xs">${usr.joined}</td>
                    <td class="px-6 py-5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openEditUserModal(${idx})" class="px-4 py-2 bg-amber-50 text-amber-800 border border-amber-300 hover:bg-amber-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Ubah</button>
                            <button onclick="deleteUser(${idx})" class="px-4 py-2 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Hapus</button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            }
        });
    }

    function openAddUserModal() {
        document.getElementById('modal-user-title').textContent = 'Tambah User Baru';
        document.getElementById('form-user-index').value = '-1';
        document.getElementById('form-user-name').value = '';
        document.getElementById('form-user-email').value = '';
        document.getElementById('form-user-role').value = 'customer';
        document.getElementById('form-user-password').value = '';
        document.getElementById('form-user-password').placeholder = 'Password (default: password)';
        document.getElementById('form-user-password-confirmation').value = '';
        document.getElementById('form-user-password-confirmation').parentElement.style.display = 'block';
        openModal('modal-user');
    }

    function openEditUserModal(index) {
        const usr = users[index];
        if (!usr) return;

        document.getElementById('modal-user-title').textContent = 'Ubah Pengguna';
        document.getElementById('form-user-index').value = index;
        document.getElementById('form-user-name').value = usr.name;
        document.getElementById('form-user-email').value = usr.email;
        document.getElementById('form-user-role').value = usr.role;
        document.getElementById('form-user-password').value = '';
        document.getElementById('form-user-password').placeholder = 'Kosongkan jika tidak ingin diubah';
        document.getElementById('form-user-password-confirmation').value = '';
        document.getElementById('form-user-password-confirmation').parentElement.style.display = 'none'; // Sembunyikan konfirmasi saat edit
        openModal('modal-user');
    }

    function saveUser() {
        const index = parseInt(document.getElementById('form-user-index').value);
        const name = document.getElementById('form-user-name').value.trim();
        const email = document.getElementById('form-user-email').value.trim();
        const role = document.getElementById('form-user-role').value;
        const password = document.getElementById('form-user-password').value;
        const passwordConfirmation = document.getElementById('form-user-password-confirmation').value;

        if (!name || !email) {
            alert('Mohon isi seluruh data form secara lengkap!');
            return;
        }

        if (index === -1 && password && password !== passwordConfirmation) {
            alert('Konfirmasi password tidak cocok!');
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        let url = '/admin/users';
        let method = 'POST';
        
        if (index !== -1) {
            const id = users[index].id;
            url = `/admin/users/${id}`;
            method = 'PUT';
        }

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ name, email, role, password })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                if (index === -1) {
                    users.push(data.user);
                    
                    if (role === 'customer') {
                        if (!loyalty.find(c => c.email.toLowerCase() === email.toLowerCase())) {
                            loyalty.push({ name: name, email: email, points: 0 });
                            persistData('studio_loyalty', loyalty);
                        }
                    }
                    triggerToast(`User ${name} Berhasil Ditambahkan.`);
                } else {
                    const prevRole = users[index].role;
                    users[index] = data.user;
                    
                    if (role === 'customer' && prevRole !== 'customer') {
                        if (!loyalty.find(c => c.email.toLowerCase() === email.toLowerCase())) {
                            loyalty.push({ name: name, email: email, points: 0 });
                            persistData('studio_loyalty', loyalty);
                        }
                    }
                    triggerToast(`Akun ${name} Berhasil Diperbarui.`);
                }

                updateOverviewStats();
                renderUsers();
                renderLoyalty();
                closeUserModal();
            } else {
                alert(data.message || 'Terjadi kesalahan saat menyimpan data.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.errors) {
                const errorMsg = Object.values(error.errors).flat().join('\n');
                alert('Gagal menyimpan user:\n' + errorMsg);
            } else {
                alert(error.message || 'Terjadi kesalahan sistem.');
            }
        });
    }

    function deleteUser(index) {
        if (!confirm('Apakah Anda yakin ingin menghapus akun user ini?')) return;
        const name = users[index].name;
        const email = users[index].email;
        const id = users[index].id;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(`/admin/users/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                users.splice(index, 1);
                
                const lIdx = loyalty.findIndex(c => c.email.toLowerCase() === email.toLowerCase());
                if (lIdx !== -1) {
                    loyalty.splice(lIdx, 1);
                    persistData('studio_loyalty', loyalty);
                }

                updateOverviewStats();
                renderUsers();
                triggerToast(`Akun ${name} Telah Dihapus dari Database.`);
            } else {
                alert(data.message || 'Gagal menghapus user.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Gagal menghapus user. Terjadi kesalahan sistem.');
        });
    }

    function closePointsModal() {
        closeModal('modal-points');
    }





    /* ─── BASE MODAL CONTROLLER UTILS ─── */
    function openModal(id) {
        const modal = document.getElementById(id);
        const modalContent = modal.querySelector('.modal-card') || modal.querySelector('.bg-white');

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
        const modalContent = modal.querySelector('.modal-card') || modal.querySelector('.bg-white');

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


    // INITIALIZER
    console.log("Running initializer...");
    try {
        updateOverviewStats();
        renderUsers();
        switchTab('overview');
        
        // Wait for tab animation to finish before rendering charts
        setTimeout(() => {
            initCharts();
            // Start AJAX Polling every 10 seconds
            setInterval(fetchDashboardData, 10000);
        }, 150);
    } catch (e) {
        alert("Error di Initializer: " + e.message);
    }

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
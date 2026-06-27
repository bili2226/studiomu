<?php $__env->startSection('title', 'Riwayat Booking'); ?>

<?php $__env->startSection('sidebar'); ?>
    <a href="<?php echo e(url('/menu-utama')); ?>" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/>
        </svg>
        <span>Dashboard</span>
    </a>
    <a href="<?php echo e(route('customer.history')); ?>" class="sidebar-item sidebar-item-active flex items-center px-5 py-3.5 transition-all text-white font-black">
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
    <a href="<?php echo e(route('customer.reviews')); ?>" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
        </svg>
        <span>Ulasan Evaluasi</span>
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Notifications Banners -->
    <div id="history-notification-container" class="mb-6 hidden"></div>

    <!-- Booking History Section -->
    <div id="booking-history-section" class="bg-white border-2 border-black rounded-[2rem] shadow-[0_12px_40px_rgba(0,0,0,0.03)] mb-12 animate-fade-in-up overflow-hidden flex flex-col">
        
        <!-- Header Hitam -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-8 bg-slate-900 border-b-[2.5px] border-amber-400">
            <div>
                <span class="inline-flex items-center px-3 py-1.5 bg-slate-800 text-slate-300 text-[9px] font-black uppercase tracking-[0.2em] rounded-lg mb-2 shadow-sm border border-slate-700">
                    Riwayat Pemesanan Anda
                </span>
                <h3 class="text-2xl font-serif italic font-bold tracking-tight text-amber-400">
                    Daftar Pemesanan Sesi Foto
                </h3>
            </div>
            <div class="flex flex-col items-start sm:items-end gap-3 text-xs font-black text-slate-300">
                <div class="flex flex-wrap items-center gap-3">
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-amber-500 border border-amber-600 animate-pulse"></span>
                        <span class="text-[10px]">Pending</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-sky-500 border border-sky-600"></span>
                        <span class="text-[10px]">Terkonfirmasi</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-rose-500 border border-rose-600"></span>
                        <span class="text-[10px]">Dibatalkan</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 border border-emerald-600"></span>
                        <span class="text-[10px]">Selesai</span>
                    </div>
                </div>
                <div class="relative w-full sm:w-auto">
                    <select id="booking-time-filter" onchange="loadCustomerBookings(this.value)" class="appearance-none w-full sm:w-36 bg-slate-800 border border-slate-700 text-amber-400 text-[9px] font-bold rounded-lg pl-3 pr-8 py-1.5 focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-400/20 cursor-pointer shadow-sm uppercase tracking-wider">
                        <option value="all">Semua Waktu</option>
                        <option value="today">Hari Ini</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="this_year">Tahun Ini</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-amber-500">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Area Wrapper -->
        <div class="p-8 bg-white flex-1">

        <!-- Desktop Table View -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-xs border-collapse">
                <thead>
                    <tr class="border-b border-black">
                        <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-2 pl-6">ID Booking</th>
                        <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-2">Layanan / Paket</th>
                        <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-2">Metode</th>
                        <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-2">Jadwal Sesi</th>
                        <th class="text-left text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-2">Nominal</th>
                        <th class="text-center text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-2">Status Bayar</th>
                        <th class="text-center text-[9px] font-black uppercase tracking-widest text-black pb-3 pr-4 pt-2">Status Sesi</th>
                        <th class="text-right text-[9px] font-black uppercase tracking-widest text-black pb-3 pt-2 pr-6">Aksi / Detail</th>
                    </tr>
                </thead>
                <tbody id="booking-history-table-body" class="font-semibold text-slate-800">
                    <!-- Loaded dynamically via JS -->
                </tbody>
            </table>
        </div>

        <!-- Mobile List View -->
        <div class="md:hidden space-y-4" id="booking-history-mobile-list">
            <!-- Loaded dynamically via JS -->
        </div>

        <!-- Empty State View -->
        <div id="booking-history-empty" class="hidden text-center py-16">
            <div class="w-16 h-16 bg-white border border-slate-200 rounded-[1.2rem] flex items-center justify-center text-slate-400 mx-auto mb-4 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/>
                </svg>
            </div>
            <p class="text-xs text-slate-900 font-black uppercase tracking-wider">Belum Ada Riwayat Pemesanan</p>
            <p class="text-[11px] text-slate-500 font-medium mt-1">Seluruh sesi foto yang Anda pesan akan tampil di sini.</p>
        </div>
        </div>

        <!-- Footer Hitam -->
        <div class="h-10 bg-slate-900 border-t-[2.5px] border-amber-400 w-full"></div>
    </div>

    <!-- Booking Detail Modal -->
    <div id="booking-detail-modal" class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm z-50 flex items-center justify-center p-4 md:p-6 opacity-0 pointer-events-none transition-all duration-300">
        <!-- Close trigger by clicking backdrop -->
        <div class="absolute inset-0 cursor-default" onclick="closeBookingDetailModal()"></div>

        <!-- Modal Card -->
        <div class="modal-card bg-white border border-slate-100 rounded-[2.5rem] shadow-2xl shadow-slate-300/50 w-full max-w-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative max-h-[90vh] overflow-y-auto z-10 p-8 sm:p-10 flex flex-col">
            <!-- Close Button -->
            <button onclick="closeBookingDetailModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-500 hover:text-slate-700 transition-colors cursor-pointer shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <!-- Breadcrumbs -->
            <nav class="text-[10px] font-black text-slate-500 mb-6 flex items-center gap-2 font-sans tracking-widest uppercase">
                <button onclick="closeBookingDetailModal()" class="hover:text-blue-600 transition-colors cursor-pointer text-slate-500 font-black text-left">Riwayat</button>
                <span class="text-slate-300 font-black">&rsaquo;</span>
                <span id="detail-modal-id-breadcrumb" class="text-slate-800 font-black"></span>
            </nav>

            <!-- Title Header Badge -->
            <div class="mb-8 border-b border-slate-100 pb-5">
                <h3 class="text-3xl font-serif italic font-bold tracking-tight text-slate-900 flex items-center gap-3">
                    Detail Pesanan
                    <span id="detail-modal-status-badge" class="px-2.5 py-1 text-[9px] font-black uppercase tracking-widest rounded-lg border-2"></span>
                </h3>
                <p id="detail-modal-order-id" class="text-[10px] text-slate-500 font-black uppercase tracking-widest mt-2"></p>
            </div>

            <!-- Details Content Grid -->
            <div class="space-y-6 flex-1 text-slate-800">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-400">Layanan / Sesi</h4>
                        <p id="detail-modal-service-name" class="text-sm font-bold text-slate-900 mt-0.5"></p>
                    </div>
                    <div>
                        <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-400">Jadwal Pemotretan</h4>
                        <p id="detail-modal-schedule" class="text-sm font-bold text-slate-900 mt-0.5"></p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-400">Total Nominal Tagihan</h4>
                        <p id="detail-modal-amount" class="text-sm font-bold text-slate-900 mt-0.5"></p>
                    </div>
                    <div>
                        <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-400">Nama Pemesan</h4>
                        <p id="detail-modal-customer-name" class="text-sm font-bold text-slate-900 mt-0.5"></p>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 bg-slate-50 rounded-2xl p-4 border border-slate-100">
                    <div>
                        <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-500">Potongan Diskon</h4>
                        <p id="detail-modal-discount" class="text-xs font-black text-emerald-600 mt-0.5">-Rp 0</p>
                    </div>
                    <div>
                        <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-500">Poin Ditukarkan</h4>
                        <p id="detail-modal-points-used" class="text-xs font-black text-amber-600 mt-0.5">0 pts</p>
                    </div>
                    <div>
                        <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-500">Poin Diperoleh</h4>
                        <p id="detail-modal-points-earned" class="text-xs font-black text-blue-600 mt-0.5">+0 pts</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-400">Catatan Khusus (Requests)</h4>
                    <p id="detail-modal-requests" class="text-xs font-medium text-slate-700 mt-1 italic p-4 bg-slate-50 border border-slate-100 rounded-xl leading-relaxed"></p>
                </div>

                <div id="detail-modal-addons-container" class="hidden">
                    <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-400">Layanan Tambahan (Add-ons)</h4>
                    <div id="detail-modal-addons-list" class="mt-1.5 p-4 bg-slate-50 border border-slate-100 rounded-xl flex flex-col gap-2"></div>
                </div>

                <div id="detail-modal-review-container" class="hidden">
                    <h4 class="text-[9px] font-black uppercase tracking-wider text-slate-400">Berikan Ulasan Evaluasi</h4>
                    <div id="review-form-container" class="mt-1.5 flex flex-col gap-3 p-4 border border-slate-200 rounded-xl bg-white shadow-sm">
                        <textarea id="review-textarea" class="w-full text-xs p-3 border border-slate-200 rounded-lg focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors" rows="3" placeholder="Tulis evaluasi atau masukkan Anda untuk layanan kami..."></textarea>
                        <button onclick="submitReview()" id="submit-review-btn" class="self-end px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-[10px] uppercase tracking-widest rounded-lg shadow-sm transition-all duration-150 active:scale-95 flex items-center gap-1.5">
                            Kirim Ulasan
                        </button>
                    </div>
                    <div id="review-success-message" class="hidden mt-1.5 p-4 bg-emerald-50 border border-emerald-100 rounded-xl flex items-center gap-3">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        <span class="text-xs font-bold text-emerald-800">Terima kasih atas ulasan evaluasi Anda! Ulasan ini sangat berarti bagi peningkatan layanan kami.</span>
                    </div>
                </div>

                <!-- Explanation Box container -->
                <div id="detail-modal-explanation-box" class="p-5 rounded-2xl border flex items-start gap-4">
                    <div id="detail-modal-explanation-icon" class="w-10 h-10 rounded-xl border flex items-center justify-center flex-shrink-0">
                        <!-- Filled dynamically -->
                    </div>
                    <div>
                        <h4 id="detail-modal-explanation-title" class="text-xs font-black uppercase tracking-wider text-slate-800"></h4>
                        <p id="detail-modal-explanation-desc" class="text-[11px] font-medium leading-relaxed mt-1 text-slate-600"></p>
                    </div>
                </div>
            </div>

            <!-- Footer Action Button -->
            <div id="detail-modal-footer" class="mt-8 border-t border-slate-100 pt-6 flex justify-end gap-3">
                <button id="detail-modal-invoice-btn" class="px-6 py-3 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all cursor-pointer flex items-center gap-1.5 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.821V21m0 0h-5.56c-.608 0-1.127-.403-1.292-.988L-.13 13.82a2.316 2.316 0 0 1 .15-1.92L2.73 6.945C3.027 6.4 3.6 6.075 4.223 6.075H19.78c.622 0 1.195.326 1.493.87l2.71 4.954c.488.893.4 1.996-.219 2.793L19.29 20.012c-.165.585-.684.988-1.292.988H12.28m0-7.18V21M12.28 21H6.72m5.56 0h5.44M6.72 13.821h5.56m0 0h5.44m-11-7.746V3.75c0-.69.56-1.25 1.25-1.25h9c.69 0 1.25.56 1.25 1.25v2.325"/>
                    </svg>
                    <span>Cetak Invoice</span>
                </button>
                <button onclick="closeBookingDetailModal()" class="px-6 py-3 border border-slate-200 hover:bg-slate-50 text-slate-500 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all cursor-pointer">
                    Tutup
                </button>
                <button id="detail-modal-pay-btn" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-[0_8px_16px_-4px_rgba(37,99,235,0.4)] active:scale-95 duration-150 flex items-center gap-1.5 border-none hidden cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                    </svg>
                    <span>Bayar Sekarang</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Print Styles -->
    <style>
        @media print {
            /* Hide all dashboard/page elements */
            body * {
                visibility: hidden;
            }
            /* Show only the modal-bill and its children */
            #modal-bill, #modal-bill * {
                visibility: visible;
            }
            #modal-bill {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                margin: 0;
                padding: 0;
                background: transparent;
                display: flex !important;
                justify-content: center;
                align-items: flex-start;
                opacity: 100 !important;
                pointer-events: auto !important;
                z-index: 9999;
            }
            #modal-bill .modal-card {
                border: none !important;
                box-shadow: none !important;
                transform: none !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            /* Hide close button and print button inside bill modal when printing */
            #modal-bill button {
                display: none !important;
            }
        }
    </style>

    
    <div id="modal-bill" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="modal-card bg-white border border-slate-100 rounded-[2.5rem] shadow-2xl shadow-slate-300/50 w-full max-w-md overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col">
            
            <button onclick="closeBillModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-500 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            <div class="bill-receipt bg-white p-2 text-left">
                <!-- Receipt Header -->
                <div class="text-center border-b border-dashed border-slate-300 pb-6 mb-6">
                    <h3 class="text-xl font-serif italic font-bold text-slate-900">Studio.mu</h3>
                    <h4 class="text-[9px] font-black uppercase tracking-[0.25em] text-slate-400 mt-1">Bukti Pemesanan Studio</h4>
                    <p id="bill-booking-id" class="text-xs font-bold text-slate-700 uppercase tracking-widest mt-2 bg-slate-50 border border-slate-200 px-3 py-1 rounded-full inline-block">#BOOK-1001</p>
                </div>

                <!-- Receipt details -->
                <div class="space-y-4 text-xs font-medium text-slate-700 pb-6 border-b border-slate-200">
                    <div class="flex justify-between items-center gap-3">
                        <span class="text-slate-400 uppercase tracking-wider text-[9px] flex-shrink-0 font-black">Nama Klien</span>
                        <span id="bill-client" class="text-slate-900 font-bold text-right truncate"></span>
                    </div>
                    <div class="flex justify-between items-center gap-3">
                        <span class="text-slate-400 uppercase tracking-wider text-[9px] flex-shrink-0 font-black">Email Klien</span>
                        <span id="bill-email" class="text-slate-900 font-medium text-right truncate text-[11px] font-sans"></span>
                    </div>
                    <div class="flex justify-between items-center gap-3">
                        <span class="text-slate-400 uppercase tracking-wider text-[9px] flex-shrink-0 font-black">Sesi & Paket</span>
                        <span id="bill-service" class="text-slate-900 font-bold text-right truncate"></span>
                    </div>
                    <div class="flex justify-between items-center gap-3">
                        <span class="text-slate-400 uppercase tracking-wider text-[9px] flex-shrink-0 font-black">Metode Pembayaran</span>
                        <span id="bill-payment-method" class="text-slate-900 font-bold text-right truncate"></span>
                    </div>
                    <div class="flex justify-between items-center gap-3" id="bill-discount-row">
                        <span class="text-slate-400 uppercase tracking-wider text-[9px] flex-shrink-0 font-black">Potongan Diskon</span>
                        <span id="bill-discount" class="text-emerald-600 font-bold text-right truncate"></span>
                    </div>
                    <div class="flex justify-between items-center gap-3">
                        <span class="text-slate-400 uppercase tracking-wider text-[9px] flex-shrink-0 font-black">Tanggal Pemotretan</span>
                        <span id="bill-date" class="text-slate-900 font-bold text-right font-sans text-[11px]"></span>
                    </div>
                    <div class="flex justify-between items-center gap-3">
                        <span class="text-slate-400 uppercase tracking-wider text-[9px] flex-shrink-0 font-black">Status</span>
                        <span id="bill-status" class="px-2.5 py-0.5 rounded-md text-[8px] font-black tracking-widest uppercase inline-block leading-none bg-slate-100 text-slate-700"></span>
                    </div>
                    
                    <div id="bill-addons-section" class="hidden border-t border-dashed border-slate-200 pt-3.5 mt-3.5 space-y-2">
                        <span class="text-slate-400 uppercase tracking-wider text-[9px] font-black block">Layanan Tambahan (Add-ons)</span>
                        <div id="bill-addons-list" class="space-y-1.5 font-bold"></div>
                    </div>
                </div>

                <!-- Receipt totals -->
                <div class="pt-6 flex justify-between items-baseline mb-6">
                    <span class="text-slate-500 font-black uppercase tracking-wider text-[10px]">Total Tagihan</span>
                    <span id="bill-amount" class="text-3xl font-serif italic font-bold text-slate-900">Rp 0</span>
                </div>

                <div class="bg-blue-50/50 rounded-2xl p-4 border border-blue-100 text-[10px] text-blue-800 text-center uppercase tracking-wider font-bold leading-relaxed">
                    Terima kasih telah mempercayakan momen Anda bersama Studio.mu Visual Art.
                </div>
            </div>
            
            <button onclick="window.print()" class="bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-[0_8px_16px_-4px_rgba(37,99,235,0.4)] active:scale-95 mt-8 border-none cursor-pointer">
                CETAK INVOICE / BUKTI TAGIHAN
            </button>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(config('midtrans.client_key')); ?>"></script>
<script>
    const loggedInUser = {
        name: "<?php echo e(Auth::user()->name); ?>",
        email: "<?php echo e(Auth::user()->email); ?>"
    };

    function loadCustomerBookings(filter = 'all') {
        const transactions = <?php echo json_encode($bookings, 15, 512) ?>;
        
        // Find bookings matching the logged-in user's email, sort by date (newest first)
        let myBookings = transactions.filter(tx => tx.email === loggedInUser.email);
        
        if (filter !== 'all') {
            const today = new Date();
            today.setHours(0,0,0,0);
            
            const startOfWeek = new Date(today);
            startOfWeek.setDate(today.getDate() - today.getDay()); 
            
            const startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            const startOfYear = new Date(today.getFullYear(), 0, 1);

            myBookings = myBookings.filter(tx => {
                if (!tx.raw_date) return true;
                // Parse "YYYY-MM-DD HH:mm:ss" properly in JS
                const parts = tx.raw_date.split(/[- :]/);
                const txDate = new Date(parts[0], parts[1]-1, parts[2]);
                txDate.setHours(0,0,0,0);
                
                if (filter === 'today') return txDate.getTime() === today.getTime();
                if (filter === 'this_week') return txDate >= startOfWeek && txDate <= new Date(startOfWeek.getTime() + 6 * 24 * 60 * 60 * 1000);
                if (filter === 'this_month') return txDate >= startOfMonth && txDate < new Date(today.getFullYear(), today.getMonth() + 1, 1);
                if (filter === 'this_year') return txDate >= startOfYear && txDate < new Date(today.getFullYear() + 1, 0, 1);
                return true;
            });
        }
        
        renderBookingHistory(myBookings);
    }

    function buildAddonsHtml(addons) {
        if (!addons || !Array.isArray(addons) || addons.length === 0) return '';
        let html = '<div class="mt-1.5 flex flex-wrap gap-1">';
        addons.forEach(addon => {
            if (addon.qty > 0) {
                html += `
                    <span class="inline-flex items-center px-1.5 py-0.5 bg-blue-50 border border-blue-100 rounded text-[9px] text-blue-700 font-bold">
                        + ${addon.name} (${addon.qty}x)
                    </span>
                `;
            }
        });
        html += '</div>';
        if (html === '<div class="mt-1.5 flex flex-wrap gap-1"></div>') return '';
        return html;
    }

    function renderBookingHistory(myBookings) {
        const tableBody = document.getElementById('booking-history-table-body');
        const mobileList = document.getElementById('booking-history-mobile-list');
        const emptyState = document.getElementById('booking-history-empty');

        if (!myBookings || myBookings.length === 0) {
            tableBody.innerHTML = '';
            mobileList.innerHTML = '';
            emptyState.classList.remove('hidden');
            return;
        }

        emptyState.classList.add('hidden');
        tableBody.innerHTML = '';
        mobileList.innerHTML = '';

        myBookings.forEach(tx => {
            // Build Status Badge HTML
            let statusText = tx.status;
            let statusClass = 'px-2.5 py-1 text-[9px] font-black uppercase tracking-widest rounded-full border inline-block leading-none shadow-sm';
            if (tx.status === 'Pending') {
                statusClass += ' bg-amber-500 text-white border-transparent';
                statusText = 'Pending';
            } else if (tx.status === 'Confirmed') {
                statusClass += ' bg-sky-500 text-white border-transparent';
                statusText = 'Terkonfirmasi';
            } else if (tx.status === 'Completed') {
                statusClass += ' bg-emerald-500 text-white border-transparent';
                statusText = 'Selesai';
            } else {
                statusClass += ' bg-rose-600 text-white border-transparent';
                statusText = 'Dibatalkan';
            }

            // Build Payment Status Badge
            let paymentStatusHtml = '';
            if (tx.status === 'Confirmed' || tx.status === 'Completed') {
                paymentStatusHtml = '<span class="px-2.5 py-0.5 text-[9px] font-black uppercase tracking-widest rounded-lg border inline-block bg-emerald-500/10 text-emerald-600 border-emerald-500/20">Lunas</span>';
            } else {
                paymentStatusHtml = '<span class="px-2.5 py-0.5 text-[9px] font-black uppercase tracking-widest rounded-lg border inline-block bg-rose-500/10 text-rose-600 border-rose-500/20">Belum Lunas</span>';
            }

            // Build Actions: Detail Button + Pay Now Button if Pending
            let payButtonHtml = '';
            if (tx.status === 'Pending') {
                if (tx.payment_method === 'Cash') {
                    payButtonHtml = `
                        <span class="px-3 py-1.5 bg-amber-55/60 text-amber-800 text-[9px] font-black uppercase tracking-widest rounded-xl border border-amber-200 select-none">
                            Bayar di Kasir
                        </span>
                    `;
                } else if (tx.snap_token) {
                    payButtonHtml = `
                        <button onclick="payPendingBooking('${tx.id}', '${tx.snap_token}', '${tx.service}')" class="px-3 py-1.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white text-[9px] font-black uppercase tracking-widest rounded-xl shadow-sm transition-all duration-150 active:scale-95 flex items-center gap-1 cursor-pointer border-none">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/>
                            </svg>
                            <span>Bayar Sekarang</span>
                        </button>
                    `;
                }
            }

            // Escape quotes in JSON string for inline attribute safely
            const addonsStr = JSON.stringify(tx.addons || []).replace(/"/g, '&quot;').replace(/'/g, "\\'");

            // Build Invoice button html
            const invoiceBtnHtml = `
                <button onclick="showBill('${tx.id}', '${tx.name.replace(/'/g, "\\'")}', '${tx.email.replace(/'/g, "\\'")}', '${tx.service.replace(/'/g, "\\'")}', '${tx.date}', '${tx.amount}', '${tx.status}', '${tx.payment_method}', '${tx.discount}', '${addonsStr}')" class="px-3 py-1.5 bg-white hover:bg-slate-50 text-slate-600 border border-slate-200 hover:border-slate-300 font-bold text-[9px] uppercase tracking-widest rounded-xl transition-all duration-150 active:scale-95 cursor-pointer shadow-sm">
                    Invoice
                </button>
            `;

            const mobileInvoiceBtnHtml = `
                <button onclick="showBill('${tx.id}', '${tx.name.replace(/'/g, "\\'")}', '${tx.email.replace(/'/g, "\\'")}', '${tx.service.replace(/'/g, "\\'")}', '${tx.date}', '${tx.amount}', '${tx.status}', '${tx.payment_method}', '${tx.discount}', '${addonsStr}')" class="px-3.5 py-2 bg-white border border-slate-200 hover:bg-slate-50 hover:border-slate-300 text-slate-600 text-[9px] font-black uppercase tracking-widest rounded-lg transition-all cursor-pointer shadow-sm">
                    Invoice
                </button>
            `;

            // Cancel button — only for Pending or Confirmed and session hasn't passed
            let cancelBtnHtml = '';
            let mobileCancelBtnHtml = '';
            const sessionDate = tx.raw_date ? new Date(tx.raw_date.replace(' ', 'T')) : null;
            const canCancel = (tx.status === 'Pending' || tx.status === 'Confirmed') && sessionDate && sessionDate > new Date();
            if (canCancel) {
                cancelBtnHtml = `
                    <button onclick="openCancelModal('${tx.id}')" class="px-3 py-1.5 bg-rose-600 hover:bg-rose-700 text-white text-[9px] font-black uppercase tracking-widest rounded-xl transition-all duration-150 active:scale-95 cursor-pointer shadow-sm border-none flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Batalkan
                    </button>
                `;
                mobileCancelBtnHtml = `
                    <button onclick="openCancelModal('${tx.id}')" class="px-3.5 py-2 bg-rose-600 hover:bg-rose-700 text-white text-[9px] font-black uppercase tracking-widest rounded-lg transition-all cursor-pointer shadow-sm border-none">
                        Batalkan
                    </button>
                `;
            }


            // Desktop Row
            const row = document.createElement('tr');
            row.className = 'group hover:bg-slate-50/60 transition-colors border-b border-black';
            row.innerHTML = `
                <td class="py-4 pr-4 pl-6 font-bold text-slate-900 font-sans tracking-wide text-xs">
                    ${tx.id}
                </td>
                <td class="py-4 pr-4 text-slate-800 text-xs">
                    <div>
                        <p class="font-bold text-slate-900 leading-snug">${tx.service}</p>
                        ${buildAddonsHtml(tx.addons)}
                    </div>
                </td>
                <td class="py-4 pr-4 text-slate-700 text-xs font-bold">
                    ${tx.payment_method || 'Transfer'}
                </td>
                <td class="py-4 pr-4 text-slate-600 font-sans text-xs">
                    ${tx.date} WIB
                </td>
                <td class="py-4 pr-4 font-bold text-slate-900 font-sans text-xs">
                    ${tx.amount}
                </td>
                <td class="py-4 pr-4 text-center">
                    ${paymentStatusHtml}
                </td>
                <td class="py-4 pr-4 text-center">
                    <span class="${statusClass}">${statusText}</span>
                </td>
                <td class="py-4 text-right pr-6">
                    <div class="flex items-center justify-end gap-1.5">
                        <button onclick="showBookingDetail('${tx.id}')" class="px-3 py-1.5 bg-slate-800 hover:bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest rounded-xl transition-colors cursor-pointer shadow-sm">
                            Detail
                        </button>
                        ${invoiceBtnHtml}
                        ${payButtonHtml}
                        ${cancelBtnHtml}
                    </div>
                </td>
            `;
            tableBody.appendChild(row);

            // Mobile Card
            const card = document.createElement('div');
            card.className = 'bg-white border border-slate-100 rounded-2xl p-5 space-y-4 shadow-sm hover:shadow-md transition-shadow text-left';
            card.innerHTML = `
                <div class="flex justify-between items-start">
                    <div>
                        <span class="block text-[10px] text-slate-500 font-black uppercase tracking-widest">${tx.id}</span>
                        <h4 class="text-sm font-black text-slate-900 mt-0.5">${tx.service}</h4>
                        ${buildAddonsHtml(tx.addons)}
                    </div>
                    <div class="flex flex-col items-end gap-1.5">
                        <span class="${statusClass}">${statusText}</span>
                        ${paymentStatusHtml}
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-2 text-[11px] font-medium text-slate-600 bg-slate-50 p-3 rounded-xl border border-slate-100">
                    <div>
                        <span class="block text-[9px] uppercase tracking-wider text-slate-400 font-black mb-0.5">Metode</span>
                        <span class="text-slate-800 font-bold">${tx.payment_method || 'Transfer'}</span>
                    </div>
                    <div>
                        <span class="block text-[9px] uppercase tracking-wider text-slate-400 font-black mb-0.5">Jadwal Sesi</span>
                        <span class="text-slate-800 font-bold">${tx.date} WIB</span>
                    </div>
                    <div>
                        <span class="block text-[9px] uppercase tracking-wider text-slate-400 font-black mb-0.5">Nominal</span>
                        <span class="text-slate-900 font-black">${tx.amount}</span>
                    </div>
                </div>
                <div class="flex gap-2 pt-2 justify-end">
                    <button onclick="showBookingDetail('${tx.id}')" class="px-3.5 py-2 bg-slate-800 hover:bg-slate-900 text-white text-[9px] font-black uppercase tracking-widest rounded-lg transition-all cursor-pointer shadow-sm">
                        Detail
                    </button>
                    ${mobileInvoiceBtnHtml}
                    ${payButtonHtml}
                    ${mobileCancelBtnHtml}
                </div>
            `;
            mobileList.appendChild(card);
        });
    }

    function showBookingDetail(bookingId) {
        const transactions = <?php echo json_encode($bookings, 15, 512) ?>;
        const tx = transactions.find(t => t.id === bookingId);
        if (!tx) return;

        document.getElementById('detail-modal-id-breadcrumb').textContent = tx.id;
        document.getElementById('detail-modal-order-id').textContent = `ORDER ID: ${tx.id}`;
        document.getElementById('detail-modal-service-name').textContent = tx.service;
        document.getElementById('detail-modal-schedule').textContent = tx.date + ' WIB';
        document.getElementById('detail-modal-amount').textContent = tx.amount;
        document.getElementById('detail-modal-customer-name').textContent = tx.name;
        document.getElementById('detail-modal-requests').textContent = tx.requests ? tx.requests : 'Tidak ada catatan tambahan.';

        // Setup detail modal addons list
        const addonsContainer = document.getElementById('detail-modal-addons-container');
        const addonsList = document.getElementById('detail-modal-addons-list');
        addonsList.innerHTML = '';
        
        let hasActiveAddons = false;
        if (tx.addons && Array.isArray(tx.addons)) {
            tx.addons.forEach(addon => {
                if (addon.qty > 0) {
                    hasActiveAddons = true;
                    const item = document.createElement('div');
                    item.className = 'flex justify-between items-center text-xs font-bold text-black';
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

        // Review Section setup
        const reviewContainer = document.getElementById('detail-modal-review-container');
        const reviewFormContainer = document.getElementById('review-form-container');
        const reviewSuccessMessage = document.getElementById('review-success-message');
        const submitReviewBtn = document.getElementById('submit-review-btn');
        
        // Remove old onclick to prevent multiple attachments if modal opened multiple times
        submitReviewBtn.onclick = null;
        
        if (tx.status === 'Completed') {
            reviewContainer.classList.remove('hidden');
            if (tx.review) {
                reviewFormContainer.classList.add('hidden');
                reviewSuccessMessage.classList.remove('hidden');
            } else {
                reviewFormContainer.classList.remove('hidden');
                reviewSuccessMessage.classList.add('hidden');
                document.getElementById('review-textarea').value = '';
                
                submitReviewBtn.onclick = function() {
                    submitReview(tx.id);
                };
            }
        } else {
            reviewContainer.classList.add('hidden');
        }

        document.getElementById('detail-modal-discount').textContent = tx.discount_raw > 0 ? `-${tx.discount}` : 'Rp 0';
        document.getElementById('detail-modal-points-used').textContent = (tx.points_used || 0) + ' pts';
        document.getElementById('detail-modal-points-earned').textContent = '+' + (tx.points_earned || 0) + ' pts';

        const statusBadge = document.getElementById('detail-modal-status-badge');
        statusBadge.textContent = tx.status;
        statusBadge.className = 'px-2.5 py-0.5 text-[8px] font-black uppercase tracking-widest rounded-lg border inline-block';

        const expBox = document.getElementById('detail-modal-explanation-box');
        const expIcon = document.getElementById('detail-modal-explanation-icon');
        const expTitle = document.getElementById('detail-modal-explanation-title');
        const expDesc = document.getElementById('detail-modal-explanation-desc');
        const payBtn = document.getElementById('detail-modal-pay-btn');
        const invoiceBtn = document.getElementById('detail-modal-invoice-btn');

        payBtn.classList.add('hidden');
        payBtn.onclick = null;

        invoiceBtn.onclick = () => {
            closeBookingDetailModal();
            setTimeout(() => {
                showBill(tx.id, tx.name, tx.email, tx.service, tx.date, tx.amount, tx.status, tx.payment_method, tx.discount, JSON.stringify(tx.addons || []));
            }, 300);
        };

        if (tx.status === 'Pending') {
            statusBadge.className += ' bg-amber-500/10 text-amber-500 border-amber-500/20';
            statusBadge.textContent = 'Pending';
            
            expBox.className = 'p-5 rounded-2xl border flex items-start gap-4 bg-amber-50/50 border-amber-200 text-amber-800 text-left';
            expIcon.className = 'w-10 h-10 rounded-xl bg-white border border-amber-200 flex items-center justify-center flex-shrink-0 text-amber-600';
            expIcon.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            `;
            
            if (tx.payment_method === 'Cash') {
                expTitle.textContent = 'Menunggu Pembayaran Kasir';
                expTitle.className = 'text-xs font-black uppercase tracking-wider text-amber-900 text-left';
                expDesc.textContent = 'Pesanan Anda telah dicatat dengan metode pembayaran tunai di kasir. Jadwal pemotretan akan terkonfirmasi setelah Anda menyerahkan uang tunai fisik ke kasir studio dan dikonfirmasi oleh admin.';
            } else {
                expTitle.textContent = 'Menunggu Pembayaran';
                expTitle.className = 'text-xs font-black uppercase tracking-wider text-amber-900 text-left';
                expDesc.textContent = 'Pesanan Anda telah dicatat oleh sistem, tetapi jadwal pemotretan belum terkonfirmasi. Silakan selesaikan pembayaran Anda menggunakan Snap Midtrans agar status pemesanan terkonfirmasi secara otomatis.';
                
                if (tx.snap_token) {
                    payBtn.classList.remove('hidden');
                    payBtn.onclick = () => {
                        closeBookingDetailModal();
                        payPendingBooking(tx.id, tx.snap_token, tx.service);
                    };
                }
            }
        } else if (tx.status === 'Confirmed') {
            statusBadge.className += ' bg-sky-500/10 text-sky-500 border-sky-500/20';
            statusBadge.textContent = 'Terkonfirmasi';

            expBox.className = 'p-5 rounded-2xl border flex items-start gap-4 bg-sky-50/50 border-sky-200 text-sky-800 text-left';
            expIcon.className = 'w-10 h-10 rounded-xl bg-white border border-sky-200 flex items-center justify-center flex-shrink-0 text-sky-655';
            expIcon.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            `;
            
            if (tx.payment_method === 'Cash') {
                expTitle.textContent = 'Pembayaran Tunai Diterima';
                expTitle.className = 'text-xs font-black uppercase tracking-wider text-sky-900 text-left';
                expDesc.textContent = 'Pembayaran tunai Anda telah diterima dan dikonfirmasi oleh kasir studio. Jadwal sesi pemotretan Anda kini telah terkonfirmasi resmi. Silakan hadir di studio 15 menit sebelum waktu pemotretan dimulai.';
            } else {
                expTitle.textContent = 'Pembayaran Berhasil / Terkonfirmasi';
                expTitle.className = 'text-xs font-black uppercase tracking-wider text-sky-900 text-left';
                expDesc.textContent = 'Selamat! Pembayaran Anda telah terverifikasi oleh sistem secara otomatis. Jadwal sesi pemotretan Anda telah terkonfirmasi secara resmi. Silakan hadir di studio 15 menit sebelum waktu pemotretan dimulai.';
            }
        } else if (tx.status === 'Completed') {
            statusBadge.className += ' bg-emerald-500/10 text-emerald-500 border-emerald-500/20';
            statusBadge.textContent = 'Selesai';

            expBox.className = 'p-5 rounded-2xl border flex items-start gap-4 bg-emerald-50/50 border-emerald-200 text-emerald-800 text-left';
            expIcon.className = 'w-10 h-10 rounded-xl bg-white border border-emerald-200 flex items-center justify-center flex-shrink-0 text-emerald-655';
            expIcon.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
            `;
            expTitle.textContent = 'Sesi Pemotretan Selesai';
            expTitle.className = 'text-xs font-black uppercase tracking-wider text-emerald-900 text-left';
            expDesc.textContent = 'Terima kasih! Sesi pemotretan Anda telah sukses dilaksanakan. Seluruh file softcopy foto akan diproses dan dikirimkan oleh tim fotografer kami sesuai paket layanan yang Anda pilih. Poin loyalitas Anda juga telah ditambahkan.';
        } else {
            statusBadge.className += ' bg-rose-500/10 text-rose-500 border-rose-500/20';
            statusBadge.textContent = 'Dibatalkan';

            expBox.className = 'p-5 rounded-2xl border flex items-start gap-4 bg-rose-50/50 border-rose-200 text-rose-800 text-left';
            expIcon.className = 'w-10 h-10 rounded-xl bg-white border border-rose-200 flex items-center justify-center flex-shrink-0 text-rose-655';
            expIcon.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            `;
            expTitle.textContent = 'Pemesanan Dibatalkan';
            expTitle.className = 'text-xs font-black uppercase tracking-wider text-rose-900 text-left';
            expDesc.textContent = 'Pemesanan ini telah dibatalkan (baik secara otomatis karena kedaluwarsa atau dibatalkan secara manual oleh Admin). Silakan lakukan pemesanan ulang atau hubungi kontak dukungan Admin kami untuk bantuan lebih lanjut.';
        }

        const modal = document.getElementById('booking-detail-modal');
        const modalContent = modal.querySelector('.modal-card');

        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100', 'pointer-events-auto');
        
        setTimeout(() => {
            modalContent.classList.remove('scale-95', 'opacity-0');
            modalContent.classList.add('scale-100', 'opacity-100');
        }, 10);
        
        document.body.style.overflow = 'hidden';
    }

    function closeBookingDetailModal() {
        const modal = document.getElementById('booking-detail-modal');
        const modalContent = modal.querySelector('.modal-card');

        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            modal.classList.remove('opacity-100', 'pointer-events-auto');
            modal.classList.add('opacity-0', 'pointer-events-none');
            document.body.style.overflow = '';
        }, 300);
    }

    function payPendingBooking(bookingId, snapToken, serviceTitle) {
        window.snap.pay(snapToken, {
            onSuccess: function(result) {
                fetch(`/booking/${bookingId}/confirm-payment`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Accept': 'application/json'
                    }
                })
                .then(() => {
                    window.location.href = `/payment/finish?order_id=${bookingId}`;
                })
                .catch(() => {
                    window.location.href = `/payment/finish?order_id=${bookingId}`;
                });
            },
            onPending: function(result) {
                window.location.href = `<?php echo e(route('customer.history')); ?>?unpaid=1&pending_id=${bookingId}`;
            },
            onError: function(result) {
                window.location.href = `/payment/error?order_id=${bookingId}`;
            },
            onClose: function() {
                window.location.href = `<?php echo e(route('customer.history')); ?>?unpaid=1&pending_id=${bookingId}`;
            }
        });
    }

    function checkURLNotifications() {
        const urlParams = new URLSearchParams(window.location.search);
        const notificationContainer = document.getElementById('history-notification-container');
        if (!notificationContainer) return;

        if (urlParams.has('booking_success')) {
            notificationContainer.innerHTML = `
                <div class="flex items-start gap-3 p-4 bg-emerald-50 border-2 border-black text-black rounded-2xl shadow-md text-xs font-bold text-left animate-fade-in-up">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <div>
                        <p class="font-black uppercase tracking-wide">Pemesanan Berhasil!</p>
                        <p class="mt-0.5 leading-relaxed font-bold">
                            Terima kasih! Pembayaran Anda sukses terverifikasi dan sesi foto Anda telah dijadwalkan secara resmi.
                        </p>
                    </div>
                </div>
            `;
            notificationContainer.classList.remove('hidden');
        } else if (urlParams.has('cash_success')) {
            const pendingId = urlParams.get('pending_id') || '';
            let idText = pendingId ? ` dengan ID <strong>${pendingId}</strong>` : '';
            notificationContainer.innerHTML = `
                <div class="flex items-start gap-3 p-4 bg-emerald-50 border-2 border-black text-black rounded-2xl shadow-md text-xs font-bold text-left animate-fade-in-up">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <div>
                        <p class="font-black uppercase tracking-wide">Pemesanan Cash Diajukan!</p>
                        <p class="mt-0.5 leading-relaxed font-bold">
                            Pemesanan Anda${idText} telah berhasil diajukan dengan metode pembayaran <strong>Tunai di Studio (Cash)</strong>. Status sesi pemesanan Anda saat ini adalah <strong>Pending (Belum Lunas)</strong>. Silakan serahkan pembayaran tunai Anda langsung ke kasir studio untuk mengonfirmasi sesi foto Anda.
                        </p>
                    </div>
                </div>
            `;
            notificationContainer.classList.remove('hidden');

            if (pendingId) {
                setTimeout(() => {
                    const rows = document.querySelectorAll('#booking-history-table-body tr');
                    rows.forEach(row => {
                        if (row.cells[0].textContent.trim() === pendingId) {
                            row.classList.add('bg-emerald-50/50', 'ring-2', 'ring-emerald-500/50');
                            row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });

                    const cards = document.querySelectorAll('#booking-history-mobile-list > div');
                    cards.forEach(card => {
                        const idEl = card.querySelector('span.block');
                        if (idEl && idEl.textContent.trim() === pendingId) {
                            card.classList.add('bg-emerald-50/50', 'ring-2', 'ring-emerald-500/50');
                            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                }, 350);
            }
        } else if (urlParams.has('unpaid')) {
            const pendingId = urlParams.get('pending_id') || '';
            let idText = pendingId ? ` dengan ID <strong>${pendingId}</strong>` : '';
            notificationContainer.innerHTML = `
                <div class="flex items-start gap-3 p-4 bg-amber-50 border-2 border-black text-black rounded-2xl shadow-md text-xs font-bold text-left animate-fade-in-up">
                    <svg class="w-5 h-5 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376C1.83 15.002 2 10.684 2 9.75c0-5.592 3.824-10.29 9-11.622 5.176 1.332 9 6.03 9 11.622 0 .934.17 5.252-.697 6.376M12 18.75h.007v.008H12v-.008Z"/>
                    </svg>
                    <div>
                        <p class="font-black uppercase tracking-wide">Pembayaran Belum Selesai!</p>
                        <p class="mt-0.5 leading-relaxed font-bold">
                            Anda keluar dari menu pembayaran sebelum menyelesaikan transaksi${idText}. Silakan selesaikan pembayaran Anda segera dengan menekan tombol <strong>Bayar Sekarang</strong> di bawah ini.
                        </p>
                    </div>
                </div>
            `;
            notificationContainer.classList.remove('hidden');

            if (pendingId) {
                setTimeout(() => {
                    const rows = document.querySelectorAll('#booking-history-table-body tr');
                    rows.forEach(row => {
                        if (row.cells[0].textContent.trim() === pendingId) {
                            row.classList.add('bg-amber-50/50', 'ring-2', 'ring-amber-500/50');
                            row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });

                    const cards = document.querySelectorAll('#booking-history-mobile-list > div');
                    cards.forEach(card => {
                        const idEl = card.querySelector('span.block');
                        if (idEl && idEl.textContent.trim() === pendingId) {
                            card.classList.add('bg-amber-50/50', 'ring-2', 'ring-amber-500/50');
                            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                }, 350);
            }
        } else if (urlParams.has('free_success')) {
            const pendingId = urlParams.get('pending_id') || '';
            let idText = pendingId ? ` dengan ID <strong>${pendingId}</strong>` : '';
            notificationContainer.innerHTML = `
                <div class="flex items-start gap-3 p-4 bg-emerald-50 border-2 border-black text-black rounded-2xl shadow-md text-xs font-bold text-left animate-fade-in-up">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <div>
                        <p class="font-black uppercase tracking-wide">Pemesanan Berhasil Terkonfirmasi!</p>
                        <p class="mt-0.5 leading-relaxed font-bold">
                            Terima kasih! Pemesanan Anda${idText} telah berhasil dikonfirmasi secara otomatis dengan potongan poin loyalitas penuh (Rp 0).
                        </p>
                    </div>
                </div>
            `;
            notificationContainer.classList.remove('hidden');

            if (pendingId) {
                setTimeout(() => {
                    const rows = document.querySelectorAll('#booking-history-table-body tr');
                    rows.forEach(row => {
                        if (row.cells[0].textContent.trim() === pendingId) {
                            row.classList.add('bg-emerald-50/50', 'ring-2', 'ring-emerald-500/50');
                            row.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });

                    const cards = document.querySelectorAll('#booking-history-mobile-list > div');
                    cards.forEach(card => {
                        const idEl = card.querySelector('span.block');
                        if (idEl && idEl.textContent.trim() === pendingId) {
                            card.classList.add('bg-emerald-50/50', 'ring-2', 'ring-emerald-500/50');
                            card.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    });
                }, 350);
            }
        }
    }

    function showBill(id, client, email, service, date, amount, status, paymentMethod, discount, addonsJson) {
        document.getElementById('bill-booking-id').textContent = '#' + id;
        document.getElementById('bill-client').textContent = client;
        document.getElementById('bill-email').textContent = email;
        document.getElementById('bill-service').textContent = service;
        document.getElementById('bill-payment-method').textContent = paymentMethod || 'Transfer';
        
        const discRow = document.getElementById('bill-discount-row');
        const discVal = document.getElementById('bill-discount');
        if (discount && discount !== 'Rp 0' && discount !== 'Rp 0') {
            discVal.textContent = '-' + discount;
            discRow.classList.remove('hidden');
        } else {
            discVal.textContent = 'Rp 0';
            discRow.classList.add('hidden');
        }

        document.getElementById('bill-date').textContent = date;
        document.getElementById('bill-amount').textContent = amount;
        
        const statusLabel = document.getElementById('bill-status');
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

        // Render Addons in Invoice
        const addonsSection = document.getElementById('bill-addons-section');
        const addonsList = document.getElementById('bill-addons-list');
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
                    const div = document.createElement('div');
                    div.className = 'flex justify-between items-center text-[11px] text-black font-bold';
                    div.innerHTML = `
                        <span>${addon.name} <span class="text-slate-500 font-medium">x${addon.qty}</span></span>
                        <span class="font-sans">Rp ${(addon.price * addon.qty).toLocaleString('id-ID')}</span>
                    `;
                    addonsList.appendChild(div);
                }
            });
        }
        
        if (hasActiveAddons) {
            addonsSection.classList.remove('hidden');
        } else {
            addonsSection.classList.add('hidden');
        }

        const modal = document.getElementById('modal-bill');
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

    function closeBillModal() {
        const modal = document.getElementById('modal-bill');
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

    function submitReview(bookingId) {
        const textarea = document.getElementById('review-textarea');
        const reviewText = textarea.value.trim();
        const btn = document.getElementById('submit-review-btn');
        
        if (!reviewText) {
            alert('Silakan tulis ulasan terlebih dahulu.');
            return;
        }
        
        btn.disabled = true;
        btn.innerHTML = 'Mengirim...';
        
        fetch(`/customer/bookings/${bookingId}/review`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ review: reviewText })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI temporarily before reload
                document.getElementById('review-form-container').classList.add('hidden');
                document.getElementById('review-success-message').classList.remove('hidden');
                
                // Reload to reflect changes globally
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            } else {
                alert(data.message || 'Gagal mengirim ulasan.');
                btn.disabled = false;
                btn.innerHTML = 'Kirim Ulasan';
            }
        })
        .catch(error => {
            console.error('Error submitting review:', error);
            alert('Terjadi kesalahan saat mengirim ulasan.');
            btn.disabled = false;
            btn.innerHTML = 'Kirim Ulasan';
        });
    }

    // Call loadCustomerBookings on initialization
    window.addEventListener('DOMContentLoaded', () => {
        loadCustomerBookings();
        checkURLNotifications();
    });
</script>




<div id="cancel-booking-modal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
    <div id="cancel-modal-card" class="bg-white border-2 border-black rounded-[2.5rem] shadow-2xl w-full max-w-lg overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10">

        
        <div id="cancel-modal-loading" class="p-10 flex flex-col items-center gap-4 text-center">
            <div class="w-12 h-12 border-4 border-slate-200 border-t-slate-800 rounded-full animate-spin"></div>
            <p class="text-sm font-bold text-slate-600">Memeriksa status pembatalan...</p>
        </div>

        
        <div id="cancel-modal-content" class="hidden">
            
            <div class="p-6 bg-slate-900 border-b-2 border-amber-400 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-serif italic font-bold text-white">Konfirmasi Pembatalan</h3>
                    <p id="cancel-modal-booking-id" class="text-[10px] font-black uppercase tracking-widest text-slate-400 mt-0.5"></p>
                </div>
                <button onclick="closeCancelModal()" class="w-9 h-9 flex items-center justify-center rounded-full bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white transition-colors cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-6 space-y-5">
                
                <div id="cancel-refund-eligible-box" class="hidden p-5 bg-emerald-50 border-2 border-emerald-200 rounded-2xl">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-emerald-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-emerald-900">Anda berhak mendapatkan Refund 70%!</p>
                            <p class="text-[11px] text-emerald-700 mt-0.5">Pembatalan lebih dari 24 jam sebelum sesi</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3 bg-white rounded-xl p-3 border border-emerald-200">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-500">Total Pembayaran</p>
                            <p id="cancel-total-amount" class="text-sm font-black text-slate-900 mt-0.5">-</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-wider text-slate-500">Nominal Refund (70%)</p>
                            <p id="cancel-refund-amount" class="text-sm font-black text-emerald-700 mt-0.5">-</p>
                        </div>
                    </div>
                </div>

                
                <div id="cancel-no-refund-box" class="hidden p-5 bg-amber-50 border-2 border-amber-200 rounded-2xl">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 bg-amber-500 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm font-black text-amber-900">Tidak Ada Refund</p>
                            <p class="text-[11px] text-amber-700 mt-1 leading-relaxed">Sesuai kebijakan Studio.mu, pembatalan yang dilakukan <strong>kurang dari 24 jam sebelum sesi dimulai</strong> tidak mendapatkan pengembalian dana. Anda tetap dapat melanjutkan pembatalan.</p>
                        </div>
                    </div>
                </div>

                
                <div id="cancel-bank-form" class="hidden space-y-4">
                    <div class="border-t border-slate-100 pt-4">
                        <h4 class="text-xs font-black uppercase tracking-wider text-slate-700 mb-3">Data Rekening untuk Transfer Refund</h4>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1.5">Nama Bank</label>
                                <input type="text" id="cancel-bank-name" placeholder="Contoh: BCA, BNI, Mandiri, BRI..."
                                    class="w-full px-4 py-3 text-xs border-2 border-slate-200 rounded-xl focus:outline-none focus:border-slate-800 focus:ring-2 focus:ring-slate-800/10 transition-all font-medium placeholder-slate-400">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1.5">Nomor Rekening</label>
                                <input type="text" id="cancel-account-number" placeholder="Masukkan nomor rekening..."
                                    class="w-full px-4 py-3 text-xs border-2 border-slate-200 rounded-xl focus:outline-none focus:border-slate-800 focus:ring-2 focus:ring-slate-800/10 transition-all font-medium placeholder-slate-400">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1.5">Nama Pemilik Rekening</label>
                                <input type="text" id="cancel-account-holder" placeholder="Nama sesuai buku tabungan..."
                                    class="w-full px-4 py-3 text-xs border-2 border-slate-200 rounded-xl focus:outline-none focus:border-slate-800 focus:ring-2 focus:ring-slate-800/10 transition-all font-medium placeholder-slate-400">
                            </div>
                        </div>
                    </div>
                </div>

                
                <div id="cancel-error-msg" class="hidden p-3 bg-rose-50 border border-rose-200 rounded-xl text-xs font-bold text-rose-700"></div>

                
                <div class="flex gap-3 pt-2">
                    <button onclick="closeCancelModal()" class="flex-1 px-5 py-3 border-2 border-slate-200 hover:bg-slate-50 text-slate-600 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all cursor-pointer">
                        Kembali
                    </button>
                    <button id="cancel-confirm-btn" onclick="confirmCancelBooking()"
                        class="flex-1 px-5 py-3 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all active:scale-95 cursor-pointer shadow-sm border-none flex items-center justify-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Konfirmasi Pembatalan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentCancelBookingId = null;
    let currentCancelEligibleForRefund = false;
    const cancelCsrfToken = '<?php echo e(csrf_token()); ?>';

    function openCancelModal(bookingId) {
        currentCancelBookingId = bookingId;
        currentCancelEligibleForRefund = false;

        // Show modal in loading state
        const modal = document.getElementById('cancel-booking-modal');
        const card = document.getElementById('cancel-modal-card');
        document.getElementById('cancel-modal-loading').classList.remove('hidden');
        document.getElementById('cancel-modal-content').classList.add('hidden');

        modal.classList.remove('opacity-0', 'pointer-events-none');
        card.classList.remove('scale-95', 'opacity-0');
        document.body.style.overflow = 'hidden';

        // Fetch cancel info
        fetch(`/customer/bookings/${bookingId}/cancel-info`, {
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': cancelCsrfToken }
        })
        .then(r => r.json())
        .then(data => {
            document.getElementById('cancel-modal-loading').classList.add('hidden');
            document.getElementById('cancel-modal-content').classList.remove('hidden');
            document.getElementById('cancel-modal-booking-id').textContent = '#' + data.booking_id + ' — ' + data.service_name;
            document.getElementById('cancel-error-msg').classList.add('hidden');

            if (data.eligible_for_refund) {
                currentCancelEligibleForRefund = true;
                document.getElementById('cancel-refund-eligible-box').classList.remove('hidden');
                document.getElementById('cancel-no-refund-box').classList.add('hidden');
                document.getElementById('cancel-bank-form').classList.remove('hidden');
                document.getElementById('cancel-total-amount').textContent = 'Rp ' + data.total_amount.toLocaleString('id-ID');
                document.getElementById('cancel-refund-amount').textContent = 'Rp ' + data.refund_amount.toLocaleString('id-ID');
            } else {
                currentCancelEligibleForRefund = false;
                document.getElementById('cancel-refund-eligible-box').classList.add('hidden');
                document.getElementById('cancel-no-refund-box').classList.remove('hidden');
                document.getElementById('cancel-bank-form').classList.add('hidden');
            }
        })
        .catch(() => {
            document.getElementById('cancel-modal-loading').classList.add('hidden');
            document.getElementById('cancel-modal-content').classList.remove('hidden');
            document.getElementById('cancel-no-refund-box').classList.remove('hidden');
            document.getElementById('cancel-refund-eligible-box').classList.add('hidden');
            document.getElementById('cancel-bank-form').classList.add('hidden');
        });
    }

    function closeCancelModal() {
        const modal = document.getElementById('cancel-booking-modal');
        const card = document.getElementById('cancel-modal-card');
        modal.classList.add('opacity-0', 'pointer-events-none');
        card.classList.add('scale-95', 'opacity-0');
        document.body.style.overflow = '';
        currentCancelBookingId = null;
    }

    function confirmCancelBooking() {
        if (!currentCancelBookingId) return;

        const btn = document.getElementById('cancel-confirm-btn');
        const errorEl = document.getElementById('cancel-error-msg');
        errorEl.classList.add('hidden');

        const body = {};
        if (currentCancelEligibleForRefund) {
            const bankName = document.getElementById('cancel-bank-name').value.trim();
            const accountNumber = document.getElementById('cancel-account-number').value.trim();
            const accountHolder = document.getElementById('cancel-account-holder').value.trim();
            if (!bankName || !accountNumber || !accountHolder) {
                errorEl.textContent = 'Harap lengkapi semua data rekening bank untuk mengajukan refund.';
                errorEl.classList.remove('hidden');
                return;
            }
            body.bank_name = bankName;
            body.account_number = accountNumber;
            body.account_holder = accountHolder;
        }

        btn.disabled = true;
        btn.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg> Memproses...';

        fetch(`/customer/bookings/${currentCancelBookingId}/cancel`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': cancelCsrfToken
            },
            body: JSON.stringify(body)
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                closeCancelModal();
                // Show success and reload
                const container = document.getElementById('history-notification-container');
                const msg = data.eligible_for_refund
                    ? '✅ Booking berhasil dibatalkan. Permintaan refund Anda sedang diproses oleh admin.'
                    : '✅ Booking berhasil dibatalkan.';
                if (container) {
                    container.innerHTML = `<div class="flex items-center gap-3 px-5 py-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-xs font-semibold">${msg}</div>`;
                    container.classList.remove('hidden');
                }
                setTimeout(() => window.location.reload(), 1800);
            } else {
                errorEl.textContent = data.message || 'Terjadi kesalahan. Silakan coba lagi.';
                errorEl.classList.remove('hidden');
                btn.disabled = false;
                btn.innerHTML = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg> Konfirmasi Pembatalan';
            }
        })
        .catch(() => {
            errorEl.textContent = 'Terjadi kesalahan jaringan. Silakan coba lagi.';
            errorEl.classList.remove('hidden');
            btn.disabled = false;
            btn.innerHTML = '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg> Konfirmasi Pembatalan';
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/customer/history.blade.php ENDPATH**/ ?>

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

            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: [],
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
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
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
            // 3. Service Popularity (Bar)
            const serviceElement = document.getElementById('serviceChart');
            if (!serviceElement) console.error("serviceChart canvas not found!");
            const ctxService = serviceElement.getContext('2d');
            new Chart(ctxService, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Jumlah Booking',
                        data: [],
                        backgroundColor: '#8b5cf6', // violet-500
                        borderRadius: 6,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { stepSize: 1 } },
                        x: { grid: { display: false } }
                    }
                }
            });

            console.log("Initializing Photographer Chart...");
            // 4. Photographer Workload (Bar)
            const photoElement = document.getElementById('photographerChart');
            if (!photoElement) console.error("photographerChart canvas not found!");
            const ctxPhoto = photoElement.getContext('2d');
            new Chart(ctxPhoto, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Sesi Diselesaikan',
                        data: [],
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
    let users = [];
    let transactions = [];
    let dbRewards = [];

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

    // Save functions to Local Storage
    function persistData(key, data) {
        localStorage.setItem(key, JSON.stringify(data));
        updateOverviewStats();
    }

    // Update Overview Stats values
    function updateOverviewStats() {
        // Stats calculations
        let totalRevenue = 0;
        let pendingCount = 0;
        
        transactions.forEach(tx => {
            if (tx.status === 'Confirmed' || tx.status === 'Completed') {
                const numericPrice = parseInt(tx.amount.replace(/[^0-9]/g, ''));
                totalRevenue += numericPrice;
            }
            if (tx.status === 'Pending') {
                pendingCount++;
            }
        });

        // Format to Indonesian Rupiah Millions/Thousands
        let formattedRevenue = 'Rp ' + totalRevenue.toLocaleString('id-ID');

        document.getElementById('stat-revenue').textContent = formattedRevenue;
        document.getElementById('stat-pending').textContent = pendingCount;
        
        // Dynamic badge text for pending
        const pendingBadge = document.getElementById('stat-pending-badge');
        if (pendingCount > 0) {
            pendingBadge.textContent = 'Butuh Tindakan Admin';
            pendingBadge.className = 'text-[9px] font-black text-rose-400 mt-4 inline-block uppercase tracking-widest bg-rose-500/10 px-2.5 py-1 rounded border border-rose-500/20 animate-pulse shadow-sm shadow-rose-500/5';
        } else {
            pendingBadge.textContent = 'Semua Bersih';
            pendingBadge.className = 'text-[9px] font-black text-slate-400 mt-4 inline-block uppercase tracking-widest bg-slate-800/50 px-2.5 py-1 rounded border border-slate-700/50';
        }

        document.getElementById('stat-services').textContent = 0;
        document.getElementById('stat-customers').textContent = users.filter(u => u.role === 'customer').length;
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
        openModal('modal-user');
    }

    function saveUser() {
        const index = parseInt(document.getElementById('form-user-index').value);
        const name = document.getElementById('form-user-name').value.trim();
        const email = document.getElementById('form-user-email').value.trim();
        const role = document.getElementById('form-user-role').value;
        const password = document.getElementById('form-user-password').value;

        if (!name || !email) {
            alert('Mohon isi seluruh data form secara lengkap!');
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
    window.addEventListener('DOMContentLoaded', () => {
        updateOverviewStats();
        renderUsers();
        switchTab('overview');
        
        // Use a short delay to ensure the DOM is fully unhidden (display: block)
        // so that Chart.js can calculate dimensions correctly.
        setTimeout(initCharts, 100);
    });

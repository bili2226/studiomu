@extends('layouts.dashboard')

@section('title', 'Loyalty & Reward')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    @php
        $settingsPath = storage_path('app/settings.json');
        $multiplier = 10000;
        if (file_exists($settingsPath)) {
            $settings = json_decode(file_get_contents($settingsPath), true);
            $multiplier = $settings['points_multiplier'] ?? 10000;
        }
    @endphp

    <div class="mb-6">
        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400 mb-1">Program Loyalitas</p>
        <h1 class="text-2xl font-serif italic font-bold text-slate-900">Loyalty & Reward</h1>
    </div>

    <!-- Settings Loyalty Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-stretch">
        <!-- Points Multiplier Setup -->
        <div class="lg:col-span-4 admin-card-dark bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50 flex flex-col justify-between">
            <div>
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-2">Skema Loyalitas</h4>
                <h3 class="text-xl font-serif italic font-bold text-slate-900 mb-6">Konfigurasi Rasio Poin</h3>
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-755 mb-2">Nilai Transaksi per 1 Poin</label>
                        <div class="relative rounded-2xl border border-white focus-within:border-white focus-within:ring-4 focus-within:ring-white/20 overflow-hidden flex items-center px-4 bg-transparent transition-all duration-300">
                            <span class="text-xs font-black text-white mr-2">Rp</span>
                            <input type="number" id="setting-multiplier" value="{{ $multiplier }}" class="w-full bg-transparent border-0 py-3.5 text-xs font-semibold focus:outline-none text-white focus:ring-0" style="background-color: transparent !important;">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-750 mb-2">Tier Leveling (Silver/Gold)</label>
                        <p class="text-slate-700 text-[11px] leading-relaxed font-semibold">Silver Member di atas 150 poin, Gold Member di atas 400 poin secara otomatis disematkan pada data member.</p>
                    </div>
                </div>
            </div>
            <button onclick="saveLoyaltySettings()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                SIMPAN PENGATURAN LOYALITAS
            </button>
        </div>

        <!-- Loyalty Catalogue Table -->
        <div class="lg:col-span-8 admin-card-blue bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden flex flex-col" style="border-left: 2px solid #111827 !important; border-right: 2px solid #111827 !important;">
            <div class="flex justify-between items-center p-8 pb-6 bg-white">
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700">Katalog Voucher</h4>
                    <h3 class="text-xl font-serif italic font-bold text-slate-900 mt-1">Reward Penukaran Poin</h3>
                </div>
                <a href="{{ route('admin.rewards.index') }}" class="inline-flex items-center gap-1.5 bg-amber-800 hover:bg-amber-900 text-white font-black uppercase tracking-widest text-[9px] py-2.5 px-4 rounded-xl transition-all shadow-md active:scale-95">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" /></svg>
                    Kelola Katalog
                </a>
            </div>
            <div class="overflow-hidden flex-1">
                <table class="w-full table-fixed text-left text-xs border-collapse">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #0f2942 0%, #0d3d5e 100%);">
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-[22%]">Kode Voucher</th>
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-[38%]">Nama Reward</th>
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-[20%]">Biaya Poin</th>
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-[20%]">Status</th>
                        </tr>
                    </thead>
                    <tbody class="font-semibold text-slate-800 bg-white">
                        @forelse ($rewards as $reward)
                        <tr class="hover:bg-slate-50 transition-colors border-b border-black">
                            <td class="px-6 py-3.5"><span class="bg-slate-50 text-slate-800 border border-slate-200 rounded-lg px-2.5 py-1 text-[9px] font-black uppercase tracking-widest font-sans inline-block shadow-sm">{{ $reward->code }}</span></td>
                            <td class="px-6 py-3.5 text-slate-900">{{ $reward->name }}</td>
                            <td class="px-6 py-3.5"><span class="text-amber-800 font-extrabold font-sans text-[10px] bg-amber-50 border border-amber-200 rounded-full px-3 py-1 inline-block shadow-sm">{{ $reward->points_required }} PTS</span></td>
                            <td class="px-6 py-3.5">
                                @if ($reward->status === 'active')
                                    <span class="bg-emerald-50 text-emerald-800 border border-emerald-200 rounded-full px-3 py-1 font-black text-[9px] uppercase tracking-wider inline-block shadow-sm">AKTIF</span>
                                @else
                                    <span class="bg-slate-100 text-slate-500 border border-slate-200 rounded-full px-3 py-1 font-black text-[9px] uppercase tracking-wider inline-block shadow-sm">NONAKTIF</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-slate-500 font-semibold italic text-xs">Belum ada reward terdaftar di database.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Loyalty Points Table balance -->
    <div class="admin-card-gold bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden mb-12" style="border-left: 2px solid #111827 !important; border-right: 2px solid #111827 !important;">
        <div class="p-6 sm:p-8 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
            <div>
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-1">Database Poin</h4>
                <h2 class="text-2xl font-serif italic font-bold text-slate-900">Informasi Point Loyalitas Pelanggan</h2>
            </div>
            <input type="text" id="search-loyalty" oninput="renderLoyalty()" placeholder="Cari pelanggan..." class="border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-2.5 text-xs focus:outline-none font-semibold min-w-[200px] bg-white text-slate-900 transition-all duration-300">
        </div>

        <div class="overflow-hidden">
            <table class="w-full table-fixed text-left border-collapse">
                <thead>
                    <tr style="background: linear-gradient(135deg, #0f2942 0%, #0d3d5e 100%);">
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-[20%]">Pelanggan</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-[22%]">Alamat Email</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-[18%]">Total Poin</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-[18%]">Tier Member</th>
                        <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 text-center w-[22%]">Aksi Penyesuaian</th>
                    </tr>
                </thead>
                <tbody id="loyalty-table-body" class="text-xs font-semibold text-slate-800 bg-white">
                    <!-- Loaded dynamically -->
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODALS --}}

    {{-- MODAL C: CUSTOM LOYALTY MANUAL POINTS ADJUSTMENT MODAL --}}
    <div id="modal-points" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="modal-card bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-md overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col">
            <button onclick="closePointsModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 id="modal-points-title" class="text-2xl font-serif italic font-bold text-slate-900 mb-1">Sesuaikan Poin Pelanggan</h3>
            <p id="modal-points-subtitle" class="text-xs text-slate-700 mb-6 font-semibold tracking-wide"></p>
            <input type="hidden" id="form-points-email">
            <input type="hidden" id="form-points-user-id">
            <div class="space-y-5">
                <input type="hidden" id="form-points-method" value="ADD">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Jumlah Poin</label>
                    <div class="relative flex items-center">
                        <button type="button" onclick="document.getElementById('form-points-value').stepDown()" class="absolute left-2 w-9 h-9 flex items-center justify-center bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl transition-all font-black text-lg focus:outline-none">-</button>
                        <input type="number" id="form-points-value" value="50" min="1" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-12 py-3.5 text-center text-lg font-bold focus:outline-none text-slate-900 transition-all duration-300">
                        <button type="button" onclick="document.getElementById('form-points-value').stepUp()" class="absolute right-2 w-9 h-9 flex items-center justify-center bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-xl transition-all font-black text-lg focus:outline-none">+</button>
                    </div>
                </div>
            </div>
            <button onclick="savePointsAdjust()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                KONFIRMASI PENYESUAIAN POIN
            </button>
        </div>
    </div>

    {{-- MODAL REDEEM: CUSTOMER REWARD CLAIM REDEMPTION MODAL --}}
    <div id="modal-redeem" class="fixed inset-0 bg-slate-900/60 backdrop-blur-md z-50 flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div class="modal-card bg-white border border-slate-200 rounded-[2.5rem] shadow-2xl w-full max-w-md overflow-hidden transform scale-95 opacity-0 transition-all duration-300 relative z-10 p-9 flex flex-col">
            <button onclick="closeRedeemModal()" class="absolute top-6 right-6 z-20 w-10 h-10 flex items-center justify-center rounded-full bg-slate-50 hover:bg-slate-100 text-slate-700 border border-slate-200 transition-all duration-300 hover:rotate-90 hover:scale-105 shadow-sm cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <h3 class="text-2xl font-serif italic font-bold text-slate-900 mb-1">Klaim Reward Pelanggan</h3>
            <p id="modal-redeem-subtitle" class="text-xs text-slate-700 mb-6 font-semibold tracking-wide"></p>
            <input type="hidden" id="form-redeem-email">
            <input type="hidden" id="form-redeem-user-id">
            <div class="space-y-5">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-wider text-slate-700 mb-2">Pilih Reward untuk Ditukarkan</label>
                    <div class="relative bg-slate-50 border border-slate-200 rounded-2xl p-1 focus-within:border-amber-600 focus-within:ring-4 focus-within:ring-amber-500/10 overflow-hidden flex items-center transition-all duration-300">
                        <select id="form-redeem-reward-id" class="w-full bg-transparent px-4 py-3.5 text-xs font-black uppercase tracking-wider text-slate-755 focus:outline-none cursor-pointer">
                            <!-- Populated dynamically -->
                        </select>
                    </div>
                </div>
            </div>
            <button onclick="saveRedeemVoucher()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                PROSES PENUKARAN REWARD
            </button>
        </div>
    </div>

    {{-- TOAST ALERTS NOTIFICATIONS --}}
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
@endsection

@section('scripts')
<script>
    // State initialization from Backend data
    let loyalty = @json($customers);
    let dbRewards = @json($rewards->where('status', 'active')->values());
    let pointMultiplier = {{ $multiplier }};

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

    // Save points ratio configuration
    function saveLoyaltySettings() {
        const inputVal = parseInt(document.getElementById('setting-multiplier').value);
        if (isNaN(inputVal) || inputVal < 100) {
            alert('Rasio poin minimal adalah Rp 100 per poin!');
            return;
        }

        fetch("{{ route('admin.settings.multiplier') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ multiplier: inputVal })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                pointMultiplier = inputVal;
                triggerToast('Rasio Poin Loyalitas Berhasil Diperbarui!');
            } else {
                alert('Gagal memperbarui rasio poin.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan koneksi saat menyimpan pengaturan.');
        });
    }

    /* ─── TAB 5: LOYALTY DATABASE FUNCTIONS ─── */
    function renderLoyalty() {
        const tbody = document.getElementById('loyalty-table-body');
        if (!tbody) return;
        tbody.innerHTML = '';

        const searchQuery = document.getElementById('search-loyalty').value.toLowerCase().trim();

        const filtered = loyalty.filter(member => {
            return member.name.toLowerCase().includes(searchQuery) ||
                   member.email.toLowerCase().includes(searchQuery);
        });

        if (filtered.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-10 text-center text-slate-500 font-semibold italic text-xs">
                        Tidak ada data customer yang cocok dengan pencarian Anda.
                    </td>
                </tr>
            `;
            return;
        }

        filtered.forEach(member => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-slate-50 transition-colors border-b border-black last:border-0';

            // Determine loyalty level tier
            let tierName = 'Bronze Member';
            let tierColor = 'bg-slate-100 text-slate-800 border-slate-200';
            if (member.points >= 400) {
                tierName = '👑 Gold Member';
                tierColor = 'bg-amber-100 text-amber-900 border-amber-300/60 font-serif italic';
            } else if (member.points >= 150) {
                tierName = '✨ Silver Member';
                tierColor = 'bg-slate-100 text-slate-900 border-slate-350';
            }

            tr.innerHTML = `
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center font-serif text-[11px] font-black uppercase text-amber-800 shadow-sm flex-shrink-0">
                            ${member.name.substring(0, 2)}
                        </div>
                        <p class="font-serif italic font-bold text-slate-900 text-sm">${member.name}</p>
                    </div>
                </td>
                <td class="px-6 py-4 font-sans text-xs font-semibold text-slate-700">${member.email}</td>
                <td class="px-6 py-4">
                    <span class="text-amber-800 font-extrabold font-sans text-xs bg-amber-50 border border-amber-200 rounded-full px-3.5 py-1.5 inline-block shadow-sm">
                        ${member.points.toLocaleString('id-ID')} PTS
                    </span>
                </td>
                <td class="px-6 py-4">
                    <span class="px-3.5 py-1.5 rounded-full border text-[9px] font-black uppercase tracking-wider inline-block shadow-sm ${tierColor}">
                        ${tierName}
                    </span>
                </td>
                <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <button onclick="openPointsModal('${member.email}', '${member.name.replace(/'/g, "\\'")}', ${member.points}, ${member.id})" 
                                class="px-3.5 py-2 bg-amber-500 text-white border border-transparent hover:bg-amber-600 text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">
                            Sesuaikan Poin
                        </button>
                        <button onclick="openRedeemModal('${member.email}', '${member.name.replace(/'/g, "\\'")}', ${member.points}, ${member.id})" 
                                class="px-3.5 py-2 bg-slate-600 text-white border border-transparent hover:bg-slate-700 text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">
                            Klaim Voucher
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
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

    // Modal Points adjustment logic
    function openPointsModal(email, name, points, id) {
        document.getElementById('modal-points-subtitle').textContent = `Customer: ${name} (${email}) - Poin Sekarang: ${points} pts`;
        document.getElementById('form-points-email').value = email;
        document.getElementById('form-points-user-id').value = id;
        document.getElementById('form-points-value').value = points;
        document.getElementById('form-points-method').value = 'SET';
        openModal('modal-points');
    }

    function savePointsAdjust() {
        const userId = document.getElementById('form-points-user-id').value;
        const value = parseInt(document.getElementById('form-points-value').value);
        const method = document.getElementById('form-points-method').value;

        if (isNaN(value) || value < 0) {
            alert('Jumlah poin harus berupa angka positif!');
            return;
        }

        const actionParam = method === 'SET' ? 'set' : (method === 'ADD' ? 'add' : 'sub');

        fetch(`/admin/users/${userId}/points`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                points: value,
                action: actionParam
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('Request failed');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update local memory list
                const member = loyalty.find(m => m.id === data.user.id);
                if (member) {
                    member.points = data.user.points;
                }
                renderLoyalty();
                closePointsModal();
                triggerToast('Poin Pelanggan Berhasil Diperbarui!');
            } else {
                alert('Gagal menyimpan penyesuaian poin.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan sistem saat menghubungi server.');
        });
    }

    function closePointsModal() {
        closeModal('modal-points');
    }

    // Modal Claim Redemption logic
    function openRedeemModal(email, name, points, id) {
        document.getElementById('modal-redeem-subtitle').textContent = `Customer: ${name} (${email}) - Poin Sekarang: ${points} pts`;
        document.getElementById('form-redeem-email').value = email;
        document.getElementById('form-redeem-user-id').value = id;

        // Populating dynamic list of rewards client-side based on user points
        const select = document.getElementById('form-redeem-reward-id');
        select.innerHTML = '';

        if (dbRewards.length === 0) {
            select.innerHTML = `<option value="">Tidak ada reward aktif terdaftar</option>`;
        } else {
            dbRewards.forEach(reward => {
                const option = document.createElement('option');
                option.value = reward.id;
                option.textContent = `${reward.code} - ${reward.name} (Butuh ${reward.points_required} Poin)`;
                // Disable option if user points are insufficient
                if (points < reward.points_required) {
                    option.disabled = true;
                    option.textContent += ' [Poin Kurang]';
                }
                select.appendChild(option);
            });
        }

        openModal('modal-redeem');
    }

    function saveRedeemVoucher() {
        const userId = document.getElementById('form-redeem-user-id').value;
        const rewardId = document.getElementById('form-redeem-reward-id').value;

        if (!rewardId) {
            alert('Silakan pilih reward yang ingin ditukarkan terlebih dahulu!');
            return;
        }

        const selectedReward = dbRewards.find(r => r.id == rewardId);
        if (!selectedReward) return;

        // Confirm
        if (!confirm(`Klaim voucher "${selectedReward.name}" dengan menukarkan ${selectedReward.points_required} poin dari customer?`)) return;

        fetch(`/admin/users/${userId}/points`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                points: selectedReward.points_required,
                action: 'sub'
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('Request failed');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update local memory list
                const member = loyalty.find(m => m.id === data.user.id);
                if (member) {
                    member.points = data.user.points;
                }
                renderLoyalty();
                closeRedeemModal();
                triggerToast('Reward Berhasil Diklaim dan Poin Customer Dikurangi!');
            } else {
                alert('Gagal memproses penukaran voucher.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan sistem saat menghubungi server.');
        });
    }

    function closeRedeemModal() {
        closeModal('modal-redeem');
    }

    // INITIALIZER
    window.addEventListener('DOMContentLoaded', () => {
        renderLoyalty();
    });
</script>
@endsection

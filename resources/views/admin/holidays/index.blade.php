@extends('layouts.dashboard')

@section('title', 'Kelola Hari Libur & Jam Sesi')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="mb-6">
        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400 mb-1">Operasional Toko</p>
        <h1 class="text-2xl font-serif italic font-bold text-slate-900">Kelola Hari Libur & Jam Sesi</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-stretch">
        <!-- Add Holiday Form -->
        <div class="lg:col-span-4 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50 flex flex-col justify-between">
            <div>
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-2">Operasional Studio</h4>
                <h3 class="text-xl font-serif italic font-bold text-slate-900 mb-6">Tambah Hari Libur</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-750 mb-2">Pilih Tanggal</label>
                        <div class="relative bg-slate-50 border border-slate-200 rounded-2xl p-1 focus-within:border-amber-600 focus-within:ring-4 focus-within:ring-amber-500/10 overflow-hidden flex items-center transition-all duration-300 shadow-sm">
                            <input type="date" id="holiday-form-date" class="w-full bg-transparent px-4 py-3 text-xs font-semibold focus:outline-none text-slate-900 cursor-pointer">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-755 mb-2">Keterangan / Alasan Libur</label>
                        <input type="text" id="holiday-form-desc" placeholder="Contoh: Libur Idul Fitri, Tutup Rutin" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300 shadow-sm">
                    </div>
                </div>
            </div>
            <button onclick="saveHoliday()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                SIMPAN HARI LIBUR TOKO
            </button>
        </div>

        <!-- Holidays List Table -->
        <div class="lg:col-span-8 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700">Daftar Penutupan Toko</h4>
                    <h3 class="text-xl font-serif italic font-bold text-slate-900 mt-1">Jadwal Hari Libur Studio</h3>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-700 bg-slate-50">
                            <th class="px-4 py-4 w-12">No</th>
                            <th class="px-4 py-4 w-44">Tanggal Libur</th>
                            <th class="px-4 py-4">Keterangan / Alasan</th>
                            <th class="px-4 py-4 text-center w-28">Aksi Pengelolaan</th>
                        </tr>
                    </thead>
                    <tbody id="holidays-table-body" class="divide-y divide-slate-100 font-semibold text-slate-800 bg-white">
                        <!-- Loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Manage Session Hours Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-stretch mt-8">
        <!-- Add Session Hour Form -->
        <div class="lg:col-span-4 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50 flex flex-col justify-between">
            <div>
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-2">Operasional Studio</h4>
                <h3 class="text-xl font-serif italic font-bold text-slate-900 mb-6">Tambah Jam Sesi</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-755 mb-2">Tentukan Jam Sesi (Contoh: "10:00 WIB")</label>
                        <input type="text" id="slot-form-time" placeholder="Contoh: 10:00 WIB atau 13:30 WIB" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300 shadow-sm">
                    </div>
                </div>
            </div>
            <button onclick="saveTimeSlot()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                SIMPAN JAM SESI BARU
            </button>
        </div>

        <!-- Session Hours List Table -->
        <div class="lg:col-span-8 bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700">Slot Waktu Pemotretan</h4>
                    <h3 class="text-xl font-serif italic font-bold text-slate-900 mt-1">Daftar Jam Sesi Studio</h3>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-[9px] font-black uppercase tracking-widest text-slate-700 bg-slate-50">
                            <th class="px-4 py-4 w-12">No</th>
                            <th class="px-4 py-4">Jam Sesi</th>
                            <th class="px-4 py-4 text-center w-28">Aksi Pengelolaan</th>
                        </tr>
                    </thead>
                    <tbody id="slots-table-body" class="divide-y divide-slate-100 font-semibold text-slate-800 bg-white">
                        <!-- Loaded dynamically -->
                    </tbody>
                </table>
            </div>
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
    const defaultHolidays = [
        { date: "2026-05-29", desc: "Hari Raya Waisak (Studio Libur)" },
        { date: "2026-06-01", desc: "Hari Lahir Pancasila (Studio Libur)" }
    ];

    const defaultTimeSlots = ["09.00 - 10.00", "11.30 - 12.30", "14.00 - 15.00", "16.30 - 17.30", "19.00 - 20.00", "21.00 - 22.00"];

    let holidays = JSON.parse(localStorage.getItem('studio_holidays')) || defaultHolidays;
    let timeSlots = JSON.parse(localStorage.getItem('studio_time_slots')) || defaultTimeSlots;

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

    /* ─── MANAGE HOLIDAYS FUNCTIONS ─── */
    function renderHolidays() {
        const tbody = document.getElementById('holidays-table-body');
        if (!tbody) return;
        tbody.innerHTML = '';

        if (holidays.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-slate-500 font-semibold italic text-xs">Belum ada hari libur toko yang ditambahkan.</td>
                </tr>
            `;
            return;
        }

        holidays.forEach((h, idx) => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-slate-50 transition-colors border-b border-slate-100';
            
            const dateStr = typeof h === 'string' ? h : h.date;
            const descStr = typeof h === 'string' ? 'Studio Libur Rutin' : h.desc;

            let formattedDate = dateStr;
            try {
                const dateObj = new Date(dateStr);
                const options = { year: 'numeric', month: 'long', day: 'numeric' };
                formattedDate = dateObj.toLocaleDateString('id-ID', options);
            } catch (e) {
                console.error(e);
            }

            tr.innerHTML = `
                <td class="px-4 py-4 text-slate-700 font-sans text-xs">${idx + 1}</td>
                <td class="px-4 py-4 font-bold text-slate-900 font-sans text-xs">${formattedDate}</td>
                <td class="px-4 py-4 text-slate-700 text-xs font-semibold">${descStr}</td>
                <td class="px-4 py-4 text-center">
                    <button onclick="deleteHoliday(${idx})" class="px-3.5 py-2 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Hapus</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function saveHoliday() {
        const dateInput = document.getElementById('holiday-form-date');
        const descInput = document.getElementById('holiday-form-desc');

        const dateVal = dateInput.value;
        const descVal = descInput.value.trim() || 'Studio Libur';

        if (!dateVal) {
            alert('Silakan tentukan tanggal libur terlebih dahulu!');
            return;
        }

        const exists = holidays.some(h => {
            const existingDate = typeof h === 'string' ? h : h.date;
            return existingDate === dateVal;
        });

        if (exists) {
            alert('Tanggal libur tersebut sudah terdaftar!');
            return;
        }

        holidays.push({ date: dateVal, desc: descVal });
        persistHolidays();
        renderHolidays();

        dateInput.value = '';
        descInput.value = '';

        triggerToast('Hari Libur Toko Berhasil Ditambahkan!');
    }

    function deleteHoliday(index) {
        if (!confirm('Apakah Anda yakin ingin menghapus hari libur ini? Toko akan dibuka kembali pada tanggal tersebut.')) return;
        
        holidays.splice(index, 1);
        persistHolidays();
        renderHolidays();
        triggerToast('Hari Libur Toko Telah Dihapus.');
    }

    function persistHolidays() {
        localStorage.setItem('studio_holidays', JSON.stringify(holidays));
    }

    /* ─── MANAGE SESSION HOURS ─── */
    function renderTimeSlots() {
        const tbody = document.getElementById('slots-table-body');
        if (!tbody) return;
        tbody.innerHTML = '';

        if (timeSlots.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="3" class="px-4 py-6 text-center text-slate-500 font-semibold italic text-xs">Belum ada jam sesi yang ditambahkan.</td>
                </tr>
            `;
            return;
        }

        timeSlots.forEach((slot, idx) => {
            const tr = document.createElement('tr');
            tr.className = 'hover:bg-slate-50 transition-colors border-b border-slate-100';

            tr.innerHTML = `
                <td class="px-4 py-4 text-slate-700 font-sans text-xs">${idx + 1}</td>
                <td class="px-4 py-4 font-bold text-slate-900 font-sans text-xs">${slot}</td>
                <td class="px-4 py-4 text-center">
                    <button onclick="deleteTimeSlot(${idx})" class="px-3.5 py-2 bg-rose-50 text-rose-700 border border-rose-200 hover:bg-rose-600 hover:text-white text-[9px] font-black uppercase tracking-widest rounded-full transition-all duration-300 active:scale-95 shadow-sm">Hapus</button>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function saveTimeSlot() {
        const slotInput = document.getElementById('slot-form-time');
        const slotVal = slotInput.value.trim();

        if (!slotVal) {
            alert('Silakan tentukan jam sesi terlebih dahulu!');
            return;
        }

        const exists = timeSlots.some(s => s.toLowerCase() === slotVal.toLowerCase());
        if (exists) {
            alert('Jam sesi tersebut sudah terdaftar!');
            return;
        }

        timeSlots.push(slotVal);
        timeSlots.sort((a, b) => {
            const timeA = a.replace(/[^0-9:]/g, '');
            const timeB = b.replace(/[^0-9:]/g, '');
            return timeA.localeCompare(timeB);
        });

        persistTimeSlots();
        renderTimeSlots();

        slotInput.value = '';
        triggerToast('Jam Sesi Baru Berhasil Ditambahkan!');
    }

    function deleteTimeSlot(index) {
        if (!confirm('Apakah Anda yakin ingin menghapus jam sesi ini? Pelanggan tidak akan dapat memilih jam ini untuk booking baru.')) return;
        
        timeSlots.splice(index, 1);
        persistTimeSlots();
        renderTimeSlots();
        triggerToast('Jam Sesi Telah Dihapus.');
    }

    function persistTimeSlots() {
        localStorage.setItem('studio_time_slots', JSON.stringify(timeSlots));
    }

    // INITIALIZER
    window.addEventListener('DOMContentLoaded', () => {
        renderHolidays();
        renderTimeSlots();
    });
</script>
@endsection

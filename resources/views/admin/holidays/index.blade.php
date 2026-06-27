@extends('layouts.dashboard')

@section('title', 'Kelola Operasional & Lokasi')

@section('sidebar')
    @include('admin.partials.sidebar')
@endsection

@section('content')
    <div class="mb-6">
        <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400 mb-1">Operasional Toko</p>
        <h1 class="text-2xl font-serif italic font-bold text-slate-900">Kelola Operasional & Lokasi</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-stretch">
        <!-- Add Holiday Form -->
        <div class="lg:col-span-4 admin-card-dark bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50 flex flex-col justify-between">
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
        <div class="lg:col-span-8 admin-card-blue bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden flex flex-col" style="border-left: 2px solid #111827 !important; border-right: 2px solid #111827 !important;">
            <div class="flex justify-between items-center p-8 pb-6 bg-white">
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700">Daftar Penutupan Toko</h4>
                    <h3 class="text-xl font-serif italic font-bold text-slate-900 mt-1">Jadwal Hari Libur Studio</h3>
                </div>
            </div>
            <div class="overflow-hidden flex-1">
                <table class="w-full table-fixed text-left text-xs border-collapse">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #0f2942 0%, #0d3d5e 100%);">
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-10">No</th>
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-36">Tanggal Libur</th>
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400">Keterangan / Alasan</th>
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 text-center w-28">Aksi Pengelolaan</th>
                        </tr>
                    </thead>
                    <tbody id="holidays-table-body" class="font-semibold text-slate-800 bg-white">
                        <!-- Loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Manage Session Hours Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-stretch mt-8">
        <!-- Add Session Hour Form -->
        <div class="lg:col-span-4 admin-card-dark bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50 flex flex-col justify-between">
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
        <div class="lg:col-span-8 admin-card-blue bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden flex flex-col" style="border-left: 2px solid #111827 !important; border-right: 2px solid #111827 !important;">
            <div class="flex justify-between items-center p-8 pb-6 bg-white">
                <div>
                    <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700">Slot Waktu Pemotretan</h4>
                    <h3 class="text-xl font-serif italic font-bold text-slate-900 mt-1">Daftar Jam Sesi Studio</h3>
                </div>
            </div>
            <div class="overflow-hidden flex-1">
                <table class="w-full table-fixed text-left text-xs border-collapse">
                    <thead>
                        <tr style="background: linear-gradient(135deg, #0f2942 0%, #0d3d5e 100%);">
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 w-12">No</th>
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400">Jam Sesi</th>
                            <th class="px-6 py-4 text-[9px] font-black uppercase tracking-widest text-amber-400 text-center w-28">Aksi Pengelolaan</th>
                        </tr>
                    </thead>
                    <tbody id="slots-table-body" class="font-semibold text-slate-800 bg-white">
                        <!-- Loaded dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Manage Google Maps and Location Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mb-12 items-stretch mt-8">
        <!-- Edit Location Settings Form -->
        <div class="lg:col-span-6 admin-card-dark bg-white border border-slate-200 p-8 rounded-[2rem] shadow-xl shadow-slate-100/50 flex flex-col justify-between">
            <div>
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-2">Lokasi & Navigasi</h4>
                <h3 class="text-xl font-serif italic font-bold text-slate-900 mb-6">Pengaturan Maps & Alamat</h3>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-white mb-2">Alamat Lengkap Studio</label>
                        <textarea id="location-form-address" placeholder="Contoh: Studio.mu Building, Jl. Sunset Boulevard No. 101, Jakarta Selatan, Indonesia" class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300 shadow-sm" rows="3">{{ $mapAddress }}</textarea>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-white mb-2">URL Embed Iframe Maps (src)</label>
                        <textarea id="location-form-iframe" placeholder="Contoh: https://www.google.com/maps/embed?pb=..." class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300 shadow-sm" rows="3">{{ $mapIframeUrl }}</textarea>
                        <span class="text-[9px] font-semibold text-white mt-1 block">Petunjuk: Buka Google Maps > Bagikan > Sematkan peta > salin nilai atribut `src` dari iframe.</span>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-white mb-2">Link Navigasi Google Maps (Tautan Langsung)</label>
                        <input type="text" id="location-form-link" value="{{ $mapLinkUrl }}" placeholder="Contoh: https://maps.google.com/?q=..." class="w-full bg-slate-50 border border-slate-200 focus:border-amber-600 focus:ring-4 focus:ring-amber-500/10 rounded-2xl px-4 py-3.5 text-xs font-semibold focus:outline-none text-slate-900 transition-all duration-300 shadow-sm">
                    </div>
                </div>
            </div>
            <button onclick="saveLocationSettings()" class="bg-gradient-to-r from-amber-50 to-amber-100 hover:from-amber-500 hover:to-amber-600 text-amber-800 hover:text-white font-black uppercase tracking-widest text-[9px] py-4 w-full rounded-2xl transition-all shadow-md shadow-amber-500/5 active:scale-95 mt-8 border border-amber-200">
                SIMPAN LOKASI & MAPS
            </button>
        </div>

        <!-- Maps Live Preview Card -->
        <div class="lg:col-span-6 admin-card-blue bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-100/50 overflow-hidden flex flex-col" style="border-left: 2px solid #111827 !important; border-right: 2px solid #111827 !important;">
            <div class="p-8 pb-6 bg-white">
                <h4 class="text-xs font-black uppercase tracking-[0.2em] text-slate-700 mb-2">Live Preview</h4>
                <h3 class="text-xl font-serif italic font-bold text-slate-900">Tampilan Lokasi di Customer</h3>
            </div>
            
            <div class="flex-grow flex flex-col justify-between bg-slate-50 border-t border-slate-100 p-6">
                <!-- Address Label -->
                <div class="mb-4">
                    <p class="text-[9px] font-black uppercase tracking-wider text-slate-400 mb-1">Alamat Studio</p>
                    <p id="preview-map-address" class="text-xs font-semibold text-slate-800 leading-relaxed">{{ $mapAddress }}</p>
                </div>
                
                <!-- Google Maps Iframe -->
                <div class="w-full h-40 bg-slate-200 rounded-xl overflow-hidden relative border border-slate-200 mb-4 shadow-sm">
                    <iframe id="preview-map-iframe" src="{{ $mapIframeUrl }}" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <!-- Google Maps Link Button -->
                <a id="preview-map-link" href="{{ $mapLinkUrl }}" target="_blank" class="w-full flex items-center justify-center gap-2 py-2.5 px-4 bg-white border border-slate-300 hover:border-slate-400 hover:bg-slate-50 text-slate-700 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all shadow-sm cursor-pointer">
                    <span>Buka di Google Maps</span>
                    <svg class="w-3.5 h-3.5 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                    </svg>
                </a>
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
    let holidays = @json($holidays);
    let timeSlots = @json($timeSlots);

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
            tr.className = 'hover:bg-slate-50 transition-colors border-b border-black';
            
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
                <td class="px-4 py-4 text-slate-700 text-xs font-semibold break-words whitespace-normal">${descStr}</td>
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

        fetch('/admin/holidays', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ date: dateVal, desc: descVal })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                holidays.push(data.holiday);
                
                // Sort holidays by date
                holidays.sort((a, b) => new Date(a.date) - new Date(b.date));
                
                renderHolidays();

                dateInput.value = '';
                descInput.value = '';

                triggerToast('Hari Libur Toko Berhasil Ditambahkan!');
            } else {
                alert('Gagal menyimpan hari libur.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan saat menyimpan hari libur.');
        });
    }

    function deleteHoliday(index) {
        if (!confirm('Apakah Anda yakin ingin menghapus hari libur ini? Toko akan dibuka kembali pada tanggal tersebut.')) return;
        
        const holidayId = holidays[index].id;
        
        fetch(`/admin/holidays/${holidayId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
                holidays.splice(index, 1);
                renderHolidays();
                triggerToast('Hari Libur Toko Telah Dihapus.');
            } else {
                alert('Gagal menghapus hari libur.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus hari libur.');
        });
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
            tr.className = 'hover:bg-slate-50 transition-colors border-b border-black';

            const timeStr = typeof slot === 'string' ? slot : slot.time;

            tr.innerHTML = `
                <td class="px-4 py-4 text-slate-700 font-sans text-xs">${idx + 1}</td>
                <td class="px-4 py-4 font-bold text-slate-900 font-sans text-xs">${timeStr}</td>
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

        const exists = timeSlots.some(s => {
            const existingTime = typeof s === 'string' ? s : s.time;
            return existingTime.toLowerCase() === slotVal.toLowerCase();
        });
        
        if (exists) {
            alert('Jam sesi tersebut sudah terdaftar!');
            return;
        }

        fetch('/admin/slots', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ time: slotVal })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                timeSlots.push(data.slot);
                
                // Sort slots
                timeSlots.sort((a, b) => {
                    const timeA = (typeof a === 'string' ? a : a.time).replace(/[^0-9:]/g, '');
                    const timeB = (typeof b === 'string' ? b : b.time).replace(/[^0-9:]/g, '');
                    return timeA.localeCompare(timeB);
                });

                renderTimeSlots();

                slotInput.value = '';
                triggerToast('Jam Sesi Baru Berhasil Ditambahkan!');
            } else {
                alert('Gagal menyimpan jam sesi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan saat menyimpan jam sesi.');
        });
    }

    function deleteTimeSlot(index) {
        if (!confirm('Apakah Anda yakin ingin menghapus jam sesi ini? Pelanggan tidak akan dapat memilih jam ini untuk booking baru.')) return;
        
        const slotId = timeSlots[index].id;

        fetch(`/admin/slots/${slotId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
                timeSlots.splice(index, 1);
                renderTimeSlots();
                triggerToast('Jam Sesi Telah Dihapus.');
            } else {
                alert('Gagal menghapus jam sesi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus jam sesi.');
        });
    }

    function saveLocationSettings() {
        const addressInput = document.getElementById('location-form-address');
        const iframeInput = document.getElementById('location-form-iframe');
        const linkInput = document.getElementById('location-form-link');

        const addressVal = addressInput.value.trim();
        const iframeVal = iframeInput.value.trim();
        const linkVal = linkInput.value.trim();

        if (!addressVal || !iframeVal || !linkVal) {
            alert('Semua field lokasi (alamat, iframe, link maps) wajib diisi!');
            return;
        }

        fetch('/admin/settings/location', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                map_address: addressVal,
                map_iframe_url: iframeVal,
                map_link_url: linkVal
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Update live preview card
                document.getElementById('preview-map-address').textContent = addressVal;
                document.getElementById('preview-map-iframe').src = iframeVal;
                document.getElementById('preview-map-link').href = linkVal;

                triggerToast('Pengaturan Lokasi & Google Maps Berhasil Disimpan!');
            } else {
                alert('Gagal menyimpan pengaturan lokasi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Terjadi kesalahan saat menyimpan pengaturan lokasi.');
        });
    }

    // INITIALIZER
    window.addEventListener('DOMContentLoaded', () => {
        renderHolidays();
        renderTimeSlots();

        // Sync LocalStorage to Database (Migration helper)
        const localHols = JSON.parse(localStorage.getItem('studio_holidays'));
        const localSlots = JSON.parse(localStorage.getItem('studio_time_slots'));

        if (localHols && Array.isArray(localHols)) {
            localHols.forEach(lh => {
                const dateStr = typeof lh === 'string' ? lh : lh.date;
                const descStr = typeof lh === 'string' ? 'Studio Libur Rutin' : lh.desc;

                const exists = holidays.some(h => (typeof h === 'string' ? h : h.date) === dateStr);
                if (!exists) {
                    fetch('/admin/holidays', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ date: dateStr, desc: descStr })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            holidays.push(data.holiday);
                            holidays.sort((a, b) => new Date(a.date) - new Date(b.date));
                            renderHolidays();
                        }
                    })
                    .catch(err => console.error(err));
                }
            });
            localStorage.removeItem('studio_holidays');
        }

        if (localSlots && Array.isArray(localSlots)) {
            localSlots.forEach(ls => {
                const timeStr = typeof ls === 'string' ? ls : ls.time;

                const exists = timeSlots.some(s => (typeof s === 'string' ? s : s.time).toLowerCase() === timeStr.toLowerCase());
                if (!exists) {
                    fetch('/admin/slots', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ time: timeStr })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            timeSlots.push(data.slot);
                            timeSlots.sort((a, b) => {
                                const timeA = (typeof a === 'string' ? a : a.time).replace(/[^0-9:]/g, '');
                                const timeB = (typeof b === 'string' ? b : b.time).replace(/[^0-9:]/g, '');
                                return timeA.localeCompare(timeB);
                            });
                            renderTimeSlots();
                        }
                    })
                    .catch(err => console.error(err));
                }
            });
            localStorage.removeItem('studio_time_slots');
        }
    });
</script>
@endsection

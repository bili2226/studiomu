<?php $__env->startSection('title', 'Edit Layanan'); ?>

<?php $__env->startSection('sidebar'); ?>
    <?php echo $__env->make('admin.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-white border border-slate-200 rounded-[2rem] shadow-2xl shadow-slate-200/40 overflow-hidden mb-12">
    <!-- Trix Editor Dependencies -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    <style>
        trix-toolbar [data-trix-button-group="file-tools"] { display: none; }
        .trix-content { font-family: 'Plus Jakarta Sans', sans-serif; }
        .trix-content ul { list-style-type: disc !important; margin-left: 1.5rem !important; }
        .trix-content ol { list-style-type: decimal !important; margin-left: 1.5rem !important; }
        .trix-button { background-color: #f8fafc !important; }
        .trix-button.trix-active { background-color: #e2e8f0 !important; }
    </style>

    <div class="p-6 sm:p-8 bg-slate-900">
        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-500 mb-1">Formulir Layanan</h4>
        <h2 class="text-2xl font-serif italic font-bold text-white">Edit Layanan: <?php echo e($service->title); ?></h2>
    </div>

    <form action="<?php echo e(route('admin.services.update', $service->id)); ?>" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 bg-slate-50/30">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <?php if($errors->any()): ?>
            <div class="mb-8 p-5 bg-rose-50 border border-rose-100 rounded-2xl text-rose-700 text-xs font-medium">
                <ul class="list-disc pl-5 space-y-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2.5">Nama Layanan</label>
                <input type="text" name="title" id="edit_title" value="<?php echo e(old('title', $service->title)); ?>" required class="w-full bg-white border border-slate-400 focus:border-slate-900 focus:ring-4 focus:ring-slate-900/5 rounded-xl px-4 py-3.5 text-xs focus:outline-none font-semibold text-slate-900 transition-all shadow-sm">
            </div>
            <div>
                <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2.5">Harga Mulai Dari</label>
                <input type="text" name="starting" id="edit_starting" value="<?php echo e(old('starting', $service->starting)); ?>" required class="w-full bg-white border border-slate-400 focus:border-slate-900 focus:ring-4 focus:ring-slate-900/5 rounded-xl px-4 py-3.5 text-xs focus:outline-none font-semibold text-slate-900 transition-all shadow-sm">
            </div>
        </div>

        
        <div class="mb-8">
            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2.5">Deskripsi Singkat</label>
            <input id="edit_description" type="hidden" name="description" value="<?php echo e(old('description', $service->description)); ?>">
            <trix-editor input="edit_description" class="w-full bg-white border border-slate-400 focus:border-slate-900 focus:ring-4 focus:ring-slate-900/5 rounded-xl px-4 py-3.5 text-xs focus:outline-none font-medium text-slate-800 transition-all trix-content min-h-[120px] shadow-sm"></trix-editor>
        </div>

        
        <div class="mb-8">
            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2.5">
                Catatan Tambahan <span class="text-slate-400 font-normal normal-case tracking-normal">(opsional)</span>
            </label>
            <input id="edit_note" type="hidden" name="note" value="<?php echo e(old('note', $service->note)); ?>">
            <trix-editor input="edit_note" class="w-full bg-white border border-slate-400 focus:border-slate-900 focus:ring-4 focus:ring-slate-900/5 rounded-xl px-4 py-3.5 text-xs focus:outline-none font-medium text-slate-800 transition-all trix-content min-h-[100px] shadow-sm"></trix-editor>
        </div>

        
        <div class="mb-8">
            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2.5">
                Foto / Slides Layanan <span class="text-slate-400 font-normal normal-case tracking-normal">(maks. 4MB per foto · JPG, PNG, WebP)</span>
            </label>
            <div class="flex flex-col gap-4 p-5 bg-white border border-slate-400 rounded-2xl w-full shadow-sm">
                
                <?php if(!empty($service->slides) && is_array($service->slides) && count(array_filter($service->slides)) > 0): ?>
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-3 block">Foto Saat Ini</span>
                    <div class="flex flex-wrap gap-4" id="existing-photos-container">
                        <?php $__currentLoopData = $service->slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($slide): ?>
                            <div class="relative w-32 h-32 rounded-2xl border-2 border-slate-200 overflow-hidden shadow-sm group existing-photo-card">
                                <img src="<?php echo e(Storage::url($slide)); ?>" alt="Foto <?php echo e($idx + 1); ?>" class="w-full h-full object-cover">
                                <button type="button" onclick="deleteExistingPhoto(this, '<?php echo e($slide); ?>')" class="absolute top-1.5 right-1.5 bg-rose-500 text-white rounded-lg w-7 h-7 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all focus:opacity-100 cursor-pointer shadow-md hover:bg-rose-600 hover:scale-105 active:scale-95">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
                
                <div id="delete-inputs-container"></div>

                <div class="pt-4 mt-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-3 block">Upload Foto Tambahan</span>
                    
                    <div id="image-preview-container" class="flex flex-wrap gap-4 hidden mb-4">
                        <!-- Previews injected via JS -->
                    </div>

                    <input type="file" name="slides[]" id="slides" accept="image/*" multiple class="hidden">
                    <button type="button" onclick="document.getElementById('slides').click()" class="px-6 py-3 bg-slate-900 text-white hover:bg-slate-800 font-bold text-[10px] uppercase tracking-widest rounded-xl transition-all flex items-center gap-2 cursor-pointer shadow-md shadow-slate-900/20 active:scale-95 w-fit">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        Pilih Foto
                    </button>
                    <p class="text-[10px] text-slate-500 mt-3 font-medium">Pilih satu per satu atau sekaligus. Foto baru akan ditambahkan (tidak menghapus foto saat ini).</p>
                </div>
            </div>
        </div>

        
        <div class="mb-10">
            <label class="block text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-2.5">Highlights / Keunggulan</label>
            <textarea name="highlights" id="edit_highlights" rows="4" class="w-full bg-white border border-slate-400 focus:border-slate-900 focus:ring-4 focus:ring-slate-900/5 rounded-xl px-4 py-3.5 text-xs focus:outline-none font-semibold text-slate-900 transition-all shadow-sm"><?php echo e(old('highlights', is_array($service->highlights) ? implode("\n", $service->highlights) : '')); ?></textarea>
            <p class="text-[10px] text-slate-500 mt-2 font-medium">Gunakan tombol Enter untuk memisahkan setiap poin. (Tanpa perlu kode HTML atau nomor)</p>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <div class="p-6 sm:p-8 bg-white border border-slate-400 rounded-[1.5rem] shadow-sm relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-slate-200"></div>
                <h5 class="text-[10px] font-black uppercase tracking-widest text-slate-800 mb-5 pb-3 border-b border-slate-100">Paket 1 (Basic / Silver)</h5>
                <div class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Judul Paket</label>
                        <input type="text" name="col1_title" value="<?php echo e(old('col1_title', $service->col1['title'] ?? '')); ?>" class="w-full bg-slate-50 border border-slate-400 focus:bg-white focus:border-slate-400 rounded-xl px-4 py-3 text-xs font-bold text-slate-800 transition-colors outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Harga Coret</label>
                            <input type="text" name="col1_old" value="<?php echo e(old('col1_old', $service->col1['old'] ?? '')); ?>" placeholder="Rp 0" class="w-full bg-slate-50 border border-slate-400 focus:bg-white focus:border-slate-400 rounded-xl px-4 py-3 text-xs font-semibold text-slate-600 transition-colors outline-none line-through">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-900 mb-2">Harga Baru</label>
                            <input type="text" name="col1_new" value="<?php echo e(old('col1_new', $service->col1['new'] ?? '')); ?>" placeholder="Rp 0" class="w-full bg-white border border-slate-300 focus:border-slate-900 rounded-xl px-4 py-3 text-xs font-bold text-slate-900 transition-colors outline-none shadow-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Fitur Paket</label>
                        <textarea name="col1_features" rows="5" class="w-full bg-slate-50 border border-slate-400 focus:bg-white focus:border-slate-400 rounded-xl px-4 py-3 text-xs font-medium text-slate-700 transition-colors outline-none" placeholder="Misal:&#10;2 Jam Sesi Foto&#10;1 Lokasi&#10;50 File Edited"><?php echo e(old('col1_features', is_array($service->col1['features'] ?? null) ? implode("\n", $service->col1['features']) : '')); ?></textarea>
                        <p class="text-[9px] text-slate-400 mt-1.5 font-medium">Gunakan tombol Enter untuk memisahkan poin.</p>
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8 bg-white border border-slate-400 rounded-[1.5rem] shadow-sm relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-amber-500"></div>
                
                <h5 class="text-[10px] font-black uppercase tracking-widest text-amber-600 mb-5 pb-3 border-b border-slate-100 flex items-center justify-between">
                    Paket 2 (Premium / Gold)
                    <span class="bg-amber-100 text-amber-600 px-2 py-0.5 rounded text-[8px] tracking-widest">REKOMENDASI</span>
                </h5>
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Judul Paket</label>
                        <input type="text" name="col2_title" value="<?php echo e(old('col2_title', $service->col2['title'] ?? '')); ?>" class="w-full bg-slate-50 border border-slate-400 focus:bg-white focus:border-amber-500 focus:ring-1 focus:ring-amber-500 rounded-xl px-4 py-3 text-xs font-bold text-slate-800 transition-colors outline-none">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Harga Coret</label>
                            <input type="text" name="col2_old" value="<?php echo e(old('col2_old', $service->col2['old'] ?? '')); ?>" placeholder="Rp 0" class="w-full bg-slate-50 border border-slate-400 focus:bg-white focus:border-amber-500 rounded-xl px-4 py-3 text-xs font-semibold text-slate-600 transition-colors outline-none line-through">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-amber-600 mb-2">Harga Baru</label>
                            <input type="text" name="col2_new" value="<?php echo e(old('col2_new', $service->col2['new'] ?? '')); ?>" placeholder="Rp 0" class="w-full bg-white border border-amber-300 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 rounded-xl px-4 py-3 text-xs font-bold text-slate-900 transition-colors outline-none shadow-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-2">Fitur Paket</label>
                        <textarea name="col2_features" rows="5" class="w-full bg-slate-50 border border-slate-400 focus:bg-white focus:border-amber-500 focus:ring-1 focus:ring-amber-500 rounded-xl px-4 py-3 text-xs font-medium text-slate-700 transition-colors outline-none" placeholder="Misal:&#10;4 Jam Sesi Foto&#10;2 Lokasi&#10;100 File Edited"><?php echo e(old('col2_features', is_array($service->col2['features'] ?? null) ? implode("\n", $service->col2['features']) : '')); ?></textarea>
                        <p class="text-[9px] text-slate-400 mt-1.5 font-medium">Gunakan tombol Enter untuk memisahkan poin.</p>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="mb-10 p-6 sm:p-8 bg-white border border-slate-400 rounded-[1.5rem] shadow-sm">
            <h5 class="text-[10px] font-black uppercase tracking-widest text-slate-800 mb-4 pb-3 border-b border-slate-100 flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Layanan Tambahan (Add-ons)
            </h5>
            <p class="text-xs font-medium text-slate-500 mb-5">Tambahkan item opsional yang dapat dipilih pelanggan saat memesan layanan ini (contoh: Makeup, Hairdo, Cetak Foto, dll.).</p>
            
            <div id="addons-container" class="space-y-3">
                <!-- Addon rows will be appended here dynamically -->
            </div>
            
            <button type="button" onclick="addAddonRow()" class="mt-5 inline-flex items-center gap-2 bg-slate-50 border border-slate-400 hover:border-slate-900 hover:bg-slate-900 hover:text-white text-slate-700 px-5 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all cursor-pointer shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                <span>Tambah Add-on</span>
            </button>
        </div>

        <div class="flex items-center gap-5 border-t border-slate-400 pt-8 mt-4">
            <button type="submit" id="btn-update-layanan" class="bg-amber-500 hover:bg-amber-600 text-white font-black uppercase tracking-[0.15em] text-[11px] py-4 px-10 rounded-xl transition-all shadow-lg shadow-amber-500/30 active:scale-95 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Update Layanan
            </button>
            <a href="<?php echo e(route('admin.services.index')); ?>" class="text-slate-500 hover:text-slate-800 font-bold text-xs transition-colors">Batal Kembali</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    let addonIndex = 0;

    function addAddonRow(name = '', price = '') {
        const container = document.getElementById('addons-container');
        const div = document.createElement('div');
        div.className = 'flex items-center gap-4 bg-slate-50 border border-slate-400 p-3 rounded-xl addon-row';
        div.innerHTML = `
            <div class="flex-1">
                <input type="text" name="addons[${addonIndex}][name]" value="${name}" placeholder="Nama Add-on (misal: Makeup)" required class="w-full bg-white border border-slate-400 focus:border-slate-900 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-800 transition-colors outline-none shadow-sm">
            </div>
            <div class="w-1/3">
                <input type="number" name="addons[${addonIndex}][price]" value="${price}" placeholder="Harga (Rp)" required class="w-full bg-white border border-slate-400 focus:border-slate-900 rounded-lg px-4 py-2.5 text-xs font-semibold text-slate-800 transition-colors outline-none shadow-sm">
            </div>
            <button type="button" onclick="this.closest('.addon-row').remove()" class="text-rose-500 hover:text-white hover:bg-rose-500 p-2.5 rounded-lg cursor-pointer transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                </svg>
            </button>
        `;
        container.appendChild(div);
        addonIndex++;
    }

    // Existing Photos Deletion
    function deleteExistingPhoto(btn, path) {
        if(!confirm('Yakin ingin menghapus foto ini?')) return;
        
        // Hide the UI
        btn.closest('.existing-photo-card').style.display = 'none';
        
        // Add hidden input to tell backend to delete
        const container = document.getElementById('delete-inputs-container');
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'delete_slides[]';
        input.value = path;
        container.appendChild(input);
    }

    // Custom Multiple File Uploader
    const fileInput = document.getElementById('slides');
    const previewContainer = document.getElementById('image-preview-container');
    let dataTransfer = new DataTransfer();

    fileInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        if(files.length === 0) return;
        
        files.forEach((file) => {
            dataTransfer.items.add(file);
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative w-32 h-32 rounded-2xl border-2 border-slate-400 overflow-hidden shadow-sm group';
                
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-full h-full object-cover';
                
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'absolute top-1.5 right-1.5 bg-rose-500 text-white rounded-lg w-7 h-7 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all focus:opacity-100 cursor-pointer shadow-md hover:bg-rose-600 hover:scale-105 active:scale-95';
                removeBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>';
                
                removeBtn.onclick = function() {
                    div.remove();
                    // Remove from DataTransfer
                    const dt = new DataTransfer();
                    const currentFiles = Array.from(dataTransfer.files);
                    for(let i = 0; i < currentFiles.length; i++) {
                        if(currentFiles[i] !== file) {
                            dt.items.add(currentFiles[i]);
                        }
                    }
                    dataTransfer = dt;
                    fileInput.files = dataTransfer.files;
                    
                    if(dataTransfer.files.length === 0) {
                        previewContainer.classList.add('hidden');
                    }
                };
                
                div.appendChild(img);
                div.appendChild(removeBtn);
                previewContainer.appendChild(div);
            }
            reader.readAsDataURL(file);
        });
        
        // Update input files
        fileInput.files = dataTransfer.files;
        previewContainer.classList.remove('hidden');
    });

    // Load existing addons
    const existingAddons = <?php echo json_encode($service->addons ?? [], 15, 512) ?>;
    if (existingAddons && existingAddons.length > 0) {
        existingAddons.forEach(addon => {
            addAddonRow(addon.name, addon.price);
        });
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\asus\Documents\kuliah\smt 8\sistem informasi studio.mu\studio\resources\views/admin/services/edit.blade.php ENDPATH**/ ?>
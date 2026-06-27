@extends('layouts.dashboard')

@section('title', 'Edit Profil')

@section('sidebar')
    @if(Auth::user()->role === 'admin')
        @include('admin.partials.sidebar')
    @elseif(Auth::user()->role === 'photographer')
        <a href="{{ route('photographer.dashboard') }}" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <span>Jadwal Saya</span>
        </a>
        <a href="{{ route('photographer.reviews') }}" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold mt-2">
            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/></svg>
            <span>Ulasan Pelanggan</span>
        </a>
        <div class="sidebar-item sidebar-item-active flex items-center px-5 py-3.5 transition-all text-white font-black mt-2">
            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
            <span>Edit Profil</span>
        </div>
    @else
        <a href="{{ url('/menu-utama') }}" class="sidebar-item flex items-center px-5 py-3.5 text-black hover:text-black transition-all font-bold">
            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z"/></svg>
            <span>Dashboard</span>
        </a>
        <div class="sidebar-item sidebar-item-active flex items-center px-5 py-3.5 transition-all text-white font-black mt-2">
            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
            <span>Edit Profil</span>
        </div>
    @endif
@endsection

@section('content')

{{-- Flash Messages --}}
@if (session('success'))
    <div class="mb-6 flex items-center gap-3 px-5 py-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-xs font-semibold animate-fade-in-up">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 bg-rose-50 border border-rose-200 rounded-2xl p-5 animate-fade-in-up">
        <div class="flex items-center gap-3 mb-2 text-rose-700">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <span class="text-xs font-black uppercase tracking-wider">Terdapat Kesalahan</span>
        </div>
        <ul class="list-disc list-inside text-xs text-rose-600 font-semibold space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="mb-6">
    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-slate-400 mb-1">Pengaturan Akun</p>
    <h1 class="text-2xl font-serif italic font-bold text-slate-900">Edit Profil Anda</h1>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="bg-white border-2 border-black rounded-[2rem] shadow-[0_12px_40px_rgba(0,0,0,0.03)] overflow-hidden flex flex-col mb-12 animate-fade-in-up">
    @csrf

    {{-- Header Hitam --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 p-8 bg-slate-900 border-b-[2.5px] border-amber-400">
        <div>
            <span class="inline-flex items-center px-3 py-1.5 bg-slate-800 text-slate-300 text-[9px] font-black uppercase tracking-[0.2em] rounded-lg mb-2 shadow-sm border border-slate-700">
                Informasi Personal
            </span>
            <h3 class="text-2xl font-serif italic font-bold tracking-tight text-amber-400">
                Lengkapi Data Profil
            </h3>
        </div>
    </div>

    {{-- Content Area --}}
    <div class="p-8 md:p-10 flex flex-col md:flex-row gap-10">
        {{-- Avatar Section --}}
        <div class="flex flex-col items-center gap-4 md:w-1/3">
            <div class="relative w-32 h-32 rounded-full border-4 border-slate-100 shadow-md overflow-hidden bg-slate-50 group">
                @if($user->avatar_url)
                    <img src="{{ $user->avatar_url }}" alt="Profile Photo" class="w-full h-full object-cover" id="avatarPreview">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center text-4xl font-black text-slate-400" id="avatarFallback">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <img src="" alt="Profile Photo" class="w-full h-full object-cover hidden" id="avatarPreview">
                @endif
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer" onclick="document.getElementById('avatarInput').click()">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
            
            <div class="text-center">
                <input type="file" name="avatar" id="avatarInput" class="hidden" accept="image/*" onchange="previewImage(this)">
                <button type="button" onclick="document.getElementById('avatarInput').click()" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-[10px] font-black uppercase tracking-widest rounded-xl transition-colors border border-slate-200">
                    Ubah Foto Profil
                </button>
                <p class="text-[9px] text-slate-400 mt-2">Format: JPG, PNG, GIF (Max 2MB)</p>
            </div>
        </div>

        {{-- Form Section --}}
        <div class="flex-1 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Nomor Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789"
                           class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition-all">
                </div>
            </div>

            @if(in_array($user->role, ['admin', 'photographer']))
            <div>
                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Bio / Deskripsi Profil</label>
                <textarea name="bio" rows="4" placeholder="Ceritakan sedikit tentang diri atau pengalaman Anda..."
                          class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition-all resize-none">{{ old('bio', $user->bio) }}</textarea>
            </div>
            @endif

            <hr class="border-slate-100 my-8">

            <div class="mb-2">
                <h4 class="text-sm font-black text-slate-900 uppercase tracking-wider">Ubah Password</h4>
                <p class="text-[10px] text-slate-400 font-semibold mt-1">Biarkan kosong jika tidak ingin mengubah password.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Password Saat Ini</label>
                    <div class="relative">
                        <input type="password" name="current_password" id="current_password"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition-all pr-12">
                        <button type="button" onclick="toggleEditPassword('current_password', 'eye-curr')"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800 transition-colors p-0.5">
                            <svg id="eye-curr" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.301 8.844 6.136 6 10.15 6c3.992 0 6.827 2.844 8.09 6.322a1.012 1.012 0 0 1 0 .644C16.927 15.156 14.092 18 10.15 18c-3.992 0-6.827-2.844-8.09-6.322Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Password Baru</label>
                    <div class="relative">
                        <input type="password" name="new_password" id="new_password"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition-all pr-12">
                        <button type="button" onclick="toggleEditPassword('new_password', 'eye-new')"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800 transition-colors p-0.5">
                            <svg id="eye-new" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.301 8.844 6.136 6 10.15 6c3.992 0 6.827 2.844 8.09 6.322a1.012 1.012 0 0 1 0 .644C16.927 15.156 14.092 18 10.15 18c-3.992 0-6.827-2.844-8.09-6.322Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-500 uppercase tracking-widest mb-2">Konfirmasi Password Baru</label>
                    <div class="relative">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                               class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-semibold focus:ring-2 focus:ring-amber-400 focus:border-amber-400 outline-none transition-all pr-12">
                        <button type="button" onclick="toggleEditPassword('new_password_confirmation', 'eye-conf')"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-800 transition-colors p-0.5">
                            <svg id="eye-conf" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.644C3.301 8.844 6.136 6 10.15 6c3.992 0 6.827 2.844 8.09 6.322a1.012 1.012 0 0 1 0 .644C16.927 15.156 14.092 18 10.15 18c-3.992 0-6.827-2.844-8.09-6.322Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="px-8 py-5 bg-slate-900 border-t-[2.5px] border-amber-400 flex justify-end gap-3">
        <a href="javascript:history.back()" class="px-5 py-2.5 bg-transparent border border-slate-600 text-slate-300 hover:bg-slate-800 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all">
            Batal
        </a>
        <button type="submit" class="px-6 py-2.5 bg-amber-400 hover:bg-amber-500 text-slate-900 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-md shadow-amber-400/20 active:scale-95">
            Simpan Perubahan
        </button>
    </div>
</form>

{{-- Cropper Modal --}}
<div id="cropperModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/80 backdrop-blur-sm animate-fade-in-up">
    <div class="bg-white rounded-2xl w-full max-w-xl mx-4 overflow-hidden flex flex-col shadow-2xl">
        <div class="p-5 bg-slate-900 flex justify-between items-center border-b-[2.5px] border-amber-400">
            <h3 class="text-xl font-serif italic font-bold text-amber-400">Sesuaikan Foto</h3>
            <button type="button" onclick="closeCropper()" class="text-slate-400 hover:text-white transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="p-4 h-[400px] w-full bg-slate-100 flex items-center justify-center overflow-hidden">
            <img id="cropperImage" src="" alt="To Crop" class="max-w-full max-h-full block">
        </div>
        <div class="p-5 bg-white flex justify-end gap-3 border-t border-slate-200">
            <button type="button" onclick="closeCropper()" class="px-5 py-2.5 bg-transparent border border-slate-300 text-slate-700 hover:bg-slate-50 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all">
                Batal
            </button>
            <button type="button" onclick="cropImage()" class="px-6 py-2.5 bg-amber-400 hover:bg-amber-500 text-slate-900 text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-md shadow-amber-400/20 active:scale-95">
                Terapkan Foto
            </button>
        </div>
    </div>
</div>

<script>
let cropper = null;
const avatarInput = document.getElementById('avatarInput');
const cropperModal = document.getElementById('cropperModal');
const cropperImage = document.getElementById('cropperImage');
const avatarPreview = document.getElementById('avatarPreview');
const avatarFallback = document.getElementById('avatarFallback');

function previewImage(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const url = URL.createObjectURL(file);
        
        cropperImage.onload = function() {
            if (cropper) {
                cropper.destroy();
            }
            
            cropper = new Cropper(cropperImage, {
                aspectRatio: 1,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 1,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
            });
        };
        cropperImage.src = url;
        cropperModal.classList.remove('hidden');
        cropperModal.classList.add('flex');
    }
}

function closeCropper() {
    cropperModal.classList.remove('flex');
    cropperModal.classList.add('hidden');
    if (cropper) {
        cropper.destroy();
        cropper = null;
    }
    avatarInput.value = ''; // Reset input so user can select same image again if needed
}

function cropImage() {
    if (!cropper) return;
    
    // Get cropped canvas
    const canvas = cropper.getCroppedCanvas({
        width: 400,
        height: 400,
    });
    
    // Convert to blob and update file input
    canvas.toBlob(function(blob) {
        const file = new File([blob], "avatar.jpg", { type: "image/jpeg", lastModified: new Date().getTime() });
        const container = new DataTransfer();
        container.items.add(file);
        
        // Remove the reset in closeCropper temporarily to ensure file stays attached
        // Actually it's fine if we just don't reset it in closeCropper when crop is applied.
        
        avatarInput.files = container.files;
        
        // Update preview
        avatarPreview.src = canvas.toDataURL("image/jpeg");
        avatarPreview.classList.remove('hidden');
        if (avatarFallback) avatarFallback.classList.add('hidden');
        
        // Custom close that doesn't clear the input
        cropperModal.classList.remove('flex');
        cropperModal.classList.add('hidden');
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
    }, 'image/jpeg');
}

function toggleEditPassword(inputId, iconId) {
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

@endsection

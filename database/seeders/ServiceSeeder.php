<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Service::truncate();
        $defaultServices = [
            [
                'title' => 'Wedding & Pre-Wedding',
                'starting' => 'Mulai Rp 1.500.000',
                'description' => 'Abadikan janji suci dan kebahagiaan tak ternilai di hari pernikahan Anda dengan sentuhan artistik kami.',
                'note' => '<ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Reservasi disarankan dilakukan minimal 1 bulan sebelum hari H</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Biaya transport & akomodasi luar kota :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Ditanggung sepenuhnya oleh klien</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> H-3 konfirmasi rincian akomodasi</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> DP minimal 30% untuk penguncian tanggal jadwal</li>
                </ul>',
                'slides' => [
                    '/img/prewedding_showcase.png',
                    'https://images.unsplash.com/photo-1519741497674-611481863552?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?q=80&w=2069&auto=format&fit=crop'
                ],
                'highlights' => [
                    'Full Day Coverage',
                    'Cinematic Highlight',
                    'Premium Photo Book'
                ],
                'col1' => [
                    'title' => 'BASIC PREWEDD',
                    'old' => 'Rp 1.999.000',
                    'new' => 'Rp 1.500.000',
                    'features' => [
                        '2 Background Indoor Studio',
                        '2 Jam Sesi Photo',
                        'Sudah termasuk Photographer & Crew',
                        'Free 20 Edited Photos',
                        'Foto unlimited / sepuasnya',
                        'All Softcopy on Google Drive'
                    ]
                ],
                'col2' => [
                    'title' => 'EXCLUSIVE WEDDING',
                    'old' => 'Rp 3.999.000',
                    'new' => 'Rp 3.200.000',
                    'features' => [
                        'Full Day Coverage (10 Jam)',
                        '2 Professional Photographers',
                        'Cinematic Highlight Video (1-3 Min)',
                        '1 Premium Photo Book Exclusive (10R, 20 Halaman)',
                        '50 Edited Photos Pilihan',
                        'All Softcopy in Exclusive USB Drive'
                    ]
                ]
            ],
            [
                'title' => 'Wisuda & Akademik',
                'starting' => 'Mulai Rp 850.000',
                'description' => 'Rayakan pencapaian akademik Anda dengan sesi foto studio yang elegan dan penuh kebanggaan.',
                'note' => '<ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Bisa untuk 1 - 2 busana (bawa sendiri)</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Penambahan orang :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Dewasa : Rp 50.000</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Anak-anak : Rp 35.000</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Diatas 14 orang pakai studio 3 (di lantai atas)</li>
                </ul>',
                'slides' => [
                    '/img/graduation_showcase.png',
                    'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?q=80&w=2070&auto=format&fit=crop'
                ],
                'highlights' => [
                    'Studio & Outdoor',
                    'Family Grouping',
                    'Fast Editing'
                ],
                'col1' => [
                    'title' => 'BEST DEAL',
                    'old' => 'Rp 1.199.000',
                    'new' => 'Rp 850.000',
                    'features' => [
                        '2 Background Studio',
                        '1 Jam Sesi Foto',
                        'Sudah termasuk Photographer',
                        'Max 6 orang (Keluarga Inti)',
                        'Free 15 Edited Photos, edit tone warna',
                        'Foto unlimited / sepuasnya',
                        'All Softcopy on Google drive (berlaku 2 Minggu)'
                    ]
                ],
                'col2' => [
                    'title' => 'SPECIAL PACKAGE',
                    'old' => 'Rp 1.599.000',
                    'new' => 'Rp 1.200.000',
                    'features' => [
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
                ]
            ],
            [
                'title' => 'Komersial & Produk',
                'starting' => 'Mulai Rp 1.200.000',
                'description' => 'Tingkatkan nilai brand Anda dengan visual produk yang profesional dan menarik perhatian audiens.',
                'note' => '<ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Pengiriman sampel produk minimal H-3 sesi pemotretan</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Penambahan Properti khusus :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Custom backdrop & model : Hubungi admin</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Makanan/Minuman segar disiapkan oleh klien</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Retouching di luar batas revisi dikenakan biaya tambahan</li>
                </ul>',
                'slides' => [
                    '/img/commercial_showcase.png',
                    'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1492691527719-9d1e07e534b4?q=80&w=2071&auto=format&fit=crop'
                ],
                'highlights' => [
                    'High-End Retouching',
                    'Concept Styling',
                    'Professional Lighting'
                ],
                'col1' => [
                    'title' => 'STARTER KIT',
                    'old' => 'Rp 1.599.000',
                    'new' => 'Rp 1.200.000',
                    'features' => [
                        'Minimalist Concept Styling',
                        '15 Produk Unggulan Sesi',
                        'Sudah termasuk Product Photographer',
                        'High-End Retouching (10 Foto)',
                        'Background Solid / Polos',
                        'All Softcopy via Google Drive'
                    ]
                ],
                'col2' => [
                    'title' => 'BRAND CHAMPION',
                    'old' => 'Rp 2.999.000',
                    'new' => 'Rp 2.400.000',
                    'features' => [
                        'Premium Concept & Storyboard',
                        'Unlimited Produk Sesi (4 Jam)',
                        'Model & Talent Friendly Setup',
                        'High-End Retouching (30 Foto)',
                        'Professional Lighting & Studio Rent',
                        'Siap untuk Banner & E-Commerce'
                    ]
                ]
            ],
            [
                'title' => 'Keluarga & Maternity',
                'starting' => 'Mulai Rp 500.000',
                'description' => 'Abadikan kehangatan kasih sayang keluarga dan perjalanan berharga kehamilan Anda dalam potret penuh makna.',
                'note' => '<ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-655 font-bold">•</span> Sesi foto maternity disarankan usia kehamilan 28-34 minggu</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-655 font-bold">•</span> Penambahan orang :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/85 font-bold">›</span> Dewasa : Rp 50.000</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/85 font-bold">›</span> Anak-anak : Rp 35.000</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-655 font-bold">•</span> Kostum bebas rapi (bawa sendiri)</li>
                </ul>',
                'slides' => [
                    '/img/family_showcase.png',
                    'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1609234656388-0ff363383899?q=80&w=2070&auto=format&fit=crop'
                ],
                'highlights' => [
                    'Studio & Home Session',
                    'Wardrobe Consultation',
                    'High-Res Digital Files'
                ],
                'col1' => [
                    'title' => 'BEST DEAL',
                    'old' => 'Rp 699.000',
                    'new' => 'Rp 500.000',
                    'features' => [
                        '2 Background Photo',
                        '1 jam Photo Session',
                        'Sudah termasuk Photographer',
                        'Max 6 orang',
                        'Free 10-15 Photo, edit tone warna',
                        'Foto unlimited / sepuasnya',
                        'All Softcopy on Google drive (berlaku 2 Minggu)'
                    ]
                ],
                'col2' => [
                    'title' => 'SPECIAL PACKAGE',
                    'old' => 'Rp 999.000',
                    'new' => 'Rp 800.000',
                    'features' => [
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
                ]
            ],
            [
                'title' => 'Potret Pribadi & Branding',
                'starting' => 'Mulai Rp 650.000',
                'description' => 'Tampilkan versi terbaik diri Anda untuk profil profesional, CV, LinkedIn, portofolio model, atau personal branding.',
                'note' => '<ul class="space-y-4 text-xs font-semibold text-slate-700 list-none p-0 m-0">
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Sudah termasuk konsultasi pose standar</li>
                    <li class="flex flex-col gap-1.5">
                        <span class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Pakaian & Busana ganti :</span>
                        <ul class="pl-6 space-y-1 mt-0.5 list-none">
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Klien membawa jas/pakaian formal sendiri</li>
                            <li class="flex items-center gap-2 text-slate-650"><span class="text-amber-500/80 font-bold">›</span> Disediakan ruang ganti privat yang nyaman</li>
                        </ul>
                    </li>
                    <li class="flex items-start gap-2"><span class="text-amber-600 font-bold">•</span> Tambahan make-up artist profesional disarankan konfirmasi H-3</li>
                </ul>',
                'slides' => [
                    '/img/personal_showcase.png',
                    'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=2070&auto=format&fit=crop',
                    'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?q=80&w=2070&auto=format&fit=crop'
                ],
                'highlights' => [
                    'Corporate Headshot',
                    'Model Portfolio',
                    'Custom Backdrop'
                ],
                'col1' => [
                    'title' => 'BASIC PORTRAIT',
                    'old' => 'Rp 899.000',
                    'new' => 'Rp 650.000',
                    'features' => [
                        '1 Background Pilihan',
                        '45 Menit Sesi Foto',
                        'Sudah termasuk Portrait Photographer',
                        'Max 1 orang (Personal)',
                        'Free 5 Edited Photos (LinkedIn Standard)',
                        '1x Pergantian Pakaian',
                        'All Softcopy on Google Drive'
                    ]
                ],
                'col2' => [
                    'title' => 'PREMIUM BRANDING',
                    'old' => 'Rp 1.499.000',
                    'new' => 'Rp 1.100.000',
                    'features' => [
                        '3 Pilihan Background',
                        '1.5 Jam Sesi Foto',
                        'Sudah termasuk Senior Photographer',
                        'Max 2 orang',
                        'Free 15 Edited Photos (Premium Retouch)',
                        '3x Pergantian Pakaian',
                        'All softcopy on Google drive'
                    ]
                ]
            ]
        ];


        foreach ($defaultServices as $service) {
            \App\Models\Service::create($service);
        }
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        if (Schema::hasTable('site_settings')) {
            $settings = [
                ['site_name', 'Home Putra Interior', 'text', 'general'],
                ['site_tagline', '#1 JASA INTERIOR DESIGN', 'text', 'general'],
                ['site_description', 'Studio interior dan furniture custom untuk hunian, apartemen, kantor, dan ruang komersial.', 'textarea', 'general'],
                ['contact_email', 'demo@homeputrainterior.local', 'text', 'contact'],
                ['contact_phone', '+62 812 0000 0000', 'text', 'contact'],
                ['contact_address', 'Bandung, Jawa Barat', 'textarea', 'contact'],
                ['whatsapp_number', '6281200000000', 'text', 'contact'],
                ['instagram_url', '', 'text', 'social'],
                ['facebook_url', '', 'text', 'social'],
                ['youtube_url', '', 'text', 'social'],
                ['seo_keywords', 'interior, furniture custom, kitchen set, wardrobe, renovasi', 'text', 'seo'],
            ];

            foreach ($settings as [$key, $value, $type, $group]) {
                DB::table('site_settings')->updateOrInsert(
                    ['setting_key' => $key],
                    [
                        'setting_value' => $value,
                        'setting_type' => $type,
                        'setting_group' => $group,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }

        if (Schema::hasTable('statistics')) {
            $statistics = [
                ['12', '+', 'Tahun Pengalaman', 1],
                ['500', '+', 'Proyek Selesai', 2],
                ['98', '%', 'Kepuasan Klien', 3],
                ['24', 'Jam', 'Respons Konsultasi', 4],
            ];

            foreach ($statistics as [$number, $suffix, $label, $order]) {
                DB::table('statistics')->updateOrInsert(
                    ['stat_label' => $label],
                    [
                        'stat_number' => $number,
                        'stat_suffix' => $suffix,
                        'display_order' => $order,
                        'is_active' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }

        if (Schema::hasTable('services')) {
            $services = [
                ['Desain Interior Rumah', 'Konsep interior menyeluruh untuk ruang keluarga, kamar tidur, ruang makan, dan area privat.', 'home', 1],
                ['Kitchen Set Custom', 'Perancangan kitchen set presisi dengan layout fungsional dan material yang mudah dirawat.', 'countertops', 2],
                ['Wardrobe & Storage', 'Lemari, wardrobe, dan storage custom yang rapi, efisien, dan menyatu dengan karakter ruang.', 'checkroom', 3],
                ['Backdrop TV', 'Backdrop TV dan wall panel untuk focal point ruang yang bersih, modern, dan elegan.', 'tv', 4],
                ['Furniture Custom', 'Meja, kabinet, rak, dan furniture built-in yang dibuat sesuai ukuran dan kebutuhan ruang.', 'chair', 5],
                ['Renovasi Interior', 'Pembaruan interior dari perencanaan, produksi, hingga instalasi akhir secara terukur.', 'construction', 6],
            ];

            foreach ($services as [$title, $description, $icon, $order]) {
                DB::table('services')->updateOrInsert(
                    ['title' => $title],
                    [
                        'description' => $description,
                        'icon' => $icon,
                        'display_order' => $order,
                        'is_active' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }

        if (Schema::hasTable('portfolios')) {
            $portfolios = [
                ['Ruang Tamu Modern', 'Residensial', 'Living room dengan komposisi panel, storage, dan pencahayaan hangat.', 'assets/images/materials/multipleks-hpl.png', 1],
                ['Kitchen Set Minimalis', 'Dapur', 'Kitchen set compact dengan finishing bersih dan area kerja yang efisien.', 'assets/images/materials/aluminium-acp.png', 2],
                ['Master Bedroom Suite', 'Kamar Tidur', 'Kamar utama dengan wardrobe custom dan tone material yang tenang.', 'assets/images/materials/multipleks-duco.png', 3],
                ['Wardrobe Custom', 'Storage', 'Sistem penyimpanan built-in yang disesuaikan dengan ritme penggunaan harian.', 'assets/images/materials/blockboard.png', 4],
                ['Office Interior', 'Komersial', 'Interior kantor dengan layout fokus, rapi, dan nyaman untuk kerja berulang.', 'assets/images/materials/pvc-board.png', 5],
                ['Wall Panel Feature', 'Dekoratif', 'Panel dinding sebagai aksen ruang dengan tekstur material yang kuat.', 'assets/images/hero-interior-local.avif', 6],
            ];

            foreach ($portfolios as [$title, $category, $description, $image, $order]) {
                DB::table('portfolios')->updateOrInsert(
                    ['title' => $title],
                    [
                        'category' => $category,
                        'description' => $description,
                        'image' => $image,
                        'display_order' => $order,
                        'is_featured' => $order <= 4,
                        'is_active' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }

        if (Schema::hasTable('testimonials')) {
            $testimonials = [
                ['Nadia Putri', 'Bandung', 'Tim sangat komunikatif dari awal konsep sampai pemasangan. Hasil akhirnya rapi dan sesuai moodboard.', 5, 1],
                ['Arman Wijaya', 'Jakarta', 'Kitchen set dan wardrobe dibuat presisi. Area rumah jadi lebih tertata dan mudah dirawat.', 5, 2],
                ['Rika Santoso', 'Bekasi', 'Proses desain jelas, pilihan material dijelaskan detail, dan finishing terlihat premium.', 5, 3],
                ['Daniel Hartono', 'Tangerang', 'Layout kantor lebih nyaman dipakai kerja harian. Tim instalasi cepat dan bersih.', 5, 4],
            ];

            foreach ($testimonials as [$name, $location, $text, $rating, $order]) {
                DB::table('testimonials')->updateOrInsert(
                    ['client_name' => $name],
                    [
                        'client_location' => $location,
                        'client_image' => null,
                        'testimonial_text' => $text,
                        'rating' => $rating,
                        'display_order' => $order,
                        'is_active' => true,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('statistics')) {
            DB::table('statistics')->whereIn('stat_label', [
                'Tahun Pengalaman',
                'Proyek Selesai',
                'Kepuasan Klien',
                'Respons Konsultasi',
            ])->delete();
        }

        if (Schema::hasTable('services')) {
            DB::table('services')->whereIn('title', [
                'Desain Interior Rumah',
                'Kitchen Set Custom',
                'Wardrobe & Storage',
                'Backdrop TV',
                'Furniture Custom',
                'Renovasi Interior',
            ])->delete();
        }

        if (Schema::hasTable('portfolios')) {
            DB::table('portfolios')->whereIn('title', [
                'Ruang Tamu Modern',
                'Kitchen Set Minimalis',
                'Master Bedroom Suite',
                'Wardrobe Custom',
                'Office Interior',
                'Wall Panel Feature',
            ])->delete();
        }

        if (Schema::hasTable('testimonials')) {
            DB::table('testimonials')->whereIn('client_name', [
                'Nadia Putri',
                'Arman Wijaya',
                'Rika Santoso',
                'Daniel Hartono',
            ])->delete();
        }
    }
};

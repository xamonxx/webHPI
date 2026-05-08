<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PortfolioSeeder extends Seeder
{
    /**
     * Seed clean dummy portfolio data for frontend previews.
     */
    public function run(): void
    {
        $portfolios = [
            [
                'title' => 'Cluster House Japandi Bandung',
                'category' => 'Residensial',
                'description' => 'Interior rumah keluarga dengan konsep Japandi, storage tertutup, panel hangat, dan pencahayaan lembut untuk aktivitas harian.',
                'image' => 'assets/images/hero-interior-local.avif',
                'slider_images' => [
                    'assets/images/hero-interior-local.avif',
                    'assets/images/materials/multipleks-hpl.png',
                    'assets/images/materials/blockboard.png',
                ],
            ],
            [
                'title' => 'Kitchen Set Premium Antapani',
                'category' => 'Dapur',
                'description' => 'Kitchen set custom dengan layout efisien, kabinet atas bawah, area prep rapi, dan finishing HPL yang mudah dirawat.',
                'image' => 'assets/images/materials/multipleks-hpl.png',
                'slider_images' => [
                    'assets/images/materials/multipleks-hpl.png',
                    'assets/images/materials/aluminium-acp.png',
                    'assets/images/hero-interior-local.jpg',
                ],
            ],
            [
                'title' => 'Master Bedroom Suite Dago',
                'category' => 'Kamar Tidur',
                'description' => 'Kamar utama dengan wardrobe built-in, headboard panel, meja rias compact, dan tone netral untuk suasana istirahat yang tenang.',
                'image' => 'assets/images/materials/multipleks-duco.png',
                'slider_images' => [
                    'assets/images/materials/multipleks-duco.png',
                    'assets/images/materials/blockboard.png',
                    'assets/images/hero-interior-local.avif',
                ],
            ],
            [
                'title' => 'Wardrobe Walk-In Closet Setiabudi',
                'category' => 'Storage',
                'description' => 'Walk-in closet dengan pembagian modul simpan, gantungan, drawer, dan display area agar koleksi tetap rapi dan mudah diakses.',
                'image' => 'assets/images/materials/blockboard.png',
                'slider_images' => [
                    'assets/images/materials/blockboard.png',
                    'assets/images/materials/multipleks-duco.png',
                    'assets/images/materials/pvc-board.png',
                ],
            ],
            [
                'title' => 'Living Room Luxury Panel Cimahi',
                'category' => 'Ruang Tamu',
                'description' => 'Ruang tamu dengan wall panel, ambalan display, backdrop TV, dan komposisi material yang memberi kesan hangat namun modern.',
                'image' => 'assets/images/hero-interior-local.jpg',
                'slider_images' => [
                    'assets/images/hero-interior-local.jpg',
                    'assets/images/materials/pvc-board.png',
                    'assets/images/materials/multipleks-hpl.png',
                ],
            ],
            [
                'title' => 'Office Interior Minimalis Pasteur',
                'category' => 'Komersial',
                'description' => 'Interior kantor kecil dengan meja kerja custom, storage dokumen, area meeting compact, dan alur kerja yang lebih efisien.',
                'image' => 'assets/images/materials/pvc-board.png',
                'slider_images' => [
                    'assets/images/materials/pvc-board.png',
                    'assets/images/materials/aluminium-acp.png',
                    'assets/images/materials/blockboard.png',
                ],
            ],
            [
                'title' => 'Backdrop TV Modern Buahbatu',
                'category' => 'Backdrop TV',
                'description' => 'Backdrop TV minimalis dengan panel vertikal, kabinet bawah menggantung, dan manajemen kabel tersembunyi untuk ruang keluarga.',
                'image' => 'assets/images/materials/aluminium-acp.png',
                'slider_images' => [
                    'assets/images/materials/aluminium-acp.png',
                    'assets/images/materials/multipleks-hpl.png',
                    'assets/images/hero-interior-local.avif',
                ],
            ],
            [
                'title' => 'Apartment Studio Ciumbuleuit',
                'category' => 'Apartemen',
                'description' => 'Interior apartemen studio dengan furniture multifungsi, storage vertikal, dan layout compact agar ruang kecil terasa lega.',
                'image' => 'assets/images/hero-interior-local.avif',
                'slider_images' => [
                    'assets/images/hero-interior-local.avif',
                    'assets/images/materials/multipleks-duco.png',
                    'assets/images/materials/pvc-board.png',
                ],
            ],
            [
                'title' => 'Cafe Counter Industrial Lembang',
                'category' => 'Komersial',
                'description' => 'Area counter cafe dengan kabinet display, meja transaksi, panel aksen, dan material tahan pakai untuk operasional harian.',
                'image' => 'assets/images/materials/blockboard.png',
                'slider_images' => [
                    'assets/images/materials/blockboard.png',
                    'assets/images/materials/aluminium-acp.png',
                    'assets/images/hero-interior-local.jpg',
                ],
            ],
            [
                'title' => 'Kids Bedroom Custom Storage',
                'category' => 'Kamar Anak',
                'description' => 'Kamar anak dengan ranjang custom, lemari pakaian, meja belajar, dan storage mainan yang aman serta mudah dijangkau.',
                'image' => 'assets/images/materials/multipleks-duco.png',
                'slider_images' => [
                    'assets/images/materials/multipleks-duco.png',
                    'assets/images/materials/multipleks-hpl.png',
                    'assets/images/materials/pvc-board.png',
                ],
            ],
        ];

        DB::transaction(function () use ($portfolios) {
            $existing = Portfolio::query()
                ->orderBy('display_order')
                ->orderBy('id')
                ->get();

            foreach ($portfolios as $index => $data) {
                $portfolio = $existing->get($index) ?? new Portfolio;

                $portfolio->fill([
                    ...collect($data)->except('slider_images')->all(),
                    'image' => $data['slider_images'][0] ?? $data['image'] ?? null,
                    'slider_images' => $data['slider_images'],
                    'display_order' => $index + 1,
                    'is_featured' => $index < 6,
                    'is_active' => true,
                ]);

                $portfolio->save();

                if (Schema::hasTable('portfolio_photos')) {
                    $portfolio->photos()->delete();
                    foreach ($data['slider_images'] as $photoIndex => $path) {
                        $portfolio->photos()->create([
                            'path' => $path,
                            'sort_order' => $photoIndex + 1,
                        ]);
                    }
                }
            }

            $extraIds = $existing->slice(count($portfolios))->pluck('id');

            if ($extraIds->isNotEmpty()) {
                Portfolio::query()
                    ->whereIn('id', $extraIds)
                    ->delete();
            }
        });
    }
}

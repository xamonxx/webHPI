<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            foreach ($this->portfolios() as $index => $portfolio) {
                $paths = $this->imagePaths($portfolio['group']);

                if (empty($paths)) {
                    throw new RuntimeException("No portfolio images found for {$portfolio['group']}.");
                }

                $now = now();
                $payload = [
                    'title' => $portfolio['title'],
                    'category' => $portfolio['category'],
                    'description' => $portfolio['description'],
                    'image' => $paths[0],
                    'slider_images' => json_encode($paths),
                    'display_order' => $index + 1,
                    'is_featured' => $portfolio['featured'],
                    'is_active' => true,
                    'updated_at' => $now,
                ];

                $portfolioId = DB::table('portfolios')
                    ->where('title', $portfolio['title'])
                    ->value('id');

                if ($portfolioId) {
                    DB::table('portfolios')
                        ->where('id', $portfolioId)
                        ->update($payload);
                } else {
                    $portfolioId = DB::table('portfolios')->insertGetId($payload + [
                        'created_at' => $now,
                    ]);
                }

                DB::table('portfolio_photos')
                    ->where('portfolio_id', $portfolioId)
                    ->delete();

                foreach ($paths as $photoIndex => $path) {
                    DB::table('portfolio_photos')->insert([
                        'portfolio_id' => $portfolioId,
                        'path' => $path,
                        'sort_order' => $photoIndex + 1,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);
                }
            }
        });

        Cache::forget('frontend.home.data');
        Cache::forget('sitemap.xml');
    }

    public function down(): void
    {
        $titles = collect($this->portfolios())->pluck('title')->all();

        DB::transaction(function () use ($titles) {
            DB::table('portfolios')->whereIn('title', $titles)->delete();
        });

        Cache::forget('frontend.home.data');
        Cache::forget('sitemap.xml');
    }

    private function imagePaths(string $group): array
    {
        $directory = public_path("assets/images/portfolio/bahan/{$group}");
        $files = glob($directory.DIRECTORY_SEPARATOR.'*.webp') ?: [];

        sort($files, SORT_NATURAL | SORT_FLAG_CASE);

        return collect($files)
            ->take(5)
            ->map(fn (string $file) => "assets/images/portfolio/bahan/{$group}/".basename($file))
            ->values()
            ->all();
    }

    private function portfolios(): array
    {
        return [
            [
                'group' => 'kitchenset-01',
                'title' => 'Kitchen Set Putih Orange',
                'category' => 'Kitchen Set',
                'description' => 'Kitchen set modern dengan kabinet putih, aksen orange, island multifungsi, dan area sink yang rapi untuk dapur keluarga yang terang dan efisien.',
                'featured' => true,
            ],
            [
                'group' => 'backdrop-tv-01',
                'title' => 'Backdrop TV Kayu Modern',
                'category' => 'Backdrop TV',
                'description' => 'Backdrop TV custom dengan kombinasi panel kayu, marmer, rak display, dan storage samping untuk ruang keluarga yang hangat sekaligus elegan.',
                'featured' => true,
            ],
            [
                'group' => 'kamarset-01',
                'title' => 'Kamar Set Panel Kayu',
                'category' => 'Kamar Set',
                'description' => 'Set kamar tidur dengan headboard, panel dinding kayu, plafon aksen, dan meja rias yang menyatu untuk tampilan bedroom yang nyaman dan premium.',
                'featured' => true,
            ],
            [
                'group' => 'wardrobe-01',
                'title' => 'Walk-in Wardrobe Display',
                'category' => 'Lemari & Wardrobe',
                'description' => 'Walk-in wardrobe dengan kabinet display, island penyimpanan, dan komposisi ruang yang tertata untuk kebutuhan penyimpanan pakaian dan aksesori.',
                'featured' => true,
            ],
            [
                'group' => 'kitchenset-02',
                'title' => 'Kitchen Set Abu Modern',
                'category' => 'Kitchen Set',
                'description' => 'Dapur modern bernuansa abu dengan counter fungsional, kabinet tinggi, panel vertikal, dan kombinasi warna putih-orange yang bersih.',
                'featured' => false,
            ],
            [
                'group' => 'kitchenset-03',
                'title' => 'Kitchen Set Marmer Elegan',
                'category' => 'Kitchen Set',
                'description' => 'Kitchen set elegan dengan island marmer, tone hitam-kayu, area washer terintegrasi, dan komposisi dapur yang terasa mewah.',
                'featured' => false,
            ],
            [
                'group' => 'kitchenset-04',
                'title' => 'Kitchen Set Minimalis Abu',
                'category' => 'Kitchen Set',
                'description' => 'Kitchen set minimalis abu dengan island marmer-kayu, sink island, aksen tanaman, dan warna netral yang mudah dipadukan.',
                'featured' => false,
            ],
            [
                'group' => 'kitchenset-05',
                'title' => 'Kitchen Set Kompak L-Shape',
                'category' => 'Kitchen Set',
                'description' => 'Dapur kompak model L dengan kombinasi putih-kayu, island marmer, dan storage efisien untuk ruang hunian modern.',
                'featured' => false,
            ],
            [
                'group' => 'kitchenset-06',
                'title' => 'Kitchen Set Dining Modern',
                'category' => 'Kitchen Set',
                'description' => 'Kitchen set dengan area dining modern, counter abu-putih, aksen hijau-kayu, dan layout yang nyaman untuk aktivitas harian.',
                'featured' => false,
            ],
            [
                'group' => 'lemari-bawah-tangga-01',
                'title' => 'Lemari Bawah Tangga Multifungsi',
                'category' => 'Lemari Bawah Tangga',
                'description' => 'Solusi storage bawah tangga dengan rak display, kabinet tertutup, dan detail kaca untuk memaksimalkan area kosong menjadi fungsional.',
                'featured' => false,
            ],
            [
                'group' => 'mini-bar-01',
                'title' => 'Mini Bar Custom Bawah Tangga',
                'category' => 'Mini Bar',
                'description' => 'Mini bar custom dengan konsep bawah tangga, display terbuka, island compact, dan pilihan warna hijau, biru, serta orange yang berkarakter.',
                'featured' => false,
            ],
            [
                'group' => 'bench-cabinet-01',
                'title' => 'Bench Cabinet Hallway Custom',
                'category' => 'Furniture Custom',
                'description' => 'Bench cabinet untuk hallway dengan kabinet dinding, area duduk, dan display rapi untuk mengisi ruang kosong secara fungsional.',
                'featured' => false,
            ],
            [
                'group' => 'backdrop-tv-02',
                'title' => 'Backdrop TV Wall Panel Hitam',
                'category' => 'Backdrop TV',
                'description' => 'Backdrop TV dengan wall panel hitam yang tegas, cocok untuk ruang keluarga bergaya modern dan maskulin.',
                'featured' => false,
            ],
            [
                'group' => 'kamarset-02',
                'title' => 'Kamar Set Headboard Putih',
                'category' => 'Kamar Set',
                'description' => 'Kamar set bernuansa putih dengan headboard clean dan tampilan sederhana untuk ruang tidur yang terang dan tenang.',
                'featured' => false,
            ],
            [
                'group' => 'lemari-bawah-tangga-02',
                'title' => 'Lemari Bawah Tangga Putih',
                'category' => 'Lemari Bawah Tangga',
                'description' => 'Kabinet bawah tangga putih dengan storage tertutup yang memanfaatkan area tangga tanpa membuat ruang terlihat penuh.',
                'featured' => false,
            ],
            [
                'group' => 'living-room-01',
                'title' => 'Living Room Panel Kayu',
                'category' => 'Living Room',
                'description' => 'Living room dengan sofa dan panel kayu sebagai aksen utama untuk suasana ruang keluarga yang hangat dan nyaman.',
                'featured' => false,
            ],
            [
                'group' => 'wall-panel-01',
                'title' => 'Wall Panel Partisi Vertical',
                'category' => 'Wallpanel',
                'description' => 'Wall panel partisi vertikal untuk membagi ruang sekaligus memberi aksen interior yang ringan, modern, dan dekoratif.',
                'featured' => false,
            ],
        ];
    }
};

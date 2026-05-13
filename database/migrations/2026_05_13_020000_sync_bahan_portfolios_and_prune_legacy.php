<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::transaction(function () {
            $keepIds = [];

            foreach ($this->portfolioGroups() as $title => $group) {
                $portfolioId = DB::table('portfolios')
                    ->where('title', $title)
                    ->value('id');

                if (! $portfolioId) {
                    continue;
                }

                $paths = $this->imagePaths($group);

                if (empty($paths)) {
                    throw new RuntimeException("No portfolio images found for {$group}.");
                }

                DB::table('portfolios')
                    ->where('id', $portfolioId)
                    ->update([
                        'image' => $paths[0],
                        'slider_images' => json_encode($paths),
                        'is_active' => true,
                        'updated_at' => now(),
                    ]);

                DB::table('portfolio_photos')
                    ->where('portfolio_id', $portfolioId)
                    ->delete();

                foreach ($paths as $index => $path) {
                    DB::table('portfolio_photos')->insert([
                        'portfolio_id' => $portfolioId,
                        'path' => $path,
                        'sort_order' => $index + 1,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $keepIds[] = $portfolioId;
            }

            if (empty($keepIds)) {
                throw new RuntimeException('No imported bahan portfolios found to keep.');
            }

            DB::table('portfolio_photos')
                ->whereNotIn('portfolio_id', $keepIds)
                ->delete();

            DB::table('portfolios')
                ->whereNotIn('id', $keepIds)
                ->delete();
        });

        Cache::forget('frontend.home.data');
        Cache::forget('sitemap.xml');
    }

    public function down(): void
    {
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

    private function portfolioGroups(): array
    {
        return [
            'Kitchen Set Putih Orange' => 'kitchenset-01',
            'Backdrop TV Kayu Modern' => 'backdrop-tv-01',
            'Kamar Set Panel Kayu' => 'kamarset-01',
            'Walk-in Wardrobe Display' => 'wardrobe-01',
            'Kitchen Set Abu Modern' => 'kitchenset-02',
            'Kitchen Set Marmer Elegan' => 'kitchenset-03',
            'Kitchen Set Minimalis Abu' => 'kitchenset-04',
            'Kitchen Set Kompak L-Shape' => 'kitchenset-05',
            'Kitchen Set Dining Modern' => 'kitchenset-06',
            'Lemari Bawah Tangga Multifungsi' => 'lemari-bawah-tangga-01',
            'Mini Bar Custom Bawah Tangga' => 'mini-bar-01',
            'Bench Cabinet Hallway Custom' => 'bench-cabinet-01',
            'Backdrop TV Wall Panel Hitam' => 'backdrop-tv-02',
            'Kamar Set Headboard Putih' => 'kamarset-02',
            'Lemari Bawah Tangga Putih' => 'lemari-bawah-tangga-02',
            'Living Room Panel Kayu' => 'living-room-01',
            'Wall Panel Partisi Vertical' => 'wall-panel-01',
        ];
    }
};

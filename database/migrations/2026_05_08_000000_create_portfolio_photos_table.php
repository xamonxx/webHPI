<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->unsignedTinyInteger('sort_order')->default(1);
            $table->timestamps();

            $table->index(['portfolio_id', 'sort_order']);
        });

        if (!Schema::hasTable('portfolios')) {
            return;
        }

        $now = now();
        DB::table('portfolios')
            ->select(['id', 'image', 'slider_images'])
            ->orderBy('id')
            ->chunkById(100, function ($portfolios) use ($now) {
                foreach ($portfolios as $portfolio) {
                    $paths = [];

                    if (!empty($portfolio->image)) {
                        $paths[] = $portfolio->image;
                    }

                    $sliderImages = json_decode($portfolio->slider_images ?? '[]', true);
                    if (is_array($sliderImages)) {
                        $paths = array_merge($paths, $sliderImages);
                    }

                    $paths = collect($paths)
                        ->filter(fn ($path) => is_string($path) && trim($path) !== '')
                        ->unique()
                        ->take(5)
                        ->values();

                    foreach ($paths as $index => $path) {
                        DB::table('portfolio_photos')->insert([
                            'portfolio_id' => $portfolio->id,
                            'path' => $path,
                            'sort_order' => $index + 1,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    }
                }
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_photos');
    }
};

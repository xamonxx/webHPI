<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('hero_sections')) {
            return;
        }

        DB::table('hero_sections')->updateOrInsert(
            ['id' => DB::table('hero_sections')->value('id') ?? 1],
            [
                'title' => 'Mendefinisikan Ruang,',
                'title_highlight' => 'Meningkatkan Gaya Hidup kamu',
                'subtitle' => 'Rasakan seni desain interior eksklusif. Kami menciptakan lingkungan hangat dan mewah yang disesuaikan dengan visi dan gaya hidup unik Anda.',
                'background_image' => 'assets/images/hero-interior-local.avif',
                'button1_text' => 'Lihat Portfolio',
                'button1_link' => '#portfolio',
                'button2_text' => 'Konsultasi Gratis',
                'button2_link' => '#contact',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    public function down(): void
    {
        if (Schema::hasTable('hero_sections')) {
            DB::table('hero_sections')
                ->where('background_image', 'assets/images/hero-interior-local.avif')
                ->update(['background_image' => 'assets/images/hero-interior-local.jpg']);
        }
    }
};

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

        $hero = [
            'title' => 'Mendefinisikan Ruang,',
            'title_highlight' => 'Meningkatkan Gaya Hidup kamu',
            'subtitle' => 'Rasakan seni desain interior eksklusif. Kami menciptakan lingkungan hangat dan mewah yang disesuaikan dengan visi dan gaya hidup unik Anda.',
            'background_image' => 'assets/images/hero-interior-local.avif',
            'button1_text' => 'Lihat Portfolio',
            'button1_link' => '#portfolio',
            'button2_text' => 'Konsultasi Gratis',
            'button2_link' => '#contact',
            'is_active' => true,
            'updated_at' => now(),
        ];

        $existingId = DB::table('hero_sections')->value('id');

        if ($existingId) {
            DB::table('hero_sections')->where('id', $existingId)->update($hero);

            return;
        }

        $hero['created_at'] = now();
        DB::table('hero_sections')->insert($hero);

        if (Schema::hasTable('site_settings')) {
            DB::table('site_settings')->updateOrInsert(
                ['setting_key' => 'site_tagline'],
                [
                    'setting_value' => '#1 JASA INTERIOR DESIGN',
                    'setting_type' => 'text',
                    'setting_group' => 'general',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('hero_sections')) {
            DB::table('hero_sections')
                ->where('background_image', 'assets/images/hero-interior-local.avif')
                ->update(['background_image' => null]);
        }
    }
};

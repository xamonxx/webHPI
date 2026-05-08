<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('site_settings')) {
            return;
        }

        DB::table('site_settings')
            ->where('setting_key', 'site_tagline')
            ->whereIn('setting_value', [
                'Desain Interior Premium',
                'Solusi Interior & Furniture Premium',
            ])
            ->update(['setting_value' => '']);

        DB::table('site_settings')
            ->where('setting_key', 'site_description')
            ->whereIn('setting_value', [
                'Kami menciptakan ruang hangat dan mewah yang disesuaikan dengan visi dan gaya hidup unik Anda.',
                'Home Putra Interior adalah perusahaan yang bergerak di bidang desain interior, furniture custom, dan renovasi untuk rumah, apartemen, kantor, dan komersial.',
            ])
            ->update(['setting_value' => '']);
    }

    public function down(): void
    {
        // No rollback. Seeded copy should not be restored automatically.
    }
};

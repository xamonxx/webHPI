<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Remove seeded/demo content and external media URLs from the live database.
     */
    public function up(): void
    {
        if (Schema::hasTable('hero_sections')) {
            DB::table('hero_sections')
                ->where('title', 'like', 'Mendefinisikan Ruang%')
                ->delete();

            DB::table('hero_sections')
                ->where('background_image', 'like', 'http://%')
                ->orWhere('background_image', 'like', 'https://%')
                ->update(['background_image' => null]);
        }

        if (Schema::hasTable('portfolios')) {
            DB::table('portfolios')
                ->whereIn('title', [
                    'The Penthouse Edit',
                    'Executive Study',
                    'Serene Master Suite',
                    'Marble & Gold Kitchen',
                    'The Grand Hall',
                ])
                ->delete();

            DB::table('portfolios')
                ->where('image', 'like', 'http://%')
                ->orWhere('image', 'like', 'https://%')
                ->update(['image' => null]);
        }

        if (Schema::hasTable('testimonials')) {
            DB::table('testimonials')
                ->whereIn('client_name', [
                    'Sarah Putri',
                    'Michael Hartono',
                    'Lisa Wijaya',
                    'Budi Santoso',
                    'Dewi Anggara',
                ])
                ->delete();

            DB::table('testimonials')
                ->where('client_image', 'like', 'http://%')
                ->orWhere('client_image', 'like', 'https://%')
                ->update(['client_image' => null]);
        }

        if (Schema::hasTable('statistics')) {
            DB::table('statistics')
                ->whereIn('stat_label', [
                    'Proyek Selesai',
                    'Tahun Pengalaman',
                    'Kepuasan Klien',
                    'Garansi',
                ])
                ->delete();
        }

        if (Schema::hasTable('services')) {
            DB::table('services')
                ->whereIn('title', [
                    'Desain Residensial',
                    'Ruang Komersial',
                    'Furniture Custom',
                ])
                ->delete();
        }

        if (Schema::hasTable('site_settings')) {
            DB::table('site_settings')
                ->whereIn('setting_key', [
                    'contact_email',
                    'contact_phone',
                    'contact_whatsapp',
                    'whatsapp_number',
                    'contact_address',
                    'instagram_url',
                    'facebook_url',
                    'social_instagram',
                    'social_facebook',
                ])
                ->update(['setting_value' => '']);
        }
    }

    public function down(): void
    {
        // No rollback. Deleted demo data should not be restored automatically.
    }
};

<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'Home Putra Interior', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Solusi Interior & Furniture Premium', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Home Putra Interior adalah perusahaan yang bergerak di bidang desain interior, furniture custom, dan renovasi untuk rumah, apartemen, kantor, dan komersial.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => null, 'type' => 'image', 'group' => 'general'],
            ['key' => 'site_favicon', 'value' => null, 'type' => 'image', 'group' => 'general'],

            // Contact Settings
            ['key' => 'contact_email', 'value' => 'info@homeputra.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+62 812 3456 7890', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '6281234567890', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Jakarta, Indonesia', 'type' => 'textarea', 'group' => 'contact'],

            // Social Media Settings
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/homeputra', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/homeputra', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_tiktok', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => '', 'type' => 'text', 'group' => 'social'],

            // SEO Settings
            ['key' => 'seo_meta_title', 'value' => 'Home Putra Interior - Jasa Interior & Furniture Premium', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'seo_meta_description', 'value' => 'Home Putra Interior menyediakan jasa desain interior, furniture custom, dan renovasi berkualitas tinggi dengan harga terjangkau.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'seo_keywords', 'value' => 'interior, furniture, desain interior, kitchen set, lemari, backdrop tv, renovasi', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'google_analytics_id', 'value' => '', 'type' => 'text', 'group' => 'seo'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $setting['key']],
                [
                    'setting_value' => $setting['value'],
                    'setting_type' => $setting['type'],
                    'setting_group' => $setting['group'],
                ]
            );
        }
    }
}

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
            ['key' => 'site_tagline', 'value' => '#1 JASA INTERIOR DESIGN', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => '', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => null, 'type' => 'image', 'group' => 'general'],
            ['key' => 'site_favicon', 'value' => null, 'type' => 'image', 'group' => 'general'],

            // Contact Settings
            ['key' => 'contact_email', 'value' => 'cs@homeputrainterior.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+62 818-0993-9681', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '6281809939681', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'whatsapp_number', 'value' => '6281809939681', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => '', 'type' => 'textarea', 'group' => 'contact'],

            // Social Media Settings
            ['key' => 'social_instagram', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_facebook', 'value' => '', 'type' => 'text', 'group' => 'social'],
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

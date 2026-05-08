<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrator',
                'full_name' => 'Administrator',
                'email' => 'admin@homeputra.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        HeroSection::updateOrCreate(
            ['id' => 1],
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
            ]
        );

        $settings = [
            ['setting_key' => 'site_name', 'setting_value' => 'Home Putra Interior', 'setting_type' => 'text', 'setting_group' => 'general'],
            ['setting_key' => 'site_tagline', 'setting_value' => '#1 JASA INTERIOR DESIGN', 'setting_type' => 'text', 'setting_group' => 'general'],
            ['setting_key' => 'site_description', 'setting_value' => '', 'setting_type' => 'textarea', 'setting_group' => 'general'],
            ['setting_key' => 'contact_email', 'setting_value' => '', 'setting_type' => 'text', 'setting_group' => 'contact'],
            ['setting_key' => 'contact_phone', 'setting_value' => '', 'setting_type' => 'text', 'setting_group' => 'contact'],
            ['setting_key' => 'contact_address', 'setting_value' => '', 'setting_type' => 'textarea', 'setting_group' => 'contact'],
            ['setting_key' => 'whatsapp_number', 'setting_value' => '', 'setting_type' => 'text', 'setting_group' => 'contact'],
            ['setting_key' => 'instagram_url', 'setting_value' => '', 'setting_type' => 'text', 'setting_group' => 'social'],
            ['setting_key' => 'facebook_url', 'setting_value' => '', 'setting_type' => 'text', 'setting_group' => 'social'],
            ['setting_key' => 'youtube_url', 'setting_value' => '', 'setting_type' => 'text', 'setting_group' => 'social'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['setting_key' => $setting['setting_key']],
                $setting
            );
        }

        $this->call(PortfolioSeeder::class);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin Login: username=admin, password=admin123');
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\HeroSection;
use App\Models\Statistic;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'full_name' => 'Administrator',
            'email' => 'admin@homeputra.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Create Hero Section
        HeroSection::create([
            'title' => 'Mendefinisikan Ruang, <span class="text-gold-gradient italic">Meningkatkan Gaya Hidup</span>',
            'subtitle' => 'Rasakan seni desain interior eksklusif. Kami menciptakan lingkungan hangat dan mewah yang disesuaikan dengan visi dan gaya hidup unik Anda.',
            'button1_text' => 'Lihat Portfolio',
            'button1_link' => '#portfolio',
            'button2_text' => 'Konsultasi Gratis',
            'button2_link' => '#contact',
            'is_active' => true,
        ]);

        // Create Statistics
        Statistic::insert([
            ['stat_number' => '500', 'stat_suffix' => '+', 'stat_label' => 'Proyek Selesai', 'display_order' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['stat_number' => '12', 'stat_suffix' => '+', 'stat_label' => 'Tahun Pengalaman', 'display_order' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['stat_number' => '98', 'stat_suffix' => '%', 'stat_label' => 'Kepuasan Klien', 'display_order' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['stat_number' => '2', 'stat_suffix' => 'th', 'stat_label' => 'Garansi', 'display_order' => 4, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create Services
        Service::insert([
            ['title' => 'Desain Residensial', 'description' => 'Renovasi skala penuh dan desain bangunan baru untuk rumah mewah, fokus pada aliran, cahaya, dan materialitas.', 'icon' => 'home', 'display_order' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Ruang Komersial', 'description' => 'Menciptakan pengalaman brand yang berdampak melalui desain tata ruang cerdas untuk ritel, perhotelan, dan kantor.', 'icon' => 'storefront', 'display_order' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Furniture Custom', 'description' => 'Desain dan koordinasi fabrikasi furniture eksklusif untuk memastikan setiap produk cocok sempurna dengan ruang Anda.', 'icon' => 'chair', 'display_order' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create Portfolios
        Portfolio::insert([
            ['title' => 'The Penthouse Edit', 'category' => 'Residensial', 'description' => 'Ruang tamu minimalis modern dengan sentuhan mewah dan pencahayaan alami yang optimal', 'image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=800&q=80', 'display_order' => 1, 'is_featured' => true, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Executive Study', 'category' => 'Kantor', 'description' => 'Ruang kerja eksekutif dengan kayu oak gelap yang elegan dan detail brass yang mewah', 'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&w=800&q=80', 'display_order' => 2, 'is_featured' => true, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Serene Master Suite', 'category' => 'Residensial', 'description' => 'Kamar tidur utama dengan nuansa Scandinavian yang tenang dan material natural', 'image' => 'https://images.unsplash.com/photo-1616594039964-ae9021a400a0?auto=format&fit=crop&w=800&q=80', 'display_order' => 3, 'is_featured' => true, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'Marble & Gold Kitchen', 'category' => 'Dapur', 'description' => 'Dapur mewah dengan kombinasi marmer Carrara dan aksen emas yang elegan', 'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=800&q=80', 'display_order' => 4, 'is_featured' => true, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['title' => 'The Grand Hall', 'category' => 'Ruang Makan', 'description' => 'Ruang makan megah dengan chandelier kristal dan furniture custom berkelas', 'image' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?auto=format&fit=crop&w=800&q=80', 'display_order' => 5, 'is_featured' => true, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create Testimonials
        Testimonial::insert([
            ['client_name' => 'Sarah Putri', 'client_location' => 'Jakarta Selatan', 'testimonial_text' => 'Home Putra Interior mengubah apartemen gelap dan kuno kami menjadi tempat tinggal yang penuh cahaya. Perhatian terhadap detail sungguh luar biasa.', 'rating' => 5, 'display_order' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['client_name' => 'Michael Hartono', 'client_location' => 'Surabaya', 'testimonial_text' => 'Tim ini memahami visi kami lebih baik dari kami sendiri. Ruang kerja kayu oak hangat sekarang menjadi ruangan favorit saya di seluruh rumah.', 'rating' => 5, 'display_order' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['client_name' => 'Lisa Wijaya', 'client_location' => 'Bandung', 'testimonial_text' => 'Profesional, tepat waktu, dan sangat berbakat. Mereka mengelola semuanya mulai dari kontraktor hingga styling.', 'rating' => 5, 'display_order' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Create Site Settings
        SiteSetting::insert([
            ['setting_key' => 'site_name', 'setting_value' => 'Home Putra Interior', 'setting_type' => 'text', 'setting_group' => 'general', 'created_at' => now(), 'updated_at' => now()],
            ['setting_key' => 'site_tagline', 'setting_value' => 'Desain Interior Premium', 'setting_type' => 'text', 'setting_group' => 'general', 'created_at' => now(), 'updated_at' => now()],
            ['setting_key' => 'site_description', 'setting_value' => 'Kami menciptakan ruang hangat dan mewah yang disesuaikan dengan visi dan gaya hidup unik Anda.', 'setting_type' => 'textarea', 'setting_group' => 'general', 'created_at' => now(), 'updated_at' => now()],
            ['setting_key' => 'contact_email', 'setting_value' => 'hello@homeputra.com', 'setting_type' => 'text', 'setting_group' => 'contact', 'created_at' => now(), 'updated_at' => now()],
            ['setting_key' => 'contact_phone', 'setting_value' => '+62 812 3456 7890', 'setting_type' => 'text', 'setting_group' => 'contact', 'created_at' => now(), 'updated_at' => now()],
            ['setting_key' => 'contact_address', 'setting_value' => 'Jl. Desain No. 123, Jakarta Selatan 12345', 'setting_type' => 'textarea', 'setting_group' => 'contact', 'created_at' => now(), 'updated_at' => now()],
            ['setting_key' => 'whatsapp_number', 'setting_value' => '6281809939681', 'setting_type' => 'text', 'setting_group' => 'contact', 'created_at' => now(), 'updated_at' => now()],
            ['setting_key' => 'instagram_url', 'setting_value' => 'https://instagram.com/homeputrainterior', 'setting_type' => 'text', 'setting_group' => 'social', 'created_at' => now(), 'updated_at' => now()],
            ['setting_key' => 'facebook_url', 'setting_value' => 'https://facebook.com/homeputrainterior', 'setting_type' => 'text', 'setting_group' => 'social', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin Login: username=admin, password=admin123');
    }
}

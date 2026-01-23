<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Sarah Putri',
                'client_location' => 'Jakarta Selatan',
                'testimonial_text' => 'Home Putra Interior mengubah apartemen kami menjadi tempat tinggal yang penuh cahaya. Perhatian terhadap detail sungguh luar biasa dan hasilnya melebihi ekspektasi.',
                'rating' => 5,
                'display_order' => 1,
                'is_active' => true,
            ],
            [
                'client_name' => 'Michael Hartono',
                'client_location' => 'Surabaya',
                'testimonial_text' => 'Tim yang sangat profesional! Ruang kerja kayu oak hangat sekarang menjadi ruangan favorit saya. Prosesnya lancar dan komunikatif.',
                'rating' => 5,
                'display_order' => 2,
                'is_active' => true,
            ],
            [
                'client_name' => 'Lisa Wijaya',
                'client_location' => 'Bandung',
                'testimonial_text' => 'Profesional, tepat waktu, dan sangat berbakat. Mereka mengelola semuanya mulai dari desain hingga instalasi dengan sempurna.',
                'rating' => 5,
                'display_order' => 3,
                'is_active' => true,
            ],
            [
                'client_name' => 'Budi Santoso',
                'client_location' => 'Malang',
                'testimonial_text' => 'Kitchen set aluminium yang dibuat sangat presisi dan berkualitas tinggi. Garansi 2 tahun membuat kami tenang. Highly recommended!',
                'rating' => 5,
                'display_order' => 4,
                'is_active' => true,
            ],
            [
                'client_name' => 'Dewi Anggara',
                'client_location' => 'Sidoarjo',
                'testimonial_text' => 'Lemari sliding yang dibuatkan sangat fungsional dan elegan. Tim instalasi sangat rapi dan bersih dalam bekerja.',
                'rating' => 5,
                'display_order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::create($data);
        }
    }
}

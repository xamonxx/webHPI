<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    /**
     * Show hero section edit form
     */
    public function index()
    {
        // Get the first (and usually only) hero section, or create one
        $hero = HeroSection::first();

        if (!$hero) {
            $hero = HeroSection::create([
                'title' => 'Wujudkan Interior Impian Anda.',
                'subtitle' => 'Kami mengubah ruangan biasa menjadi mahakarya visual yang mewah, nyaman, dan mencerminkan karakter sukses kamu.',
                'button1_text' => 'Lihat Portfolio',
                'button1_link' => '#portfolio',
                'button2_text' => 'Konsultasi Gratis',
                'button2_link' => '#contact',
                'is_active' => true,
            ]);
        }

        return view('admin.hero.index', compact('hero'));
    }

    /**
     * Update hero section
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_highlight' => 'nullable|string|max:255',
            'subtitle' => 'required|string|max:1000',
            'button1_text' => 'nullable|string|max:50',
            'button1_link' => 'nullable|string|max:255',
            'button2_text' => 'nullable|string|max:50',
            'button2_link' => 'nullable|string|max:255',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'background_url' => 'nullable|url|max:500',
            'is_active' => 'boolean',
        ]);

        $hero = HeroSection::first();

        if (!$hero) {
            $hero = new HeroSection();
        }

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            // Delete old image if exists
            if ($hero->background_image && !filter_var($hero->background_image, FILTER_VALIDATE_URL)) {
                Storage::disk('public')->delete('uploads/' . $hero->background_image);
            }

            $file = $request->file('background_image');
            $filename = 'hero_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploads', $filename, 'public');
            $hero->background_image = $filename;
        } elseif ($request->filled('background_url')) {
            // Use URL instead of upload
            $hero->background_image = $request->background_url;
        }

        $hero->title = $validated['title'];
        $hero->title_highlight = $validated['title_highlight'] ?? null;
        $hero->subtitle = $validated['subtitle'];
        $hero->button1_text = $validated['button1_text'] ?? 'Lihat Portfolio';
        $hero->button1_link = $validated['button1_link'] ?? '#portfolio';
        $hero->button2_text = $validated['button2_text'] ?? 'Konsultasi Gratis';
        $hero->button2_link = $validated['button2_link'] ?? '#contact';
        $hero->is_active = $request->boolean('is_active', true);
        $hero->save();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section berhasil diperbarui!');
    }
}

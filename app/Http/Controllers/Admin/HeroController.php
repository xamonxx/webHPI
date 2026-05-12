<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HeroRequest;
use App\Models\HeroSection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HeroController extends Controller
{
    /**
     * Show hero section edit form
     */
    public function index()
    {
        $hero = HeroSection::first() ?? new HeroSection(['is_active' => true]);

        return view('admin.hero.index', compact('hero'));
    }

    /**
     * Update hero section
     */
    public function update(HeroRequest $request)
    {
        $validated = $request->validated();

        $hero = HeroSection::first();

        if (! $hero) {
            $hero = new HeroSection;
        }

        $uploadedFilename = null;
        $oldBackground = null;

        if ($request->hasFile('background_image')) {
            $oldBackground = $hero->background_image && ! filter_var($hero->background_image, FILTER_VALIDATE_URL)
                ? $hero->background_image
                : null;

            $file = $request->file('background_image');
            $uploadedFilename = 'hero_'.Str::uuid().'.'.strtolower($file->getClientOriginalExtension());
            $file->storeAs('uploads', $uploadedFilename, 'public');
            $hero->background_image = $uploadedFilename;
        }

        try {
            $hero->title = $validated['title'];
            $hero->title_highlight = $validated['title_highlight'] ?? null;
            $hero->subtitle = $validated['subtitle'];
            $hero->button1_text = $validated['button1_text'] ?? null;
            $hero->button1_link = $validated['button1_link'] ?? null;
            $hero->button2_text = $validated['button2_text'] ?? null;
            $hero->button2_link = $validated['button2_link'] ?? null;
            $hero->is_active = $request->boolean('is_active', true);
            $hero->save();
        } catch (\Throwable $exception) {
            if ($uploadedFilename) {
                Storage::disk('public')->delete('uploads/'.$uploadedFilename);
            }

            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Hero section gagal diperbarui, silakan coba lagi.');
        }

        if ($oldBackground) {
            Storage::disk('public')->delete(str_contains($oldBackground, '/') ? $oldBackground : 'uploads/'.$oldBackground);
        }

        Cache::forget('frontend.home.data');

        return redirect()->route('admin.hero.index')
            ->with('success', 'Hero section berhasil diperbarui!');
    }
}

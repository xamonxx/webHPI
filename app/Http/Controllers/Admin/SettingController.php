<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SettingController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index()
    {
        $settings = SiteSetting::getAllAsArray();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update the settings.
     */
    public function update(SettingRequest $request)
    {
        $settings = [
            ['key' => 'site_name', 'value' => $request->site_name, 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => $request->site_tagline, 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => $request->site_description, 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'contact_email', 'value' => $request->contact_email, 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => $request->contact_phone, 'type' => 'text', 'group' => 'contact'],
            ['key' => 'whatsapp_number', 'value' => $request->whatsapp_number, 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => $request->contact_address, 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'instagram_url', 'value' => $request->instagram_url, 'type' => 'text', 'group' => 'social'],
            ['key' => 'facebook_url', 'value' => $request->facebook_url, 'type' => 'text', 'group' => 'social'],
            ['key' => 'tiktok_url', 'value' => $request->tiktok_url, 'type' => 'text', 'group' => 'social'],
            ['key' => 'youtube_url', 'value' => $request->youtube_url, 'type' => 'text', 'group' => 'social'],
            ['key' => 'seo_meta_title', 'value' => $request->seo_meta_title, 'type' => 'text', 'group' => 'seo'],
            ['key' => 'seo_meta_description', 'value' => $request->seo_meta_description, 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'seo_keywords', 'value' => $request->seo_keywords, 'type' => 'text', 'group' => 'seo'],
            ['key' => 'google_analytics_id', 'value' => $request->google_analytics_id, 'type' => 'text', 'group' => 'seo'],
        ];

        $newUploads = [];
        $oldFilesToDelete = [];

        if ($request->hasFile('site_logo')) {
            $oldLogo = SiteSetting::get('site_logo');
            $logoPath = $request->file('site_logo')->store('settings', 'public');

            $settings[] = ['key' => 'site_logo', 'value' => $logoPath, 'type' => 'image', 'group' => 'general'];
            $newUploads[] = $logoPath;

            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                $oldFilesToDelete[] = $oldLogo;
            }
        }

        if ($request->hasFile('site_favicon')) {
            $oldFavicon = SiteSetting::get('site_favicon');
            $faviconPath = $request->file('site_favicon')->store('settings', 'public');

            $settings[] = ['key' => 'site_favicon', 'value' => $faviconPath, 'type' => 'image', 'group' => 'general'];
            $newUploads[] = $faviconPath;

            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                $oldFilesToDelete[] = $oldFavicon;
            }
        }

        try {
            DB::transaction(fn () => SiteSetting::setMany($settings));
        } catch (Throwable $exception) {
            foreach ($newUploads as $path) {
                Storage::disk('public')->delete($path);
            }

            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Pengaturan gagal disimpan, silakan coba lagi.');
        }

        foreach ($oldFilesToDelete as $path) {
            Storage::disk('public')->delete($path);
        }

        Cache::forget('frontend.home.data');
        Cache::forget('sitemap.xml');

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}

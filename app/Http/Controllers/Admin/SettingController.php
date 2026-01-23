<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'nullable|string|max:255',
            'site_tagline' => 'nullable|string|max:500',
            'site_description' => 'nullable|string|max:1000',
            'site_logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'site_favicon' => 'nullable|image|mimes:png,ico,svg|max:512',

            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:30',
            'whatsapp_number' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:500',

            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
            'tiktok_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',

            'seo_meta_title' => 'nullable|string|max:70',
            'seo_meta_description' => 'nullable|string|max:160',
            'seo_keywords' => 'nullable|string|max:255',
            'google_analytics_id' => 'nullable|string|max:50',
        ]);

        // Handle General Settings
        SiteSetting::set('site_name', $request->site_name, 'text', 'general');
        SiteSetting::set('site_tagline', $request->site_tagline, 'text', 'general');
        SiteSetting::set('site_description', $request->site_description, 'textarea', 'general');

        // Handle Logo Upload
        if ($request->hasFile('site_logo')) {
            $oldLogo = SiteSetting::get('site_logo');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            $logoPath = $request->file('site_logo')->store('settings', 'public');
            SiteSetting::set('site_logo', $logoPath, 'image', 'general');
        }

        // Handle Favicon Upload
        if ($request->hasFile('site_favicon')) {
            $oldFavicon = SiteSetting::get('site_favicon');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            $faviconPath = $request->file('site_favicon')->store('settings', 'public');
            SiteSetting::set('site_favicon', $faviconPath, 'image', 'general');
        }

        // Handle Contact Settings (using original keys for backward compatibility)
        SiteSetting::set('contact_email', $request->contact_email, 'text', 'contact');
        SiteSetting::set('contact_phone', $request->contact_phone, 'text', 'contact');
        SiteSetting::set('whatsapp_number', $request->whatsapp_number, 'text', 'contact');
        SiteSetting::set('contact_address', $request->contact_address, 'textarea', 'contact');

        // Handle Social Settings (using original keys for backward compatibility)
        SiteSetting::set('instagram_url', $request->instagram_url, 'text', 'social');
        SiteSetting::set('facebook_url', $request->facebook_url, 'text', 'social');
        SiteSetting::set('tiktok_url', $request->tiktok_url, 'text', 'social');
        SiteSetting::set('youtube_url', $request->youtube_url, 'text', 'social');

        // Handle SEO Settings
        SiteSetting::set('seo_meta_title', $request->seo_meta_title, 'text', 'seo');
        SiteSetting::set('seo_meta_description', $request->seo_meta_description, 'textarea', 'seo');
        SiteSetting::set('seo_keywords', $request->seo_keywords, 'text', 'seo');
        SiteSetting::set('google_analytics_id', $request->google_analytics_id, 'text', 'seo');

        // Clear all cache
        SiteSetting::clearCache();

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan berhasil disimpan!');
    }
}

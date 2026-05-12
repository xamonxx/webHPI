<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display a listing of services
     */
    public function index(): View
    {
        $services = Service::ordered()->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service
     */
    public function store(ServiceRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['display_order'] = $validated['display_order'] ?? 0;

        try {
            Service::create($validated);
        } catch (\Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Layanan gagal ditambahkan, silakan coba lagi.');
        }

        $this->clearFrontendCache();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Display the specified service
     */
    public function show(Service $service): View
    {
        // Simple show view or reuse edit with disabled fields
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Show the form for editing the specified service
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service
     */
    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $validated = $request->validated();

        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = $validated['display_order'] ?? $service->display_order;

        try {
            $service->update($validated);
        } catch (\Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Layanan gagal diperbarui, silakan coba lagi.');
        }

        $this->clearFrontendCache();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Remove the specified service
     */
    public function destroy(Service $service): RedirectResponse
    {
        try {
            $service->delete();
        } catch (\Throwable $exception) {
            report($exception);

            return back()->with('error', 'Layanan gagal dihapus, silakan coba lagi.');
        }

        $this->clearFrontendCache();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Layanan berhasil dihapus!');
    }

    private function clearFrontendCache(): void
    {
        Cache::forget('frontend.home.data');
        Cache::forget('sitemap.xml');
    }
}

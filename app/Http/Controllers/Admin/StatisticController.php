<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StatisticRequest;
use App\Models\Statistic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class StatisticController extends Controller
{
    /**
     * Display a listing of statistics
     */
    public function index(): View
    {
        $statistics = Statistic::orderBy('display_order')->get();

        return view('admin.statistics.index', compact('statistics'));
    }

    /**
     * Store a newly created statistic
     */
    public function store(StatisticRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        try {
            Statistic::create($validated);
        } catch (\Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Statistik gagal ditambahkan, silakan coba lagi.');
        }

        $this->clearFrontendCache();

        return back()->with('success', 'Statistik berhasil ditambahkan!');
    }

    /**
     * Update the specified statistic
     */
    public function update(StatisticRequest $request, Statistic $statistic): RedirectResponse
    {
        $validated = $request->validated();

        try {
            $statistic->update($validated);
        } catch (\Throwable $exception) {
            report($exception);

            return back()
                ->withInput()
                ->with('error', 'Statistik gagal diperbarui, silakan coba lagi.');
        }

        $this->clearFrontendCache();

        return back()->with('success', 'Statistik berhasil diperbarui!');
    }

    /**
     * Remove the specified statistic
     */
    public function destroy(Statistic $statistic): RedirectResponse
    {
        try {
            $statistic->delete();
        } catch (\Throwable $exception) {
            report($exception);

            return back()->with('error', 'Statistik gagal dihapus, silakan coba lagi.');
        }

        $this->clearFrontendCache();

        return back()->with('success', 'Statistik berhasil dihapus!');
    }

    private function clearFrontendCache(): void
    {
        Cache::forget('frontend.home.data');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'stat_number' => 'required|string',
            'stat_suffix' => 'nullable|string|max:10',
            'stat_label' => 'required|string|max:100',
            'display_order' => 'nullable|integer',
        ]);

        Statistic::create($validated);

        return back()->with('success', 'Statistik berhasil ditambahkan!');
    }

    /**
     * Update the specified statistic
     */
    public function update(Request $request, Statistic $statistic): RedirectResponse
    {
        $validated = $request->validate([
            'stat_number' => 'required|string',
            'stat_suffix' => 'nullable|string|max:10',
            'stat_label' => 'required|string|max:100',
            'display_order' => 'nullable|integer',
        ]);

        $statistic->update($validated);

        return back()->with('success', 'Statistik berhasil diperbarui!');
    }

    /**
     * Remove the specified statistic
     */
    public function destroy(Statistic $statistic): RedirectResponse
    {
        $statistic->delete();

        return back()->with('success', 'Statistik berhasil dihapus!');
    }
}

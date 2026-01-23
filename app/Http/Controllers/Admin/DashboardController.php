<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\ContactSubmission;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index(): View
    {
        $stats = [
            'portfolios' => Portfolio::active()->count(),
            'services' => Service::active()->count(),
            'testimonials' => Testimonial::active()->count(),
            'unread_messages' => ContactSubmission::unread()->count(),
        ];

        $recentMessages = ContactSubmission::latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentMessages'));
    }
}

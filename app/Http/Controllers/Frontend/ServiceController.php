<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display all services
     */
    public function index(): View
    {
        $services = Service::active()
            ->ordered()
            ->get();

        return view('frontend.services-all', compact('services'));
    }
}

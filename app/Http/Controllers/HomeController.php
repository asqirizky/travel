<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Package;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)
            ->latest()
            ->get();

        $destinations = Destination::where('is_active', true)
            ->orderBy('id')
            ->get();

        return Inertia::render('Welcome', [
            'packages' => $packages,
            'destinations' => $destinations,
        ]);
    }
}

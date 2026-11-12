<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $packages = Package::where('is_active', true)
            ->latest()
            ->get();

        return Inertia::render('Welcome', [
            'packages' => $packages,
        ]);
    }
}

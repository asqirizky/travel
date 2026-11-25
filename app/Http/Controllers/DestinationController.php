<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Inertia\Inertia;
use Inertia\Response;

class DestinationController extends Controller
{
    public function show(Destination $destination): Response
    {
        abort_unless($destination->is_active, 404);

        return Inertia::render('public/destinations/Show', [
            'destination' => $destination->load('sections'),
            'whatsappNumber' => config('services.whatsapp.number', '6281216904379'),
        ]);
    }
}

<?php

use App\Models\Destination;
use Inertia\Testing\AssertableInertia as Assert;

test('the landing page shares active destinations', function () {
    $active = Destination::factory()->create(['name' => 'Bromo']);
    Destination::factory()->inactive()->create();

    $this->get(route('home'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('Welcome')
            ->has('destinations', 1)
            ->where('destinations.0.name', 'Bromo')
            ->where('destinations.0.id', $active->id));
});

test('a destination page displays the destination and its sections', function () {
    $destination = Destination::factory()->create([
        'name' => 'Kawah Ijen',
        'slug' => 'kawah-ijen',
        'location' => 'Banyuwangi',
        'short_description' => 'Danau kawah toska.',
        'description' => 'Deskripsi lengkap Kawah Ijen.',
    ]);

    $destination->sections()->create([
        'title' => 'Blue Fire',
        'description' => 'Fenomena api biru.',
        'sort_order' => 0,
    ]);

    $this->get(route('destinations.show', $destination->slug))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('public/destinations/Show')
            ->where('destination.name', 'Kawah Ijen')
            ->where('destination.slug', 'kawah-ijen')
            ->has('destination.sections', 1)
            ->where('destination.sections.0.title', 'Blue Fire')
            ->has('whatsappNumber'));
});

test('inactive destinations are not accessible to the public', function () {
    $destination = Destination::factory()->inactive()->create();

    $this->get(route('destinations.show', $destination->slug))->assertNotFound();
});

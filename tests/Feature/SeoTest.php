<?php

use App\Models\Destination;
use App\Models\Package;

test('public pages render search engine metadata in the initial HTML', function () {
    config()->set('app.url', 'https://travel.test');
    config()->set('seo.description', 'Deskripsi default untuk pengujian.');

    $this->get(route('home'))
        ->assertOk()
        ->assertSee('<title data-inertia="">Indonesia Culture Trip</title>', false)
        ->assertSee('<meta data-inertia="description" name="description" content="Deskripsi default untuk pengujian.">', false)
        ->assertSee('<link data-inertia="canonical" rel="canonical" href="https://travel.test/">', false)
        ->assertSee('property="og:title" content="Indonesia Culture Trip - Ijen Bromo Travel"', false)
        ->assertSee('name="twitter:card" content="summary_large_image"', false)
        ->assertSee('type="application/ld+json"', false)
        ->assertSee('"@type":"WebSite"', false);
});

test('destination pages use destination content for seo metadata', function () {
    config()->set('app.url', 'https://travel.test');

    $destination = Destination::factory()->create([
        'name' => 'Kawah Ijen',
        'slug' => 'kawah-ijen',
        'location' => 'Banyuwangi',
        'short_description' => 'Danau kawah toska dengan api biru.',
        'image' => '/destinations/kawah-ijen.jpg',
    ]);

    $this->get(route('destinations.show', $destination->slug))
        ->assertOk()
        ->assertSee('<title data-inertia="">Kawah Ijen - Destinasi</title>', false)
        ->assertSee('name="description" content="Danau kawah toska dengan api biru."', false)
        ->assertSee('property="og:image" content="https://travel.test/destinations/kawah-ijen.jpg"', false)
        ->assertSee('"@type":"TouristAttraction"', false);
});

test('package pages use package content for seo metadata', function () {
    config()->set('app.url', 'https://travel.test');

    Package::query()->create([
        'name_package' => 'Paket Ijen Bromo',
        'slug' => 'paket-ijen-bromo',
        'location' => 'Banyuwangi',
        'short_description' => 'Perjalanan tiga hari ke Ijen dan Bromo.',
        'duration_days' => 3,
        'duration_nights' => 2,
        'thumbnail' => '/packages/paket-ijen-bromo.jpg',
        'is_active' => true,
    ]);

    $this->get(route('packages.show', 'paket-ijen-bromo'))
        ->assertOk()
        ->assertSee('<title data-inertia="">Paket Ijen Bromo - Detail Paket</title>', false)
        ->assertSee('name="description" content="Perjalanan tiga hari ke Ijen dan Bromo."', false)
        ->assertSee('rel="canonical" href="https://travel.test/packages/paket-ijen-bromo"', false)
        ->assertSee('"@type":"Product"', false);
});

test('sitemap contains active public pages and excludes inactive content', function () {
    config()->set('app.url', 'https://travel.test');

    Destination::factory()->create(['slug' => 'kawah-ijen']);
    Destination::factory()->inactive()->create(['slug' => 'destinasi-nonaktif']);
    Package::query()->create([
        'name_package' => 'Paket Aktif',
        'slug' => 'paket-aktif',
        'location' => 'Malang',
        'short_description' => 'Paket wisata aktif.',
        'duration_days' => 2,
        'duration_nights' => 1,
        'is_active' => true,
    ]);
    Package::query()->create([
        'name_package' => 'Paket Nonaktif',
        'slug' => 'paket-nonaktif',
        'location' => 'Malang',
        'short_description' => 'Paket wisata nonaktif.',
        'duration_days' => 2,
        'duration_nights' => 1,
        'is_active' => false,
    ]);

    $this->get(route('sitemap.xml'))
        ->assertOk()
        ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
        ->assertSee('<loc>https://travel.test/</loc>', false)
        ->assertSee('<loc>https://travel.test/destinations/kawah-ijen</loc>', false)
        ->assertSee('<loc>https://travel.test/packages/paket-aktif</loc>', false)
        ->assertDontSee('destinasi-nonaktif')
        ->assertDontSee('paket-nonaktif');
});

test('robots points crawlers to the sitemap', function () {
    config()->set('app.url', 'https://travel.test');

    $this->get(route('robots'))
        ->assertOk()
        ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
        ->assertSee("User-agent: *\nAllow: /", false)
        ->assertSee('Sitemap: https://travel.test/sitemap.xml');
});

test('non public pages are marked as not indexable', function () {
    $this->get(route('contact.login'))
        ->assertOk()
        ->assertSee('name="robots" content="noindex, nofollow"', false);
});

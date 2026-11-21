<?php

use App\Enums\UserRole;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Inertia\Testing\AssertableInertia as Assert;

test('guests are redirected from the destination management area', function () {
    $this->get(route('admin.destinations.index'))->assertRedirect(route('login'));
});

test('regular users cannot access destination management', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get(route('admin.destinations.index'))->assertForbidden();
});

test('admins can view the destination list', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    Destination::factory()->count(2)->create();

    $this->actingAs($admin)
        ->get(route('admin.destinations.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('admin/destinations/Index')
            ->has('destinations', 2));
});

test('admins can create a destination with custom sections and images', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    $this->actingAs($admin)
        ->post(route('admin.destinations.store'), [
            'name' => 'Kawah Ijen',
            'location' => 'Banyuwangi',
            'short_description' => 'Danau kawah toska.',
            'description' => 'Deskripsi lengkap.',
            'is_active' => true,
            'image' => UploadedFile::fake()->image('hero.jpg'),
            'sections' => [
                [
                    'title' => 'Blue Fire',
                    'description' => 'Fenomena api biru.',
                    'image' => UploadedFile::fake()->image('section.jpg'),
                ],
            ],
        ])
        ->assertRedirect(route('admin.destinations.index'));

    $destination = Destination::where('slug', 'kawah-ijen')->firstOrFail();

    expect($destination->sections)->toHaveCount(1)
        ->and($destination->sections->first()->title)->toBe('Blue Fire')
        ->and($destination->image)->toStartWith('/destinations/')
        ->and($destination->sections->first()->image)->toStartWith('/destinations/');

    File::delete(public_path(ltrim($destination->image, '/')));
    File::delete(public_path(ltrim($destination->sections->first()->image, '/')));
});

test('admins can update a destination and its sections', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    $destination = Destination::factory()->create(['name' => 'Bromo', 'slug' => 'bromo']);
    $section = $destination->sections()->create([
        'title' => 'Lama',
        'description' => 'Deskripsi lama.',
        'sort_order' => 0,
    ]);

    $this->actingAs($admin)
        ->post(route('admin.destinations.update', $destination), [
            '_method' => 'PUT',
            'name' => 'Bromo Tengger',
            'location' => 'East Java',
            'description' => 'Deskripsi baru.',
            'is_active' => true,
            'sections' => [
                [
                    'id' => $section->id,
                    'title' => 'Sunrise',
                    'description' => 'Deskripsi baru sub bab.',
                ],
                [
                    'title' => 'Lautan Pasir',
                    'description' => 'Sub bab baru.',
                ],
            ],
        ])
        ->assertRedirect(route('admin.destinations.index'));

    $destination->refresh();

    expect($destination->name)->toBe('Bromo Tengger')
        ->and($destination->slug)->toBe('bromo-tengger')
        ->and($destination->sections()->count())->toBe(2)
        ->and($destination->sections()->where('title', 'Sunrise')->exists())->toBeTrue();
});

test('admins can delete a destination', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    $destination = Destination::factory()->create();
    $destination->sections()->create([
        'title' => 'Sub bab',
        'description' => null,
        'sort_order' => 0,
    ]);

    $this->actingAs($admin)
        ->delete(route('admin.destinations.destroy', $destination))
        ->assertRedirect(route('admin.destinations.index'));

    $this->assertDatabaseMissing('destinations', ['id' => $destination->id]);
    $this->assertDatabaseMissing('destination_sections', ['destination_id' => $destination->id]);
});

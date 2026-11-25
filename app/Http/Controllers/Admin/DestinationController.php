<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class DestinationController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('admin/destinations/Index', [
            'destinations' => Destination::query()
                ->withCount('sections')
                ->latest()
                ->get(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('admin/destinations/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateDestination($request);

        DB::transaction(function () use ($request, $validated): void {
            $destination = Destination::create([
                'name' => $validated['name'],
                'slug' => $this->uniqueSlug($validated['name']),
                'location' => $validated['location'] ?? null,
                'short_description' => $validated['short_description'] ?? null,
                'description' => $validated['description'] ?? null,
                'image' => $this->storeImage($request->file('image'), $validated['name']),
                'is_active' => $request->boolean('is_active'),
            ]);

            $this->syncSections($destination, $validated['sections'] ?? [], $request);
        });

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Destinasi berhasil ditambahkan.']);

        return to_route('admin.destinations.index');
    }

    public function edit(Destination $destination): Response
    {
        return Inertia::render('admin/destinations/Edit', [
            'destination' => $destination->load('sections'),
        ]);
    }

    public function update(Request $request, Destination $destination): RedirectResponse
    {
        $validated = $this->validateDestination($request);

        DB::transaction(function () use ($request, $destination, $validated): void {
            $data = [
                'name' => $validated['name'],
                'location' => $validated['location'] ?? null,
                'short_description' => $validated['short_description'] ?? null,
                'description' => $validated['description'] ?? null,
                'is_active' => $request->boolean('is_active'),
            ];

            if ($destination->name !== $validated['name']) {
                $data['slug'] = $this->uniqueSlug($validated['name'], $destination);
            }

            if ($request->hasFile('image')) {
                $this->deleteImage($destination->image);
                $data['image'] = $this->storeImage($request->file('image'), $validated['name']);
            } elseif ($request->boolean('remove_image')) {
                $this->deleteImage($destination->image);
                $data['image'] = null;
            }

            $destination->update($data);

            $this->syncSections($destination, $validated['sections'] ?? [], $request);
        });

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Destinasi berhasil diperbarui.']);

        return to_route('admin.destinations.index');
    }

    public function destroy(Destination $destination): RedirectResponse
    {
        DB::transaction(function () use ($destination): void {
            $destination->sections->each(function (DestinationSection $section): void {
                $this->deleteImage($section->image);
            });

            $this->deleteImage($destination->image);

            $destination->delete();
        });

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Destinasi berhasil dihapus.']);

        return to_route('admin.destinations.index');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateDestination(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'remove_image' => ['nullable', 'boolean'],
            'is_active' => ['boolean'],
            'sections' => ['nullable', 'array', 'max:20'],
            'sections.*.id' => ['nullable', 'integer'],
            'sections.*.title' => ['required', 'string', 'max:255'],
            'sections.*.description' => ['nullable', 'string'],
            'sections.*.image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'sections.*.remove_image' => ['nullable', 'boolean'],
        ]);
    }

    /**
     * @param  array<int, array<string, mixed>>  $sections
     */
    private function syncSections(Destination $destination, array $sections, Request $request): void
    {
        $keptIds = collect($sections)
            ->pluck('id')
            ->filter()
            ->map(fn ($id) => (int) $id)
            ->all();

        $destination->sections()
            ->whereNotIn('id', $keptIds)
            ->get()
            ->each(function (DestinationSection $section): void {
                $this->deleteImage($section->image);
                $section->delete();
            });

        $order = 0;

        foreach ($sections as $index => $data) {
            $section = ! empty($data['id'])
                ? $destination->sections()->find($data['id'])
                : new DestinationSection();

            if (! $section instanceof DestinationSection) {
                continue;
            }

            $section->destination_id = $destination->id;
            $section->title = $data['title'];
            $section->description = $data['description'] ?? null;
            $section->sort_order = $order++;

            $file = $request->file("sections.{$index}.image");

            if ($file instanceof UploadedFile) {
                $this->deleteImage($section->image);
                $section->image = $this->storeImage($file, $data['title']);
            } elseif (! empty($data['remove_image'])) {
                $this->deleteImage($section->image);
                $section->image = null;
            }

            $section->save();
        }
    }

    private function storeImage(?UploadedFile $file, string $prefix): ?string
    {
        if (! $file instanceof UploadedFile) {
            return null;
        }

        $name = Str::slug(Str::limit($prefix, 40, '')) ?: 'destinasi';
        $filename = $name.'-'.Str::random(8).'.'.$file->getClientOriginalExtension();

        if (! File::isDirectory(public_path('destinations'))) {
            File::makeDirectory(public_path('destinations'), 0755, true);
        }

        $file->move(public_path('destinations'), $filename);

        return '/destinations/'.$filename;
    }

    private function deleteImage(?string $path): void
    {
        if (! $path) {
            return;
        }

        $absolute = public_path(ltrim($path, '/'));

        if (File::isFile($absolute)) {
            File::delete($absolute);
        }
    }

    private function uniqueSlug(string $name, ?Destination $ignore = null): string
    {
        $base = Str::slug($name) ?: 'destinasi';
        $slug = $base;
        $counter = 2;

        while (
            Destination::query()
                ->where('slug', $slug)
                ->when($ignore, fn ($query) => $query->whereKeyNot($ignore->getKey()))
                ->exists()
        ) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }
}

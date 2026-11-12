<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Service;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Inertia\Inertia;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = Package::latest()->get();

        return Inertia::render('admin/packages/Index', [
            'packages' => $packages,
        ]);
    }

    // public function show($slug)
    // {
    //     $package = TourPackage::where('slug', $slug)
    //         ->where('is_active', true)
    //         ->firstOrFail();

    //     return Inertia::render('public/packages/Show', [
    //         'package' => $package,
    //         'whatsappNumber' => config('services.whatsapp.number', '6281234567890'), // Ganti dengan nomor WA kamu (format 62)
    //     ]);
    // }

    public function show($slug)
    {
        $package = Package::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return Inertia::render('public/packages/Show', [
            'package' => $package,
            'whatsappNumber' => config('services.whatsapp.number', '6281234567890'),
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/packages/Create', [
            'services' => Service::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_active' => 'boolean',
        ]);

        // Form mengirim 'title', mapping ke kolom 'name_package' pada tabel packages
        $validated['name_package'] = $validated['title'];
        unset($validated['title']);

        // Generate slug dari name_package
        $validated['slug'] = Str::slug($validated['name_package']).'-'.Str::random(5);

        // Proses upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $filename = Str::slug($validated['name_package']).'-'.Str::random(5).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->move(public_path('packages'), $filename);
            $validated['thumbnail'] = '/packages/'.$filename;
        }

        $package = Package::create($validated);

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Paket wisata berhasil ditambahkan!']);

        return redirect()->route('admin.packages.index');
    }

    public function edit(Package $package)
    {
        return Inertia::render('admin/packages/Edit', [
            'package' => $package,
        ]);
    }

    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'duration_days' => 'required|integer|min:1',
            'duration_nights' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Form mengirim 'title', mapping ke kolom 'name_package' pada tabel packages
        $validated['name_package'] = $validated['title'];
        unset($validated['title']);

        // Update slug jika name_package berubah
        if ($package->name_package !== $validated['name_package']) {
            $validated['slug'] = Str::slug($validated['name_package']).'-'.Str::random(5);
        }

        // Cek jika ada upload foto baru
        if ($request->hasFile('thumbnail')) {
            // Hapus foto lama jika ada
            if ($package->thumbnail) {
                $oldPath = public_path($package->thumbnail);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // Simpan foto baru
            $filename = Str::slug($validated['name_package']).'-'.Str::random(5).'.'.$request->file('thumbnail')->getClientOriginalExtension();
            $request->file('thumbnail')->move(public_path('packages'), $filename);
            $validated['thumbnail'] = '/packages/'.$filename;
        } else {
            unset($validated['thumbnail']);
        }

        $package->update($validated);

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Paket berhasil diperbarui']);

        return redirect()->route('admin.packages.index');
    }

    public function destroy(Package $package)
    {
        // Hapus file gambar jika ada
        if ($package->thumbnail) {
            $path = public_path($package->thumbnail);
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $package->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => 'Paket berhasil dihapus']);

        return redirect()->back();
    }
}

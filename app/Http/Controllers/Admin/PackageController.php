<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PackageController extends Controller
{
    // note: routes should protect this controller with IsAdmin middleware

    public function index(Request $request)
    {
        $query = Package::query()->orderByDesc('created_at');

        if ($q = $request->input('q')) {
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%$q%")
                    ->orWhere('excerpt', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%");
            });
        }

        if ($duration = $request->input('duration')) {
            if ($duration !== 'all' && !empty($duration)) {
                $query->where('duration', 'like', "%$duration%");
            }
        }

        $packages = $query->paginate(15)->withQueryString();

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:255',
            'price' => 'nullable|integer|min:0',
            'cover_image' => 'nullable|image|max:2048',
            'featured' => 'sometimes',
            'is_active' => 'sometimes',
        ]);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $path = $file->store('packages', 'public');
            $data['cover_image'] = $path;
        }

        $data['slug'] = Str::slug($data['title']);
        // convert checkbox presence to booleans
        $data['featured'] = $request->has('featured') ? true : false;
        $data['is_active'] = $request->has('is_active') ? true : false;
        $data['user_id'] = auth()->id();

        // ensure slug uniqueness
        $base = $data['slug'];
        $i = 1;
        while (Package::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $base . '-' . $i++;
        }

        Package::create($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil dibuat');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function show(Package $package)
    {
        // admin view for a single package
        return view('admin.packages.show', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:255',
            'price' => 'nullable|integer|min:0',
            'cover_image' => 'nullable|image|max:2048',
            'featured' => 'sometimes',
            'is_active' => 'sometimes',
        ]);

        if ($request->hasFile('cover_image')) {
            // remove old image if exists
            if ($old = $package->cover_image) {
                if (str_starts_with($old, 'storage/')) {
                    $old = substr($old, strlen('storage/'));
                }
                Storage::disk('public')->delete($old);
            }
            $file = $request->file('cover_image');
            $path = $file->store('packages', 'public');
            $data['cover_image'] = $path;
        }

        // normalize checkbox values
        $data['featured'] = $request->has('featured') ? true : false;
        $data['is_active'] = $request->has('is_active') ? true : false;

        // if title changed, update slug
        if (!empty($data['title']) && $data['title'] !== $package->title) {
            $slug = Str::slug($data['title']);
            $base = $slug;
            $i = 1;
            while (Package::where('slug', $slug)->where('id', '!=', $package->id)->exists()) {
                $slug = $base . '-' . $i++;
            }
            $data['slug'] = $slug;
        }

        $package->update($data);

        return redirect()->route('admin.packages.index')->with('success', 'Paket berhasil diperbarui');
    }

    public function destroy(Package $package)
    {
        // delete files associated
        if ($old = $package->cover_image) {
            if (str_starts_with($old, 'storage/')) {
                $old = substr($old, strlen('storage/'));
            }
            Storage::disk('public')->delete($old);
        }
        $package->delete();
        return back()->with('success', 'Paket dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::query()->where('is_active', true)->orderByDesc('featured')->orderByDesc('created_at');

        if ($q = $request->input('q')) {
            $query->where(function($sub) use ($q) {
                $sub->where('title', 'like', "%$q%")
                    ->orWhere('excerpt', 'like', "%$q%")
                    ->orWhere('description', 'like', "%$q%");
            });
        }

        // duration filter (expects exact duration strings like "1 Hari 2 Malam" or 'all')
        if ($duration = $request->input('duration')) {
            if ($duration !== 'all' && !empty($duration)) {
                $query->where('duration', 'like', "%$duration%");
            }
        }

        // keep query params when paginating
        $packages = $query->paginate(12)->withQueryString();

        return view('packages.index', compact('packages'));
    }

    public function show(Package $package)
    {
        if (!$package->is_active) {
            abort(404);
        }
        return view('packages.show', compact('package'));
    }
}

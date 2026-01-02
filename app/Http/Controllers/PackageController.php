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

        // Filter paket lebih tinggi jika ada upgrade_from
        if ($upgradeFrom = $request->input('upgrade_from')) {
            // Ambil angka hari dari string durasi, contoh: "2 Hari 2 Malam" => 2
            preg_match('/(\d+)/', $upgradeFrom, $matchFrom);
            $fromDays = isset($matchFrom[1]) ? (int)$matchFrom[1] : 0;
            $query->whereRaw('CAST(SUBSTRING_INDEX(duration, " ", 1) AS UNSIGNED) > ?', [$fromDays]);
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
        // Ambil testimoni yang sudah di-approve dan terkait dengan paket ini (dari payment)
        $testimoniPayment = \App\Models\Testimonial::whereHas('payment', function($q) use ($package) {
            $q->where('package_id', $package->id);
        })->where('approved', true);

        // Ambil testimoni umum (tanpa payment) yang menyebutkan nama paket di message
        $testimoniUmum = \App\Models\Testimonial::whereNull('payment_id')
            ->where('approved', true)
            ->where('message', 'like', '%' . $package->title . '%');

        // Gabungkan dan ambil 5 terbaru
        $testimonials = $testimoniPayment->union($testimoniUmum)->latest()->take(5)->get();
        return view('packages.show', compact('package', 'testimonials'));
    }
}

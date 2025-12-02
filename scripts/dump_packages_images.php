<?php

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Package;
use Illuminate\Support\Facades\Storage;

$rows = Package::all()->map(function ($p) {
    $exists = false;
    $path = $p->cover_image;
    $url = $p->cover_image_url;

    if ($path) {
        // normalize
        if (str_starts_with($path, '/storage/')) $path = substr($path, 9);
        if (str_starts_with($path, 'storage/')) $path = substr($path, 8);
        $exists = Storage::disk('public')->exists($path);
    }
    return [
        'id' => $p->id,
        'title' => $p->title,
        'cover_image' => $p->cover_image,
        'normalized' => $path,
        'exists_on_disk' => $exists,
        'cover_image_url' => $url,
    ];
});

echo json_encode($rows->toArray(), JSON_PRETTY_PRINT);

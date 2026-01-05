<?php

/**
 * Custom router for PHP built-in server (used by `php artisan serve` if present).
 *
 * Goal: serve static files (especially /storage/...) WITH CORS headers,
 * because PHP's built-in server bypasses Laravel middleware for static assets.
 */

$publicPath = __DIR__ . DIRECTORY_SEPARATOR . 'public';

$uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$uri = is_string($uri) ? urldecode($uri) : '/';

if ($uri === '') {
    $uri = '/';
}

$isOptions = (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS');

$startsWith = static function (string $haystack, string $needle): bool {
    return $needle === '' || strncmp($haystack, $needle, strlen($needle)) === 0;
};

$sendCorsHeaders = static function (): void {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization');
    header('Access-Control-Max-Age: 86400');
};

$isHead = (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'HEAD');

$getMimeType = static function (string $path): string {
    $ext = strtolower((string) pathinfo($path, PATHINFO_EXTENSION));

    // Prefer deterministic mapping (Windows often lacks fileinfo/mime_content_type).
    $map = [
        'css' => 'text/css; charset=utf-8',
        'js' => 'application/javascript; charset=utf-8',
        'mjs' => 'application/javascript; charset=utf-8',
        'json' => 'application/json; charset=utf-8',
        'map' => 'application/json; charset=utf-8',
        'html' => 'text/html; charset=utf-8',
        'htm' => 'text/html; charset=utf-8',
        'txt' => 'text/plain; charset=utf-8',
        'svg' => 'image/svg+xml',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'webp' => 'image/webp',
        'gif' => 'image/gif',
        'ico' => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf' => 'font/ttf',
        'otf' => 'font/otf',
        'eot' => 'application/vnd.ms-fontobject',
    ];

    if ($ext !== '' && isset($map[$ext])) {
        return $map[$ext];
    }

    $detected = function_exists('mime_content_type') ? @mime_content_type($path) : null;
    if (is_string($detected) && $detected !== '') {
        return $detected;
    }

    return 'application/octet-stream';
};

// Handle CORS preflight for /storage/*
if ($isOptions && $startsWith($uri, '/storage/')) {
    $sendCorsHeaders();
    http_response_code(204);
    exit;
}

// Serve existing files in /public directly (including /public/storage symlink)
if ($uri !== '/' && !str_contains($uri, '..')) {
    $filePath = $publicPath . str_replace('/', DIRECTORY_SEPARATOR, $uri);

    if (is_file($filePath)) {
        if ($startsWith($uri, '/storage/')) {
            $sendCorsHeaders();
        }

        $contentType = $getMimeType($filePath);
        header('Content-Type: ' . $contentType);
        header('Content-Length: ' . (string) filesize($filePath));

        // Dev-friendly caching: prevent browsers from keeping a previously-wrong MIME type
        // for CSS/JS in cache.
        $ext = strtolower((string) pathinfo($filePath, PATHINFO_EXTENSION));
        if (in_array($ext, ['css', 'js', 'mjs', 'map', 'json', 'html', 'htm'], true)) {
            header('Cache-Control: no-store, max-age=0');
            header('Pragma: no-cache');
            header('Expires: 0');
        } else {
            header('Cache-Control: public, max-age=3600');
        }

        if (!$isHead) {
            readfile($filePath);
        }
        exit;
    }
}

require_once $publicPath . DIRECTORY_SEPARATOR . 'index.php';

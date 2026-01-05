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

        $mimeType = function_exists('mime_content_type') ? @mime_content_type($filePath) : null;
        if (!is_string($mimeType) || $mimeType === '') {
            $mimeType = 'application/octet-stream';
        }

        header('Content-Type: ' . $mimeType);
        header('Content-Length: ' . (string) filesize($filePath));

        // Basic caching for static files
        header('Cache-Control: public, max-age=3600');

        readfile($filePath);
        exit;
    }
}

require_once $publicPath . DIRECTORY_SEPARATOR . 'index.php';

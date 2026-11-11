<?php

namespace App\Support;

use Illuminate\Support\Str;

/**
 * Lighter copies of uploaded images. `php artisan images:webp` writes photo.webp next to
 * photo.jpg; pages ask for the copy through webp_asset() and fall back to the original.
 */
class Images
{
    /** Extensions that get a WebP copy. */
    public const SOURCE_EXTENSIONS = ['jpg', 'jpeg', 'png'];

    /**
     * The WebP copy's path when it exists, else the path as given. Accepts what views pass to
     * asset(): "attachments/x.jpg", "/attachments/x.jpg" or a full URL on this site.
     */
    public static function webp(string $path): string
    {
        $local = self::localPath($path);

        if ($local === null || ! in_array(strtolower(pathinfo($local, PATHINFO_EXTENSION)), self::SOURCE_EXTENSIONS, true)) {
            return $path;
        }

        $copy = self::copyPath($local);
        $copyFile = public_path($copy);
        $sourceFile = public_path($local);

        // only a copy that is really lighter (a small PNG icon can come out bigger as WebP)
        if (! is_file($copyFile) || (is_file($sourceFile) && filesize($copyFile) >= filesize($sourceFile))) {
            return $path;
        }

        // keep the caller's form (leading slash, or full URL)
        return Str::startsWith($path, ['http://', 'https://'])
            ? url($copy)
            : (Str::startsWith($path, '/') ? '/' . $copy : $copy);
    }

    /** "attachments/x.jpg" -> "attachments/x.webp" */
    public static function copyPath(string $path): string
    {
        return preg_replace('/\.[^.\/]+$/', '', $path) . '.webp';
    }

    /** The path under public/ without a leading slash, or null for another site's URL. */
    private static function localPath(string $path): ?string
    {
        $path = trim($path);

        if ($path === '') {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '//'])) {
            $host = parse_url($path, PHP_URL_HOST);
            if ($host !== parse_url(url('/'), PHP_URL_HOST)) {
                return null;
            }
            $path = (string) parse_url($path, PHP_URL_PATH);
        }

        $path = rawurldecode(strtok($path, '?#'));

        return ltrim($path, '/') ?: null;
    }
}

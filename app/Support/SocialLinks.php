<?php

namespace App\Support;

use Illuminate\Support\Str;
use App\Settings\SettingSingleton;

/**
 * The brand's social profiles from the dashboard (site settings), as clean profile addresses:
 * the footer links to them and the Organization schema lists them in sameAs, which is how
 * search engines and AI assistants tie those profiles to this company.
 */
class SocialLinks
{
    /** dashboard key => Font Awesome icon, in footer order */
    public const NETWORKS = [
        'facebook' => 'fa-facebook-f',
        'linked_in' => 'fa-linkedin-in',
        'instagram' => 'fa-instagram',
        'youtube' => 'fa-youtube',
        'tiktok' => 'fa-tiktok',
    ];

    /** key => profile URL, for every network filled in with a web address */
    public static function all(): array
    {
        $settings = SettingSingleton::getInstance();
        $links = [];

        foreach (array_keys(self::NETWORKS) as $key) {
            if ($url = self::clean($key, $settings->getItem($key))) {
                $links[$key] = $url;
            }
        }

        return $links;
    }

    /**
     * Profiles that name the company itself, for schema sameAs. A Facebook /share/ link is a
     * redirect made by the app's share button, not the page's address, so it is left out until
     * the page link is entered in the dashboard.
     */
    public static function profiles(): array
    {
        return array_values(array_filter(self::all(), fn ($url) => ! preg_match('#facebook\.com/share/#i', $url)));
    }

    /**
     * Tracking and view parameters dropped ("?hl=ar", "?mibextid=…"), and a LinkedIn company
     * link reduced to the company page (".../company/name/posts/?feedView=all" → ".../company/name/").
     */
    public static function clean(string $key, ?string $raw): ?string
    {
        $url = trim((string) $raw);

        if (! Str::startsWith($url, ['http://', 'https://'])) {
            return null;
        }

        if ($key === 'linked_in' && preg_match('#^(https?://(?:[a-z]+\.)?linkedin\.com/company/[^/?\#]+)#i', $url, $match)) {
            return $match[1] . '/';
        }

        return self::withoutTracking($url);
    }

    /**
     * Only tracking and view parameters go; the rest of the query stays, since some profile
     * addresses live in it (facebook.com/profile.php?id=…).
     */
    private static function withoutTracking(string $url): string
    {
        $url = preg_replace('/#.*$/', '', $url);
        [$base, $query] = array_pad(explode('?', $url, 2), 2, '');

        parse_str($query, $params);
        $params = array_filter($params, fn ($key) => ! preg_match(
            '/^(utm_\w+|hl|mibextid|fbclid|igshid|igsh|si|feedview|ref|rdid|share_url|locale)$/i',
            (string) $key
        ), ARRAY_FILTER_USE_KEY);

        return $base . ($params ? '?' . http_build_query($params) : '');
    }
}

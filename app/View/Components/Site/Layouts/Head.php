<?php

namespace App\View\Components\Site\Layouts;

use App\Support\WhatsApp;
use App\Support\SocialLinks;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use App\Settings\SettingSingleton;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Head extends Component
{
    public $title;
    public $currentLang;
    public $settings;
    public $pageName;

    public $siteName;
    public $metaTitle;
    public $metaDescription;
    public $metaKeywords;
    public $ogImage;
    public $ogType;
    public $ogLocale;
    public $alternates;
    public $schema;
    public $robots;

    public function __construct()
    {

        $this->currentLang = app()->getLocale();
        $this->settings = SettingSingleton::getInstance();
        $this->pageName = $this->getPageNameFromRoute();
        $this->siteName = $this->settings->getItem('site_name') ?: config('app.name');
        $this->title = $this->getDynamicTitle();

        $this->metaTitle = $this->getMetaTitle();
        $this->metaDescription = $this->getMetaDescription();
        $this->metaKeywords = $this->section('meta_key') ?: (string) $this->settings->getMeta('home_meta_key_' . $this->currentLang);
        $this->ogImage = $this->section('og_image') ?: asset($this->settings->getItem('logo') ?? 'site/img/logos/logo.png');
        $this->ogType = $this->section('og_type') ?: 'website';
        $this->ogLocale = $this->currentLang === 'ar' ? 'ar_EG' : 'en_US';
        $this->robots = $this->section('robots');
        $this->alternates = $this->getAlternates();
        $this->schema = $this->getSchema();
    }

    private function getPageNameFromRoute()
    {
        $routeName = Route::currentRouteName();
        $routes = [
            'site.home' => 'home',
            'site.gallery.index' => 'gallery',
            'site.offers.index' => 'offers',
            'site.services.index' => 'services',
            'site.specialites' => 'specialites',
        ];
        return $routes[$routeName] ?? 'home';
    }

    private function getDynamicTitle()
    {
        return $this->siteName . ' | ' . $this->defaultTitle();
    }

    /** Home meta title from the dashboard; it already carries the brand name. */
    private function defaultTitle(): string
    {
        return $this->clean($this->settings->getMeta($this->pageName . '_meta_title_' . $this->currentLang))
            ?: $this->clean($this->settings->getMeta('home_meta_title_' . $this->currentLang));
    }

    /**
     * "Page title | Site name". A page that sets no title (or an empty one from the dashboard)
     * falls back to the home meta title instead of rendering "Hulul-eg |".
     */
    private function getMetaTitle(): string
    {
        $page = $this->section('title');

        if ($page === '') {
            return $this->defaultTitle() ?: $this->siteName;
        }

        if (Route::currentRouteName() === 'site.home') {
            return $page;
        }

        $page = $this->withoutBrand($page) ?: $page;

        if (Str::contains($page, $this->siteName)) {
            return $page;
        }

        return $page . ' | ' . $this->siteName;
    }

    /**
     * A dashboard title with the brand already at its start or end ("… | حلول", "Hulul - …")
     * loses it, so the site name added after it is the only one and always the same spelling.
     */
    private function withoutBrand(string $title): string
    {
        $brand = '(?:' . preg_quote($this->siteName, '/') . '|حلول(?:\s+hulul)?|hulul(?:[\s-]?eg)?(?:\s+agency)?)';

        $title = preg_replace('/\s*[|\-–—]\s*' . $brand . '\s*$/iu', '', $title) ?? $title;
        $title = preg_replace('/^\s*' . $brand . '\s*[|\-–—]\s*/iu', '', $title) ?? $title;

        return trim($title);
    }

    private function getMetaDescription(): string
    {
        $description = $this->section('meta_description')
            ?: $this->clean($this->settings->getMeta('home_meta_description_' . $this->currentLang));

        return Str::limit($description, 160);
    }

    /**
     * Same page in every language. Pages whose slug differs per language (services) share
     * their own list as `seoAlternates`; everything else keeps its path and swaps the locale.
     */
    private function getAlternates(): array
    {
        // error pages (404/500, marked noindex) must not advertise alternates
        if (! Route::currentRouteName() || $this->robots !== '') {
            return [];
        }

        $alternates = View::shared('seoAlternates');

        if (! $alternates) {
            $alternates = [];
            foreach (array_keys(LaravelLocalization::getSupportedLocales()) as $locale) {
                $alternates[$locale] = LaravelLocalization::getLocalizedURL($locale, url()->current(), [], true);
            }
        }

        // The bare domain sends each visitor to /ar or /en by browser language (and crawlers that
        // send none to /en), so it is the home page's x-default. Inner pages have no such page:
        // Arabic, the main market, answers visitors whose language is neither.
        $alternates['x-default'] = Route::currentRouteName() === 'site.home'
            ? url('/') . '/'
            : ($alternates['ar'] ?? reset($alternates));

        return array_filter($alternates);
    }

    private function getSchema(): array
    {
        $home = url('/');
        $phone = WhatsApp::tel($this->settings->getItem('mobile'), WhatsApp::EGYPT);

        $addresses = array_values(array_filter([
            $this->postalAddress($this->settings->getItem('address'), 'EG'),
            $this->postalAddress($this->settings->getItem('address_ksa'), 'SA'),
        ]));

        $sameAs = SocialLinks::profiles();

        $organization = array_filter([
            '@type' => 'Organization',
            '@id' => $home . '#organization',
            'name' => $this->siteName,
            'alternateName' => array_values(array_diff(['HULUL', 'حلول'], [$this->siteName])),
            'url' => $home,
            'logo' => $this->ogImage,
            'email' => $this->settings->getItem('email') ?: null,
            'telephone' => $phone,
            'address' => $addresses,
            'sameAs' => $sameAs,
        ]);

        $graph = [
            $organization,
            [
                '@type' => 'WebSite',
                '@id' => $home . '#website',
                'url' => $home,
                'name' => $this->siteName,
                'inLanguage' => $this->currentLang,
                'publisher' => ['@id' => $home . '#organization'],
            ],
        ];

        // the two offices, on the pages that present them (home and contact)
        if (in_array(Route::currentRouteName(), ['site.home', 'site.contact-us'], true)) {
            array_push($graph, ...$this->branches($home));
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => $graph,
        ];
    }

    /**
     * Each office as a local business (ProfessionalService) of the organization, for local
     * results and the Google Business Profiles. Everything comes from the dashboard: address,
     * phone, email, the map pin and the opening hours (Egypt office only; Jeddah has none set).
     */
    private function branches(string $home): array
    {
        $ar = $this->currentLang === 'ar';

        $offices = [
            [
                'id' => 'dokki',
                'name' => $ar ? 'الدقي' : 'Dokki',
                'street' => $this->settings->getItem('address'),
                'locality' => $ar ? 'الدقي، الجيزة' : 'Dokki, Giza',
                'country' => 'EG',
                'phone' => WhatsApp::tel($this->settings->getItem('mobile'), WhatsApp::EGYPT),
                'email' => $this->settings->getItem('email'),
                'geo' => $this->mapPin($this->settings->getItem('maps')),
                'hours' => $this->openingHours($this->settings->getItem('openTime')),
            ],
            [
                'id' => 'jeddah',
                'name' => $ar ? 'جدة' : 'Jeddah',
                'street' => $this->settings->getItem('address_ksa'),
                'locality' => $ar ? 'جدة' : 'Jeddah',
                'country' => 'SA',
                'phone' => WhatsApp::tel($this->settings->getItem('mobile_ksa'), WhatsApp::SAUDI_ARABIA),
                'email' => $this->settings->getItem('email_ksa') ?: $this->settings->getItem('email'),
                'geo' => null,
                'hours' => null,
            ],
        ];

        $branches = [];
        foreach ($offices as $office) {
            $street = $this->clean($office['street']);
            if ($street === '') {
                continue;
            }

            $branches[] = array_filter([
                '@type' => 'ProfessionalService',
                '@id' => $home . '#office-' . $office['id'],
                'name' => $this->siteName . ' - ' . $office['name'],
                'url' => route('site.contact-us'),
                'image' => $this->ogImage,
                'logo' => $this->ogImage,
                'telephone' => $office['phone'],
                'email' => $office['email'] ? strtolower($office['email']) : null,
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $street,
                    'addressLocality' => $office['locality'],
                    'addressCountry' => $office['country'],
                ],
                'geo' => $office['geo'],
                'openingHoursSpecification' => $office['hours'],
                'areaServed' => ['@type' => 'Country', 'name' => $office['country'] === 'EG' ? 'Egypt' : 'Saudi Arabia'],
                'parentOrganization' => ['@id' => $home . '#organization'],
            ]);
        }

        return $branches;
    }

    /** Coordinates from a Google Maps embed link ("…!2d31.2079!3d30.0513…"), or null. */
    private function mapPin(?string $embed): ?array
    {
        if (! preg_match('/!3d(-?\d+(?:\.\d+)?)/', (string) $embed, $lat)
            || ! preg_match('/!2d(-?\d+(?:\.\d+)?)/', (string) $embed, $lng)) {
            return null;
        }

        return ['@type' => 'GeoCoordinates', 'latitude' => (float) $lat[1], 'longitude' => (float) $lng[1]];
    }

    /**
     * Opening hours from the dashboard text, when it reads as every day between two times
     * ("Daily from 9 am to 5 pm", "يوميا من 9 ص الى 5 م"). Any other wording is left out
     * rather than guessed.
     */
    private function openingHours(?string $text): ?array
    {
        $text = mb_strtolower($this->clean($text));

        if (! preg_match('/daily|every ?day|يومي/u', $text)) {
            return null;
        }

        $time = '(\d{1,2})(?:[:.](\d{2}))?\s*(am|pm|ص|م)';
        if (! preg_match('/' . $time . '.*?' . $time . '/u', $text, $m)) {
            return null;
        }

        $format = function (string $hour, string $minutes, string $half): string {
            $hour = (int) $hour % 12 + (in_array($half, ['pm', 'م'], true) ? 12 : 0);

            return sprintf('%02d:%02d', $hour, (int) ($minutes ?: 0));
        };

        return [[
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
            'opens' => $format($m[1], $m[2], $m[3]),
            'closes' => $format($m[4], $m[5], $m[6]),
        ]];
    }

    private function postalAddress(?string $address, string $country): ?array
    {
        $address = $this->clean($address);

        return $address === '' ? null : [
            '@type' => 'PostalAddress',
            'streetAddress' => $address,
            'addressCountry' => $country,
        ];
    }

    /** A page's @section value as plain text (Blade stores section values escaped). */
    private function section(string $name): string
    {
        return $this->clean(View::yieldContent($name));
    }

    /**
     * Plain text from dashboard HTML: tags dropped without gluing words, entities decoded.
     * Decoded before and after stripping, because section values arrive escaped ("&lt;p&gt;").
     */
    private function clean(?string $value): string
    {
        $text = html_entity_decode((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $text = strip_tags(str_replace('<', ' <', $text));
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return trim(preg_replace('/[\s\x{00A0}]+/u', ' ', $text) ?? $text);
    }

    public function render()
    {
        return view('components.site.layouts.head');
    }
}

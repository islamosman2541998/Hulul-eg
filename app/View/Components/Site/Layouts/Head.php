<?php

namespace App\View\Components\Site\Layouts;

use App\Support\WhatsApp;
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

        if (Route::currentRouteName() === 'site.home' || Str::contains($page, $this->siteName)) {
            return $page;
        }

        return $page . ' | ' . $this->siteName;
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

        // Arabic is the main market, so it answers visitors whose language is neither
        $alternates['x-default'] = $alternates['ar'] ?? reset($alternates);

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

        $sameAs = collect(['facebook', 'instagram', 'youtube', 'tiktok', 'linkedin'])
            ->map(fn ($key) => $this->settings->getItem($key))
            ->filter(fn ($link) => is_string($link) && Str::startsWith($link, ['http://', 'https://']))
            ->values()
            ->all();

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

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                $organization,
                [
                    '@type' => 'WebSite',
                    '@id' => $home . '#website',
                    'url' => $home,
                    'name' => $this->siteName,
                    'inLanguage' => $this->currentLang,
                    'publisher' => ['@id' => $home . '#organization'],
                ],
            ],
        ];
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

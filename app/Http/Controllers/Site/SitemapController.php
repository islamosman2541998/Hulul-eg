<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SitemapController extends Controller
{
    /**
     * Pages worth indexing, each with its URL in every language so search engines
     * can pair the Arabic and English versions (hreflang).
     */
    public function index()
    {
        $locales = array_keys(LaravelLocalization::getSupportedLocales());
        $pages = [];

        $paths = ['', 'about-us', 'services', 'portfolio', 'blogs', 'jobs', 'faq-questions', 'contact-us'];
        if (! Faq::active()->exists()) {
            // an empty FAQ page is marked noindex, so it isn't offered either
            $paths = array_diff($paths, ['faq-questions']);
        }

        foreach ($paths as $path) {
            $pages[] = [
                'urls' => collect($locales)->mapWithKeys(fn ($locale) => [$locale => url(trim($locale . '/' . $path, '/'))])->all(),
                'lastmod' => null,
                // the bare domain picks the language for the visitor: the home page's x-default
                'x_default' => $path === '' ? url('/') . '/' : null,
            ];
        }

        $categories = ServiceCategory::withoutGlobalScope('transNow')->active()->with('translations')->orderBy('sort', 'ASC')->get();
        foreach ($categories as $category) {
            $urls = $category->translations
                ->filter(fn ($trans) => $trans->slug && in_array($trans->locale, $locales))
                ->mapWithKeys(fn ($trans) => [$trans->locale => url($trans->locale . '/services/' . rawurlencode($trans->slug))])
                ->all();

            if ($urls) {
                $pages[] = ['urls' => $urls, 'lastmod' => $category->updated_at, 'x_default' => null];
            }
        }

        $blogs = Blog::active()->with('translations')->orderBy('sort', 'ASC')->get();
        foreach ($blogs as $blog) {
            // a language without a written article would render an empty page
            $urls = $blog->translations
                ->filter(fn ($trans) => $trans->title && in_array($trans->locale, $locales))
                ->mapWithKeys(fn ($trans) => [$trans->locale => $blog->url($trans->locale)])
                ->all();

            if ($urls) {
                $pages[] = ['urls' => $urls, 'lastmod' => $blog->updated_at, 'x_default' => null];
            }
        }

        foreach ($pages as &$page) {
            // inner pages: Arabic, the main market, answers visitors whose language is neither
            $page['x_default'] ??= $page['urls']['ar'] ?? null;
        }
        unset($page);

        // the declaration lives here, not in the Blade view: servers with short_open_tag on
        // would read "<?xml" in the template as PHP and fail to compile it
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . trim(view('site.sitemap', compact('pages'))->render());

        return response($xml)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}

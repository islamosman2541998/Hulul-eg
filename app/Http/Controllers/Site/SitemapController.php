<?php

namespace App\Http\Controllers\Site;

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

        foreach (['', 'about-us', 'services', 'portfolio', 'blogs', 'jobs', 'faq-questions', 'contact-us'] as $path) {
            $pages[] = [
                'urls' => collect($locales)->mapWithKeys(fn ($locale) => [$locale => url(trim($locale . '/' . $path, '/'))])->all(),
                'lastmod' => null,
            ];
        }

        $categories = ServiceCategory::withoutGlobalScope('transNow')->active()->with('translations')->orderBy('sort', 'ASC')->get();
        foreach ($categories as $category) {
            $urls = $category->translations
                ->filter(fn ($trans) => $trans->slug && in_array($trans->locale, $locales))
                ->mapWithKeys(fn ($trans) => [$trans->locale => url($trans->locale . '/services/' . rawurlencode($trans->slug))])
                ->all();

            if ($urls) {
                $pages[] = ['urls' => $urls, 'lastmod' => $category->updated_at];
            }
        }

        $blogs = Blog::active()->with('translations')->orderBy('sort', 'ASC')->get();
        foreach ($blogs as $blog) {
            // a language without a written article would render an empty page
            $urls = $blog->translations
                ->filter(fn ($trans) => $trans->title && in_array($trans->locale, $locales))
                ->mapWithKeys(fn ($trans) => [$trans->locale => url($trans->locale . '/blogs/' . $blog->id)])
                ->all();

            if ($urls) {
                $pages[] = ['urls' => $urls, 'lastmod' => $blog->updated_at];
            }
        }

        return response()
            ->view('site.sitemap', compact('pages'))
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}

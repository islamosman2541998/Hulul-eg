<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTranslation;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BlogController extends Controller
{
    /**
     */
    public function index()
    {
        $blogs = Blog::with('translations')->active()->orderBy('sort', 'ASC')->get();

        return view('site.pages.blogs.index', compact('blogs'));
    }

    /**
     * An article lives at /{locale}/blogs/{slug}. The old /blogs/{id} address, and a slug from
     * the other language (the language switcher keeps the slug), move there permanently.
     */
    public function show(string $blog)
    {
        $article = $this->find($blog);
        abort_unless($article, 404);

        $url = $article->url();
        if (rawurldecode(parse_url($url, PHP_URL_PATH)) !== rawurldecode('/' . request()->path())) {
            return redirect()->to($url, 301);
        }

        // slugs differ per language, so the head can't just swap /ar for /en
        view()->share('seoAlternates', $article->translations
            ->filter(fn ($trans) => $trans->title && LaravelLocalization::checkLocaleInSupportedLocales($trans->locale))
            ->mapWithKeys(fn ($trans) => [$trans->locale => $article->url($trans->locale)])
            ->all());

        return view('site.pages.blogs.show', ['blog' => $article]);
    }

    /** A published article by its slug in any language, or by its id. */
    private function find(string $key): ?Blog
    {
        $id = BlogTranslation::where('slug', $key)->value('blog_id');

        if (! $id && ctype_digit($key)) {
            $id = (int) $key;
        }

        return $id ? Blog::active()->with('translations')->find($id) : null;
    }
}

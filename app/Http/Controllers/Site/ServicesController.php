<?php

namespace App\Http\Controllers\Site;

use App\Models\Partner;
use App\Models\Services;
use App\Models\HomeSettingPage;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class ServicesController extends Controller
{

    public function index()
    {
        $categories = ServiceCategory::with('transNow')
            ->active()
            ->orderBy('sort', 'ASC')
            ->get();
        $services_section = HomeSettingPage::with('trans')->where('title_section', 'services')->first();
                $partners = Partner::with('translations')->where('status', 1)->get();



        return view('site.pages.services.index', compact('categories', 'services_section','partners'));
    }


    public function show($slug)
    {
        $category = ServiceCategory::whereHas('translations', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->with('transNow', 'translations')->firstOrFail();

        // one URL per language: a slug from another language moves to this language's slug
        $localSlug = $category->transNow?->slug;
        if ($localSlug && $localSlug !== $slug) {
            return redirect()->route('site.services.show', $localSlug, 301);
        }

        // slugs differ per language, so the head can't just swap /ar for /en
        view()->share('seoAlternates', $category->translations
            ->filter(fn ($trans) => $trans->slug && LaravelLocalization::checkLocaleInSupportedLocales($trans->locale))
            ->mapWithKeys(fn ($trans) => [$trans->locale => url($trans->locale . '/services/' . rawurlencode($trans->slug))])
            ->all());

        $services = Services::where('service_category_id', $category->id)
            ->with('transNow')
            ->active()
            ->orderBy('sort', 'ASC')
            ->get();

        return view('site.pages.services.show', compact('category', 'services'));
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\News;
use App\Models\About;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Statistic;
use App\Models\Portfolios;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use App\Models\AboutTranslation;
use App\Http\Controllers\Controller;
use App\Models\HomeSettingPage;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function home()
    {
        $current_lang = app()->getLocale();

        $data = Cache::rememberForever('home_page_data_' . $current_lang, function () {
            $about_us = About::with('transNow')->first();
            if (!$about_us) {
                $about_us = new About();
                $about_us->transNow = new AboutTranslation();
            }

            return [
                'about_us'           => $about_us,
                'blogs'              => Blog::with('translations')->feature()->active()->orderBy('sort', 'ASC')->get(),
                'partners'           => Partner::with('translations')->where('status', 1)->get(),
                'news'               => News::with('translations')->where('status', 1)->take(3)->get(),
                'faq_questions'      => Faq::with('translations')->where('status', 1)->get(),
                'products'           => Product::with('transNow')->feature()->active()->orderBy('sort', 'ASC')->take(3)->get(),
                'categoryProducts'   => ProductCategory::with('transNow')->feature()->active()->orderBy('sort', 'ASC')->get(),
                'servicesCategories' => ServiceCategory::with('transNow')->feature()->active()->orderBy('sort', 'ASC')->take(4)->get(),
                'statistics'         => Statistic::with('transNow')->feature()->active()->orderBy('sort', 'ASC')->get(),
                'services_section'   => HomeSettingPage::with('trans')->where('title_section', 'services')->first(),
            ];
        });

        $page_name = 'home';

        $portfolios = Portfolios::with('transNow')
            ->active()
            ->feature()
            ->take(20)
            ->get()
            ->shuffle()
            ->take(12)
            ->values();

        return view('site.pages.index', array_merge($data, [
            'current_lang' => $current_lang,
            'page_name'    => $page_name,
            'portfolios'   => $portfolios,
        ]));
    }
}
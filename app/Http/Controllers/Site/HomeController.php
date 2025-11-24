<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\News;
use App\Models\About;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Services;
use App\Models\PromoCode;
use App\Models\Portfolios;
use App\Models\PaymentMethod;
use App\Models\PortfolioTags;
use App\Models\ProductCategory;
use App\Models\ServiceCategory;
use App\Models\AboutTranslation;
use App\Settings\SettingSingleton;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function home()
    {

        $current_lang       = app()->getLocale();
        $about_us = About::with('transNow')->first();
        if (!$about_us) {
            $about_us = new About();
            $about_us->transNow = new AboutTranslation();
        }
        $blogs = Blog::with('translations')->where('status', 1)->take(3)->get();
        $partners = Partner::with('translations')->where('status', 1)->get();
        $news = News::with('translations')->where('status', 1)->take(3)->get();
        $faq_questions = Faq::with('translations')->where('status', 1)->get();

        $products = Product::with('transNow')->feature()->active()->orderBy('sort', 'ASC')->take(3)->get();
        $categoryProducts = ProductCategory::with('transNow')->feature()->active()->orderBy('sort', 'ASC')->get();
        $servicesCategories = ServiceCategory::with('transNow')->feature()->active()->orderBy('sort', 'ASC')->get();

        $page_name = 'home';


  $portfolios = Portfolios::active()->feature()
        
        ->take(7)
        ->with('trans','tag.trans')
        ->get();
                //    $portfolios = Portfolios::active()->feature()->inRandomOrder()->take(7)->with('trans','tag.trans')->get();

        return view('site.pages.index', compact(
            'current_lang',
            'page_name',
            'about_us',
            'products',
            'categoryProducts',
            'blogs',
            'partners',
            'news',
            'faq_questions',
            'servicesCategories',
            'portfolios'
        ));
    }
}

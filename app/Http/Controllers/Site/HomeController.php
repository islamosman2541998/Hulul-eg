<?php

namespace App\Http\Controllers\Site;

use App\Models\Blog;
use App\Models\News;
use App\Models\About;
use App\Models\Partner;
use App\Models\Product;
use App\Models\PromoCode;
use App\Models\PaymentMethod;
use App\Models\ProductCategory;
use App\Models\AboutTranslation;
use App\Settings\SettingSingleton;
use App\Http\Controllers\Controller;
use App\Models\Faq;

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

        $products = Product::with('transNow')->feature()->active()->orderBy('sort','ASC')->take(3)->get(); 
        $categoryProducts = ProductCategory::with('transNow')->feature()->active()->orderBy('sort','ASC')->get();        
       
        $page_name = 'home';

        return view('site.pages.index', compact(
            'current_lang',
            'page_name',
            'about_us',
            'products',
            'categoryProducts',
            'blogs',
            'partners',
            'news',
            'faq_questions'
        ));
    }
}

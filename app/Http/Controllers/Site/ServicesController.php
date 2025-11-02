<?php

namespace App\Http\Controllers\Site;

use App\Models\Occasion;
use App\Settings\SettingSingleton;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    public function index()
    {
        $services = \App\Models\Services::query()->with('trans')->active()->orderBy('sort', 'ASC')->limit(4)->get();
        $servicesInfo = \App\Settings\HomeSettingSingleton::getInstance()->getItem('services');
        return view('site.pages.services.index', compact('services', 'servicesInfo'));
    }

    public function show($slug)
    {
        if (is_numeric($slug)) {
            $service = \App\Models\Services::findOrFail($slug);
        } else {
            $service = \App\Models\Services::with('trans')->whereTranslation('slug', $slug)->first();
            if ($service == null) abort(404);
        }
        return view('site.pages.services.show', compact('service'));
    }

    public function byOccasion()
    {
        $occasions = Occasion::with('translations', 'products')->active()->orderBy('sort', 'ASC')->get();
        $settings = SettingSingleton::getInstance();
        $currentLang = app()->getLocale();
        $pageName = 'services-by-occasion';
        return view('site.services.by-occasion', compact('occasions', 'settings', 'currentLang', 'pageName'));
    }

    public function byProduct()
    {
        return view('site.services.by-product');
    }

    public function customBouquet()
    {
        return view('site.services.custom-bouquet');
    }
}
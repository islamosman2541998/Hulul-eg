<?php

namespace App\Http\Controllers\Site;

use App\Models\Partner;
use App\Models\Services;
use App\Models\HomeSettingPage;
use App\Models\ServiceCategory;
use App\Http\Controllers\Controller;

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
        })->with('transNow')->firstOrFail();

        $services = Services::where('service_category_id', $category->id)
            ->with('transNow')
            ->active()
            ->orderBy('sort', 'ASC')
            ->get();

        return view('site.pages.services.show', compact('category', 'services'));
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {

        $about = About::with('translations')->first();
        $trans = $about->translate(app()->getLocale()) ?? $about->translate(config('app.fallback_locale'));
        $coreValues = [];

        if ($trans && $trans->core_values) {
            $raw = $trans->core_values;
            $coreValues = is_array($raw) ? $raw : (json_decode($raw, true) ?? []);
        }

        // dd($about);
        return view('site.pages.about.index', compact('about', 'coreValues'));
    }
}

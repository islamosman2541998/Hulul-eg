<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('transNow')->where('status', 1)->orderBy('sort')->get();

        // the questions as the page first shows them (all categories), for the FAQPage schema
        $questions = Faq::with('translations')->active()->orderBy('sort')->get()
            ->filter(fn ($faq) => trim((string) $faq->question) !== '' && trim(strip_tags((string) $faq->answer)) !== '')
            ->values();

        return view('site.pages.faq-questions.index', compact('categories', 'questions'));
    }
}

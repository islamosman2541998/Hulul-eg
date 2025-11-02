<?php

namespace App\Http\Controllers\Site;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function index()
    {
        $categories = FaqCategory::with('transNow')->where('status', 1)->get();

        return view('site.pages.faq-questions.index', compact('categories'));
    }
}

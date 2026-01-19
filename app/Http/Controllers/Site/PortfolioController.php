<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Livewire\Site\PortfolioGallery;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        return view('site.pages.portfolio.index');
    }
}
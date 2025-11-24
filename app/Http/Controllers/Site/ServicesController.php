<?php

namespace App\Http\Controllers\Site;

use App\Models\Occasion;
use App\Settings\SettingSingleton;
use App\Http\Controllers\Controller;
use App\Models\Services;

class ServicesController extends Controller
{
 public function index()
    {
        $services = Services::with('trans')->where('status', 1)
            ->get();

        return view('site.pages.services.index', compact('services'));
    }

  
   public function show(Services $services)
    {
       
        $services->load('trans', 'images');

        return view('site.pages.services.show', compact('services'));
    }
}
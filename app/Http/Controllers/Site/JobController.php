<?php

namespace App\Http\Controllers\Site;

use App\Models\Job;
use App\Models\CareerCategory;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function index()
    {
        return view('site.pages.jobs.index');
    }
}
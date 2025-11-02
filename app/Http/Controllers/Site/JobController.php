<?php

namespace App\Http\Controllers\Site;

use App\Models\Cv;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('translations')->where('status', 1)->get();
        return view('site.pages.jobs.index', compact('jobs'));
    }

    public function show($slug)
    {
        $job = Job::with('translations')->firstOrFail();
        return view('site.pages.jobs.show', compact('job'));
    }

    public function apply(Request $request, $slug)
    {
        $job = Job::where('slug', $slug)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'cv_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $cvPath = $request->file('cv_file')->store('cvs', 'public');

        Cv::create([
            'job_id' => $job->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cv_file' => $cvPath,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'CV submitted successfully!');
    }
}
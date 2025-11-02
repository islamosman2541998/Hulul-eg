<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\JobRequest;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    // Index: list jobs
    public function index(Request $request)
{
    $query = Job::with('translations')->orderBy('created_at', 'desc');

    if ($request->filled('title')) {
        $title = trim($request->input('title'));
        $query->whereTranslation('title', 'like', "%{$title}%");
    }

    $jobs = $query->paginate(20)->appends($request->only(['title']));
    return view('admin.dashboard.jobs.index', compact('jobs'));
}

    // Show create form
    public function create()
    {
        $languages = config('translatable.locales', ['en']);
        return view('admin.dashboard.jobs.create', compact('languages'));
    }

    // Store new job
    public function store(JobRequest $request)
    {
        $data = $request->validated();

     

        Job::create($data);

  

        session()->flash('success', __('Created successfully'));
        return redirect()->route('admin.jobs.index');
    }

    // Edit form
    public function edit(Job $job)
    {
        $languages = config('translatable.locales', ['en']);
        return view('admin.dashboard.jobs.edit', compact('job', 'languages'));
    }

    // Update
    public function update(JobRequest $request, Job $job)
    {

               $data = $request->validated();

                Job::create($data);


     

     
        

        session()->flash('success', __('Updated successfully'));
        return redirect()->route('admin.jobs.index');
    }

    // Show single
    public function show(Job $job)
    {
        return view('admin.dashboard.jobs.show', compact('job'));
    }

    // Delete
    public function destroy(Job $job)
    {
        if ($job->image) {
            Storage::disk('public')->delete($job->image);
        }
        $job->delete();

        session()->flash('success', __('Deleted successfully'));
        return redirect()->route('admin.jobs.index');
    }

    // Toggle status (active / inactive)
    public function toggleStatus(Job $job)
    {
        $job->status = !$job->status;
        $job->save();
        session()->flash('success', __('Status updated'));
        return redirect()->back();
    }
    public function toggleFeature(Job $job)
    {
        $job->feature = !$job->feature;
        $job->save();
        session()->flash('success', __('Feature updated'));
        return redirect()->back();
    }
}

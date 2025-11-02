<?php

namespace App\Http\Livewire\Site;

use App\Models\Cv;
use App\Models\Job;
use Livewire\Component;
use Livewire\WithFileUploads;


class JobForm extends Component
{

    use WithFileUploads;
    public $name;
    public $email;
    public $phone;
    public $cv_file;
    public $job_slug;
    protected $rules = [
        'name'    => 'required|string|max:255',
        'email'   => 'required|email|max:255',
        'phone'   => 'nullable|string|max:50',
        'cv_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',

    ];
      public function mount($job_slug = null)
    {
        $this->job_slug = $job_slug;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
   public function submit()
    {
        $data = $this->validate();

       
        if ($this->cv_file) {
            $path = $this->cv_file->store('cvs', 'public');
            $data['cv_file'] = $path;
        }

      
        if ($this->job_slug) {
            $slug = $this->job_slug;
           $job = Job::whereHas('transNow', function($q) use ($slug) {
    $q->where('slug', $slug);
})->first();
            if (!$job) {
                $this->addError('job_slug', 'Job not found.');
                return;
            }
            $data['job_id'] = $job->id;
        } else {
           
            $this->addError('job_slug', 'Job identifier missing.');
            return;
        }

        
        Cv::create($data);

        $this->reset(['name', 'email', 'phone', 'cv_file']);
        $this->dispatchBrowserEvent('job-sent', ['message' => __('Your message has been sent successfully!')]);
    }
    public function render()
    {
        return view('livewire.site.job-form');
    }
}

<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\ServiceRequest;
use App\Models\ServiceCategory;
use Livewire\WithFileUploads;

class ServiceRequestForm extends Component
{
    use WithFileUploads;

    // Form fields
    public $name;
    public $email;
    public $phone;
    public $company;
    public $service_category_id;
    public $timeline = 'Flexible';
    public $message;
    public $attachment;

    // UI state
    public $showForm = false;

    // Validation rules
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'company' => 'nullable|string|max:255',
        'service_category_id' => 'required|exists:service_categories,id',
        'timeline' => 'nullable|string',
        'message' => 'nullable|string',
        'attachment' => 'nullable|file|max:10240', // 10MB max
    ];

    protected $messages = [
        'name.required' => 'الاسم مطلوب',
        'email.required' => 'البريد الإلكتروني مطلوب',
        'email.email' => 'البريد الإلكتروني غير صحيح',
        'service_category_id.required' => 'الخدمة مطلوبة',
        'service_category_id.exists' => 'الخدمة المحددة غير موجودة',
        'attachment.max' => 'حجم الملف يجب أن لا يتجاوز 10 ميجابايت',
    ];

    public function startRequest()
    {
        $this->showForm = true;
    }

    public function goBack()
    {
        $this->showForm = false;
        $this->reset(['name', 'email', 'phone', 'company', 'service_category_id', 'timeline', 'message', 'attachment']);
        $this->resetValidation();
    }

    public function submit()
    {
        $this->validate();

        try {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'company' => $this->company,
                'service_category_id' => $this->service_category_id,
                'timeline' => $this->timeline,
                'message' => $this->message,
            ];

            // Handle file upload
            if ($this->attachment) {
                $filename = time() . '_' . $this->attachment->getClientOriginalName();
                $this->attachment->storeAs('service_requests', $filename, 'public');
                $data['attachment'] = $filename;
            }

            ServiceRequest::create($data);

            // Reset form and show success message
            $this->reset(['name', 'email', 'phone', 'company', 'service_category_id', 'timeline', 'message', 'attachment']);
            $this->showForm = false;

            session()->flash('success', 'Your request has been submitted successfully! We will contact you within 24 hours.');

            // Dispatch browser event for additional feedback
            $this->dispatch('request-submitted');

        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred. Please try again.');
        }
    }

    public function render()
    {
        $serviceCategories = ServiceCategory::active()
            ->orderBy('sort', 'ASC')
            ->get();

        return view('livewire.site.service-request-form', [
            'serviceCategories' => $serviceCategories
        ]);
    }
}
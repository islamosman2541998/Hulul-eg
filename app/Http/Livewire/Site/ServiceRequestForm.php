<?php

namespace App\Http\Livewire\Site;

use Livewire\Component;
use App\Models\ServiceRequest;
use App\Models\ServiceCategory;
use App\Models\MeetingRequest;
use Livewire\WithFileUploads;

class ServiceRequestForm extends Component
{
    use WithFileUploads;

    public $activeForm = 'service'; // service / meeting
    // null / service / meeting

    // Service form fields
    public $name;
    public $email;
    public $phone;
    public $company;
    public $service_category_id;
    public $timeline = 'Flexible';
    public $message;
    public $attachment;

    // Meeting form fields
    public $meeting_name;
    public $meeting_email;
    public $meeting_phone;
    public $meeting_company;
    public $meeting_type = 'Online';
    public $preferred_date;
    public $preferred_time;
    public $meeting_message;

    protected function rules()
    {
        if ($this->activeForm === 'meeting') {
            return [
                'meeting_name' => 'required|string|max:255',
                'meeting_email' => 'required|email|max:255',
                'meeting_phone' => 'nullable|string|max:20',
                'meeting_company' => 'nullable|string|max:255',
                'meeting_type' => 'nullable|string|max:255',
                'preferred_date' => 'nullable|date',
                'preferred_time' => 'nullable',
                'meeting_message' => 'nullable|string',
            ];
        }

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'service_category_id' => 'required|exists:service_categories,id',
            'timeline' => 'nullable|string',
            'message' => 'nullable|string',
            'attachment' => 'nullable|file|max:10240',
        ];
    }

   protected $messages = [
    'name.required' => 'messages.name_required',
    'email.required' => 'messages.email_required',
    'email.email' => 'messages.email_invalid',
    'service_category_id.required' => 'messages.service_required',
    'service_category_id.exists' => 'messages.service_not_found',
    'attachment.max' => 'messages.attachment_max',

    'meeting_name.required' => 'messages.name_required',
    'meeting_email.required' => 'messages.email_required',
    'meeting_email.email' => 'messages.email_invalid',
];
    public function showServiceForm()
    {
        $this->activeForm = 'service';
        $this->resetValidation();
    }

    public function showMeetingForm()
    {
        $this->activeForm = 'meeting';
        $this->resetValidation();
    }

   public function goBack()
{
    $this->activeForm = 'service';

    $this->reset([
        'name',
        'email',
        'phone',
        'company',
        'service_category_id',
        'timeline',
        'message',
        'attachment',
        'meeting_name',
        'meeting_email',
        'meeting_phone',
        'meeting_company',
        'meeting_type',
        'preferred_date',
        'preferred_time',
        'meeting_message',
    ]);

    $this->timeline = 'Flexible';
    $this->meeting_type = 'Online';

    $this->resetValidation();
}

    public function submitService()
    {
        $this->activeForm = 'service';
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

            if ($this->attachment) {
                $filename = time() . '_' . $this->attachment->getClientOriginalName();
                $this->attachment->storeAs('service_requests', $filename, 'public');
                $data['attachment'] = $filename;
            }

            ServiceRequest::create($data);

            $this->goBack();

            session()->flash('success', __('messages.service_request_success'));
        } catch (\Exception $e) {
            session()->flash('error', __('messages.request_error'));
        }
    }

    public function submitMeeting()
    {
        $this->activeForm = 'meeting';
        $this->validate();

        try {
            MeetingRequest::create([
                'name' => $this->meeting_name,
                'email' => $this->meeting_email,
                'phone' => $this->meeting_phone,
                'company' => $this->meeting_company,
                'meeting_type' => $this->meeting_type,
                'preferred_date' => $this->preferred_date,
                'preferred_time' => $this->preferred_time,
                'message' => $this->meeting_message,
                'status' => 'new',
            ]);

            $this->goBack();

            session()->flash('success', __('messages.meeting_request_success'));
        } catch (\Exception $e) {
            session()->flash('error', __('messages.request_error'));
        }
    }

    public function render()
    {
        $serviceCategories = ServiceCategory::active()
            ->orderBy('sort', 'ASC')
            ->get();

        return view('livewire.site.service-request-form', [
            'serviceCategories' => $serviceCategories,
        ]);
    }
}
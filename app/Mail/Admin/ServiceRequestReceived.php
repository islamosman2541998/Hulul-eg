<?php

namespace App\Mail\Admin;

use App\Models\ServiceRequest;

class ServiceRequestReceived extends AdminSubmissionMail
{
    public function __construct(public ServiceRequest $serviceRequest)
    {
    }

    protected function type(): string
    {
        return 'service_request';
    }

    protected function accent(): string
    {
        return '#00a3c7';
    }

    protected function details(): array
    {
        $request = $this->serviceRequest;

        return [
            ['label' => __('emails.fields.name'), 'value' => $request->name],
            ['label' => __('emails.fields.email'), 'value' => $request->email, 'href' => 'mailto:' . $request->email],
            ['label' => __('emails.fields.phone'), 'value' => $request->phone, 'href' => 'tel:' . preg_replace('/[^\d+]/', '', (string) $request->phone)],
            ['label' => __('emails.fields.company'), 'value' => $request->company],
            ['label' => __('emails.fields.service'), 'value' => $request->service_category?->title],
            ['label' => __('emails.fields.timeline'), 'value' => $this->optionLabel($request->timeline, [
                'Flexible' => 'messages.flexible',
                'ASAP' => 'messages.asap',
                '2–4 weeks' => 'messages.two_four_weeks',
                '1–3 months' => 'messages.one_three_months',
            ])],
        ];
    }

    protected function messageText(): ?string
    {
        return $this->serviceRequest->message;
    }

    protected function attachmentPath(): ?string
    {
        return $this->serviceRequest->attachment ? 'service_requests/' . $this->serviceRequest->attachment : null;
    }

    protected function senderName(): string
    {
        return (string) $this->serviceRequest->name;
    }

    protected function senderEmail(): ?string
    {
        return $this->serviceRequest->email;
    }

    protected function dashboardRoute(): string
    {
        return 'admin.service_request.index';
    }

    protected function submittedAt(): ?\DateTimeInterface
    {
        return $this->serviceRequest->created_at;
    }
}

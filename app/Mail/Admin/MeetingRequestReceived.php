<?php

namespace App\Mail\Admin;

use App\Models\MeetingRequest;
use Carbon\Carbon;

class MeetingRequestReceived extends AdminSubmissionMail
{
    public function __construct(public MeetingRequest $meetingRequest)
    {
    }

    protected function type(): string
    {
        return 'meeting_request';
    }

    protected function accent(): string
    {
        return '#6c5ce7';
    }

    protected function details(): array
    {
        $meeting = $this->meetingRequest;
        $locale = app()->getLocale();

        return [
            ['label' => __('emails.fields.name'), 'value' => $meeting->name],
            ['label' => __('emails.fields.email'), 'value' => $meeting->email, 'href' => 'mailto:' . $meeting->email],
            ['label' => __('emails.fields.phone'), 'value' => $meeting->phone, 'href' => 'tel:' . preg_replace('/[^\d+]/', '', (string) $meeting->phone)],
            ['label' => __('emails.fields.company'), 'value' => $meeting->company],
            ['label' => __('emails.fields.meeting_type'), 'value' => $this->optionLabel($meeting->meeting_type, [
                'Online' => 'messages.online',
                'Phone call' => 'messages.phone_call',
                'Office meeting' => 'messages.office_meeting',
            ])],
            ['label' => __('emails.fields.preferred_date'), 'value' => $meeting->preferred_date
                ? Carbon::parse($meeting->preferred_date)->locale($locale)->translatedFormat('l j F Y')
                : null],
            ['label' => __('emails.fields.preferred_time'), 'value' => $meeting->preferred_time
                ? Carbon::parse($meeting->preferred_time)->locale($locale)->translatedFormat('g:i A')
                : null],
        ];
    }

    protected function messageText(): ?string
    {
        return $this->meetingRequest->message;
    }

    protected function senderName(): string
    {
        return (string) $this->meetingRequest->name;
    }

    protected function senderEmail(): ?string
    {
        return $this->meetingRequest->email;
    }

    protected function dashboardRoute(): string
    {
        return 'admin.meeting_request.index';
    }

    protected function submittedAt(): ?\DateTimeInterface
    {
        return $this->meetingRequest->created_at;
    }
}

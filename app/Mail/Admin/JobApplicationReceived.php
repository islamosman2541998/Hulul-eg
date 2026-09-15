<?php

namespace App\Mail\Admin;

use App\Models\Cv;

class JobApplicationReceived extends AdminSubmissionMail
{
    /**
     * @param string|null $coverMessage the applicant's note; the cvs table has no column for it,
     *                                  so the email is the only place it is kept
     */
    public function __construct(public Cv $cv, public ?string $coverMessage = null)
    {
    }

    protected function type(): string
    {
        return 'job_application';
    }

    protected function accent(): string
    {
        return '#16a34a';
    }

    protected function details(): array
    {
        $cv = $this->cv;

        return [
            ['label' => __('emails.fields.job'), 'value' => $this->jobTitle()],
            ['label' => __('emails.fields.name'), 'value' => $cv->name],
            ['label' => __('emails.fields.email'), 'value' => $cv->email, 'href' => 'mailto:' . $cv->email],
            ['label' => __('emails.fields.phone'), 'value' => $cv->phone, 'href' => 'tel:' . preg_replace('/[^\d+]/', '', (string) $cv->phone)],
        ];
    }

    protected function subjectParameters(): array
    {
        return ['name' => $this->senderName(), 'job' => $this->jobTitle() ?: '—'];
    }

    protected function messageText(): ?string
    {
        return $this->coverMessage;
    }

    protected function attachmentPath(): ?string
    {
        return $this->cv->cv_file;
    }

    protected function senderName(): string
    {
        return (string) $this->cv->name;
    }

    protected function senderEmail(): ?string
    {
        return $this->cv->email;
    }

    protected function dashboardRoute(): string
    {
        return 'admin.cvs.index';
    }

    protected function submittedAt(): ?\DateTimeInterface
    {
        return $this->cv->created_at;
    }

    private function jobTitle(): ?string
    {
        $job = $this->cv->job;

        return $job ? ($job->translate(app()->getLocale())?->title ?? $job->title) : null;
    }
}

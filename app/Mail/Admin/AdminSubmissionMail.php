<?php

namespace App\Mail\Admin;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/**
 * Email sent to the site's booking address when a visitor submits a service request,
 * a meeting request or a job application. It is written in the language the visitor
 * used on the site (see App\Support\AdminNotifier), and Reply-To is the visitor.
 */
abstract class AdminSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    /** The app stores times in UTC; the email shows the submission time in the company's local time. */
    protected const DISPLAY_TIMEZONE = 'Africa/Cairo';

    /** Translation group under emails.*: service_request, meeting_request or job_application. */
    abstract protected function type(): string;

    /** Badge / button colour. */
    abstract protected function accent(): string;

    /**
     * Rows shown in the email, in order. Each row: ['label' => ..., 'value' => ..., 'href' => optional].
     * Rows with an empty value are left out.
     */
    abstract protected function details(): array;

    abstract protected function senderName(): string;

    abstract protected function senderEmail(): ?string;

    /** Dashboard page listing this kind of submission. */
    abstract protected function dashboardRoute(): string;

    abstract protected function submittedAt(): ?\DateTimeInterface;

    /** Free text the visitor wrote, shown in its own box. */
    protected function messageText(): ?string
    {
        return null;
    }

    /** File on the public disk to attach (CV, service attachment). */
    protected function attachmentPath(): ?string
    {
        return null;
    }

    protected function subjectParameters(): array
    {
        return ['name' => $this->senderName()];
    }

    public function envelope(): Envelope
    {
        $email = $this->senderEmail();

        return new Envelope(
            subject: __('emails.' . $this->type() . '.subject', $this->subjectParameters()),
            replyTo: filter_var($email, FILTER_VALIDATE_EMAIL) ? [new Address($email, $this->senderName())] : [],
        );
    }

    public function content(): Content
    {
        $locale = app()->getLocale();
        $submittedAt = Carbon::instance($this->submittedAt() ?? now())
            ->timezone(static::DISPLAY_TIMEZONE)
            ->locale($locale);

        return new Content(
            view: 'emails.admin-submission',
            with: [
                'type' => $this->type(),
                'accent' => $this->accent(),
                'details' => array_values(array_filter($this->details(), fn ($row) => filled($row['value'] ?? null))),
                'messageText' => $this->messageText(),
                'hasAttachment' => $this->attachmentExists(),
                'senderName' => $this->senderName(),
                'canReply' => (bool) filter_var($this->senderEmail(), FILTER_VALIDATE_EMAIL),
                'dashboardUrl' => LaravelLocalization::getLocalizedURL($locale, route($this->dashboardRoute())),
                'submittedAt' => $submittedAt->translatedFormat('j F Y - g:i A'),
            ],
        );
    }

    public function attachments(): array
    {
        return $this->attachmentExists()
            ? [Attachment::fromStorageDisk('public', $this->attachmentPath())]
            : [];
    }

    protected function attachmentExists(): bool
    {
        $path = $this->attachmentPath();

        return $path && Storage::disk('public')->exists($path);
    }

    /** Translated label for a stored option value, e.g. "Online" → "أونلاين". */
    protected function optionLabel(?string $value, array $map): ?string
    {
        return isset($map[$value]) ? __($map[$value]) : $value;
    }
}

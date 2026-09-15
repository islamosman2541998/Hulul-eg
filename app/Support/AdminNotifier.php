<?php

namespace App\Support;

use App\Settings\SettingSingleton;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class AdminNotifier
{
    /**
     * Emails the booking address from the site settings ("البريد الإلكتروني للحجز").
     *
     * The mail goes out after the response has been sent: the visitor never waits for the
     * mail server, and a mail failure is only logged, it never breaks their submission.
     * If no valid booking address is set, nothing is sent.
     */
    public static function send(Mailable $mail): void
    {
        $to = trim((string) SettingSingleton::getInstance()->getItem('mail_booking'));

        if (! filter_var($to, FILTER_VALIDATE_EMAIL)) {
            return;
        }

        // written in the language the visitor was using
        $mail->locale(app()->getLocale());

        app()->terminating(function () use ($to, $mail) {
            try {
                Mail::to($to)->send($mail);
            } catch (\Throwable $e) {
                report($e);
            }
        });
    }
}

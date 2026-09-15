<?php

// Emails sent to the booking address when a visitor submits something on the website.
return [
    'service_request' => [
        'subject' => 'New service request from :name',
        'badge' => 'Service request',
        'title' => 'New service request',
        'intro' => 'A new service request was just submitted on the website. Here are the details:',
    ],

    'meeting_request' => [
        'subject' => 'New meeting request from :name',
        'badge' => 'Meeting request',
        'title' => 'New meeting request',
        'intro' => 'Someone asked to book a meeting through the website. Here are the details:',
    ],

    'job_application' => [
        'subject' => 'New application for ":job" from :name',
        'badge' => 'Job application',
        'title' => 'New job application',
        'intro' => 'A new candidate applied through the careers page. Here are the details:',
    ],

    'fields' => [
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'company' => 'Company',
        'service' => 'Service',
        'timeline' => 'Timeline',
        'meeting_type' => 'Meeting type',
        'preferred_date' => 'Preferred date',
        'preferred_time' => 'Preferred time',
        'job' => 'Position',
        'message' => 'Message',
    ],

    'attachment_service_request' => 'The file the client uploaded is attached to this email.',
    'attachment_job_application' => 'The candidate\'s CV is attached to this email.',
    'view_in_dashboard' => 'View in dashboard',
    'reply_hint' => 'Reply to this email to contact :name directly.',
    'submitted_at' => 'Submitted on :date',
    'footer' => 'Automatic notification from the :site website.',
];

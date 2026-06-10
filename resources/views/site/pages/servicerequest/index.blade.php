<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request</title>

    <link rel="stylesheet" href="{{ asset('site/css/custom.css') }}">
    @livewireStyles
</head>

<body>
    <div class="section-service">
        @livewire('site.service-request-form')
    </div>

    @include('site.layouts.script')
    @livewireScripts
</body>
</html>
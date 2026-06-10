<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Request</title>
    <link rel="stylesheet" href="{{asset('site/css/custom.css') }}">
</head>
<x-site.layouts.head />

<body>
    <div class="section-service">
    @livewire('site.service-request-form')

</div>

    @include('site.layouts.script')
    @livewireScripts
</body>
</html>




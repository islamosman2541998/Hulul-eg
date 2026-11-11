<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

{{-- read by the head component below: one <title>, a description of this page, canonical and hreflang --}}
@section('title', __('services.service_request_title'))
@section('meta_description', __('services.service_request_description'))
@section('uses_livewire', '1')
@section('style')
    <style>
        [wire\:cloak] {
            display: none !important;
        }
    </style>
@endsection

<x-site.layouts.head />

<body>

    <div class="section-service">
        @livewire('site.service-request-form')
    </div>

    @include('site.layouts.script')
    @livewireScripts

</body>
</html>

@extends('site.app')

@section('content')
    <section class="job-section hero py-5" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container">
            <h2 class="section-title">{{ optional($job->translate(app()->getLocale()))->title ?? '—' }}</h2>
            {{-- <p>{{ optional($job->translate(app()->getLocale()))->short_description ?? '—' }}</p> --}}
            <p>{!! optional($job->translate(app()->getLocale()))->description ?? '—' !!}</p>
            <h3>@lang('job.requirements')</h3>
            <p>{!!  optional($job->translate(app()->getLocale()))->requirements ?? '—' !!}</p>
            <h4>@lang('job.apply')</h4>
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @livewire('site.job-form', ['job_slug' => $job->slug])

        </div>
    </section>
@endsection
<style>
    .hero {
        margin-top: 70px !important;
    }
</style>

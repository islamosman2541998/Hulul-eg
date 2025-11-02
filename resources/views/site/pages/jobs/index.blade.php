@extends('site.app')

@section('title', 'Careers')

@section('content')

<section id="careers" class="careersection hero"  dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
  <img src="images/leaf-bg.svg" alt="" class="careerImg1">
  <img src="images/leaf-bg.svg" alt="" class="careerImg2">

  <div class="careerdiv">
    <!-- Title -->
    <div class="careertitle">
      <div class="careerh1">@lang('job.careers')</div>
      <h2 class="careerh2">@lang('job.we_are_hiring')</h2>
      <p class="careerp">
        @lang('job.career_p')
      </p>
    </div>
    <!-- Job Openings -->
  <div id="openings" class="jobopening">
    @forelse ($jobs as $job)
        <article class="jobcard">
            <div class="jobdesc">{{ $job->employment_type }} • {{ $job->location }}</div>
            <h3 class="job_h3"> {{ optional($job->translate(app()->getLocale()))->title ?? '—' }}</h3>
            <p class="job_P">{!!  optional($job->translate(app()->getLocale()))->short_description ?? '—' !!}</p>
            {{-- <div class="field_title">
                @foreach (explode(',',optional($job->translate(app()->getLocale()))->description ) as $requirement)
                    <span class="fieldspan">{!!   trim($requirement) !!}</span>
                @endforeach
            </div> --}}
            <a class="Cv_btn" href="{{ route('site.jobs.show', $job->slug) }}">@lang('job.apply')</a>
        </article>
    @empty
        <p>No job openings available.</p>
    @endforelse
</div>


   
  </div>
 
</section>

@endsection

<style>
  .hero{
      margin-top: 70px !important;
  }
</style>
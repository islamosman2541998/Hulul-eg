	<!--CAREER INTRO SECTION -->

	@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_career    = (int) $settings->getHome('show_career');
@endphp
@if ($show_career)
		<section class="career-intro wow fadeInDown">

		<div class="career-content">
			<h2>@lang('job.build_career')</h2>
			<p>
				@lang('job.career_p')
			</p>
			<a href="{{ route('site.jobs.index') }}"  class="btn-career">@lang('job.apply')</a>
		</div>
	</section>
@endif

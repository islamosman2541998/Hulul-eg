	<!-- FAQ Section--------------------------------- -->
		@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_faq    = (int) $settings->getHome('show_faq');
@endphp
@if ($show_faq)
	<section id="tetra-faq" class="faqsec" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
	    <div class="faqdiv wow fadeInUp">
	        <div class="faq1">
	            <div class="faqtitle">@lang('home.faq')</div>
	            <h2 class="faq2">@lang('home.faq_title')</h2>
	            {{-- <p faqP>@lang('home.faq_p')</p> --}}
	        </div>
	        @forelse ( $faq_questions as $key => $question )
	        <div class="tf-item faqitem wow bounceInLeft" style="animation-delay: 0.{{ ($key + 1) }}s;">
	            <button class="tf-q faqbtn" type="button" aria-expanded="false" aria-controls="tf-a-1" id="tf-q-1">
	                <span>{{ $question->question }}</span>
	                <span class="tf-ic faqspan" aria-hidden="true">▾</span>
	            </button>
	            <div class="tf-a faqanswer" id="tf-a-1" role="region" aria-labelledby="tf-q-1">
	                <p class="faq_P">
	                    {{ $question->answer }}
	                </p>
	            </div>
	        </div>
	        @empty
	        <p>@lang('home.no_faq')</p>
	        @endforelse
	    </div>
	    <div class="viewall" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'ltr' }}">
	        <a class="viewnews" href="{{ route('site.faq-questions') }}">
	            <span class="viewnewstext">@lang('site.view_all_faq_questions')</span>
	            <span class="viewnewsspan">→</span>
	        </a>
	    </div>
	</section>


@endif
	

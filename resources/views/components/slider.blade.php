@php
    $settings = \App\Settings\SettingSingleton::getInstance();
    $show_slider = (int) $settings->getHome('show_slider');

@endphp

<!-- Hero Section Begin -->
<section class="hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="hero__slider owl-carousel">

       @forelse ($slides as $index => $slide)
    <div class="hero__item set-bg bgImg"
         @if($index === 0) style="background-image: url('{{ webp_asset($slide->pathInView()) }}');" @endif
         data-setbg="{{ webp_asset($slide->pathInView()) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <span class="slider-desc">{!! $slide->description !!} </span>
                                {{-- the first slide's title is the home page's only H1 --}}
                                @if ($index === 0)
                                    <h1>{{ $slide->title }}</h1>
                                @else
                                    <h2>{{ $slide->title }}</h2>
                                @endif
                                <a href="{{ route('site.about-us') }}" class="primary-btn">@lang('home.see_more')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
        @endforelse


    </div>
</section>
<!-- Hero Section End -->
{{-- Owl's loop copies the first slide (with its h1) at both ends; search engines render the page
     and would count three h1s. The copies get an h2: same styles, one h1 left. --}}
<script>
    (function () {
        function demoteClonedTitles() {
            document.querySelectorAll('.hero__slider .owl-item.cloned h1').forEach(function (h1) {
                var h2 = document.createElement('h2');
                h2.className = h1.className;
                h2.innerHTML = h1.innerHTML;
                h1.replaceWith(h2);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            var slider = document.querySelector('.hero__slider');
            if (!slider) return;
            // clones appear when Owl starts and again on every refresh (resize)
            new MutationObserver(demoteClonedTitles).observe(slider, { childList: true, subtree: true });
            demoteClonedTitles();
        });
    })();
</script>
@if(isset($slides[0]))
    @push('preload')
        <link rel="preload" as="image" href="{{ webp_asset($slides[0]->pathInView()) }}" fetchpriority="high">
    @endpush
@endif
<style>
    .slider-desc p {
        color: #fff !important;
    }
</style>

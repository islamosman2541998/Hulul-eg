@extends('site.app')

@section('title', @$metaSetting->where('key', 'about_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'about_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'about_meta_description_' . $current_lang)->first()->value)

@section('content')
<!-- HERO -->
<section class="hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container hero-grid">
        <div class="hero-copy wow bounceInRight">
            <span class="eyebrow color_red">{{ $about->subtitle }}</span>
            <h1 class="color_blue">{{ $about->title }}</h1>
            <p class="lead">
                {{ $about->description }}
            </p>
        </div>

        <div class="hero-card wow bounceInLeft">
            <img class="hero-cardImg" src="{{ asset('storage/' . $about->image_background) }}" alt="logo watermark" />

            <div class="quote">

                {{ $about->sub_description }}
            </div>
            <div class="logo-line">
                <span class="dot"></span>
                <span class="rule"></span>
                <span class="dot"></span>
            </div>
        </div>
    </div>
</section>

<!-- STORY + CEO -->
<section class="section about-cards wow fadeInDown" id="story" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <!-- Card 1: Our Story -->
        <article class="ac-card d-flex">
            <div>
                <div class="ac-head">
                    <span class="ac-badge">@lang('about.ceo_message')</span>
                    <h3 class="ac-title">{{ $about->ceo_title }}</h3>
                </div>

                <div class="ac-body">
                    <p>
                        {{ $about->ceo_description }}
                    </p>
                </div>
                <button class="ac-toggle" aria-expanded="false" type="button">@lang('about.see_more')</button>

            </div>

            <div class="ac-image card-img ">
                <img class="rounded-5 ceo-image " src="{{ asset('storage/' . $about->ceo_image) }}" alt="ceo_image">
            </div>
        </article>
        <!-- Card 2: CEO Message -->


    </div>
</section>

<!-- VISION / MISSION / SNAPSHOT -->
<section class="section muted" id="vision" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container grid-3">
        <div class="card wow bounceInUp" style="animation-delay: 0.1s;">
            <span class="badge color_blue">@lang('about.vision')</span>
            <p class="color_black pt-2">
                {{ $about->vision }}
            </p>
        </div>
        <div class="card wow bounceInUp" style="animation-delay: 0.2s;">
            <span class="badge color_blue">@lang('about.mission')</span>
            <p class="color_black pt-2">
                {{ $about->mission }}
            </p>
        </div>
        <div class="card mini-list wow bounceInUp" style="animation-delay: 0.3s;">
            <span class="badge color_blue">@lang('about.at_a_glance')</span>
            <ul>
                <p class="color_black pt-2">
                    {{ $about->at_a_glance }}
                </p>
            </ul>
        </div>
    </div>
</section>

<!-- VALUES -->

<!-- Core Values Section -->
<section class="cv-section" id="core-values" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="cv-container">

        <div class="cv-head">
            <span class="cv-badge color_blue">@lang('about.core_values')</span>
            <h2 class="cv-title color_blue">@lang('about.core_values_title')</h2>
        </div>

        <div class="cv-grid">
            <!-- 1 -->
            @forelse ($coreValues as $key => $item)
            <article class="cv-item wow fadeInRight" style="animation-delay: 0.{{ $key }}s;">
                <div class="cv-icon" aria-hidden="true">
                    <!-- Star -->
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 3l2.7 5.5 6.1.9-4.4 4.3 1 6.1L12 17l-5.4 2.8 1-6.1-4.4-4.3 6.1-.9L12 3z" />
                    </svg>
                </div>
                <div class="cv-text">
                    <h3>{{ $item['title'] }}</h3>
                    <p>{{ $item['description'] }}</p>
                </div>
            </article>
            @empty
            <p> @lang('No products available') </p>
            @endforelse
        </div>

        <div class="cv-actions">
            <a class="cv-btn primary blue_btn" href="{{ route('site.products.index') }}">@lang('about.our_products')</a>
            <a class="cv-btn light color_blue" href="{{ route('site.site.blogs.index') }}">@lang('about.our_blog')</a>
        </div>
    </div>
</section>
@endsection

<style>
    .hero {
        margin-top: 70px !important;
    }
    .ceo-image{
        border-radius: 10px !important;
    }

    @media (max-width: 768px) {
        .ac-card{
            display: flex !important;
            flex-direction: column !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 20px !important;
        }
    }   

</style>

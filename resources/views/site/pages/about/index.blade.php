@extends('site.app')

@section('title', @$metaSetting->where('key', 'about_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'about_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'about_meta_description_' . $current_lang)->first()->value)

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad w-100 h-50 set-bg" data-setbg="{{ asset('site/img/111.jpeg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>@lang('about.about_us')</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('site.home') }}">@lang('site.home') /</a>
                            <span>@lang('about.about_us')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- About Section Begin -->
    <section class="about spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about__pic about-images-grid">
                        <div class="about-big-image">
                            <img src="{{ asset('storage/' . $about->ceo_image) }}" alt="{{ $about->title }}">
                        </div>

                        <div class="about-small-images">
                            <div class="about-small-image">
                                <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}">
                            </div>

                            <div class="about-small-image">
                                <img src="{{ asset('storage/' . $about->image_background) }}" alt="{{ $about->title }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__text">
                        <div class="section-title">
                            <span>{{ $about->title }}</span>
                            <h2>{{ $about->subtitle }}</h2>
                        </div>

                        <div class="about__text__desc">
                            <p>{!! $about->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End -->

    <!-- Vision & Mission Section -->
    <section class="vision-mission spad">
        <div class="container">
            <div class="section-title section-title1 text-center">
                <h2>@lang('about.Vision_Mission')</h2>
                <p>@lang('about.at_hulul')</p>
            </div>

            <div class="row">
                <!-- Vision -->
                <div class="col-lg-6 col-md-6">
                    <div class="vm-box">
                        <h3>@lang('about.vision')</h3>
                        <p>{!! $about->transNow->vision ?? 'No description available' !!}</p>
                    </div>
                </div>

                <!-- Mission -->
                <div class="col-lg-6 col-md-6">
                    <div class="vm-box">
                        <h3>@lang('about.mission')</h3>
                        <p>{!! $about->transNow->mission ?? 'No description available' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Testimonial Section Begin -->



    <!-- Testimonial Section End -->

@endsection
<style>
    .about-images-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    height: 520px;
}

.about-big-image,
.about-small-image {
    width: 100%;
    overflow: hidden;
    border-radius: 14px;
}

.about-big-image {
    height: 70%;
}

.about-small-images {
    display: grid;
    grid-template-rows: 1fr 1fr;
    gap: 16px;
    height: 70%;
}

.about-big-image img,
.about-small-image img {
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Responsive */
@media (max-width: 767px) {
    .about-images-grid {
        grid-template-columns: 1fr;
        height: auto;
    }

    .about-big-image {
        height: 360px;
    }

    .about-small-images {
        grid-template-rows: none;
        grid-template-columns: 1fr 1fr;
        height: 180px;
    }
}

@media (max-width: 480px) {
    .about-small-images {
        grid-template-columns: 1fr;
        height: auto;
    }

    .about-small-image {
        height: 220px;
    }
}
</style>
@extends('site.app')

@section('title', @$metaSetting->where('key', 'about_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'about_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'about_meta_description_' . $current_lang)->first()->value)

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ asset('site/img/breadcrumb-bg.jpg') }}">
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
                    <div class="about__pic">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="about__pic__item about__pic__item--large set-bg about3"
                                    data-setbg="{{ asset('storage/' . $about->ceo_image) }}">
                                    <img src="{{ asset('storage/' . $about->ceo_image) }}" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="row">
                                    <div class="col-lg-12 mb-5">
                                        <div class="about__pic__item set-bg about1"
                                            data-setbg="{{ asset('storage/' . $about->image) }}">
                                            <img src="{{ asset('storage/' . $about->image) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 p-2">
                                        <div class="about__pic__item set-bg about2"
                                            data-setbg="{{ asset('storage/' . $about->image_background) }}">
                                            <img src="{{ asset('storage/' . $about->image_background) }}" alt="">
                                        </div>
                                    </div>
                                </div>
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


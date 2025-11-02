@extends('site.app')
@section('title','Dalia El Haggar' . ' | ' .  'Events')
@section('title', $settings->getMeta('events_meta_title_' . $current_lang) ?? 'Default Title')
@section('meta_key', $settings->getMeta('events_meta_key_' . $current_lang) ?? 'Default Keywords')
@section('meta_description', $settings->getMeta('events_meta_description_' . $current_lang) ?? 'Default Description')
@section('content')


    <!-- section 1 -->
    <section class="hero">
        <div class="container hero-content text-center text-lg-start">
            <div class="row">
                <div class="col-lg-8">
                    <h1>
                        <span class=""> {{ $eventCategory->transNow->title }}
                        </span>
                    </h1>
                    <p>
                        {!! $eventCategory->transNow->description !!}

                    </p>
                    <a href="https://wa.me/201111779544" target="_blank" class="btn btn-cta text-white fw-bold fs-4">
                        {{ __('messages.Book_by_Whatsapp') }}
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- end section 1 -->

    <!-- Section 2 -->
    <section class="section-two py-5">
        <div class="container">
            <div class="row align-items-center  gx-md-5">
                @if (!empty($galleryImages[0]))
                    <div class="col-12 col-md-6 mb-4 mb-md-0">
                        <img src="{{ $galleryImages[0] }}" alt="Event Image" class="img-fluid rounded-custom w-100">
                    </div>
                @endif
                <div class="col-12 col-md-6 order-2 order-md-2">
                    <h2 class="section-title">
                        {{ $occasion->transNow->title ?? '' }}
                    </h2>
                    <ul class="section-list list-unstyled mt-3">
                        {!! $occasion->transNow->description ?? '' !!}

                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- End Section 2 -->

    <!-- Section 3 -->

    <section class="section-four py-5">
        <div class="container text-center">
            <h4 class="mb-5 section-four-title">
                {{ __('messages.Your_event') }}

            </h4>

            <div class="row gx- gy-4 mb-4 align-items-stretch" dir="ltr">
                <div class="col-12 col-lg-6">
                    <div class="img-card img-card-left">
                        @if (!empty($galleryImages[0]))
                            <img src="{{ $galleryImages[1] }}" alt="Image 1" class="img-fluid object-fit-cover">
                        @endif
                    </div>
                </div>

                <div class="col-12 col-lg-6 d-flex flex-column justify-content-between">
                    <div class="img-card img-card-top">
                        @if (!empty($galleryImages[0]))
                            <img src="{{ $galleryImages[2] }}" alt="Image 2" class="img-fluid object-fit-cover">
                        @endif
                    </div>
                    <div class="img-card img-card-bottom mt-4 mt-lg-0">
                        @if (!empty($galleryImages[0]))
                            <img src="{{ $galleryImages[3] }}" alt="Image 3" class="img-fluid object-fit-cover">
                        @endif
                    </div>
                </div>
            </div>

            <a href="https://wa.me/201111779544" target="_blank" class="btn btn-cta text-white fw-bold fs-4">
                {{ __('messages.Book_by_Whatsapp') }}
            </a>
        </div>
    </section>
    <!-- End Section 3 -->

    <!-- Section 5 -->

    <section class="packages-section py-5">
        <div class="container text-center">
            <h2 class="packages-title mb-4">{{ __('messages.Design & Care Packages') }}</h2>
            <div class="row g-4 mb-4">
                @forelse($event_followings as $f)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="package-card p-4">
                            <div class="package-img mb-3">
                                <img src="{{ asset($f->pathInView()) }}" alt="Landscape Designs">
                            </div>
                            <h3 class="package-card-title">{{ $f->translate($current_lang)->title }}</h3>
                            <p class="package-card-desc">
                                {{ $f->translate($current_lang)->description }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">{{ __('No followings available.') }}</p>
                @endforelse

            </div>
            <a href="https://wa.me/201111779544" target="_blank" class="btn btn-cta text-white fw-bold fs-4">
                {{ __('messages.Book_by_Whatsapp') }}
            </a>
        </div>
    </section>
    <!-- Section 5 -->

@endsection

<style>
    .hero {

        position: relative !important;

        background: url('{{ $eventCategory->pathInView() }}') center/cover no-repeat !important;

        height: 100vh !important;

        min-height: 400px !important;

        display: flex !important;

        align-items: center !important;

        color: #fff !important;

    }

    .hero::before {

        content: '' !important;

        position: absolute !important;

        inset: 0 !important;

        background: rgba(0, 0, 0, 0.4) !important;

    }

    .hero-content {

        position: relative !important;

        z-index: 1 !important;

    }

    .hero-content h1 {

        font-size: 2.5rem !important;

        font-weight: 700 !important;

        line-height: 1.2 !important;

    }

    .hero-content h1 .underline {

        display: inline-block !important;

        position: relative !important;

    }

    .hero-content h1 .underline::after {

        content: '' !important;

        position: absolute !important;

        left: 0 !important;

        bottom: -0.2rem !important;

        width: 100% !important;

        height: 0.3rem !important;

        background-color: #28a745 !important;

        border-radius: 2px !important;

    }

    .hero-content p {

        max-width: 600px !important;

        font-size: 1rem !important;

        margin-top: 1rem !important;

    }

    .btn-cta {

        margin-top: 1.5rem !important;

        padding: 1.1rem 2.5rem !important;

        font-size: 1rem !important;

    }

    @media (min-width: 992px) {

        .hero-content h1 {

            font-size: 3.5rem !important;

        }

        .hero-content p {

            font-size: 1.125rem !important;

        }

    }

    .btn {

        padding: 20px 30px !important;

        background-color: #677162a1 !important;

        border: none !important;

        border-radius: 10px 0px 20px 0px !important;

    }

    /* //////////////////////////////////////// */

    .section-two {

        background-color: #f0f7f5 !important;

    }

    .section-two .rounded-custom {

        border-top-left-radius: 12rem !important;

        border-bottom-left-radius: 0 !important;

        border-top-right-radius: 0 !important;

        border-bottom-right-radius: 12rem !important;

    }

    .section-two .section-title {

        font-size: 1.75rem !important;

        font-weight: 600 !important;

        line-height: 1.3 !important;

        color: #1f3d3a !important;

    }

    .section-two .underline {

        position: relative !important;

        display: inline-block !important;

    }

    .section-two .underline::after {

        content: '' !important;

        position: absolute !important;

        left: 0 !important;

        bottom: -0.25rem !important;

        width: 100% !important;

        height: 0.3rem !important;

        background-color: #28a745 !important;

        border-radius: 2px !important;

    }

    .section-two .section-list li {

        font-size: 1rem !important;

        margin-bottom: 0.5rem !important;

        color: #334f4a !important;

    }

    @media (min-width: 992px) {

        .section-two .section-title {

            font-size: 2.5rem !important;

        }

    }

    /* ====== Section Four ====== */

    .section-four {
        background-color: #fff;

    }

    .section-four .container {
        max-width: 900px;

    }

    .section-four-title {
        font-size: 2rem;
        font-weight: 600;
        color: #1f3d3a;
    }

    .img-card {
        position: relative;
        overflow: hidden;
        width: 100%;
        height: 100%;
    }

    .object-fit-cover {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .img-card-left img {
        border-start-start-radius: 12rem;
        border-start-end-radius: 0;
        border-end-start-radius: 0;
        border-end-end-radius: 0;
    }

    .img-card-top img {
        border-radius: 0;
    }

    .img-card-bottom img {
        border-start-start-radius: 0;
        border-start-end-radius: 0;
        border-end-start-radius: 0;
        border-end-end-radius: 12rem;
    }

    @media (max-width: 767.98px) {

        .img-card-left,
        .img-card-top,
        .img-card-bottom {
            height: 250px;
        }
    }


    /* /////////////////////// */

    /* Section 5: Packages */

    .packages-section {}

    .packages-title {

        font-size: 1.5rem !important;

        font-weight: 600 !important;

        color: #1f3d3a !important;

    }

    @media (min-width: 992px) {

        .packages-title {

            font-size: 2rem !important;

        }

    }

    .package-card {

        background-color: #80808017 !important;

        border-radius: 0.5rem !important;

        transition: transform .3s !important;

    }

    .package-card:hover {

        transform: translateY(-5px) !important;

    }

    .package-img {

        width: 160px !important;

        height: 160px !important;

        margin: 0 auto !important;

        overflow: hidden !important;

        border-radius: 50% !important;

        background-color: #fff !important;

    }

    .package-img img {

        width: 100% !important;

        height: 100% !important;

        object-fit: cover !important;

    }

    .package-card-title {

        font-size: 1.5rem !important;

        font-weight: 600 !important;

        color: #1f3d3a !important;

        margin-top: 1rem !important;

    }

    .package-card-desc {

        font-size: 1.0rem !important;

        color: #334f4a !important;

        margin-top: 0.5rem !important;

    }

    .btn-custom {

        display: inline-block !important;

        padding: 0.9rem 2rem !important;

        font-size: 1rem !important;

        background-color: #ec781f !important;

        color: #fff !important;

        border: none !important;

        border-radius: 10px 0 20px 0 !important;

        transition: background-color .3s !important;

        text-decoration: none !important;

    }

    .btn-custom:hover {

        background-color: #d96e1b !important;

    }

    @media (max-width: 767.98px) {
        .hero-content h1 {
            font-size: 2rem !important;
            line-height: 1.1 !important;
        }

        .hero-content p {
            font-size: 0.9rem !important;
        }

        .btn-cta {
            padding: 0.8rem 1.8rem !important;
            font-size: 0.9rem !important;
        }

        /* Section Two */
        .section-two .section-title {
            font-size: 1.5rem !important;
        }

        /* Section Four */
        .section-four-title {
            font-size: 1.5rem !important;
        }

        /* Packages */
        .packages-title {
            font-size: 1.5rem !important;
        }

        .package-card-title {
            font-size: 1.5rem !important;
        }

        .package-card-desc {
            font-size: 0.7rem !important;
        }

        .btn,
        .btn-custom {
            padding: 0.7rem 1.5rem !important;
            font-size: 0.9rem !important;
        }

        .img-card-left,
        .img-card-top,
        .img-card-bottom {
            height: 180px;
        }
    }
</style>

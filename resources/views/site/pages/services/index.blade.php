@extends('site.app')

@section('title', @$metaSetting->where('key', 'services_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'services_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'services_meta_description_' . $current_lang)->first()->value)

@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad w-100 h-50 set-bg" data-setbg="{{ asset('site/img/111.jpeg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>@lang('services.our_services')</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('site.home') }}">@lang('services.home')</a>
                            <span>@lang('services.services')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Services Section Begin -->
    <section class="services-page spad">
        <div class="container">
            <div class="row" id="services-grid">

                @forelse($categories as $category)
                    <div class="col-lg-4 col-md-6 col-sm-6 text-center">
                        <div class="services__item">
                            <div class="services__item__icon mx-auto">
                                <img src="{{ $category->pathInView() }}" alt="{{ $category->transNow->title ?? '' }}" />
                            </div>
                            <h4>{{ $category->transNow->title ?? 'N/A' }}</h4>
                            <p>
                                {!! $category->transNow->description ?? '' !!}
                            </p>
                            <a href="{{ route('site.services.show', $category->transNow->slug ?? $category->id) }}"
                                class="service-btn">@lang('services.learn_more')</a>
                        </div>
                    </div>
                @empty
                    <h3>@lang('services.no_services')</h3>
                @endforelse
















            </div>

            <!-- See more / See less -->
            {{-- <div class="services__more text-center">
          <button
            id="toggleMore"
            class="cta-btn"
            aria-expanded="false"
            aria-controls="services-grid"
          >
            See more ->
          </button>
        </div> --}}
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Call To Action Section Begin -->
    <!-- Call To Action Section Begin -->
    <section class="callto spad set-bg careerImg" data-setbg="">
        <div class="container appcontainer">
            <div class="row">
                <img src="{{ asset($services_section->image) }}" class="applicationImg d-none d-sm-block" />
                <div class="col-lg-8">
                    <div class="callto__text">
                        <h2> {{ $services_section->transNow->title }}</h2>
                        <p>{!! $services_section->transNow->description !!}</p>
                        <a class="btn" href="{{ route('site.services.index') }}">@lang('home.Services')</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action Section End -->
<!-- Logo Begin -->
<div class="logo spad">
    <div class="container-fluid">
        <div class="logo-swiper swiper">
            <div class="swiper-wrapper">
                @forelse ($partners as $partner)
                    <div class="swiper-slide">
                        <a target="_blank" href="{{ $partner->url }}" class="partner-card">
                            <img src="{{ asset('storage/attachments/partners/' . $partner->image) }}"
                                 alt="partner-{{ $loop->index }}" />
                        </a>
                    </div>
                @empty
                    <p>@lang('site.no_partners')</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- Logo End -->

<style>
    .partner-card {
        display: flex;
        align-items: center;
        justify-content: center;
        background: transparent;
        border-radius: 12px;
        padding: 10px;
        height: 150px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #100028;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .partner-card:hover {
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        transform: translateY(-3px);
    }

    .partner-card img {
        max-width: 100%;
        max-height: 100%;
        width: auto;
        height: auto;
        object-fit: contain;
        filter: grayscale(30%);
        transition: filter 0.3s ease;
    }

    .partner-card:hover img {
        filter: grayscale(0%);
    }
    .callto {
    padding-bottom: 1px !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const swiper = new Swiper('.logo-swiper', {
            loop: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            slidesPerView: 5,
            spaceBetween: 24,
            breakpoints: {
                0:   { slidesPerView: 2, spaceBetween: 12 },
                576: { slidesPerView: 3, spaceBetween: 16 },
                768: { slidesPerView: 4, spaceBetween: 20 },
                992: { slidesPerView: 5, spaceBetween: 24 }
            },
        });
    });
</script>






@endsection

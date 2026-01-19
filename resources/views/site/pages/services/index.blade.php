@extends('site.app')

@section('title', @$metaSetting->where('key', 'services_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'services_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'services_meta_description_' . $current_lang)->first()->value)

@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ asset('site/img/breadcrumb-bg.jpg') }}">
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

    <style>
        [dir="rtl"] .applicationImg {
            position: absolute !important;
            right: 41rem !important;
            top: 0.5rem !important;
            height: 22rem !important;
            width: auto;
        }
    </style>
    <!-- Call To Action Section End -->

  <!-- Logo Begin -->
<div class="logo spad">
    <div class="container">
        <!-- Swiper container -->
        <div class="logo-swiper swiper">
            <div class="swiper-wrapper">
                @forelse ($partners as $partner)
                    <div class="swiper-slide">
                        <a target="_blank" href="{{ $partner->url }}" class="logo__item">
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
        0:   { slidesPerView: 2 },
        576: { slidesPerView: 3 },
        768: { slidesPerView: 4 },
        992: { slidesPerView: 5 }
      },
     
    });
  });
</script>






@endsection

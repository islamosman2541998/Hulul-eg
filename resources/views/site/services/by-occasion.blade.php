@extends('layouts.app')

@section('title', $settings->getMeta($pageName . '_meta_title_' . $currentLang) ?? __('messages.shop_by_occasions'))

@section('content')
    <div class="BuyByOccasions my-4 p-3">
        <div class="container">
            <div class="title mb-3">
                <h2>{{ __('messages.shop_by_occasions') }}</h2>
            </div>
            <!-- Slider main container -->
            <div class="swiper Occasions text-center">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach($occasions as $occasion)
                        <div class="swiper-slide">
                            <a href="{{ route('site.services.show', [$occasion->translations->where('locale', $currentLang)->first()->slug ?? $occasion->id]) }}">
                                <img src="{{ asset($occasion->pathInView()) }}" class="img-fluid rounded" alt="{{ $occasion->translations->where('locale', $currentLang)->first()->title ?? 'Occasion' }}">
                                <h4 class="my-3">{{ $occasion->translations->where('locale', $currentLang)->first()->title ?? 'No Title' }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div> <!-- إضافة Pagination لـ Swiper -->
            </div>
            <div class="Btns text-start">
                <a href="{{ route('site.services.by-occasion') }}" class="btn btn-more">{{ __('messages.more') }}</a>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        var swiper = new Swiper('.Occasions', {
            slidesPerView: 4,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                640: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
            },
        });
    </script>
@endpush
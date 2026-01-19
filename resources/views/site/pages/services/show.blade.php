@extends('site.app')

{{-- @section('title', @$service->trans->where('locale', $current_lang)->first()->meta_title)
@section('meta_key', @$service->trans->where('locale', $current_lang)->first()->meta_key)
@section('meta_description', @$service->trans->where('locale', $current_lang)->first()->meta_description) --}}

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ asset('site/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{ $category->transNow->title ?? '' }}</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('site.home') }}">@lang('services.home')</a>
                            <span>{{ $category->transNow->title ?? '' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Digital Marketing Content -->
    <section class="services-soft">
        <div class="wrap">

            <header class="head">
                <span class="eyebrow text-white">{{ $category->transNow->title ?? '' }}</span>
                {{-- <h2 class="text-white">We Prioritize Your Growth</h2> --}}
                <p>{!! $category->transNow->description ?? '' !!}</p>
            </header>

            <div class="grid">

                @forelse($services as $service)
                    <!-- Card 1 -->
                    <a class="card highlight" href="{{ route('site.service_request.index') }}">
                        <span class="icon" aria-hidden="true">
                            <img src="{{ asset(path: $service->image) }}" alt="{{ $service->transNow->title ?? '' }}"
                                style="width: 40px; height: 40px;">

                        </span>
                        <h3 class="text-white">{{ $service->transNow->title ?? '' }}</h3>
                        <p>{!! $service->transNow->description ?? '' !!}</p>
                        <span class="more">@lang('services.service_request') →</span>
                    </a>
                @empty
                    <p>@lang('services.no_services')</p>
                @endforelse




            </div>
        </div>
    </section>
    <!-- End of this section  -->
    <style>
    .card {

        background: #3b436d3d !important;
    }

    
</style>
@endsection


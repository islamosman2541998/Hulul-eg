@extends('site.app')

{{-- dashboard meta first; the service's own title/description keep the page from going out blank --}}
@section('title', $category->transNow?->meta_title ?: ($category->transNow?->title ?? ''))
@section('meta_key', $category->transNow?->meta_key ?? '')
@section('meta_description', $category->transNow?->meta_desc ?: ($category->transNow?->description ?? ''))

@push('schema')
    @php
        $serviceSchema = [
            '@context' => 'https://schema.org',
            '@graph' => [
                array_filter([
                    '@type' => 'Service',
                    'name' => $category->transNow?->title,
                    'description' => \Illuminate\Support\Str::limit(trim(html_entity_decode(strip_tags(str_replace('<', ' <', (string) $category->transNow?->description)), ENT_QUOTES | ENT_HTML5, 'UTF-8')), 300),
                    'url' => url()->current(),
                    'image' => asset($category->pathInView()),
                    'provider' => ['@id' => url('/') . '#organization'],
                    'areaServed' => [
                        ['@type' => 'Country', 'name' => 'Egypt'],
                        ['@type' => 'Country', 'name' => 'Saudi Arabia'],
                    ],
                ]),
                [
                    '@type' => 'BreadcrumbList',
                    'itemListElement' => [
                        ['@type' => 'ListItem', 'position' => 1, 'name' => __('services.home'), 'item' => route('site.home')],
                        ['@type' => 'ListItem', 'position' => 2, 'name' => __('services.services'), 'item' => route('site.services.index')],
                        ['@type' => 'ListItem', 'position' => 3, 'name' => $category->transNow?->title, 'item' => url()->current()],
                    ],
                ],
            ],
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($serviceSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
@endpush

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ webp_asset('site/img/111.jpeg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h1>{{ $category->transNow->title ?? '' }}</h1>
                        <div class="breadcrumb__links">
                            <a href="{{ route('site.home') }}">@lang('services.home')</a>
                            <span>{{ $category->transNow->title ?? '' }}</span>
                        </div>
                        <div class="pt-3">
                            <button class="btn btn-secondary text-white">
                                <a href="{{ route('site.service_request.index') }}">@lang('services.service_request') →</a>
                            </button>
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
                {{-- <span class="eyebrow text-white">{{ $category->transNow->title ?? '' }}</span> --}}
                <h2 class="text-white">{{ $category->transNow->title ?? '' }}</h2>
                <p>{!! $category->transNow->description ?? '' !!}</p>
            </header>

            <div class="grid">

                @forelse($services as $service)
                    <!-- Card 1 -->
                    <a class="card highlight" href="{{ route('site.service_request.index') }}">
                        <span class="icon" aria-hidden="true">
                            <img src="{{ webp_asset($service->image) }}" alt="{{ $service->transNow->title ?? '' }}"
                                style="width: 40px; height: 40px;">

                        </span>
                        <h3 class="text-white">{{ $service->transNow->title ?? '' }}</h3>
                        <p class="fs-5">{!! $service->transNow->description ?? '' !!}</p>
                        {{-- <span class="more">@lang('services.service_request') →</span> --}}
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

        .card p {

            font-size: 16.8px !important;
        }
    </style>
@endsection

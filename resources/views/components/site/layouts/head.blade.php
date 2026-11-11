<head>
    <meta charset="UTF-8">

    <title>{{ $metaTitle }}</title>

    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="description" content="{{ $metaDescription }}">
    @if ($robots)
        <meta name="robots" content="{{ $robots }}">
    @else
        <link rel="canonical" href="{{ url()->current() }}" />
    @endif
    @foreach ($alternates as $hreflang => $href)
        <link rel="alternate" hreflang="{{ $hreflang }}" href="{{ $href }}" />
    @endforeach

    <meta property="og:site_name" content="{{ $siteName }}" />
    <meta property="og:title" content="{{ $metaTitle }}" />
    <meta property="og:description" content="{{ $metaDescription }}" />
    <meta property="og:type" content="{{ $ogType }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ $ogImage }}" />
    <meta property="og:locale" content="{{ $ogLocale }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $metaTitle }}" />
    <meta name="twitter:description" content="{{ $metaDescription }}" />
    <meta name="twitter:image" content="{{ $ogImage }}" />

    <script type="application/ld+json">{!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @stack('schema')

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&family=Play:wght@400;700&display=swap"
    rel="stylesheet"
>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('site/fonts/css2.css') }}" />

    <link href="{{ $settings->getItem('icon') ? asset($settings->getItem('icon')) : asset('site/img/logos/logo.png') }}"
        rel="icon">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}" />
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('site/css/bootstrap.rtl.min.css') }}" />
    @endif

    <link rel="stylesheet" href="{{ asset('site/fonts/all.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}" />
    
    <link rel="stylesheet" href="{{ asset('site/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/style.css?v=0.0.22') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/custom.css?v=0.0.12') }}" />

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-THXZWWKN');</script>
<!-- End Google Tag Manager -->


    @stack('preload')
    @yield('style')

{{-- Livewire assets only on pages that render a Livewire component (see AppServiceProvider) --}}
@if (View::hasSection('uses_livewire') || app()->bound('livewire.used_on_page'))
    @livewireStyles
@endif
</head>

  


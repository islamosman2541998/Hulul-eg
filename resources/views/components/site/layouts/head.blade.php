<head>
    <meta charset="UTF-8">

    <title> {{ @$settings->getItem('site_name') }} | @yield('title', $settings->getItem('meta_title_' . $current_lang)) </title>

    <meta name="keywords" content="@yield('meta_key', $settings->getItem('meta_key_' . $current_lang))">
    <meta name="description" content="@yield('meta_description', $settings->getItem('meta_description_' . $current_lang))">
    <link rel="canonical" href="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta name="og:image" content="{{ asset($settings->getItem('logo') ?? 'site/img/logos/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
    href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&family=Play:wght@400;700&display=swap"
    rel="stylesheet"
>

    <meta name="msapplication-TileImage"
        content="https://snapster.foxthemes.me/wp-content/uploads/2020/05/favicon.png" />
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
    <link rel="stylesheet" href="{{ asset('site/css/style.css?v=0.0.12') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/custom.css?v=0.0.11') }}" />

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-THXZWWKN');</script>
<!-- End Google Tag Manager -->


    @stack('preload')
    @yield('style')

    @livewireStyles
</head>

  


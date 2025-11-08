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
    <link rel='dns-prefetch' href='//use.fontawesome.com' />
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Play:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/fontawesome.min.css"
        integrity="sha512-M5Kq4YVQrjg5c2wsZSn27Dkfm/2ALfxmun0vUE3mPiJyK53hQBHYCVAtvMYEC7ZXmYLg8DVG4tF8gD27WmDbsg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/regular.min.css"
        integrity="sha512-x3gns+l9p4mIK7vYLOCUoFS2P1gavFvnO9Its8sr0AkUk46bgf9R51D8xeRUwCSk+W93YbXWi19BYzXDNBH5SA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/brands.min.css"
        integrity="sha512-WxpJXPm/Is1a/dzEdhdaoajpgizHQimaLGL/QqUIAjIihlQqlPQb1V9vkGs9+VzXD7rgI6O+UsSKl4u5K36Ydw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/solid.min.css"
        integrity="sha512-EHa6vH03/Ty92WahM0/tet1Qicl76zihDCkBnFhN3kFGQkC+mc86d7V+6y2ypiLbk3h0beZAGdUpzfMcb06cMg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta name="msapplication-TileImage"
        content="https://snapster.foxthemes.me/wp-content/uploads/2020/05/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" /> --}}
    <link rel="stylesheet" href="{{ asset('site/fonts/css2.css') }}" />

    <link href="{{ $settings->getItem('icon') ? asset($settings->getItem('icon')) : asset('site/img/logos/logo.png') }}"
        rel="icon">

        <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}" />
    @if (app()->getLocale() == 'ar')
        <link rel="stylesheet" href="{{ asset('site/css/bootstrap.rtl.min.css') }}" />
    @else
    @endif
    {{-- <link rel="stylesheet" href="./fonts/LCALLIG.TTF">
	<link rel="stylesheet" href="index.css"> --}}



    <link rel="stylesheet" href="{{ asset('site/fonts/all.min.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('site/fonts/nouislider.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('site/css//font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/elegant-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/slicknav.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/style.css?v=0.0.10') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/custom.css?v=0.0.10') }}" />




    {!! \App\Settings\SettingSingleton::getInstance()->getScript('header_script') !!}


    @yield('style')

    @livewireStyles
</head>

<body>
    <div id="preloder">
        <div class="loader"></div>
    </div>

    {!! \App\Settings\SettingSingleton::getInstance()->getScript('body_script') !!}

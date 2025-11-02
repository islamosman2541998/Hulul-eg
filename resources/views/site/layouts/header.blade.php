<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>
        {{ $settings->getItem('site_name') ?? 'My Website' }} |
        @yield('title', $settings->getMeta($page_name . '_meta_title_' . $current_lang) ?? 'Default Title')
    </title>

    <meta name="keywords" content="@yield('meta_key', $settings->getMeta($page_name . '_meta_key_' . $current_lang) ?? 'default, keywords')">
    <meta name="description" content="@yield('meta_description', $settings->getMeta($page_name . '_meta_description_' . $current_lang) ?? 'Default description')">
    <meta name="robots" content="index, follow">

    <meta name="theme-color" content="#ffffff">
    <meta http-equiv="Content-Security-Policy"
        content="default-src 'self'; script-src 'self' https://unpkg.com; style-src 'self' https://unpkg.com;">
    <link rel="canonical" href="{{ url()->current() }}" />

    <meta property="og:title" content="{{ $settings->getItem('site_name') ?? 'My Website' }} | @yield('title', $settings->getMeta($page_name . '_meta_title_' . $current_lang) ?? 'Default Title')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset($settings->getItem('logo') ?? 'site/img/logos/logo.png') }}">
    <meta property="og:description" content="@yield('meta_description', $settings->getMeta($page_name . '_meta_description_' . $current_lang) ?? 'Default description')" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $settings->getItem('site_name') ?? 'My Website' }} | @yield('title', $settings->getMeta($page_name . '_meta_title_' . $current_lang) ?? 'Default Title')">
    <meta name="twitter:description" content="@yield('meta_description', $settings->getMeta($page_name . '_meta_description_' . $current_lang) ?? 'Default description')">
    <meta name="twitter:image" content="{{ asset($settings->getItem('logo') ?? 'site/img/logos/logo.png') }}">

    <link href="{{ $settings->getItem('icon') ? asset($settings->getItem('icon')) : asset('site/img/logos/logo.png') }}"
        rel="icon">
    <link rel="preconnect" href="https://unpkg.com">



    <link rel="stylesheet" href="{{ asset('site/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('site/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/swiper-bundle.min.css') }}" />

    @livewireStyles
    @yield('style')
</head>

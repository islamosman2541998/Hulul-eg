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
    <link rel="alternate" type="application/rss+xml" title="snapster.foxthemes.me &raquo; Feed" href="https://snapster.foxthemes.me/feed/" />
    <link rel="alternate" type="application/rss+xml" title="snapster.foxthemes.me &raquo; Comments Feed" href="https://snapster.foxthemes.me/comments/feed/" />
    <link rel='preload stylesheet preconnect' as='style' id='woocommerce-add-to-cart-form-style' href='https://snapster.foxthemes.me/wp-content/plugins/woocommerce/assets/client/blocks/woocommerce/add-to-cart-form-style.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='woocommerce-product-filter-price-slider-style' href='https://snapster.foxthemes.me/wp-content/plugins/woocommerce/assets/client/blocks/woocommerce/product-filter-price-slider-style.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='woocommerce-product-gallery-style' href='https://snapster.foxthemes.me/wp-content/plugins/woocommerce/assets/client/blocks/woocommerce/product-gallery-style.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='contact-form-7' href='https://snapster.foxthemes.me/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=6.0.6' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='scheduled-tooltipster' href='https://snapster.foxthemes.me/wp-content/plugins/scheduled/assets/js/tooltipster/css/tooltipster.css?ver=3.3.0' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='scheduled-tooltipster-theme' href='https://snapster.foxthemes.me/wp-content/plugins/scheduled/assets/js/tooltipster/css/themes/tooltipster-light.css?ver=3.3.0' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='scheduled-animations' href='https://snapster.foxthemes.me/wp-content/plugins/scheduled/assets/css/animations.css?ver=1.0.0' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='scheduled-css' href='https://snapster.foxthemes.me/wp-content/plugins/scheduled/dist/scheduled.css?ver=1.0.0' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='whizzy_skin' href='https://snapster.foxthemes.me/wp-content/plugins/whizzy/assets/css/skin.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='whizzy-advanced-main' href='https://snapster.foxthemes.me/wp-content/plugins/whizzy/assets/css/advanced.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='whizzy-advanced-shortcodes' href='https://snapster.foxthemes.me/wp-content/plugins/whizzy/assets/css/shortcodes.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='ppress-frontend' href='https://snapster.foxthemes.me/wp-content/plugins/wp-user-avatar/assets/css/frontend.min.css?ver=4.16.1' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='ppress-flatpickr' href='https://snapster.foxthemes.me/wp-content/plugins/wp-user-avatar/assets/flatpickr/flatpickr.min.css?ver=4.16.1' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='ppress-select2' href='https://snapster.foxthemes.me/wp-content/plugins/wp-user-avatar/assets/select2/select2.min.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='brands-styles' href='https://snapster.foxthemes.me/wp-content/plugins/woocommerce/assets/css/brands.css?ver=9.9.4' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='snapster-child-css' href='https://snapster.foxthemes.me/wp-content/themes/snapster-child-theme/style.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='snapster-general' href='https://snapster.foxthemes.me/wp-content/themes/snapster/assets/css/general.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='snapster-shop' href='https://snapster.foxthemes.me/wp-content/themes/snapster/assets/css/shop.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='snapster-style' href='https://snapster.foxthemes.me/wp-content/themes/snapster/style.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='elementor-icons' href='https://snapster.foxthemes.me/wp-content/plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.43.0' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='elementor-frontend' href='https://snapster.foxthemes.me/wp-content/plugins/elementor/assets/css/frontend.min.css?ver=3.30.1' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='elementor-post-7972' href='https://snapster.foxthemes.me/wp-content/uploads/elementor/css/post-7972.css?ver=1752055397' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='swiper' href='https://snapster.foxthemes.me/wp-content/plugins/elementor/assets/lib/swiper/v8/css/swiper.min.css?ver=8.4.5' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='magnific' href='https://snapster.foxthemes.me/wp-content/plugins/aheto/assets/frontend/vendors/magnific/magnific.min.css' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='widget-image' href='https://snapster.foxthemes.me/wp-content/plugins/elementor/assets/css/widget-image.min.css?ver=3.30.1' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='e-animation-fadeInUp' href='https://snapster.foxthemes.me/wp-content/plugins/elementor/assets/lib/animations/styles/fadeInUp.min.css?ver=3.30.1' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='widget-spacer' href='https://snapster.foxthemes.me/wp-content/plugins/elementor/assets/css/widget-spacer.min.css?ver=3.30.1' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='widget-testimonial' href='https://snapster.foxthemes.me/wp-content/plugins/elementor/assets/css/widget-testimonial.min.css?ver=3.30.1' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='widget-divider' href='https://snapster.foxthemes.me/wp-content/plugins/elementor/assets/css/widget-divider.min.css?ver=3.30.1' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='lity' href='https://snapster.foxthemes.me/wp-content/plugins/aheto/assets/frontend/vendors/lity/lity.min.css' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='ionicons' href='https://snapster.foxthemes.me/wp-content/plugins/aheto/assets/fonts/ionicons.min.css' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='elementor-post-7' href='https://snapster.foxthemes.me/wp-content/uploads/elementor/css/post-7.css?ver=1752055420' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='elementor-post-13' href='https://snapster.foxthemes.me/wp-content/uploads/elementor/css/post-13.css?ver=1752055420' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='elementor-post-1535' href='https://snapster.foxthemes.me/wp-content/uploads/elementor/css/post-1535.css?ver=1752055397' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='scheduled-wc-fe-styles' href='https://snapster.foxthemes.me/wp-content/plugins/scheduled/includes/add-ons/woocommerce-payments//css/frontend-style.css?ver=6.8.2' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='font-awesome-official' href='https://use.fontawesome.com/releases/v6.5.1/css/all.css' type='text/css' media='all' crossorigin integrity="sha384-t1nt8BQoYMLFN5p42tRAtuAAFQaCQODekUVeKKZrEnEyp4H2R0RHFz0KWpmj7i8g" crossorigin="anonymous" />
    <link rel='preload stylesheet preconnect' as='style' id='preloader-spinner' href='https://snapster.foxthemes.me/wp-content/plugins/aheto/assets/frontend/css/preloader-spinner.css' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='elegant' href='https://snapster.foxthemes.me/wp-content/plugins/aheto/assets/fonts/elegant.min.css' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='font-awesome' href='https://snapster.foxthemes.me/wp-content/plugins/aheto/assets/fonts/font-awesome.min.css' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='style-main' href='https://snapster.foxthemes.me/wp-content/plugins/aheto/assets/frontend/css/style.css' type='text/css' media='all' crossorigin />

    <link rel='preload stylesheet preconnect' as='style' id='whizzy_gallery-general' href='https://snapster.foxthemes.me/wp-content/plugins/whizzy/assets/css/gallery-general.css?ver=1.0.0' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='lightgallery' href='https://snapster.foxthemes.me/wp-content/plugins/aheto/assets/frontend/vendors/lightgallery/lightgallery.min.css' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='font-awesome-official-v4shim' href='https://use.fontawesome.com/releases/v6.5.1/css/v4-shims.css' type='text/css' media='all' crossorigin integrity="sha384-5Jfdy0XO8+vjCRofsSnGmxGSYjLfsjjTOABKxVr8BkfvlaAm14bIJc7Jcjfq/xQI" crossorigin="anonymous" />
    <link rel='preload stylesheet preconnect' as='style' id='elementor-gf-local-roboto' href='https://snapster.foxthemes.me/wp-content/uploads/elementor/google-fonts/css/roboto.css?ver=1750222650' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='elementor-gf-local-robotoslab' href='https://snapster.foxthemes.me/wp-content/uploads/elementor/google-fonts/css/robotoslab.css?ver=1750222660' type='text/css' media='all' crossorigin />
    <link rel='preload stylesheet preconnect' as='style' id='elementor-gf-local-playfairdisplay' href='https://snapster.foxthemes.me/wp-content/uploads/elementor/google-fonts/css/playfairdisplay.css?ver=1750222654' type='text/css' media='all' crossorigin />
    <script type="text/javascript" src="https://snapster.foxthemes.me/wp-includes/js/jquery/jquery.min.js?ver=3.7.1" id="jquery-core-js"></script>
    <script type="text/javascript" src="https://snapster.foxthemes.me/wp-includes/js/jquery/jquery-migrate.min.js?ver=3.4.1" id="jquery-migrate-js"></script>
    <script type="text/javascript" src="https://snapster.foxthemes.me/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.7.0-wc.9.9.4" id="jquery-blockui-js" defer="defer" data-wp-strategy="defer"></script>
    <script type="text/javascript" src="https://snapster.foxthemes.me/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart.min.js?ver=9.9.4" id="wc-add-to-cart-js" defer="defer" data-wp-strategy="defer"></script>
    <script type="text/javascript" src="https://snapster.foxthemes.me/wp-content/plugins/wp-user-avatar/assets/flatpickr/flatpickr.min.js?ver=4.16.1" id="ppress-flatpickr-js"></script>
    <script type="text/javascript" src="https://snapster.foxthemes.me/wp-content/plugins/wp-user-avatar/assets/select2/select2.min.js?ver=4.16.1" id="ppress-select2-js"></script>
    <script type="text/javascript" id="scheduled-wc-fe-functions-js-extra">
    </script>
    <script type="text/javascript" src="https://snapster.foxthemes.me/wp-content/plugins/scheduled/includes/add-ons/woocommerce-payments//js/frontend-functions.js?ver=6.8.2" id="scheduled-wc-fe-functions-js"></script>
    <link rel="https://api.w.org/" href="https://snapster.foxthemes.me/wp-json/" />
    <link rel="alternate" title="JSON" type="application/json" href="https://snapster.foxthemes.me/wp-json/wp/v2/pages/7" />
    <link rel="EditURI" type="application/rsd+xml" title="RSD" href="https://snapster.foxthemes.me/xmlrpc.php?rsd" />
    <link rel="canonical" href="https://snapster.foxthemes.me/" />
    <link rel='shortlink' href='https://snapster.foxthemes.me/' />
    <link rel="alternate" title="oEmbed (JSON)" type="application/json+oembed" href="https://snapster.foxthemes.me/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fsnapster.foxthemes.me%2F" />
    <link rel="alternate" title="oEmbed (XML)" type="text/xml+oembed" href="https://snapster.foxthemes.me/wp-json/oembed/1.0/embed?url=https%3A%2F%2Fsnapster.foxthemes.me%2F&#038;format=xml" />
    <noscript>
    </noscript>
    <meta name="generator" content="Elementor 3.30.1; features: additional_custom_breakpoints; settings: css_print_method-external, google_font-enabled, font_display-auto">
    {{-- <link rel="icon" href="https://snapster.foxthemes.me/wp-content/uploads/2020/05/favicon.png" sizes="32x32" />
	<link rel="icon" href="https://snapster.foxthemes.me/wp-content/uploads/2020/05/favicon.png" sizes="192x192"/>
	<link rel="apple-touch-icon" href="https://snapster.foxthemes.me/wp-content/uploads/2020/05/favicon.png" /> --}}
    <meta name="msapplication-TileImage" content="https://snapster.foxthemes.me/wp-content/uploads/2020/05/favicon.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" /> --}}
    <link rel="stylesheet" href="{{ asset('site/fonts/css2.css') }}" />

    <link href="{{ $settings->getItem('icon') ? asset($settings->getItem('icon')) : asset('site/img/logos/logo.png') }}" rel="icon">

    @if (app()->getLocale() == 'ar')
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.rtl.min.css') }}" />
    @else
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}" />
    @endif
    {{-- <link rel="stylesheet" href="./fonts/LCALLIG.TTF">
	<link rel="stylesheet" href="index.css"> --}}



    <link rel="stylesheet" href="{{ asset('site/fonts/all.min.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('site/fonts/nouislider.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('site/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/swiper.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/style.css?v=0.0.10') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/custom.css?v=0.0.10') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/career.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/Blog.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/news.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/contact.css?v=0.0.1') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/Faq.css') }}" />
    <link rel="stylesheet" href="{{ asset('site/css/About.css') }}" />



    {!! \App\Settings\SettingSingleton::getInstance()->getScript('header_script') !!}


    @yield('style')

    @livewireStyles
</head>
<body class="home wp-singular page-template page-template-aheto_canvas page page-id-7 wp-embed-responsive wp-theme-snapster wp-child-theme-snapster-child-theme theme-snapster woocommerce-no-js no-sidebar elementor-default elementor-kit-7972 elementor-page elementor-page-7">
    <div class="aheto-preloader">
        <div class="aheto-preloader__spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    {!! \App\Settings\SettingSingleton::getInstance()->getScript('body_script') !!}

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<x-site.layouts.head />

@livewireStyles

<body>

    <!-- nav bar -->
    <x-site.layouts.navbar />
    <!-- End nav bar -->


    @yield('content')


    <!-- Footer -->
    <x-footer />
    <!---End Footer-->


    <!-- script  -->
    @include('site.layouts.script')
    <!-- End script  -->
    @livewireScripts

    {!! \App\Settings\SettingSingleton::getInstance()->getScript('footer_script') !!}

    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-THXZWWKN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

</body>

</html>

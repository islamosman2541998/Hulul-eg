<!DOCTYPE html>
<html
    lang="{{ app()->getLocale() }}"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}"
>

<x-site.layouts.head />

<body>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe
            src="https://www.googletagmanager.com/ns.html?id=GTM-THXZWWKN"
            height="0"
            width="0"
            style="display:none;visibility:hidden"
        ></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    {!! \App\Settings\SettingSingleton::getInstance()->getScript('body_script') !!}

    <x-site.layouts.navbar />

    <main>
        @yield('content')
    </main>

    <x-footer />

    @include('site.layouts.script')

    {{-- مرة واحدة فقط --}}
    @livewireScripts

    {!! \App\Settings\SettingSingleton::getInstance()->getScript('footer_script') !!}

</body>
</html>
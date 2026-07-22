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


    <x-site.layouts.navbar />

    <main>
        @yield('content')
    </main>

    <x-footer />

    @include('site.layouts.script')

@hasSection('uses_livewire')
    @livewireScripts
@endif


</body>
</html>
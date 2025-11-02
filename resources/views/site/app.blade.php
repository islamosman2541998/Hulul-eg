<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<x-site.layouts.head />


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

    
{!!    \App\Settings\SettingSingleton::getInstance()->getScript('footer_script') !!}

</body>

</html>

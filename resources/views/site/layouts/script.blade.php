<!-- jquery cdn -->
<script src="{{ asset('site/js/jquery-3.3.1.min.js') }}"></script>

<!-- popper cdn -->
<script src="{{ asset('site/js/popper.min.js') }}"></script>
<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('site/js/mixitup.min.js') }}"></script>
<script src="{{ asset('site/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('site/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('site/js/owl.carousel.min.js') }}"></script>

<!--Bootstrap cdn -->
<script src="{{ asset('site/js/bootstrap.bundle.min.js') }} "></script>

<!--Swiper-->
<script src="{{ asset('site/js/swiper-bundle.min.js') }}"></script>
{{-- <script src="{{ asset('site/js/swiper-bundle.js') }} "></script> --}}

<!--Animation-->
<script src="{{ asset('site/js/wow.min.js') }} "></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<!--Custom Script-->
<script src="{{ asset('site/js/cdn.min.js') }}"></script>
<script src="{{ asset('site/js/nouislider.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('site/css/swiper.min.css') }}" />
{{-- <link rel="stylesheet" href="{{ asset('site/css/swiper-bundle.min.css') }}" /> --}}

<script src="{{ asset('site/js/custom.js') }} "></script>
<script src="{{ asset('site/js/main.js') }} "></script>


@stack('scripts')

@livewireScripts

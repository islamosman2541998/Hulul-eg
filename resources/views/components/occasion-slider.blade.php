@php
        $settings = \App\Settings\SettingSingleton::getInstance();
    @endphp
<div>
    <hr class="my-4 text-bg-dark w-90 mx-auto" />
</div>
<!--BuyByOccasions-->
<div class="BuyByOccasions my-4 p-3 bg-white">
    <div class="container ">
        <div class="title mb-3">
            <h2  >{{ $settings->getItem('Shop_by_Occasions') }}</h2>

        </div>
        <!-- Slider main container -->
        <div class="swiper Occasions text-center ">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach($occasions as $occasion)
                    <div class="swiper-slide">
                        <a href="{{ route('site.shop', ['occasion_id' => $occasion->id]) }}">
                            <img src="{{ asset($occasion->pathInView()) }}" class="img-fluid  " alt="{{ $occasion->transNow->title ?? 'Occasion' }}" />
                        </a>
                        <h4 class="my-3">
                            {{ $occasion->transNow->title ?? 'No Title' }}
                        </h4>
                    </div>
                @endforeach
            </div>
                <!-- If we need navigation buttons -->
          <div class="swiper-button-prev Occain-prev"></div>
          <div class="swiper-button-next Occain-next"></div>
        </div>
      
    </div>
</div>
<!--BuyByOccasions-->



<style>
    .swiper-button-prev, .swiper-button-next {
        left: 0;
        z-index: 10;
        color: #431934 !important;
    }
</style>

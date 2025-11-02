<!-- OUR PRODUCTS -->

@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_product    = (int) $settings->getHome('show_product');
@endphp

@if ($show_product)
<section class="products-section  wow bounceInUp" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">@lang('messages.Our Products')</h2>
            <div class="DivNews">
             </div>
            {{-- <p class="section-sub pt-2">@lang('messages.our_products')</p> --}}
        </div>
        <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
            @forelse ($products as $key => $product)
                <div class="col  wow bounceInUp" style="animation-delay: 0.{{ ($key + 1) }}s;">
                    <a href="{{ route('site.products.show', $product->transNow->slug) }}" class="text-decoration-none" aria-label="{{ $product->transNow->title }}">
                        <div class="product-card">
                            <div class="product-media">
                                <img src="{{ asset($product->path() . $product->image) }}" alt="{{ $product->transNow->title }}">
                            </div>
                            <div class="product-footer">
                                <div class="product-title">{{ $product->transNow->title }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col text-center">
                    <p>{{ __('messages.no_products') }}</p>
                </div>
            @endforelse
        </div>
    </div>
      <div class="viewall wow fadeInLeft" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'ltr' }}">
             <a class="viewnews" href="{{ route('site.products.index') }}">
                 <span class="viewnewstext">@lang('site.view_all_products')</span>
                 <span class="viewnewsspan">→</span>
             </a>
         </div>
</section>
@endif

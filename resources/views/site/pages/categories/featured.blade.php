@foreach ($featuredCategories as $category)
    <!-- Plants Section -->
    <div class="plants my-4">
        <div class="container">
            <div class="title mb-3">
                <h2 class="m-0 p-3 text-right">
                    {{ $category->transNow->title ?? __('messages.No Title') }}
                </h2>
            </div>

            <div class="Content position-relative text-center">
                <div class="swiper PlanteSwiper">
                    <div class="swiper-wrapper">
                        @forelse($category->products as $product)
                            <div class="swiper-slide">
                                <div class="SingleCell py-3 mb-0">
                                    {{-- <div class="avaible d-flex align-items-center justify-content-end">
                    <div class="dot {{ $product->in_stock ? 'bg-success' : 'bg-danger' }}"></div>
                    <span class="mb-2 mx-1">
                      {{ $product->in_stock ? 'available' : 'unavailable' }}
                    </span>
                  </div> --}}
                                    <a href="{{ route('site.products.show', $product->id) }}"
                                        class="text-decoration-none">
                                        <img src="{{ asset($product->pathInView()) }}" class="img-fluid p-2"
                                            alt="{{ $product->transNow->title ?? 'No Title' }}">
                                        <h3 class="text-center mt-3">
                                            {{ $product->transNow->title ?? 'No Title' }}
                                        </h3>
                                        <p class="text-center mb-0">
                                            @if ($product->price_after_sale !== $product->price)
                                                <span class="text-danger main-color">
                                                    {{ number_format($product->price_after_sale, 2) }} EGP
                                                </span>
                                                <span class="text-danger text-decoration-line-through mx-2">
                                                    {{ number_format($product->price, 2) }} EGP
                                                </span>
                                            @else
                                                {{ number_format($product->price, 2) }} EGP
                                            @endif
                                        </p>
                                        {{-- <div class="rate text-center" style="color:#e2ad26;">
                      @php
                        $avg = $product->average_rating;
                        $full = floor($avg);
                        $half = $avg - $full >= .5;
                      @endphp
                      @for ($i = 1; $i <= 5; $i++)
                        <i class="fa-solid fa-star {{
                            $i <= $full
                              ? 'text-warning'
                              : ($i == $full+1 && $half
                                  ? 'text-warning half'
                                  : 'text-secondary')
                          }}"></i>
                      @endfor
                      <span class="text-muted">({{ number_format($avg,1) }})</span>
                    </div> --}}
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <p class="text-center">
                                    {{ app()->getLocale() == 'ar' ? 'لا يوجد منتجات متاحة' : 'No products available' }}
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <!-- navigation buttons -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('site.shop', ['category_id' => $category->id]) }}" class="btn btn-more px-0 mx-auto">
                    {{ app()->getLocale() == 'ar' ? 'عرض المزيد' : 'View More' }}
                </a>
            </div>
        </div>
    </div>
@endforeach



<style>
    .swiper-button-next, .swiper-button-prev {
    top: var(--swiper-navigation-top-offset, 39%) !important; 
    }
</style>
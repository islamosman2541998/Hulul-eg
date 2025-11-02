<!-- Best Offers Section -->
@php
        $settings = \App\Settings\SettingSingleton::getInstance();
    @endphp
<div class="BestOffers my-5">
    <div class="container">
        <div class="title mb-3">
            <h2 class="m-0 p-3">
            {{ $settings->getItem('Best_Offers') }}
            </h2>
        </div>

        <div class="Content position-relative text-center">
            <div class="swiper BestOffersSwiper PlanteSwiper ">
                <div class="swiper-wrapper">
                    @forelse ($offerProducts as $product)
                        <div class="swiper-slide">
                            <div class="SingleCell py-3 mb-0">
                                <div class="px-2 avaible d-flex align-items-center justify-content-start">
                                    <div class="dot {{ $product->in_stock ? 'bg-success' : 'bg-danger' }}"></div>
                                    <span class="mb-2 mx-1 {{ $product->in_stock ? 'text-success' : 'text-danger' }}">
                                        {{ $product->in_stock ? trans('in stock') : trans('out of stock') }}
                                    </span>
                                </div>
                                <a href="{{ route('site.products.show', $product->id) }}">
                                    <img src="{{ asset($product->pathInView()) }}" class="img-fluid p-2"
                                        alt="{{ $product->transNow?->title ?? 'No Title Available' }}">
                                </a>
                                <h3 class="text-center">{{ $product->transNow?->title ?? 'No Title Available' }}</h3>
                              <p class="text-center mb-0">
                                            @if ($product->price_after_sale !== $product->price)
                                                <span class="text-danger main-color">
                                                    {{ number_format($product->price_after_sale, 2) }} EGP
                                                </span>
                                                <span class="text-danger text-decoration-line-through mx-2">
                                                    {{ number_format($product->price, 2) }} EGP
                                                </span>
                                            @else
                                            <span class="text-danger main-color">
                                                {{ number_format($product->price, 2) }} EGP

                                            </span>
                                            @endif
                                        </p>
                                {{-- <div class="rate text-center">
                                    @php
                                        $averageRating = $product->average_rating;
                                        $filledStars = floor($averageRating);
                                        $hasHalfStar = $averageRating - $filledStars >= 0.5;
                                    @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fa-solid fa-star {{ $i <= $filledStars
                                                ? 'text-warning'
                                                : ($i == $filledStars + 1 && $hasHalfStar
                                                    ? 'text-warning half'
                                                    : 'text-secondary') }}"></i>
                                    @endfor
                                    <span class="text-muted">({{ number_format($averageRating, 1) }})</span>
                                </div> --}}
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <p> @lang('No products available') </p>
                        </div>
                    @endforelse
                </div>

                <!-- navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <div class="text-end mt-3">
            <a href="{{ route('site.shop', ['best_offer' => 1, 'sort' => 'best_offer']) }}"
                class="btn btn-primary border-0" style="background-color:#431934;">
                @lang('View More') 
            </a>
        </div>
    </div>
</div>
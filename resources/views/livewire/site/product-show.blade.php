@php
    $settings = \App\Settings\SettingSingleton::getInstance();
    $avg = $product->reviews()->where('status', 1)->avg('rate');
    $averageRating = $avg ? round($avg, 1) : 0;
    $reviewCount = $product->reviews()->where('status', 1)->count();
    $reviewes = $product->reviews()->where('status', 1)->get();
    // dd($reviewes);
@endphp

@section('title', $settings->getMeta('product_meta_title_' . $current_lang) ?? 'Default Title ')
@section('meta_key', $settings->getMeta('product_meta_key_' . $current_lang) ?? 'Default Keywords')
@section('meta_description', $settings->getMeta('product_meta_description_' . $current_lang) ?? 'Default Description')

<div class="Product single-productt pt-5">
    <div class="container">
        <div class="row pt-3">
            <div class="col-12 col-lg-6 ProductImgs p-lg-5 mt-3">
                <div class="row">
                    <div class="ProductSwiper col-12">
                        <div class="swiper prodect">
                            <div class="swiper-wrapper">
                                @if ($selectedPocket)
                                    @php
                                        $pocket = $product->pockets->firstWhere('id', $selectedPocket);
                                        $raw = $pocket->image;
                                        $images = $raw ? json_decode($raw, true) : [];
                                        if (!is_array($images) || empty($images[0])) {
                                            $images = [];
                                        }
                                    @endphp

                                    @if (count($images) > 0)
                                        @foreach ($images as $img)
                                            <div class="swiper-slide">
                                                <div class="img-zoom-container">
                                                    <img class="zoomable-image"
                                                        src="{{ asset('attachments/pockets/' . $img) }}"
                                                        alt="{{ $pocket->pocket_name ?? 'Pocket Image' }}" />
                                                    <div class="zoom-window"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide">
                                            <div class="img-zoom-container">
                                                <img class="zoomable-image" src="{{ asset($product->pathInView()) }}"
                                                    alt="{{ $product->transNow->title ?? 'No Title' }}" />
                                                <div class="zoom-window"></div>
                                            </div>
                                        </div>
                                    @endif
                                @else
                                    @if ($product->galleryGroup && $product->galleryGroup->images->isNotEmpty())
                                        @foreach ($product->galleryGroup->images as $image)
                                            <div class="swiper-slide">
                                                <div class="img-zoom-container">
                                                    <img class="zoomable-image"
                                                        src="{{ asset($image->pathInView('products')) }}"
                                                        alt="{{ $product->transNow->title ?? 'No Title' }}" />
                                                    <div class="zoom-window"></div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="swiper-slide">
                                            <div class="img-zoom-container">
                                                <img class="zoomable-image" src="{{ asset($product->pathInView()) }}"
                                                    alt="{{ $product->transNow->title ?? 'No Title' }}" />
                                                <div class="zoom-window"></div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 ProductInfo p-4 mt-lg-3">
                <div class="info my-4">


                    <h6 class="pt-2"> <span>{{ __('messages.code_number') }}</span>{{ $product->code ?? 'unknown' }}
                    </h6>
                    <h1 class="h3">{{ $product->transNow->title ?? __('messages.no_title') }}</h1>
                    <div class="rightSide">
                        <h6 class="text-dark">{{ number_format($averageRating, 1) }}
                            {{ __('messages.out_of_5') }}</h6>
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="fa-solid fa-star {{ $i <= $averageRating ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                        </div>
                        <p class="text-dark">{{ $reviewCount }} {{ __('messages.reviews') }}</p>
                        <a href="#reviews" class="btn"><i class="fas fa-star"> {{__('messages.leave_a_review')}}</i></a>
                    </div>
                    @if ($product->show_text)
                        <span class="badge p-3 mt-3 fs-6" style="color:#FFFFFF;background:rgb(204, 4, 4);">
                            {{ $settings->getItem('show_text_in_product') }}
                        </span>
                    @endif
                </div>
                <div class="descri my-4">
                    <p>{!! $product->transNow->description ?? __('messages.no_description') !!}</p>
                </div>
                @if (!$product->user_input)
                    <button
                        class="btn btn-outline-secondary mb-3 w-50 main-color-bg text-white d-flex align-items-center justify-content-center"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseCareTips"
                        aria-expanded="false" aria-controls="collapseCareTips">
                        {{ __('messages.care_tips') }}
                        <i class="fa-solid fa-chevron-down ms-2 transition-icon"></i>
                    </button>
                    <div class="collapse" id="collapseCareTips">
                        <div class="card list-style-none card-body">
                            {!! $product->transNow->care_tips ?? '<em>' . __('messages.no_care_tips') . '</em>' !!}
                        </div>
                    </div>
                @endif
                <div class="price my-4">
                    <h2>
                        @if (trim($userInput) !== '')
                            @php
                                $trimmed = preg_replace('/\s+/', '', $userInput);
                                $len = mb_strlen($trimmed);
                                $dynamicPrice = $len * $currentPrice;
                            @endphp
                            {{ number_format($dynamicPrice, 2) }} EGP
                        @else
                            @if ($product->has_pockets && $product->pockets->isNotEmpty())
                                {{ number_format($currentPrice, 2) }} EGP
                            @else
                                @if ($product->price_after_sale !== $product->price)
                                    <span class="text-danger main-color">
                                        {{ number_format($product->price_after_sale, 2) }} EGP
                                    </span>
                                    <span class="text-decoration-line-through text-muted mx-2">
                                        {{ number_format($product->price, 2) }} EGP
                                    </span>
                                @else
                                    {{ number_format($product->price, 2) }} EGP
                                @endif
                            @endif
                        @endif
                    </h2>

                    @if ($product->has_pockets && $product->pockets->isNotEmpty())
                        <div class="pocket-options my-4">
                            <h4>{{ __('messages.select_bouquet') }}</h4>
                            <div class="d-flex flex-column">
                                @foreach ($product->pockets as $pocket)
                                    <div class="card p-2 mb-2">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="form-check">
                                                <input type="radio" class="form-check-input me-2"
                                                    name="selectedPocket" id="pocket_{{ $pocket->id }}"
                                                    value="{{ $pocket->id }}" wire:model="selectedPocket">
                                                <label class="form-check-label" for="pocket_{{ $pocket->id }}">
                                                    {{ $pocket->pocket_name ?? __('messages.no_title') }}
                                                </label>
                                            </div>
                                            <strong>{{ number_format($pocket->price, 2) }} EGP</strong>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif


                    @if ($product->user_input == 1)
                        <div class="mb-4">
                            <label for="userInput" class="form-label">{{ __('messages.enter_text_or_number') }}</label>
                            <input type="text" id="userInput" wire:model="userInput" class="form-control"
                                placeholder="{{ __('messages.type_here') }}" />

                            @php
                                $countChars = mb_strlen(preg_replace('/\s+/', '', $userInput));
                            @endphp
                            <small class="text-muted">
                                {{ __('messages.chars_count') }}: {{ $countChars }}
                            </small>

                            @if (trim($userInput) !== '')
                                @php
                                    $trimmed = preg_replace('/\s+/', '', $userInput);
                                    $len = mb_strlen($trimmed);
                                    $dynamicPrice = $len * $currentPrice;
                                @endphp
                                <div>
                                    {{-- <small class="fw-bold">
                                    {{ __('messages.computed_price') }}: {{ number_format($dynamicPrice, 2) }} EGP
                                </small> --}}
                                </div>
                            @endif
                        </div>
                    @endif
                    <div class="fixed-footer">
                        <div class="row">
                            <div class="col-6 animate__animated animate__zoomIn    ">
                                @if ($product->in_stock > 0)
                                    <button type="button" wire:click="orderNow"
                                        class="btn btn-order order_now text-white p-3 w-100 btn-buy">
                                        {{ __('messages.order_now') }}
                                    </button>
                                @endif
                            </div>
                            <div class="col-6">
                                @if ($product->in_stock > 0)
                                    <button type="button" wire:click="addToCart({{ $product->id }})"
                                        class="btn btn-order text-white p-3 w-100 btn-buy">
                                        {{ __('messages.Add to Cart') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

    {{-- Customer Review --}}
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <h3 class="text-center mb-4">{{ __('messages.customer_review') }}</h3>

                <div class="card shadow-lg p-2 border-0">
                    <div class="card-body p-0">

                        <div class="reviews-list">
                            @forelse ($reviewes as $review)
                                <div
                                    class="review-item d-flex justify-content-between align-items-start px-3 py-3 border-bottom">
                                    <div class="me-3 review-meta">
                                        <h6 class="mb-1 fw-semibold">
                                            {{ $review->customer_name ?? __('messages.guest') }}
                                        </h6>
                                        <small class="text-muted">
                                            {{ optional($review->created_at)->format('d M Y') ?? '' }}
                                        </small>
                                    </div>

                                    <div class="text-end ms-auto" style="min-width:120px">
                                        @php
                                            $rate = (int) ($review->rate ?? 0);
                                        @endphp
                                        <div class="mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i
                                                    class="fa-solid fa-star {{ $i <= $rate ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                        </div>
                                        <p class="card-text text-secondary mb-0 review-desc">
                                            {{ $review->description }}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <p class="text-muted mb-0">{{ __('messages.no_reviews_yet') }}</p>
                                </div>
                            @endforelse
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">

                <div class="CustomerReview   pt-3"  id="reviews">
                    @if (session('success-review'))
                        <div class="alert alert-success">
                            {{ session('success-review') }}
                        </div>
                    @endif
                    @php
                    @endphp
                    <div class="">
                        <div class="row justify-content-center">
                            <div class="">
                                <div class="content mx-auto text-center">

                                    <div class="bottom  justify-content-between align-items-center flex-wrap mt-4">
                                        <div class="rightSide">
                                            <h6 class="text-dark">{{ number_format($averageRating, 1) }}
                                                {{ __('messages.out_of_5') }}</h6>
                                            <div class="stars">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fa-solid fa-star {{ $i <= $averageRating ? 'text-warning' : 'text-muted' }}"></i>
                                                @endfor
                                            </div>
                                            <p class="text-dark">{{ $reviewCount }} {{ __('messages.reviews') }}</p>
                                        </div>

                                    </div>
                                    <div class="GiveRate mt-4">
                                        <h4 class="text-dark">{{ __('messages.rate_prompt') }}</h4>
                                        <div class="star-container d-flex justify-content-center">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <a class="star mx-1" data-rating="{{ $i }}"
                                                    style="cursor: pointer;">
                                                    <i class="fa-solid fa-star text-muted "></i>
                                                </a>
                                            @endfor
                                        </div>
                                    </div>
                                    <form action="{{ route('site.reviews.store', $product->id) }}" method="POST"
                                        class="mt-4">
                                        @csrf
                                        {{-- <input type="hidden" name="reviewable_id" value="{{ $product->id }}">
                            <input type="hidden" name="reviewable_type" value="App\Models\Product"> --}}
                                        <input type="hidden" name="rating" id="rating" value="0">
                                        <div class="RateForm">
                                            <div class="row">
                                                <div class="col-12 col-lg-6 mb-3">
                                                    <div class="Name d-flex flex-column align-items-start w-100">
                                                        <label for="name">{{ __('messages.name') }}</label>
                                                        <input type="text" name="name" id="name"
                                                            class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-6 mb-3">
                                                    <div class="Email d-flex flex-column align-items-start w-100">
                                                        <label for="email">{{ __('messages.email') }}</label>
                                                        <input type="email" name="email" id="email"
                                                            class="form-control" required />
                                                        <span>{{ __('messages.email_privacy') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="comment d-flex flex-column align-items-start mb-3">
                                                <label for="comment">{{ __('messages.leave_review') }}</label>
                                                <textarea name="comment" id="comment" class="form-control" rows="4" required></textarea>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-dark w-100">{{ __('messages.submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- cart modal --}}
    <div class="modal fade @if ($show_modal) show @endif"
        @if ($show_modal) style="display: block;" @endif id="cartModal" tabindex="-1"
        aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #431934; color: white;">
                    <button type="button" wire:click="closeModal" class="btn-close btn-close-white text-end"
                        data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <p>{{ __('messages.Product added to cart') }}</p>
                </div>
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">
                        {{ __('messages.Continue') }}
                    </button>
                    <a href="{{ route('site.cart') }}" class="btn btn-primary"
                        style="background-color: #431934; border: none;">{{ __('messages.Go to Cart') }}</a>


                </div>
            </div>
        </div>
    </div>

    <!-- Make Your Order Prettier Section -->
    <div class="mostSalling my-5">
        <div class="container">
            <div class="title mb-3">
                <h2 class="m-0 p-3">
                    {{ app()->getLocale() == 'ar' ? 'اجعل طلبك أجمل ' : 'Make Your Order Prettier' }}
                </h2>
            </div>
            <div class="Content text-center">
                <div wire:ignore class="swiper MostSellingSwiper PlanteSwiper">
                    <div class="swiper-wrapper">
                        @forelse ($productsShowInCart as $product)
                            <div class="swiper-slide">
                                <div class="SingleCell mb-0">
                                    <a href="{{ route('site.products.show', $product->id) }}">
                                        <img src="{{ $product->pathInView() }}" class="img-fluid p-2"
                                            alt="{{ $product->transNow?->title ?? 'No Title Available' }}">
                                    </a>
                                    <div class="fixed-height">
                                        <h3 class="text-center">
                                            {{ $product->transNow?->title ?? 'No Title Available' }}
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
                                                <span class="text-danger main-color">
                                                    {{ number_format($product->price, 2) }} EGP

                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="text-center">
                                        <button wire:click="addToCart({{ $product->id }})"
                                            class="btn w-100 m-auto text-white main-color-bg">
                                            {{ __('messages.Add to Cart') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <p>
                                    {{ app()->getLocale() == 'ar' ? 'لا يوجد منتجات متاحة' : 'No products available' }}
                                </p>
                            </div>
                        @endforelse
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Similar Products --}}
    <div class="mostSalling my-5">
        <div class="container">
            <div class="title mb-3">
                <h2 class="m-0 p-3">
                    {{ app()->getLocale() == 'ar' ? ' منتجات مشابهة' : ' Similar products' }}
                </h2>
            </div>
            <div class="Content text-center">
                <div class="swiper MostSellingSwiper PlanteSwiper">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">

                        <!-- Slides -->
                        @forelse ($similarProducts as $similarProduct)
                            <div class="swiper-slide">
                                <div class="SingleCell py-3 mb-0">
                                    {{-- <div class="avaible d-flex align-items-center justify-content-end">
                                        <div class="dot {{ $similarProduct->in_stock ? 'bg-success' : 'bg-danger' }}">
                                        </div>
                                        <span class="mb-2 mx-1">
                                            {{ $similarProduct->in_stock ? 'in stock' : 'out of stock' }}
                                        </span>
                                    </div> --}}
                                    <div class="px-2 avaible d-flex align-items-center justify-content-start">
                                        <div class="dot {{ $similarProduct->in_stock ? 'bg-success' : 'bg-danger' }}">
                                        </div>
                                        <span
                                            class="mb-2 mx-1 {{ $similarProduct->in_stock ? 'text-success' : 'text-danger' }}">
                                            {{ $similarProduct->in_stock ? trans('in stock') : trans('out of stock') }}
                                        </span>
                                    </div>
                                    <a href="{{ route('site.products.show', $similarProduct->id) }}">
                                        <img src="{{ asset($similarProduct->pathInView()) }}" class="img-fluid p-2"
                                            alt="{{ $similarProduct->transNow?->title ?? 'No Title Available' }}">
                                    </a>
                                    <div class="fixed-height">
                                        <h3 class="text-center">
                                            {{ $similarProduct->transNow?->title ?? 'No Title Available' }}</h3>
                                        <p class="text-center">
                                            @if ($similarProduct->price_after_sale !== $similarProduct->price)
                                                <span class="text-danger main-color">
                                                    {{ number_format($similarProduct->price_after_sale, 2) }} EGP
                                                </span>
                                                <span class="text-danger text-decoration-line-through">
                                                    {{ number_format($similarProduct->price, 2) }} EGP
                                                </span>
                                            @else
                                                <span class="text-danger main-color">
                                                    {{ number_format($similarProduct->price, 2) }} EGP

                                                </span>
                                            @endif
                                        </p>
                                        {{-- <div class="rate text-center">
                                            @php
                                                $averageRating = $similarProduct->average_rating;
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
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <p>
                                    {{ app()->getLocale() == 'ar' ? 'لا يوجد منتجات متاحة' : 'No products available' }}
                                </p>
                            </div>
                        @endforelse
                    </div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev other-product "></div>
                    <div class="swiper-button-next other-product"></div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('site.shop', ['best_offer' => 1, 'sort' => 'best_offer']) }}"
                    class="btn btn-primary border-0" style="background-color:#431934;">
                    {{ app()->getLocale() == 'ar' ? 'عرض المزيد' : 'View More' }}
                </a>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');

            stars.forEach((star, index) => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    ratingInput.value = rating;

                    stars.forEach((s, i) => {
                        if (i < rating) {
                            s.querySelector('i').classList.add('text-warning');
                            s.querySelector('i').classList.remove('text-muted');
                        } else {
                            s.querySelector('i').classList.add('text-muted');
                            s.querySelector('i').classList.remove('text-warning');
                        }
                    });
                });
            });
        });
    </script>
</div>

<style>
    .img-zoom-container {
        position: relative;
        display: inline-block;
    }

    .img-zoom-container img {
        display: block;
        max-width: 100%;
    }

    .zoom-window {
        display: none;
        position: absolute;
        border: 1px solid #ccc;
        width: 550px;
        height: 550px;
        overflow: hidden;
        top: 0;
        left: 0%;
        background-repeat: no-repeat;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
        z-index: 1100;
        pointer-events: none;
    }

    @media (max-width: 767px) {
        .zoom-window {
            width: 100vw;
            height: 100vw;
            left: 0;
            top: 0;
            background-size: cover;
        }
    }

    @media (max-width: 576px) {
        .card .card-body {

            height: 50% !important;
            align-items: normal !important;
        }
    }
</style>
<style>
    :root {
        --review-item-height: 110px;
    }


    .reviews-list {
        max-height: calc(var(--review-item-height) * 5);
        overflow-y: auto;
        scroll-behavior: smooth;
    }


    .review-item {


        align-items: flex-start;
    }

    .review-desc {

        white-space: normal;
        text-align: left;
    }


    .reviews-list::-webkit-scrollbar {
        width: 8px;
    }

    .reviews-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .reviews-list::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.12);
        border-radius: 8px;
    }


    @media (max-width: 767px) {
        :root {
            --review-item-height: 120px;
        }

        .reviews-list {
            max-height: calc(var(--review-item-height) * 4);
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const zoomFactor = 2.0;

        function setupZoom(img, zoomWin) {
            zoomWin.style.backgroundImage = `url('${img.src}')`;
            zoomWin.style.backgroundSize =
                `${img.naturalWidth * zoomFactor}px ${img.naturalHeight * zoomFactor}px`;

            img.addEventListener('mouseenter', () => zoomWin.style.display = 'block');
            img.addEventListener('mouseleave', () => zoomWin.style.display = 'none');
            img.addEventListener('mousemove', (e) => moveHandler(e, img, zoomWin));

            img.addEventListener('touchstart', (e) => {
                zoomWin.style.display = 'block';
                e.preventDefault();
            }, {
                passive: true
            });
            img.addEventListener('touchmove', (e) => moveHandler(e, img, zoomWin), {
                passive: true
            });
            img.addEventListener('touchend', () => zoomWin.style.display = 'none');
        }

        function moveHandler(e, img, zoomWin) {
            const point = e.touches ? e.touches[0] : e;
            const imgRect = img.getBoundingClientRect();
            let x = point.clientX - imgRect.left;
            let y = point.clientY - imgRect.top;
            if (x < 0 || y < 0 || x > imgRect.width || y > imgRect.height) {
                zoomWin.style.display = 'none';
                return;
            }
            zoomWin.style.display = 'block';

            const rx = img.naturalWidth / imgRect.width;
            const ry = img.naturalHeight / imgRect.height;
            const nx = x * rx,
                ny = y * ry;
            const winW = zoomWin.clientWidth,
                winH = zoomWin.clientHeight;
            const bgX = -(nx * zoomFactor - winW / 2);
            const bgY = -(ny * zoomFactor - winH / 2);
            zoomWin.style.backgroundPosition = `${bgX}px ${bgY}px`;
        }

        function applyZoomToImages() {
            const images = document.querySelectorAll('.zoomable-image');
            images.forEach(img => {
                const zoomWin = img.parentElement.querySelector('.zoom-window');
                if (img.complete) {
                    setupZoom(img, zoomWin);
                } else {
                    img.addEventListener('load', () => setupZoom(img, zoomWin));
                }
            });
        }

        applyZoomToImages();

        function initSwiper() {
            return new Swiper('.prodect', {
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                loop: true,
            });
        }

        let swiper = initSwiper();

        document.addEventListener('selectedPocketChanged', function() {
            if (swiper) {
                swiper.destroy();
            }
            swiper = initSwiper();
            applyZoomToImages();
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function initSwiper() {
            return new Swiper('.prodect', {
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                loop: true,
            });
        }

        let swiper = initSwiper();

        document.addEventListener('selectedPocketChanged', function() {
            if (swiper) {
                swiper.destroy();
            }
            swiper = initSwiper();
        });
    });
</script>

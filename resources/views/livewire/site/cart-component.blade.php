<div class="Cart cart-product pt-5">
    <div class="container pt-5">
        <div class="row">
            <h2 class="mt-3">{{ __('messages.cart_title') }}</h2>
            @if (session('success'))
                <div class="alert alert-success p-5">
                    {{ session('success') }}
                </div>
            @endif

            <div class="ItemsBox rounded-3 mt-4 p-4">
                @if ($carts->isEmpty())
                       <p class="text-center cart-tittle  fs-4">{{ __('messages.empty_cart') }}</p>
                    <div class="text-center">
                        <a href="{{ route('site.shop') }}" class="btn cart-btn px-5 p-3 main-color-bg border-0 btn-primary">
                            {{ __('messages.shop_now') }}
                        </a>
                    </div>
                @else
                    @foreach ($carts as $cart)
                        <div
                            class="SingleItem d-flex my-3 align-items-center justify-content-between pb-3 flex-column flex-md-row">

                            <div class="ImgBox">
                                @if ($cart->product && $cart->product->image)
                                    <img src="{{ asset($cart->product->pathInView()) }}" class="img-fluid"
                                        alt="{{ $cart->product_name }}">
                                @else
                                    <img src="{{ asset('attachments/no_image/no_image.png') }}" class="img-fluid"
                                        alt="{{ $cart->product_name }}">
                                @endif
                            </div>

                            <h5>
                                {{ $cart->product_name }}
                                @if ($cart->pocket)
                                    <p class="text-muted text-center">
                                        {{ $cart->pocket->pocket_name }}
                                    </p>
                                @endif
                            </h5>

                            <p>{{ number_format($cart->price, 2) }} EGP</p>


                            @if ($cart->user_input != '')
                                
                                    <p>
                                <strong>{{ __('messages.entered_chars') }}:</strong>
                                {{ $cart->user_input }}
                            </p>
                            @endif
                        

                            <div class="d-flex align-items-center">
                                <button type="button" wire:click="decreaseQuantity({{ $cart->id }})"
                                    class="btn btn-sm btn-secondary">-</button>

                                @php
                                    $countChars = $cart->user_input
                                        ? mb_strlen(preg_replace('/\s+/', '', $cart->user_input))
                                        : $cart->quantity;
                                @endphp
                                <span class="mx-2">{{ $countChars }}</span>

                                <button type="button" wire:click="increaseQuantity({{ $cart->id }})"
                                    class="btn btn-sm btn-secondary">+</button>
                            </div>

                            <p>{{ __('messages.product_price') }}: {{ number_format($cart->total_price, 2) }} EGP</p>

                            <div class="icon">
                                <form action="{{ route('site.cart.destroy', $cart->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link p-0">
                                        <i class="fa-solid fa-trash fs-3 text-danger"></i>
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach

                    <form method="GET" action="{{ route('site.checkout') }}">
                        <div class="delivery-options mt-4 w-25">
                            <h5>{{ __('messages.delivery_options') }}</h5>

                            <div class="border p-2 rounded mb-2 input-delivery">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ __('messages.same_day_delivery') }}</span>
                                    <input class="form-check-input" type="radio" name="delivery_option" id="sameDay"
                                        value="same_day" checked>
                                </div>
                            </div>

                            <div class="border p-2 rounded mb-2 input-delivery">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>{{ __('messages.schedule_delivery') }}</span>
                                    <input class="form-check-input" type="radio" name="delivery_option"
                                        id="scheduleDelivery" value="schedule">
                                </div>
                            </div>

                            <div id="scheduleFields" style="display: none;" class="mt-3">
                                <div class="form-group mb-2 input-delivery">
                                    <label for="deliveryDate">{{ __('messages.delivery_date') }}</label>
                                    <input type="date" class="form-control" id="deliveryDate" name="delivery_date">
                                </div>
                                <div class="form-group mb-2 input-delivery">
                                    <label for="deliveryTime">{{ __('messages.delivery_time') }}</label>
                                    <input type="time" class="form-control" id="deliveryTime" name="delivery_time">
                                </div>
                            </div>
                        </div>

                        <div class="totalBox mt-4">
                            <div class="info d-flex justify-content-between align-items-center">

                                <a class="text-decoration-none text-muted" href="{{ route('site.shop') }}">
                                    {{ __('messages.continue_shopping') }}
                                </a>
                            </div>
                            <div class="price mt-3">
                                <h5 class="mb-0">{{ __('messages.total_price') }}</h5>
                                <h4 class="p-3">{{ number_format($total, 2) }} EGP</h4>
                                <button type="submit" class="btn btn-order w-25">
                                    {{ __('messages.order_now') }}
                                </button>
                            </div>
                        </div>
                    </form>

                @endif
            </div>

            <!--cart product-->
            <div class="mostSalling my-5">
                <div class="container">
                    <div class="title mb-3">
                        <h2 class="m-0 p-3">
                            {{ app()->getLocale() == 'ar' ? 'اجعل طلبك أجمل ' : 'Make Your Order Prettier' }}
                        </h2>
                    </div>
                    <div class="Content text-center">
                        <div wire:ignore class="swiper MostSellingSwiper PlanteSwiper">
                            <!-- Additional required wrapper -->
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
                                                <p class="text-center main-color">
                                                    {{ number_format($product->price, 2) }} EGP
                                                </p>
                                            </div>
                                            <div class="text-center">
                                                <button wire:click="addToCart({{ $product->id }})"
                                                    class="btn w-100 m-auto text-white"
                                                    style="background-color:#431934; border-top-left-radius: 0; border-top-right-radius: 0;">
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


                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>


                </div>
            </div>
            <!--cart product-->


        </div>
    </div>
</div>

<script>
    document.querySelectorAll('input[name="delivery_option"]').forEach(function(radio) {
        radio.addEventListener('change', function() {
            var scheduleFields = document.getElementById('scheduleFields');
            scheduleFields.style.display = (this.value === 'schedule') ? 'block' : 'none';
        });
    });
</script>

<style>
    .swiper-button-prev,
    .swiper-button-next {
        color: #431934 !important;
    }
    .cart-btn{
        padding: 20px 90px !important;
        font-size: 20px !important;
    }
    .cart-btn:hover {
        
        background-color: #6d1d50 !important;
        color: #fff !important;
        
    }
    @media screen and (max-width: 768px) {
        .cart-btn {
            padding: 10px 30px !important;
            font-size: 16px !important;
        }
        .cart-tittle {
            font-size: 20px !important;
        }
        
    }
</style>

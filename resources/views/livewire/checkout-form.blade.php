<form wire:submit.prevent="submit">
    <div class="row">
        <div class="col-12 col-lg-6 Order_info border-start p-3 mt-5">
            <!-- Sender Info -->
            @include('site.layouts.message')
            @error('delivery_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            @error('delivery_time')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="Sender_info mb-4">
                <h4>{{ __('messages.sender_details') }}</h4>
                <input type="email" wire:model="sender_email" class="form-control p-3" placeholder="{{ __('messages.email') }}">
                @error('sender_email')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="send_offers" id="sendOffers">
                    <label class="form-check-label" for="sendOffers">
                        {{ __('messages.send_offers') }}
                    </label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="hide_my_name" id="hideName">
                    <label class="form-check-label" for="hideName">
                        {{ __('messages.hide_name') }}
                    </label>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <input type="text" wire:model="sender_name" required class="form-control p-3 w-50" placeholder="{{ __('messages.name') }}">
                    <input type="tel" wire:model="sender_mobile" required class="form-control p-3 w-50 me-2" placeholder="{{ __('messages.mobile') }}">
                </div>
                @error('sender_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('sender_mobile')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Recipient Info -->
            <div class="resciver_info mb-4">
                <h4>{{ __('messages.recipient_details') }}</h4>
                <div class="d-flex justify-content-between mt-3">
                    <input type="text" wire:model="recipient_first_name" class="form-control p-3 w-50" placeholder="{{ __('messages.first_name') }}">
                    <input type="text" wire:model="recipient_last_name" class="form-control p-3 w-50 me-2" placeholder="{{ __('messages.last_name') }}">
                </div>
                @error('recipient_first_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                @error('recipient_last_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <input type="tel" wire:model="recipient_mobile" class="form-control mb-3 p-3 mt-3" placeholder="{{ __('messages.mobile') }}">
                @error('recipient_mobile')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <h4>{{ __('messages.recipient_address') }}</h4>
                <input type="text" wire:model="st_name" required class="form-control mb-3 p-3 mt-3" placeholder="{{ __('messages.street_name') }}">
                @error('st_name')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <input type="text" wire:model="apartment" required class="form-control mb-3 p-3 mt-3" placeholder="{{ __('messages.apartment') }}">
                @error('apartment')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <input type="text" wire:model="floor" required class="form-control mb-3 p-3 mt-3" placeholder="{{ __('messages.floor') }}">
                @error('floor')
                <span class="text-danger">{{ $message }}</span>
                @enderror

                <input type="text" wire:model="area" required class="form-control mb-3 p-3 mt-3" placeholder="{{ __('messages.area') }}">
                @error('area')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Greeting Card -->
            <div class="OtherInfo mt-4">
                <h5>{{ __('messages.greeting_card') }}</h5>
                <textarea wire:model="greeting_card" class="form-control mt-3" placeholder="{{ __('messages.greeting_card') }}"></textarea>
            </div>

            <!-- Extra Instructions -->
            <div class="OtherInfo mt-4">
                <h5>{{ __('messages.extra_instructions') }}</h5>
                <textarea wire:model="extra_instructions" class="form-control mt-3" placeholder="{{ __('messages.extra_instructions') }}"></textarea>
            </div>

            <!-- Payment Methods -->
            <div class="payment pt-4 mb-4"> 
                <div class="title">
                    <h4>{{ __('messages.payment_methods') }}</h4>
                    <p>To proceed with your order, please complete the payment using one of the methods below and send us a screenshot of the transaction via WhatsApp: <a class="text-decoration-none" href="https://wa.me/201222167048" target="_blank"> (Opens in WhatsApp)</a>, along with your order number.</p>
                </div>
                <div class="paymentMethod mt-4">
                    <div class="accordion" id="accordionExample" wire:ignore>
                        @foreach ($paymentMethods as $index => $paymentMethod)
                        @php
                        $methodName = strtolower($paymentMethod->unique_name);
                        @endphp
                        <div class="accordion-item">
                            <h2 class="accordion-header" onclick="selectRadio('flexRadioDefault{{ $index }}')">
                                <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" wire:click="selectPaymentMethod('{{ $methodName}}')" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                    <input class="form-check-input payment-radio" required type="radio" name="payment_method" id="flexRadioDefault{{ $index }}" value="{{ $methodName }}" {{ $index == 0 ? 'checked' : '' }} wire:model="payment_method">
                                    <label class="form-check-label" for="flexRadioDefault{{ $index }}">
                                        {{ $paymentMethod->transNow->title }}
                                    </label>
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="content d-flex flex-column align-items-center justify-content-center">
                                        <div class="text text-center d-flex flex-column align-items-center justify-content-center">
                                            @if ($methodName == 'instapay')
                                            <p>{{ __('messages.click_here_to_pay') }}</p>
                                            <button class="btn btn-primary main-color-bg  border-0 w-50">
                                                <a class="text-white text-decoration-none" href="https://ipn.eg/S/daliaelhaggar/instapay/73pEWj" target="_blank">
                                                    {{ __('messages.insta_pay') }}
                                                </a></button>


                                            <img src="{{ asset($paymentMethod->path() . $paymentMethod->qr_image)  }}" alt="{{ $paymentMethod->transNow->title }}" class="img-fluid mb-3 mt-3" style="width: 150px; height: 200px;">
                                            @else
                                            <h5>{{ $paymentMethod->user_name }}</h5>
                                            @endif

                                            <h5>{{ $paymentMethod->number }}</h5>
                                            <p class="mx-auto">{!! $paymentMethod->transNow->description !!}</p>
                                            @if (in_array($methodName, ['instapay', 'orange_cash']))
                                            <div class="form-group mt-3">
                                                <label for="receipt_image">{{ __('messages.upload_receipt') }}</label>
                                                <input type="file" wire:model="receipt_image" class="form-control" id="receipt_image" accept="image/*">
                                                @error('receipt_image')
                                                0 @enderror
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <input type="hidden" wire:model="delivery_option">
            @if ($delivery_option === 'schedule')
            <input type="hidden" wire:model="delivery_date">
            <input type="hidden" wire:model="delivery_time">
            @endif
        </div>

        <div class="col-12 col-lg-6 p-3 mt-5">
            <div class="product-items mb-4">
                @foreach ($carts as $cart)
                <div class="product-item d-flex align-items-center justify-content-between mb-3">
                    <div class="product-details flex-grow-1 ms-3">
                        <div class="product-name">{{ $cart->product_name }}</div>
                        <div class="product-price">{{ number_format($cart->price, 2) }} {{ __('messages.currency') }}</div>
                    </div>
                    <img src="{{ $cart->product->pathInView() }}" class="img-fluid rounded-circle" style="width: 50px; height: 50px;" alt="{{ $cart->product_name }}">
                </div>
                @endforeach
            </div>

            <div class="delivery-info mb-4">
                <h4>{{ __('messages.delivery_info') }}</h4>
                @if ($delivery_option === 'same_day')
                <p>{{ __('messages.delivery_today') }}</p>
                @else
                <p>{{ __('messages.delivery_on') }} {{ $delivery_date }} {{ __('messages.at') }} {{ $delivery_time }}</p>
                @endif
            </div>

            <div class="mb-4">
                @livewire('apply-coupon', [
                'subtotal' => $subtotal,
                'shippingCost' => $shippingCost,
                'taxRate' => $taxRate,
                'carts' => $carts->toArray(),
                ])
            </div>

            <button type="submit" class="btn border-0 btn-primary main-color-bg mt-3 p-2 w-100">
                {{ __('messages.complete_order') }}
            </button>
        </div>
    </div>
</form>

<script>
    function selectRadio(radioId) {
        document.getElementById(radioId).click();
    }

</script>

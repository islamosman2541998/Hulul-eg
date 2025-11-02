<div>
    <div class="mb-3">
        <label>{{ __('messages.area') }}</label>
        <select wire:model="governorate" class="form-select" required>
            <option value="">-- @lang('select') --</option>
            <option value="Downtown">{{ __('messages.Downtown') }}</option>
            <option value="Zamalek">{{ __('messages.Zamalek') }}</option>
            <option value="Garden_City">{{ __('messages.Garden_City') }}</option>
            <option value="ElManial">{{ __('messages.ElManial') }}</option>
            <option value="Nasr_City">{{ __('messages.Nasr_City') }}</option>
            <option value="Heliopolis">{{ __('messages.Heliopolis') }}</option>
            <option value="Abbassia">{{ __('messages.Abbassia') }}</option>
            <option value="Roxy">{{ __('messages.Roxy') }}</option>
            <option value="ElNozha">{{ __('messages.ElNozha') }}</option>
            <option value="Sheraton">{{ __('messages.Sheraton') }}</option>
            <option value="Shubra">{{ __('messages.Shubra') }}</option>
            <option value="Maadi">{{ __('messages.Maadi') }}</option>
            <option value="Helwan">{{ __('messages.Helwan') }}</option>
            <option value="ElRehab">{{ __('messages.ElRehab') }}</option>
            <option value="Madinaty">{{ __('messages.Madinaty') }}</option>
            <option value="The_fifth_settlement">{{ __('messages.The_fifth_settlement') }}</option>
            <option value="Giza">{{ __('messages.Giza') }}</option>
            <option value="Dokki">{{ __('messages.Dokki') }}</option>
            <option value="Mohandessin">{{ __('messages.Mohandessin') }}</option>
            <option value="Agouza">{{ __('messages.Agouza') }}</option>
            <option value="Imbaba">{{ __('messages.Imbaba') }}</option>
            <option value="Faisal">{{ __('messages.Faisal') }}</option>
            <option value="6th_of_October_City">{{ __('messages.6th_of_October_City') }}</option>
            <option value="Sheikh_Zayed">{{ __('messages.Sheikh_Zayed') }}</option>
            <option value="Haram">{{ __('messages.Haram') }}</option>
        </select>
    </div>
    <input type="hidden" name="governorate" value="{{ $governorate }}">

    <div class="input-group mb-3">
        <input type="text" wire:model.defer="code" class="form-control" placeholder=" {{ __('messages.enter_coupon_code') }}">
        <button type="button" class="btn btn-outline-secondary" wire:click="applyCode">{{ __('messages.apply') }}</button>
        
    </div>

    @if ($message)
        <div class="alert alert-info">{{ $message }}</div>
    @endif

    <div class="mb-2 d-flex justify-content-between">
        <span>{{ __('messages.subtotal') }}</span>
        <span>{{ number_format($subtotal, 2) }} {{ __('messages.currency') }}</span>
    </div>
    <div class="mb-2 d-flex justify-content-between">
        <span>{{ __('messages.discount') }}</span>
        <span>- {{ number_format($discountAmount, 2) }} {{ __('messages.currency') }}</span>
    </div>
    <div class="mb-2 d-flex justify-content-between">
        <span> {{ __('messages.shipping') }} {{ $governorate }}:</span>
        <span>{{ number_format($shippingCost, 2) }} {{ __('messages.currency') }}</span>
    </div>
    {{-- <div class="mb-2 d-flex justify-content-between">
        <span>{{ __('messages.tax') }}</span>
        <span>{{ number_format($taxAmount, 2) }} {{ __('messages.currency') }}</span>
    </div> --}}
    <hr>
    
    <div class="d-flex justify-content-between fw-bold">
        <span>{{ __('messages.total') }}</span>
        <span>{{ number_format($finalTotal, 2) }} {{ __('messages.currency') }}</span>
    </div>
</div>

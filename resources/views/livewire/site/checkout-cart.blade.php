<div class="col-12 col-lg-6 total_Price p-3 mt-5">
    <div class="product-items">
        @foreach($carts as $cart)
            <div class="product-item d-flex align-items-center justify-content-between mb-3">
                <button class="btn btn-link text-danger p-0" wire:click="remove({{ $cart->id }})">
                    <i class="fa fa-trash"></i>
                </button>
                <div class="quantity-controls d-flex align-items-center">
                    <button class="btn btn-outline-secondary btn-sm" wire:click="decrement({{ $cart->id }})">-</button>
                    <input type="number" class="form-control mx-2 text-center bg-purple text-white" 
                        style="width: 60px;" value="{{ $cart->quantity }}" min="1" readonly>
                    <button class="btn btn-outline-secondary btn-sm" wire:click="increment({{ $cart->id }})">+</button>
                </div>
              
                
            </div>
        @endforeach
    </div>

</div>

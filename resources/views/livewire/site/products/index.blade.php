<div>
    <div class="row category text-center d-flex justify-content-center">
        <div class="faq-controls controls d-flex justify-content-center">
            <span class="chip  {{ $selectedCategory == 0 ? 'active': '' }}" data-tag="@lang('All')" wire:click="changeCategory(0)"> @lang('All')</span>
            @forelse ($categories as $category)
                <span class="chip {{ $selectedCategory == $category->id ? 'active': '' }}" data-tag="{{ $category->transNow->title }}" wire:click="changeCategory({{ $category->id }})"> {{ $category->transNow->title }} </span>
            @empty
            @endforelse
        </div>
    </div>


    <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
        @forelse ($products as $key => $product)
            <div class="col wow bounceInUp" style="animation-delay: 0.{{ ($key + 1) }}s;">
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

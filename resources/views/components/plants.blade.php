<div class="plants my-4">
    <div class="container">
        <div class="title mb-3">
            <h2 class="m-0 p-3 text-right" style="color: rgb(255, 255, 255);">{{ app()->getLocale() == 'ar' ? 'نباتات' : 'Plants' }}</h2>
        </div>
        <div class="row text-center">
            @forelse ($plantProducts as $product)
                <div class="col-12 col-lg-3 SingleCell py-3 mb-3">
                    <a href="{{ route('products.show', $product->id) }}" target="_blank" class="text-decoration-none">
                        <div class="avaible d-flex align-items-center justify-content-end">
                            <div class="dot {{ $product->in_stock ? 'bg-success' : 'bg-danger' }}"></div>
                            <span class="mb-2 mx-1">{{ $product->in_stock ? 'available' : 'unavailable ' }}</span>
                        </div>
                        <img src="{{ asset($product->pathInView()) }}" class="img-fluid" alt="{{ $product->transNow ? $product->transNow->title : 'غير متوفر' }}" style="height: 200px; object-fit: cover;">
                        <h3 class="text-center mt-3">{{ $product->transNow ? $product->transNow->title : 'غير متوفر' }}</h3>
                        <p class="text-center">
                            @if ($product->price_after_sale)
                                <span class="text-danger">{{ number_format($product->price_after_sale, 2) }} EGP</span>
                                <span class="text-muted text-decoration-line-through mx-2">{{ number_format($product->price, 2) }} EGP</span>
                            @else
                                {{ number_format($product->price, 2) }} EGP
                            @endif
                        </p>
                        <div class="rate text-center">
                            @php
                                $averageRating = $product->average_rating;
                                $filledStars = floor($averageRating);
                                $hasHalfStar = $averageRating - $filledStars >= 0.5;
                            @endphp
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $filledStars ? 'text-warning' : ($i == $filledStars + 1 && $hasHalfStar ? 'text-warning half' : 'text-secondary') }}"></i>
                            @endfor
                            <span class="text-muted">({{ number_format($averageRating, 1) }})</span>
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-center">{{ app()->getLocale() == 'ar' ? 'لا يوجد نباتات متاحة' : 'No plants available' }}</p>
            @endforelse
            <div class="Btns text-start px-5">
                <a href="#" class="btn btn-more px-0 mx-auto">
                    {{ app()->getLocale() == 'ar' ? 'المزيد' : 'More' }}
                </a>
            </div>
        </div>
    </div>
</div>


@extends('site.app')

@section('title', @$category->transNow->meta_title  )
@section('meta_key', @$category->transNow->meta_key )
@section('meta_description', @$category->transNow->meta_desc )


@section('content')
<section class="products-section hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="row">
            <div class="col-md-6 col-12">
                <h1 class="mb-3 p-3">{{ @$category->transNow->title }}</h1>
                <div class="blog-description  p-3">
                    {!! @$category->transNow->description !!}
                </div>
            </div>
            <div class="col-md-6 col-12">
                @if($category->image)
                <img src="{{ asset($category->path() . $category->image) }}" class="rounded p-3" styl alt="{{ @$category->transNow->title }}">
                @endif
            </div>
        </div>
    </div>
</section>

<section class="products-section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">@lang('messages.Our Products')</h2>
        </div>
        <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
            @forelse ($category->products as $product)
                <div class="col">
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
</section>
@endsection
<style>
    .blog-page {
        margin-top: 140px;
    }

</style>
<style>
    .hero {
        margin-top: 70px !important;
    }

</style>

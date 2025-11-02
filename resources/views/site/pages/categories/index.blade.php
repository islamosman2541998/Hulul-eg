@extends('site.app')

@section('title', @$metaSetting->where('key', 'categories_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'categories_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'categories_meta_description_' . $current_lang)->first()->value)


@section('content')
     <!-- OUR PRODUCTS -->
<section class="products-section hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">@lang('Our Categories')</h2>
        </div>
        <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
            @forelse ($categories as $category)
                <a href="{{ route('site.categories.show', $category->transNow->slug) }}" class="text-decoration-none" aria-label="{{ $category->transNow->title }}">
                    <div class="card" style="background-color: transparent; box-shadow: none; border: none;">
                        <div class="mb-1">
                            <img src="{{ asset($category->path() . $category->image) }}" class="rounded" alt="{{ $category->transNow->title }}">
                        </div>
                        <div class="product-footer">
                            <div class="product-title">{{ $category->transNow->title }}</div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col text-center">
                    <p>{{ __('messages.no_category') }}</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
   

@endsection
<style>
    .hero{
        margin-top: 60px !important;
    }
</style>
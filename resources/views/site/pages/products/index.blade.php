@extends('site.app')


@section('title', @$metaSetting->where('key', 'product_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'product_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'product_meta_description_' . $current_lang)->first()->value)


@section('content')

<!-- OUR PRODUCTS -->
<section class="products-section hero wow fadeInDown" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        
        <div class="text-center mb-4">
            <h2 class="section-title">@lang('messages.Our Products')</h2>
            {{-- <p class="section-sub">@lang('messages.our_products')</p> --}}
        </div>

        @livewire('site.products.index', ['categories' => $categories])

       

    </div>
</section>


@endsection
<style>
    .hero {
        margin-top: 60px !important;
    }

</style>

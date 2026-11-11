@extends('site.app')

@section('title', @$metaSetting->where('key', 'portfolio_meta_title_' . $current_lang)->first()->value ?: __('site.our_portfolio'))
@section('meta_key', @$metaSetting->where('key', 'portfolio_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'portfolio_meta_description_' . $current_lang)->first()->value)

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-option spad w-100 h-50 set-bg" data-setbg="{{ webp_asset('site/img/111.jpeg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h1>@lang('site.our_portfolio')</h1>
                        <div class="breadcrumb__links">
                            <a href="{{ route('site.home') }}">Home</a>
                            <span>@lang('site.portfolio')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Portfolio Section -->
    <section class="portfolio spad">
        <div class="container">
            <livewire:site.portfolio-gallery />
        </div>
    </section>
<style>
    .portfolio {
    padding-top: 0px !important;
    padding-bottom: 100px;
}
  
</style>
@endsection
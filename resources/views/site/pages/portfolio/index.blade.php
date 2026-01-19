@extends('site.app') 

@section('content')

    <!-- Breadcrumb -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ asset('site/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>@lang('site.our_portfolio')</h2>
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
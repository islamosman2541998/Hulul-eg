@extends('site.app')

@section('title', @$metaSetting->where('key', 'offers_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'offers_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'offers_meta_description_' . $current_lang)->first()->value)

@section('content')

<!--Bath-->
<div class="bath py-3 ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('site.home') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            @lang('offers.offers')
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--Bath-->

<div class="best py-3 mt-5">
    <div class="container">
        <div class="row text-center">
            <h1 class="display-lg-3 w"> {{ @$offersInfo->trans->where('locale', $current_lang)->first()->title }} </h1>
            <h5 class="my-5 px-5 text-secound">
                {!! @$offersInfo->trans->where('locale', $current_lang)->first()->description !!}
            </h5>
        </div>
    </div>
</div>


<main class="services my-3">
    <!-- SERVICES SECTION START -->
    <div class="container">
        <section class="about wow animate__zoomIn">
            <div class="services-container">
                <div class="row w-100">
                    @forelse($offers as $key => $offer)
                    <div class="col-12 col-md-4 mb-4 mb-md-5 wow animate__zoomIn">
                        <a href="{{ route('site.offers.show', @$offer->id) }}"> 
                        <div class="services__card" style="background-image: url('{{ asset($offer->image) }}' )">
                                {{-- <h2 class="services__card-title heading--border-left"> {{ @$offer->trans->where('locale', $current_lang)->first()->title }}</h2>
                                <p class="services__card-content">
                                    {!! removeHTML(@$offer->trans->where('locale', $current_lang)->first()->description) !!} ..
                                </p> --}}
                            </div>
                        </a>
                        </div>
                    @empty
                    @endforelse


                    <div class="col-12 justify-content-center text-center" id="loadMore">
                        <a hx-get="{{ route('site.offers-more.loadMore', ['start' => 6, 'count' => 6]) }}" hx-indicator="#loading" hx-target="#loadMore" hx-swap="outerHTML" class="btn text-white  bg-success q me-3 px-5 my-5">@lang('SEE MORE')</a>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <!-- SERVICES SECTION END -->
</main>


<!--INFO-->
@include('site.components.info')
<!--INFO-->
@endsection

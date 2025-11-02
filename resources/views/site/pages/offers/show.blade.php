@extends('site.app')

@section('title', @$offer->trans->where('locale',$current_lang)->first()->meta_title)
@section('meta_key', @$offer->trans->where('locale',$current_lang)->first()->meta_key)
@section('meta_description', @$offer->trans->where('locale',$current_lang)->first()->meta_description)

@section('content')
<!--Bath-->
<div class="bath py-3 ">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('site.home') }}">@lang('Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('site.offers.index') }}"> @lang('offers.offers') </a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $offer->trans->where('locale',$current_lang)->first()->title }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!--Bath-->

<div class="container page my-5 rounded">
     <div class="row py-5">
        <div class="col-lg-8 col-12 text text-center wow bounceInLeft">
            <h1 class="text-main"> {{ @$offer->trans->where('locale', $current_lang)->first()->title }}</h1>
            <h5 class="my-5 px-5 text-secound">
                {!! @$offer->trans->where('locale', $current_lang)->first()->description !!}
            </h5>
            <a class="btn btn-success  me-lg-3 my-3 my-lg-0 px-5 text-white booking"  href="{{url(app()->getLocale() . '/booking')}}">@lang('Booking Now') </a>

        </div>
        <div class="col-lg-4 col-12 wow bounceInRight">
            <img src="{{ asset(@$offer->image) }}" class="img-fluid rounded" alt="">
        </div>
    </div>
</div>


<!--INFO-->
@include('site.components.info')
<!--INFO-->

@endsection

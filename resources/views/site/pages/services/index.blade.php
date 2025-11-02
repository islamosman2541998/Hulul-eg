@extends('site.app')

@section('title', @$metaSetting->where('key', 'services_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'services_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'services_meta_description_' . $current_lang)->first()->value)

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
                            @lang('services.services')
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
            <h1 class="display-lg-3 w"> {{ @$servicesInfo->trans->where('locale', $current_lang)->first()->title }} </h1>
            <h5 class="my-5 px-5  text-secound">
                {!! @$servicesInfo->trans->where('locale', $current_lang)->first()->description !!}
            </h5>
        </div>

        <div class="services mt-5">
            @forelse($services as $key => $service)
                @if(fmod($key, 2) == 0 )
                    <div class="row mb-5 wow bounceInLeft">
                        <div class="col-md-4">
                            <div class="services-img">
                                <img src="{{ asset($service->image) }}" class="img-fluid rounded" alt="about us">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="servicest__info px-5">
                                <h2 class="pt-5 text-main">
                                    <strong>
                                        {{ @$service->trans->where('locale', $current_lang)->first()->title }}
                                    </strong>
                                </h2>
                                <hr>
                                <p>
                                    {!! substr(@$service->trans->where('locale', $current_lang)->first()->description, 0, 350) !!} .. 
                                </p>
                                <a href="{{ route('site.services.show',  @$service->trans->where('locale', $current_lang)->first()->slug) }}" class="btn text-white bg-primary px-5"> 
                                    @lang('Show')
                                </a>
                            </div>
                        </div>
                    </div>
                @else 
                    <div class="row mb-5 wow bounceInRight">
                    
                        <div class="col-md-8">
                            <div class="servicest__info px-5">
                                <h2 class="pt-5 text-main">
                                    <strong>
                                        {{ @$service->trans->where('locale', $current_lang)->first()->title }}
                                    </strong>
                                </h2>
                                <hr>
                                <p> 
                                    {!! substr(@$service->trans->where('locale', $current_lang)->first()->description, 0, 350) !!} .. 
                                </p>
                                <a href="{{ route('site.services.show',  @$service->trans->where('locale', $current_lang)->first()->slug) }}" class="btn text-white bg-primary px-5"> 
                                    @lang('Show')
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="services-img">
                                <img src="{{ asset($service->image) }}" class="img-fluid rounded" alt="about us">
                            </div>
                        </div>
                    </div>
                @endif
            @empty
            @endforelse


            <div class="col-12 justify-content-center text-center" id="loadMore">
                <a hx-get="{{ route('site.services-more.loadMore', ['start' => 4, 'count' => 4]) }}" 
                    hx-indicator="#loading" hx-target="#loadMore" hx-swap="outerHTML" class="btn text-white  bg-success q me-3 px-5 my-5">@lang('SEE MORE')</a>
            </div>
            
        </div>
    </div>
</div>



<!--INFO-->
@include('site.components.info')
<!--INFO-->
@endsection

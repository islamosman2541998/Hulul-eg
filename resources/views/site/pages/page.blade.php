@extends('site.app')

@section('title', @$page->trans->where('locale',$current_lang)->first()->meta_title)
@section('meta_key', @$page->trans->where('locale',$current_lang)->first()->meta_key)
@section('meta_description', @$page->trans->where('locale',$current_lang)->first()->meta_description)

@section('content')


<div class="container page my-5 pt-5 rounded" @if(app()->getLocale() =="ar") dir="rtl" @else dir="ltr" @endif>
    <div class="row py-5">
        <div class="col-lg-6 col-12 text-center  wow bounceInLeft">
            <h1 class="text-main main-color"> {{ @$page->trans->where('locale', $current_lang)->first()->title }}</h1>
            <h5 class="my-5 px-5 text-muted">
                {!! @$page->trans->where('locale', $current_lang)->first()->content !!}
            </h5>
        </div>
        <div class="col-lg-6 col-12 text-center wow bounceInRight">
            <img src="{{ asset(@$page->image) }}" class="img-fluid rounded" alt="">
        </div>
    </div>
</div>




@endsection

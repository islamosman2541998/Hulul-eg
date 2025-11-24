@extends('site.app')

@section('title', @$metaSetting->where('key', 'home_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'home_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'home_meta_description_' . $current_lang)->first()->value)


@section('content')

    <!-- Slider -->
    <x-slider />

     <!-- services -->
    @include('site.pages.services')


     <!-- Portfolios -->
    @include('site.pages.Portfolios')


   <!-- About -->
    @include('site.pages.about')

    <!-- category -->
    @include('site.pages.product-categories')

    <!-- Products -->
    @include('site.pages.products')
    
    <!-- Jobs -->
    @include('site.pages.careere')

    <!-- Blogs -->
    @include('site.pages.blogs')

    <!-- our-partner -->
    @include('site.pages.our-partner')

    <!-- news -->
    @include('site.pages.news')

    <!-- contact us -->
    @include('site.pages.contact-us.home')

    <!-- Reviews -->
    <x-reviews :limit="10" />

    <!-- FAQ -->
    @include('site.pages.faq_questions')
    
@endsection

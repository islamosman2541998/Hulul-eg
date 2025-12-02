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

 <!-- statistics -->
    @include('site.pages.statistics')

    <!-- Blogs -->
    @include('site.pages.blogs')


    <!-- services_section -->
    @include('site.pages.services_section')


@endsection

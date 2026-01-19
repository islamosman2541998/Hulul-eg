@extends('site.app')

@section('title', @$blog->transNow->meta_title  )
@section('meta_key', @$blog->transNow->meta_key )
@section('meta_description', @$blog->transNow->meta_description )


@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ asset('site/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>@lang('blogs.blogs')</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('site.home') }}"> @lang('site.home') /</a>
                            <span>@lang('blogs.blogs')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Blog Section Begin -->
  <div class="container">
      <h1 class="text-white theH1 mt-4">{{ @$blog->transNow->title }}</h1>
    </div>

  <main class="container">
    <figure class="cover">
      <img src="{{ asset(@$blog->pathInView()) }}" class="blogImg" alt="Share a Video on Social Media">
    </figure>

         <p class="single-meta">{!!  @$blog->transNow->description !!} </p>

  </main>
    <!-- Blog Section End -->

@endsection
<style>
    .blog-page{
        margin-top: 140px;
    }
</style>
<style>
    .hero{
        margin-top: 70px !important;
    }
</style>
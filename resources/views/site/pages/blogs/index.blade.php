@extends('site.app')

@section('title', @$metaSetting->where('key', 'blogs_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'blogs_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'blogs_meta_description_' . $current_lang)->first()->value)


@section('content')
    <header class="hero  wow fadeInDown" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container">
            <h1 class="color_blue">@lang('blogs.take_a_look_at_our_blogs')</h1>
            <p class="breadcrumb"><a class="color_red" href="{{ route('site.home') }}">@lang('blogs.home')</a> / 
                @lang('blogs.blogs')</p>
        </div>
    </header>
    <section class="section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container">
            <div class="blog-grid">
                @forelse ($blogs as $key =>$blog)
                    <article class="post-card wow bounceInUp" style="animation-delay: 0.{{ ($key + 1) }}s;">
                        <img class="card-img" src="{{ asset($blog->pathInView()) }}" alt="Science-based approach">
                        <div class="card-body">
                            <h4 class="">{{ $blog->title }}</h4>
                            <p id="ex1" class="excerpt exp-text" data-lines="3">
                                {!! Str::limit($blog->description, 200) !!}
                            </p>
                            <a href="{{ route('site.site.blogs.show', $blog->id) }}"> <button class="btn ghost exp-toggle" data-target="#ex1"
                                    aria-expanded="false">@lang('blogs.read_more')</button>
                            </a>
                        </div>
                    </article>
                @empty
                    <h3>@lang('blogs.no_blogs')</h3>
                @endforelse
            </div>
        </div>
    </section>
@endsection
<style>
    .hero{
        margin-top: 60px !important;
    }
</style>
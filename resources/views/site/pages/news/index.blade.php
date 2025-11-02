@extends('site.app')

@section('title', @$metaSetting->where('key', 'news_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'news_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'news_meta_description_' . $current_lang)->first()->value)


@section('content')
    <!-- ===== HERO ===== -->
    <header class="hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container">
            <p class="kicker color_red">Company Updates</p>
            <h1 class="color_blue">Latest News & Press</h1>
            
            <p class="breadcrumb color_red"><a href="{{ route('site.home') }}" target="_blank">@lang('home.home')</a> / @lang('news.news')</p>
        </div>
    </header>

    <!-- ===== FEATURED NEWS ===== -->
    <section class="section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container">
            <article class="featured">
                <a class="feat-thumb" href="#" aria-label="Featured news image">
                    <img src="{{ asset($first_news->image) }}" alt="Featured announcement" loading="lazy">
                </a>
                <div class="feat-body">
                    <span class="badge">Press Release</span>
                    <h2 class="feat-title">{{ $first_news->title }}</h2>
                    <div class="meta"> {{ $first_news->created_at }}</div>
                    <p id="featNews" class="feat-excerpt exp-text" data-lines="3">
                        {!! Str::limit($first_news->description, 400) !!}
                    </p>
                    <a href="{{ route('site.news.show', $first_news->id) }}">
                        <button class="btn ghost exp-toggle" data-target="#featNews"
                            aria-expanded="false">@lang('site.read_more')</button>

                    </a>
                </div>
            </article>
        </div>
    </section>

    <!-- ===== NEWS GRID ===== -->
    <section class="section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container">
            <div class="news-grid">
                @forelse ($news as $new)
                    <article class="news-card">
                        <img class="card-img" src="{{ asset($new->image) }}" alt="Distributor upgrade">
                        <div class="card-body">
                            <div class="meta-row">
                                <span class="badge">Update</span>
                                <time datetime="2025-09-12" class="date">{{ $new->created_at }}</time>
                            </div>
                            <h3 class="title">{{ $new->title }}</h3>
                            <p id="n1" class="excerpt exp-text" data-lines="3">
                                {!! Str::limit($new->description, 200) !!}
                            </p>
                            <a href="{{ route('site.news.show', $new->id) }}">
                                <button class="btn ghost exp-toggle" data-target="#n1"
                                    aria-expanded="false">@lang('site.read_more')</button>

                            </a>
                        </div>
                    </article>

                @empty
                    <h3>@lang('site.no_news')</h3>
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
@extends('site.app')

@section('title', @$blog->transNow->meta_title)
@section('meta_key', @$blog->transNow->meta_key)
@section('meta_description', @$blog->transNow->meta_description)


@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ asset('site/img/111.jpeg') }}">
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
            <img src="{{ asset(@$blog->pathInView()) }}" class="blogImg" alt="{{ @$blog->transNow->title }}">
        </figure>

        {{-- Editor HTML: may contain headings, lists and inline styles, so it lives in a div, not a <p> --}}
        <div class="blog-body">{!! @$blog->transNow->description !!}</div>

    </main>
    <!-- Blog Section End -->

@endsection

@section('style')
    <style>
        .blog-page {
            margin-top: 140px;
        }

        .hero {
            margin-top: 70px !important;
        }

        .theH1 {
            line-height: 1.3;
            overflow-wrap: anywhere;
        }

        .blogImg {
            object-fit: cover;
        }

        /* ---------- Article body ----------
           Text pasted into the dashboard editor often carries its own colors,
           backgrounds, fonts, sizes and direction. The article always shows in
           white with the site's typography, whatever the editor saved. */
        .blog-body {
            margin: 24px 0 70px;
            color: #ffffff;
            font-size: 17px;
            line-height: 1.9;
            text-align: start;
            overflow-wrap: break-word;
        }

        .blog-body *,
        .blog-body *::before,
        .blog-body *::after {
            color: #ffffff !important;
            background-color: transparent !important;
            max-width: 100%;
        }

        .blog-body [style*="font-family"],
        .blog-body font[face] {
            font-family: inherit !important;
        }

        .blog-body :not(h1, h2, h3, h4, h5, h6)[style*="font-size"],
        .blog-body font[size] {
            font-size: inherit !important;
        }

        .blog-body [style*="line-height"] {
            line-height: inherit !important;
        }

        /* direction and left/right alignment follow the page language (ar = rtl, en = ltr);
           centered or justified text is left as the editor saved it */
        .blog-body [dir] {
            direction: inherit !important;
        }

        .blog-body [style*="text-align:left"],
        .blog-body [style*="text-align: left"],
        .blog-body [style*="text-align:right"],
        .blog-body [style*="text-align: right"],
        .blog-body [align="left"],
        .blog-body [align="right"] {
            text-align: start !important;
        }

        .blog-body p,
        .blog-body div,
        .blog-body span,
        .blog-body li {
            font-size: inherit;
            line-height: inherit;
        }

        .blog-body p {
            margin: 0 0 16px;
        }

        .blog-body h1,
        .blog-body h2,
        .blog-body h3,
        .blog-body h4,
        .blog-body h5,
        .blog-body h6 {
            margin: 34px 0 14px;
            line-height: 1.4 !important;
            font-weight: 700;
        }

        .blog-body h1,
        .blog-body h2 {
            font-size: 30px !important;
        }

        .blog-body h3 {
            font-size: 24px !important;
        }

        .blog-body h4 {
            font-size: 20px !important;
        }

        .blog-body h5,
        .blog-body h6 {
            font-size: 18px !important;
        }

        .blog-body > :first-child {
            margin-top: 0;
        }

        .blog-body strong,
        .blog-body b {
            font-weight: 700;
        }

        .blog-body ul,
        .blog-body ol {
            margin: 0 0 16px;
            padding-inline-start: 24px;
        }

        .blog-body ul li {
            list-style: disc;
        }

        .blog-body ol li {
            list-style: decimal;
        }

        .blog-body li {
            margin-bottom: 8px;
        }

        .blog-body a {
            text-decoration: underline !important;
            text-underline-offset: 3px;
        }

        .blog-body a:hover {
            opacity: 0.8;
        }

        .blog-body blockquote {
            margin: 20px 0;
            padding-inline-start: 18px;
            border-inline-start: 3px solid #00d8ff;
        }

        .blog-body img,
        .blog-body video {
            height: auto !important;
            border-radius: 12px;
        }

        .blog-body iframe {
            width: 100% !important;
            height: auto !important;
            aspect-ratio: 16 / 9;
            border: 0;
        }

        .blog-body table {
            display: block;
            width: 100% !important;
            overflow-x: auto;
            border-collapse: collapse;
            margin: 0 0 16px;
        }

        .blog-body th,
        .blog-body td {
            padding: 8px 12px;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
        }

        .blog-body pre {
            white-space: pre-wrap;
        }

        @media (max-width: 767px) {
            .theH1 {
                font-size: 1.8rem;
            }

            .blogImg {
                height: 16rem;
                margin-top: 0;
            }

            .blog-body {
                font-size: 16px;
                line-height: 1.8;
                margin-bottom: 50px;
            }

            .blog-body h1,
            .blog-body h2 {
                font-size: 24px !important;
            }

            .blog-body h3 {
                font-size: 20px !important;
            }

            .blog-body h4,
            .blog-body h5,
            .blog-body h6 {
                font-size: 18px !important;
            }
        }
    </style>
@endsection

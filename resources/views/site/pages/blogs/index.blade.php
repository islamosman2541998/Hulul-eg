@extends('site.app')

@section('title', @$metaSetting->where('key', 'blogs_meta_title_' . $current_lang)->first()->value)

@section('meta_key', @$metaSetting->where('key', 'blogs_meta_key_' . $current_lang)->first()->value)

@section('meta_description', @$metaSetting->where('key', 'blogs_meta_description_' . $current_lang)->first()->value)


@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option set-bg"
        data-setbg="{{ asset('site/img/111.jpeg') }}">

        <div class="container">

            <div class="row">

                <div class="col-lg-12 text-center">

                    <div class="breadcrumb__text">

                        <h2>
                            @lang('blogs.blogs')
                        </h2>

                        <div class="breadcrumb__links">

                            <a href="{{ route('site.home') }}">
                                @lang('site.home') /
                            </a>

                            <span>
                                @lang('blogs.blogs')
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <!-- Breadcrumb End -->


    <!-- Blog Section Begin -->
    <section class="blog spad">

        <div class="container">

            <div class="row">

                @forelse ($blogs as $key => $blog)

                    <div class="col-lg-4 col-md-6 col-sm-6 mb-3">

                        <div class="blog__item latest__item">

                            <img src="{{ asset($blog->pathInView()) }}"
                                alt="{{ $blog->title }}">

                            <div
                                class="blog-content d-flex flex-column justify-content-center align-items-center p-3">

                                <h4>
                                    {{ $blog->title }}
                                </h4>

                                <p>
                                    {!! Str::limit($blog->description, 65) !!}
                                </p>

                                <ul>
                                    <li>
                                        {{ $blog->created_at->format('M d, Y') }}
                                    </li>
                                </ul>

                                <a href="{{ route('site.site.blogs.show', $blog->id) }}">
                                    @lang('admin.read_more')
                                </a>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12 text-center">

                        <h3 class="text-white">
                            @lang('blogs.no_blogs')
                        </h3>

                    </div>

                @endforelse

            </div>

        </div>

    </section>
    <!-- Blog Section End -->

@endsection
@extends('site.app')

@section('title', @$metaSetting->where('key', 'blogs_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'blogs_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'blogs_meta_description_' . $current_lang)->first()->value)


@section('content')


    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ asset('site/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2> @lang('blogs.blogs')</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('site.home') }}">@lang('site.home') /</a>
                            <span>@lang('blogs.blogs')</span>
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

                @forelse ($blogs as $key =>$blog)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item latest__item">
                            <h4>{{ $blog->title }} </h4>
                            <ul>
                                <li>{{ $blog->created_at->format('M d, Y') }}</li>
                            </ul>
                            <p>
                                {!! Str::limit($blog->description, 200) !!}
                            </p>
                            <a href="{{ route('site.site.blogs.show', $blog->id) }}">@lang('admin.read_more') <span class="arrow_right"></span></a>
                        </div>
                    </div>
                @empty
                    <h3>@lang('blogs.no_blogs')</h3>
                @endforelse

            </div>
            {{-- <div class="row">
                <div class="col-lg-12">
                    <div class="pagination__option blog__pagi">
                        <a href="#" class="arrow__pagination left__arrow"><span class="arrow_left"></span> Prev</a>
                        <a href="#" class="number__pagination">1</a>
                        <a href="#" class="number__pagination">2</a>
                        <a href="#" class="arrow__pagination right__arrow">Next <span class="arrow_right"></span></a>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- Blog Section End -->
 



@endsection




 <!-- BLOG SECTION -->

 @php
     $settings = \App\Settings\SettingSingleton::getInstance();
     $show_blogs = (int) $settings->getHome('show_blogs');
 @endphp
 @if ($show_blogs)
    
   <!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title center-title">
                    <span class="applicatonSpan">@lang('blogs.blogs')</span>
                    <h2>@lang('blogs.latest_blogs')</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @if($blogs->isEmpty())
                <div class="col-12">
                    <h3 class="text-center">@lang('blogs.no_blogs')</h3>
                </div>
            @else
                <div class="col-12">
                    <!-- Swiper wrapper -->
                    <div class="swiper blogs-swiper">
                        <div class="swiper-wrapper">
                            @foreach ($blogs as $blog)
                                <div class="swiper-slide">
                                    <div class="blog__item latest__item">
                                        <h4>{{ $blog->title }}</h4>
                                        <ul>
                                            <li>{{ $blog->created_at->format('Y-m-d') }}</li>
                                        </ul>
                                        <p>{!! Str::limit($blog->description, 200) !!}</p>
                                        <a href="{{ route('site.site.blogs.show', $blog->id) }}">
                                            @lang('admin.read_more') <span class="arrow_right"></span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination & Navigation -->
                        <div class="swiper-pagination"></div>
                        <div class="blogs-button-prev swiper-button-prev"></div>
                        <div class="blogs-button-next swiper-button-next"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->

 @endif

 <style>
    .swiper .swiper-slide {
    display: flex;
    justify-content: center;
}
.blog__item.latest__item {
    width: 100%;
    max-width: 420px;
    box-sizing: border-box;
}

 </style>

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
                 @if ($blogs->isEmpty())
                     <div class="col-12">
                         <h3 class="text-center">@lang('blogs.no_blogs')</h3>
                     </div>
                 @else
                     <div class="col-12">
                         <div class="blogs-slider-wrap">
                             <!-- Swiper wrapper -->
                             <div class="swiper blogs-swiper">
                                 <div class="swiper-wrapper">
                                     @foreach ($blogs as $blog)
                                         <div class="swiper-slide">
                                             <div class="blog__item latest__item">
                                                 <img src="{{ asset($blog->pathInView()) }}" alt="{{ $blog->title }}">

                                                 <div class="blog-content d-flex flex-column align-items-center p-3">
                                                     <h4>{{ $blog->title }}</h4>

                                                     <p>{!! Str::limit($blog->description, 70) !!}</p>
                                                     <ul>
                                                         <li>{{ $blog->created_at->format('Y-m-d') }}</li>
                                                     </ul>
                                                     <a href="{{ route('site.site.blogs.show', $blog->id) }}">
                                                         @lang('admin.read_more')
                                                     </a>
                                                 </div>

                                             </div>
                                         </div>
                                     @endforeach
                                 </div>

                                 <!-- Pagination -->
                                 <div class="swiper-pagination"></div>
                             </div>

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
     .latest {
         padding-top: 20px !important;
     }

     .swiper .swiper-slide {
         display: flex;
         justify-content: center;
         height: auto;
     }

     .blogs-swiper .swiper-wrapper {
         align-items: stretch;
     }

     .blog__item.latest__item {
         width: 100%;
         max-width: 420px;
         height: 100%;
         box-sizing: border-box;
         display: flex;
         flex-direction: column;
     }

     .blog__item.latest__item img {
         flex-shrink: 0;
         width: 100%;
         height: 180px;
         object-fit: cover;
     }

     .blog__item.latest__item .blog-content {
         flex: 1 1 auto;
         width: 100%;
         padding: 20px !important;
     }

     .blog__item.latest__item .blog-content h4 {
         display: -webkit-box;
         -webkit-line-clamp: 2;
         -webkit-box-orient: vertical;
         overflow: hidden;
     }

     .blog__item.latest__item .blog-content p {
         display: -webkit-box;
         -webkit-line-clamp: 2;
         -webkit-box-orient: vertical;
         overflow: hidden;
     }

     .blog__item.latest__item .blog-content a {
         margin-top: 12px;
         flex-shrink: 0;
     }

     .blogs-swiper {
         padding-bottom: 40px;
     }

     .blogs-swiper .swiper-pagination {
         bottom: 0;
     }

     .blogs-slider-wrap {
         position: relative;
         padding: 0 64px;
     }

     .blogs-slider-wrap .swiper-button-prev,
     .blogs-slider-wrap .swiper-button-next {
         top: 50%;
         margin-top: 0;
         transform: translateY(-50%);
         width: 50px;
         height: 50px;
         border-radius: 50%;
         background: rgba(10, 4, 40, 0.55);
         border: 1px solid rgba(0, 216, 255, 0.4);
         color: #ffffff;
         --swiper-navigation-size: 16px;
         transition: background 0.3s ease, border-color 0.3s ease;
     }

     .blogs-slider-wrap .swiper-button-prev {
         left: 0;
     }

     .blogs-slider-wrap .swiper-button-next {
         right: 0;
     }

     .blogs-slider-wrap .swiper-button-prev:hover,
     .blogs-slider-wrap .swiper-button-next:hover {
         background: linear-gradient(135deg, #1a1c6e 0%, #00d8ff 100%);
         border-color: transparent;
     }

     .blogs-slider-wrap .swiper-button-prev:after,
     .blogs-slider-wrap .swiper-button-next:after {
         font-size: 16px;
         font-weight: 700;
     }

     @media (max-width: 767px) {
         .blogs-slider-wrap {
             padding: 0 46px;
         }

         .blogs-slider-wrap .swiper-button-prev,
         .blogs-slider-wrap .swiper-button-next {
             width: 38px;
             height: 38px;
             --swiper-navigation-size: 13px;
         }
     }
 </style>

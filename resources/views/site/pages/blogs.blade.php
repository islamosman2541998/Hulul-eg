 <!-- BLOG SECTION -->

 @php
     $settings = \App\Settings\SettingSingleton::getInstance();
     $show_blogs = (int) $settings->getHome('show_blogs');
 @endphp
 @if ($show_blogs)
     <section class="blog-section text-center py-5" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
         <h2 class="section-title wow fadeInDown">@lang('blogs.blogs')</h2>

         <div class="DivNews">
         </div>
         {{-- <p class="section-sub pt-2 wow fadeInDown">@lang('blogs.blogs_p')</p> --}}
         <div class="container pt-3">
             <div class="row gap-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
                 @forelse ($blogs as $key => $blog)
                     <div class=" col-lg-4 col-md-6 card wow bounceInUp" style="animation-delay: 0.{{ $key + 1 }}s;">
                         <div class="blog-card">
                             <div class="blog-media">
                                 <img src="{{ asset($blog->pathInView()) }}" alt="Your Image Alt Text">
                             </div>
                             <div class="blog-body">
                                 <h3 class="blog-title">{{ $blog->title }}</h3>
                                 <p class="blog-text">{!! Str::limit($blog->description, 200) !!}</p>
                                 <a href="{{ route('site.site.blogs.show', $blog->id) }}" class="blog-btn"
                                     aria-label="Read More: The Future of Generic Medicines">@lang('blogs.see_more')</a>
                             </div>
                         </div>
                     </div>
                 @empty
                     <h3>@lang('blogs.no_blogs')</h3>
                 @endforelse


             </div>
         </div>
         <div class="viewall  wow fadeInLeft" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'ltr' }}">
             <a class="viewnews" href="{{ route('site.site.blogs.index') }}">
                 <span class="viewnewstext">@lang('site.view_all_blogs')</span>
                 <span class="viewnewsspan">→</span>
             </a>
         </div>
     </section>
 @endif

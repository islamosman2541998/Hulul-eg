
@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_category    = (int) $settings->getHome('show_category');
@endphp
@if ($show_category)
    <div class="Review testimonial my-4 p-5 text-center">
    <div class="container">
        <h2 class="testimonialh2">@lang('Our Categories')</h2>

        
        <div class="swiper categorySlider">
            <div class="swiper-wrapper mt-3">
                @forelse ($categoryProducts as $key => $category)
                    <div class="swiper-slide wow bounceInUp" style="animation-delay: 0.{{ ($key + 1) }}s;">
                        <a href="{{ route('site.categories.show', $category->transNow->slug) }}">
                        <div class="Reviewbox d-flex flex-column align-items-center mx-auto p-3 rounded" >
                                <img src="{{ asset($category->path() . $category->image)}}" class="img-fluid rounded-circle" alt="{{ $category->transNow->title }}" style="width: 100px; height: 100px; object-fit: cover;">
                                <h4 class="mt-3">
                                    {{ $category->transNow->title}}
                                  </h4>
                                </div>
                            </a>
                    </div>
                @empty
                    <p>{{ app()->getLocale() == 'ar' ? 'لا يوجد تقييمات متاحة' : 'No reviews available' }}</p>
                @endforelse
            </div>

            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev category-button-prev"></div>
            <div class="swiper-button-next category-button-next"></div>
        </div>

        <div class="viewall wow fadeInLeft" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'ltr' }}">
            <a class="viewnews" href="{{ route('site.categories.index') }}">
                <span class="viewnewstext">@lang('view all categories')</span>
                <span class="viewnewsspan">→</span>
            </a>
        </div>
    </div>
</div>
@endif

@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_slider    = (int) $settings->getHome('show_slider');
    
@endphp

   <!-- Hero Section Begin -->
    <section class="hero" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="hero__slider owl-carousel">

            @forelse ($slides as $slide)
            <div class="hero__item set-bg bgImg"
            {{-- style="background-image: url('{{ asset($slide->pathInView()) }}') !important;" --}}
             data-setbg="{{ asset($slide->pathInView()) }}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <span>{!!  $slide->description !!} </span>
                                <h2>{{ $slide->title }}</h2>
                                <a href="#" class="primary-btn">See more about us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            


            @endforelse 
          
          
        </div>
    </section>
    <!-- Hero Section End -->

  
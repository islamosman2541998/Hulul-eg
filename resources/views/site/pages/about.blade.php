
@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_about_us    = (int) $settings->getHome('show_about_us');
@endphp

<!-- ABOUT US -->
@if ( $show_about_us)
    <section class="about-section py-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <div class="col-lg-6 order-2 wow bounceInRight">
                <div class="about-left text-start ">
                    <img src="{{ asset('storage/' . $about_us->image_background) }}" alt="Tetra Pharma"
                        class=" me-3 small-logo">
                    <div class="eyebrow text-muted mb-2">{{ $about_us->transNow->subtitle ?? 'TETRA PHARMA' }}</div>
                    <h2 class="section-title mb-4">{{ $about_us->transNow->title ?? 'About Us' }}</h2>

                    <blockquote class="lead-quote mb-4">
                        <span class="quote-mark">“</span>
						
                        <p class="mb-0">{{ $about_us->transNow->description ?? 'No description available' }}</p>
                    </blockquote>

                    <div class=" d-flex align-items-center  mt-4">
                        <img src="{{ asset('storage/' . $about_us->image) }}" alt="Tetra Pharma"
                            class="rounded-circle me-3 small-logo">
                        <div>
                            <h5 class="mb-0 text-primary">{{ $about_us->transNow->subtitle ?? 'Tetra Pharma' }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 order-1 wow bounceInLeft order-lg-{{ app()->getLocale() == 'en' ? '1' : '2' }}">
                <div
                    class="about-right d-flex justify-content-center justify-content-lg-{{ app()->getLocale() == 'en' ? 'start' : 'end' }} align-items-center h-100">

                    <img src="{{ asset('storage/' . $about_us->image) }}" alt="Tetra Pharma"
                        class="img-fluid big-logo">
                </div>
            </div>
        </div>
    </div>
</section>
@endif


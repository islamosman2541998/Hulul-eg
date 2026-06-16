<!-- OUR PARTNERS -->
	@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_partners    = (int) $settings->getHome('show_partners');
@endphp
@if ($show_partners)
    <div class="logo spad">
        <div class="container-fluid">
            <div class="logo-swiper swiper">
                <div class="swiper-wrapper">
                    @forelse ($partners as $partner)
                        <div class="swiper-slide">
                            <a target="_blank" href="{{ $partner->url }}" class="partner-card">
                                <img src="{{ asset('storage/attachments/partners/' . $partner->image) }}"
                                    alt="partner-{{ $loop->index }}" />
                            </a>
                        </div>
                    @empty
                        <p>@lang('site.no_partners')</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <!-- Logo End -->

@endif

    <style>
  

        .partner-card {
            display: flex;
            align-items: center;
            justify-content: center;
            background: transparent;
            border-radius: 12px;
            padding: 10px;
            height: 150px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #100028;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .partner-card:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            transform: translateY(-3px);
        }

        .partner-card img {
            max-width: 100%;
            max-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain;
            filter: grayscale(30%);
            transition: filter 0.3s ease;
        }

        .partner-card:hover img {
            filter: grayscale(0%);
        }

     
    </style>

<script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.logo-swiper', {
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                slidesPerView: 5,
                spaceBetween: 24,
                breakpoints: {
                    0: {
                        slidesPerView: 2,
                        spaceBetween: 12
                    },
                    576: {
                        slidesPerView: 3,
                        spaceBetween: 16
                    },
                    768: {
                        slidesPerView: 4,
                        spaceBetween: 20
                    },
                    992: {
                        slidesPerView: 5,
                        spaceBetween: 24
                    }
                },
            });
        });
    </script>
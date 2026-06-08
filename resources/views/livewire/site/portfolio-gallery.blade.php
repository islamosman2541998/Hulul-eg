<div>
    <!-- Filters -->
    <div class="portfolio__filter text-center mb-5">
        <ul class="list-inline d-inline-block">
            <li class="list-inline-item {{ $activeTag === 'all' ? 'active' : '' }}">
                <button type="button" wire:click="filterByTag('all')" class="btn-filter">
                    {{ __('admin.all') }}
                </button>
            </li>

            @foreach ($tags as $tag)
                <?php
                $currentTrans = $tag->trans->where('locale', app()->getLocale())->first();
                ?>
                <li class="list-inline-item {{ $activeTag === ($currentTrans->slug ?? '') ? 'active' : '' }}">
                    <button type="button" wire:click="filterByTag('{{ $currentTrans->slug ?? '' }}')" class="btn-filter">
                        {{ @$currentTrans->title ?? 'غير معروف' }}
                    </button>
                </li>
            @endforeach

        </ul>
    </div>

    <div class="row portfolio__gallery" id="portfolio-container">
        @forelse($portfolios as $item)
            <div class="col-lg-4 col-md-6 col-sm-6 mb-4 mix">
                <div class="portfolio__item position-relative overflow-hidden">
                    @if ($item->image)
                        @if ($item->type == 'image')
                            @php
                                $galleryImages = $item->galleryGroup?->images
                                    ? $item->galleryGroup->images
                                        ->sortBy('sort')
                                        ->map(function ($galleryImage) {
                                            return asset($galleryImage->pathInView('portfolios'));
                                        })
                                        ->values()
                                        ->toArray()
                                    : [];
                            @endphp
                            <a href="javascript:void(0)" class="work__link"
                                onclick="openPortfolioPopup(
    'image',
    @js(asset($item->image)),
    @js($item->transNow->title ?? ''),
    @js($item->link ?? ''),
    @js(app()->getLocale() == 'ar' ? 'زيارة الرابط' : 'Visit Link'),
    @js($galleryImages)
)"
                                title="{{ $item->transNow->title ?? '' }}">

                                <img src="{{ asset($item->image) }}" class="img-fluid w-100"
                                    alt="{{ $item->transNow->title ?? '' }}"
                                    style="height: 15rem; object-fit: cover; border-radius: 1rem;">

                                <div class="portfolio__item__text bottom-0 start-0 end-0 p-3 text-white">
                                    <h4>{{ $item->transNow->title ?? 'No Title' }}</h4>
                                    <ul class="list-unstyled mb-0">
                                        @if ($item->tag && $item->tag->transNow)
                                            <li>{{ $item->tag->transNow->title }}</li>
                                        @endif
                                        <li>{{ __('Image') }}</li>
                                    </ul>
                                </div>
                            </a>
                        @elseif($item->type == 'video')
                            <div class="video-wrapper position-relative">
                                @php
                                    $galleryImages = $item->galleryGroup?->images
                                        ? $item->galleryGroup->images
                                            ->sortBy('sort')
                                            ->map(function ($galleryImage) {
                                                return asset($galleryImage->pathInView('portfolios'));
                                            })
                                            ->values()
                                            ->toArray()
                                        : [];
                                @endphp
                                <div class="video-thumb"
                                    onclick="openPortfolioPopup(
    'video',
    @js(asset($item->image)),
    @js($item->transNow->title ?? ''),
    @js($item->link ?? ''),
    @js(app()->getLocale() == 'ar' ? 'زيارة الرابط' : 'Visit Link'),
    @js($galleryImages)
)">
                                    <video width="100%" muted playsinline preload="metadata"
                                        style="height: 15rem; object-fit: cover; border-radius: 1rem;">
                                        <source src="{{ asset($item->image) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>

                                    <div class="video-play-icon">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </div>

                                <div class="portfolio__item__text bottom-0 start-0 end-0 p-3 text-white">
                                    <h4>{{ $item->transNow->title ?? 'No Title' }}</h4>
                                    <ul class="list-unstyled mb-0">
                                        @if ($item->tag && $item->tag->transNow)
                                            <li>{{ $item->tag->transNow->title }}</li>
                                        @endif
                                        <li>{{ __('Video') }}</li>
                                    </ul>
                                </div>
                            </div>
                        @elseif($item->type == 'pdf')
                            <a href="{{ asset($item->image) }}" class="work__link popup-iframe" target="_blank"
                                title="{{ $item->transNow->title ?? '' }}">

                                <div class="pdf-preview d-flex align-items-center justify-content-center"
                                    style="height: 15rem; background: #f8f9fa; border-radius: 1rem;">
                                    <i class="fas fa-file-pdf fa-5x text-danger"></i>
                                </div>

                                <div class="portfolio__item__text  bottom-0 start-0 end-0 p-3 text-white"
                                    style="background: rgba(0,0,0,0.7);">
                                    <h4>{{ $item->transNow->title ?? 'No Title' }}</h4>
                                    <ul class="list-unstyled mb-0">
                                        @if ($item->tag && $item->tag->transNow)
                                            <li>{{ $item->tag->transNow->title }}</li>
                                        @endif
                                        <li>{{ __('PDF Document') }}</li>
                                    </ul>
                                </div>
                            </a>
                        @else
                            <a href="{{ $item->link ?? '#' }}" class="work__link external-link" target="_blank"
                                title="{{ $item->transNow->title ?? '' }}">
                                <img src="{{ asset($item->image) }}" class="img-fluid w-100"
                                    alt="{{ $item->transNow->title ?? '' }}"
                                    style="height: 15rem; object-fit: cover; border-radius: 1rem;">

                                <div
                                    class="portfolio__item__text position-absolute bottom-0 start-0 end-0 p-3 text-white">
                                    <h4>{{ $item->transNow->title ?? 'No Title' }}</h4>
                                    <ul class="list-unstyled mb-0">
                                        @if ($item->tag && $item->tag->transNow)
                                            <li>{{ $item->tag->transNow->title }}</li>
                                        @endif
                                        @if ($item->type)
                                            <li>{{ ucfirst($item->type) }}</li>
                                        @endif
                                    </ul>
                                </div>
                            </a>
                        @endif
                    @endif
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h4>{{ __('admin.no_portfolios') }}</h4>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $portfolios->links() }}
    </div>
    <div id="portfolioPopup" class="portfolio-popup">
        <div class="portfolio-popup-overlay" onclick="closePortfolioPopup()"></div>

        <div class="portfolio-popup-content">
            <button type="button" class="portfolio-popup-close" onclick="closePortfolioPopup()">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <h4 id="portfolioPopupTitle" class="portfolio-popup-title"></h4>

            <div id="portfolioPopupBody" class="portfolio-popup-body"></div>
            <div id="portfolioPopupActions" class="portfolio-popup-actions"></div>
        </div>
    </div>
</div>

<style>
    .pagination {
      background-color: transparent !important;
    }
      /* الباجينيشن */
    .pagination .page-link {
        background-color: #1a083d;
        border-color: #2d1060;
        color: #fff;
    }

    .pagination .page-link:hover {
        background-color: #2d1060;
        border-color: #242B8A;
        color: #fff;
    }

    /* الصفحة الاكتيف */
    .pagination .page-item.active .page-link {
        background-color: #242B8A;
        border-color: #242B8A;
        color: #fff;
        font-weight: 700;
    }

    /* الأسهم */
    .pagination .page-item.disabled .page-link {
        background-color: #0f0229;
        border-color: #2d1060;
        color: #6b4fa0;
    }
    .btn-filter {
        background: transparent;
        border: none;
        color: #fff;
        padding: 10px 20px;
        margin: 0 5px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-filter:hover,
    .btn-filter.active {
        background: #242B8A;
        border-radius: 30px;
    }

    .portfolio__item {
        transition: transform 0.3s ease;
    }

    .portfolio__item:hover {
        transform: translateY(-5px);
    }

    .portfolio__item__text {
        /* background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); */
    }

    .video-wrapper video {
        cursor: pointer;
    }

    .pdf-preview {
        transition: all 0.3s ease;
    }

    .pdf-preview:hover {
        background: #e9ecef !important;
    }

    .pdf-preview i {
        transition: transform 0.3s ease;
    }

    .pdf-preview:hover i {
        transform: scale(1.1);
    }

    .portfolio-popup {
        position: fixed;
        inset: 0;
        z-index: 99999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .portfolio-popup.active {
        display: flex;
    }

    .portfolio-popup-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.82);
        backdrop-filter: blur(6px);
    }

    .portfolio-popup-content {
        position: relative;
        z-index: 2;
        width: min(100%, 1100px);
        max-height: 90vh;
        background: #111;
        border-radius: 18px;
        padding: 18px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.45);
    }

    .portfolio-popup-title {
        color: #fff;
        margin-bottom: 14px;
        font-size: 20px;
        text-align: center;
    }

    .portfolio-popup-body {
        width: 100%;
        max-height: 78vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .portfolio-popup-body img,
    .portfolio-popup-body video {
        max-width: 100%;
        max-height: 78vh;
        border-radius: 14px;
        object-fit: contain;
    }

    .portfolio-popup-close {
        position: absolute;
        top: -14px;
        right: -14px;
        width: 42px;
        height: 42px;
        border: none;
        border-radius: 50%;
        background: #fff;
        color: #111;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 3;
    }

    .video-thumb {
        position: relative;
        cursor: pointer;
    }

    .video-play-icon {
        position: absolute;
        inset: 0;
        margin: auto;
        width: 58px;
        height: 58px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.65);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    @media (max-width: 767px) {
        .portfolio-popup-content {
            padding: 12px;
            border-radius: 14px;
        }

        .portfolio-popup-close {
            top: 8px;
            right: 8px;
        }

        .portfolio-popup-title {
            font-size: 16px;
            padding-inline: 45px;
        }
    }

    .portfolio-popup-actions {
        display: flex;
        justify-content: center;
        margin-top: 16px;
    }

    .portfolio-popup-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 24px;
        border-radius: 999px;
        background: #fff;
        color: #111;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .portfolio-popup-link:hover {
        color: #111;
        transform: translateY(-2px);
    }

    .portfolio-slider {
        position: relative;
        width: 100%;
        max-height: 78vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .portfolio-slide {
        display: none;
        width: 100%;
        text-align: center;
    }

    .portfolio-slide.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .portfolio-slide img {
        max-width: 100%;
        max-height: 78vh;
        border-radius: 14px;
        object-fit: contain;
    }

    .portfolio-slider-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: none;
        background: #fff;
        color: #111;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 4;
    }

    .portfolio-slider-prev {
        left: 16px;
    }

    .portfolio-slider-next {
        right: 16px;
    }

    @media (max-width: 767px) {
        .portfolio-slider-btn {
            width: 38px;
            height: 38px;
        }

        .portfolio-slider-prev {
            left: 8px;
        }

        .portfolio-slider-next {
            right: 8px;
        }
    }
</style>
<script>
    window.openPortfolioPopup = function(type, src, title = '', link = '', linkText = 'Visit Link',
        galleryImages = []) {
        const popup = document.getElementById('portfolioPopup');
        const body = document.getElementById('portfolioPopupBody');
        const popupTitle = document.getElementById('portfolioPopupTitle');
        const actions = document.getElementById('portfolioPopupActions');

        if (!popup || !body) return;

        popupTitle.innerText = title || '';
        body.innerHTML = '';

        if (actions) {
            actions.innerHTML = '';
        }

        if (Array.isArray(galleryImages) && galleryImages.length > 0) {
            let slides = galleryImages.map((image, index) => {
                return `
                    <div class="portfolio-slide ${index === 0 ? 'active' : ''}">
                        <img src="${image}" alt="${title}">
                    </div>
                `;
            }).join('');

            body.innerHTML = `
                <div class="portfolio-slider" data-current="0">
                    <div class="portfolio-slider-track">
                        ${slides}
                    </div>

                    ${galleryImages.length > 1 ? `
                        <button type="button" class="portfolio-slider-btn portfolio-slider-prev" onclick="changePortfolioSlide(-1)">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>

                        <button type="button" class="portfolio-slider-btn portfolio-slider-next" onclick="changePortfolioSlide(1)">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    ` : ''}
                </div>
            `;
        } else {
            if (type === 'image') {
                body.innerHTML = `
                    <img src="${src}" alt="${title}">
                `;
            }

            if (type === 'video') {
                body.innerHTML = `
                    <video controls autoplay playsinline>
                        <source src="${src}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                `;
            }
        }

        if (link && link.trim() !== '' && actions) {
            actions.innerHTML = `
                <a href="${link}" target="_blank" class="portfolio-popup-link">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                    <span>${linkText}</span>
                </a>
            `;
        }

        popup.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    window.changePortfolioSlide = function(direction) {
        const slider = document.querySelector('.portfolio-slider');
        if (!slider) return;

        const slides = slider.querySelectorAll('.portfolio-slide');
        if (!slides.length) return;

        let current = parseInt(slider.getAttribute('data-current')) || 0;

        slides[current].classList.remove('active');

        current = current + direction;

        if (current < 0) {
            current = slides.length - 1;
        }

        if (current >= slides.length) {
            current = 0;
        }

        slides[current].classList.add('active');
        slider.setAttribute('data-current', current);
    }

    window.closePortfolioPopup = function() {
        const popup = document.getElementById('portfolioPopup');
        const body = document.getElementById('portfolioPopupBody');
        const actions = document.getElementById('portfolioPopupActions');

        if (!popup || !body) return;

        popup.classList.remove('active');
        body.innerHTML = '';

        if (actions) {
            actions.innerHTML = '';
        }

        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePortfolioPopup();
        }

        if (e.key === 'ArrowRight') {
            changePortfolioSlide(1);
        }

        if (e.key === 'ArrowLeft') {
            changePortfolioSlide(-1);
        }
    });
</script>

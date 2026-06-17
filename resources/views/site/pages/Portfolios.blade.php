<!-- Work Section Begin -->
<section class="work portfolio-modern-section">
    <div class="container">
        <div class="portfolio-modern-header text-center">
            <span>@lang('admin.our_work')</span>
            <h2>@lang('home.portfolio')</h2>
        </div>

        <div class="portfolio-modern-grid">
            @forelse ($portfolios as $portfolio)
                @php
                    $title = $portfolio->transNow->title ?? ($portfolio->title ?? 'No Title');
                    $description = $portfolio->transNow->description ?? ($portfolio->description ?? '');
                    $image = $portfolio->image ? asset($portfolio->image) : asset('attachments/no_image/no_image.png');
                @endphp

                <a href="{{ route('site.portfolio.index') }}" class="portfolio-modern-card">
                    <img src="{{ $image }}" alt="{{ $title }}">

                    <div class="portfolio-modern-overlay">
                        <div class="portfolio-modern-content">
                            <h4>{{ $title }}</h4>

                            @if ($description)
                                <p>{!! Str::limit(strip_tags($description), 90) !!}</p>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="portfolio-modern-empty">
                    @lang('admin.no_portfolios')
                </div>
            @endforelse
        </div>

        <div class="portfolio-modern-action text-center">
            <a href="{{ route('site.portfolio.index') }}" class="primary-btn">
                @lang('services.see_more_works')
            </a>
        </div>
    </div>
</section>
<!-- Work Section End -->

<style>
    .portfolio-modern-section {
        padding: 90px 0;
        background: #050019;
    }

    .portfolio-modern-header {
        margin-bottom: 45px;
    }

    .portfolio-modern-header span {
        display: inline-block;
        color: #00bfe7;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .portfolio-modern-header h2 {
        color: #fff;
        font-size: 38px;
        font-weight: 800;
        margin: 0;
    }

    .portfolio-modern-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 26px;
    }

    .portfolio-modern-card {
        position: relative;
        display: block;
        width: 100%;
        aspect-ratio: 16 / 9;
        overflow: hidden;
        border-radius: 18px;
        background: #111;
        text-decoration: none;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.28);
    }

    .portfolio-modern-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transform: scale(1);
        transition: transform 0.45s ease;
    }

    .portfolio-modern-card:hover img {
        transform: scale(1.08);
    }

    .portfolio-modern-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: flex-end;
        padding: 18px;
        background: linear-gradient(to top,
                rgba(0, 0, 0, 0.88) 0%,
                rgba(0, 0, 0, 0.62) 38%,
                rgba(0, 0, 0, 0.12) 72%,
                rgba(0, 0, 0, 0) 100%);
        opacity: 0;
        transition: opacity 0.35s ease;
    }

    .portfolio-modern-card:hover .portfolio-modern-overlay {
        opacity: 1;
    }

    .portfolio-modern-content {
        width: 100%;
        transform: translateY(24px);
        opacity: 0;
        transition: all 0.35s ease;
    }

    .portfolio-modern-card:hover .portfolio-modern-content {
        transform: translateY(0);
        opacity: 1;
    }

    .portfolio-modern-content h4 {
        color: #fff;
        font-size: 18px;
        font-weight: 800;
        line-height: 1.35;
        margin-bottom: 8px;
    }

    .portfolio-modern-content p {
        color: rgba(255, 255, 255, 0.82);
        font-size: 13px;
        line-height: 1.7;
        margin: 0;
    }

    .portfolio-modern-action {
        margin-top: 45px;
    }

    .portfolio-modern-empty {
        grid-column: 1 / -1;
        color: #fff;
        text-align: center;
        padding: 40px 0;
    }

    @media (max-width: 1199px) {
        .portfolio-modern-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (max-width: 991px) {
        .portfolio-modern-section {
            padding: 70px 0;
        }

        .portfolio-modern-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .portfolio-modern-header h2 {
            font-size: 32px;
        }
    }

    @media (max-width: 575px) {
        .portfolio-modern-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .portfolio-modern-card {
            aspect-ratio: 16 / 9;
            border-radius: 16px;
        }

        .portfolio-modern-card {
            border-radius: 16px;
        }

        .portfolio-modern-overlay {
            opacity: 1;
            padding: 12px;
        }

        .portfolio-modern-content {
            opacity: 1;
            transform: translateY(0);
        }

        .portfolio-modern-content h4 {
            font-size: 13px;
            margin-bottom: 4px;
        }

        .portfolio-modern-content p {
            font-size: 11px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .portfolio-modern-header h2 {
            font-size: 26px;
        }
    }
</style>

<!-- Header Section Begin -->
{{-- Home: transparent over the hero until scrolled. Other pages: always solid. --}}
<header class="header {{ request()->routeIs('site.home') ? 'header--overlay' : 'header--solid' }}"
    dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('site.home') }}"><img
                            src="{{ asset($settings->getItem(app()->getLocale() == 'en' ? 'logo_en' : 'logo_ar')) }}"
                            class="logoImg" alt=""></a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="header__nav__option" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                    <nav class="header__nav__menu" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                        <ul>
                            @php
                                $items = Cache::get('menus');
                                if ($items == null) {
                                    $items = Cache::rememberForever('menus', function () {
                                        return App\Models\Menue::with('trans')
                                            ->orderBy('sort', 'ASC')
                                            ->main()
                                            ->active()
                                            ->get();
                                    });
                                }
                            @endphp
                            @include('site.layouts.menuItem')
                            <li> <a href="{{ asset('site/img/HULUL.EG (1).pdf') }}" class="profile-link" target="_blank"
                                    aria-label="Our Profile">
                                    <span class="hide-on-mobile text-white">@lang('messages.Profile')</span>
                                </a>
                            </li>
                            <li class="header__actions">
                                <a href="{{ route('site.service_request.index') }}" class="btn request-btn"
                                    id="startBtn">
                                    <i class="fa-regular fa-pen-to-square"></i> @lang('messages.request_meeting')
                                </a>
                            </li>

                            <li class="lang-switch d-flex align-items-center ms-lg-3">
                                @foreach ($locals as $lang)
                                    @php
                                        $url = LaravelLocalization::getLocalizedURL($lang);
                                        $isActive = app()->getLocale() === $lang;
                                    @endphp

                                    <a href="{{ $url }}"
                                        class="text-white d-inline-flex align-items-center me-3 {{ $isActive ? 'fw-bold text-decoration-underline' : '' }}"
                                        rel="alternate" hreflang="{{ $lang }}">
                                        @if ($lang == 'en')
                                            <i class="fa-solid fa-globe m-2"></i>
                                            English
                                        @else
                                            <i class="fa-solid fa-language me-1"></i>
                                            عربي
                                        @endif
                                    </a>
                                @endforeach
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        {{-- mobile / tablet menu button (hidden on desktop) --}}
        <button type="button" class="mobile-nav-toggle" aria-controls="mobileNav" aria-expanded="false"
            aria-label="{{ app()->getLocale() == 'ar' ? 'فتح القائمة' : 'Open menu' }}"
            data-label-open="{{ app()->getLocale() == 'ar' ? 'فتح القائمة' : 'Open menu' }}"
            data-label-close="{{ app()->getLocale() == 'ar' ? 'إغلاق القائمة' : 'Close menu' }}">
            <span class="mobile-nav-toggle__bar"></span>
            <span class="mobile-nav-toggle__bar"></span>
            <span class="mobile-nav-toggle__bar"></span>
        </button>
    </div>

    @include('site.layouts.mobileMenu')
</header>
<div class="mobile-nav-backdrop" aria-hidden="true"></div>
<!-- Header End -->

<script>
    (function() {
        const header = document.querySelector('.header');
        if (!header) {
            return;
        }

        // home page: transparent at the top, solid once scrolled
        const onScroll = function() {
            header.classList.toggle('header--scrolled', window.scrollY > 20);
        };

        onScroll();
        window.addEventListener('scroll', onScroll, {
            passive: true
        });

        // mobile / tablet menu
        const toggle = header.querySelector('.mobile-nav-toggle');
        const panel = document.getElementById('mobileNav');
        const backdrop = document.querySelector('.mobile-nav-backdrop');
        if (!toggle || !panel) {
            return;
        }

        const isOpen = () => header.classList.contains('header--menu-open');

        const setOpen = function(open) {
            header.classList.toggle('header--menu-open', open);
            document.documentElement.classList.toggle('mobile-nav-open', open);
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
            toggle.setAttribute('aria-label', open ? toggle.dataset.labelClose : toggle.dataset.labelOpen);
        };

        toggle.addEventListener('click', () => setOpen(!isOpen()));

        if (backdrop) {
            backdrop.addEventListener('click', () => setOpen(false));
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen()) {
                setOpen(false);
                toggle.focus();
            }
        });

        // back to desktop width: the panel does not exist there
        window.matchMedia('(min-width: 992px)').addEventListener('change', function(e) {
            if (e.matches) {
                setOpen(false);
            }
        });

        panel.addEventListener('click', function(e) {
            const subToggle = e.target.closest('.mobile-nav__toggle');
            if (subToggle) {
                const sub = document.getElementById(subToggle.getAttribute('aria-controls'));
                const expanded = subToggle.getAttribute('aria-expanded') === 'true';
                subToggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
                sub.hidden = expanded;
                return;
            }

            if (e.target.closest('a')) {
                setOpen(false);
            }
        });
    })();
</script>

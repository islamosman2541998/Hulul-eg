<!-- Header Section Begin -->
<header class="header" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="./index.html"><img
                            src="{{ asset($settings->getItem(app()->getLocale() == 'en' ? 'logo_en' : 'logo_ar')) }}"
                            class="logoImg" alt=""></a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="header__nav__option" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
                    <nav class="header__nav__menu mobile-menu" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
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
                            <li> <a href="./img/HULUL.EG (1).pdf" class="profile-link" aria-label="Our Profile">
                                    <span class="hide-on-mobile text-white">@lang('messages.Profile')</span>
                                </a>
                            </li>
                            <div class="header__actions ">
                                <a href="./requestService.html" class="btn request-btn " id="startBtn">
                                    <i class="fa-regular fa-pen-to-square "></i> @lang('messages.request_service')
                                </a>
                            </div>
                            <div class="lang-switch d-flex align-items-center ms-lg-3"> 
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
                            </div>
                        </ul>
                       
                    </nav>

                </div>
            </div>
        </div>
<div id="mobile-menu-wrap" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" data-locale="{{ app()->getLocale() }}"></div>
    </div>
</header>
<!-- Header End -->

<style>
   [dir="rtl"]  .slicknav_btn {
    position: absolute;
    left: 10px !important ;
    right: auto !important ;
    top: 26px;
    background: #00bfe7;
  }
</style>

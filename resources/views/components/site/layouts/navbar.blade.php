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
            <div class="col-lg-10" >
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
                                    <span class="hide-on-mobile text-white"> Profile</span>
                                </a>
                            </li>
                            <div class="header__actions ">
                                <a href="./requestService.html" class="btn request-btn " id="startBtn">
                                    <i class="fa-regular fa-pen-to-square "></i> Request Service
                                </a>
                            </div>

                        </ul>

                    </nav>

                    <div class="dropdown d-none d-sm-block">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-globe main-color m-0 p-0 "></i>
                            {{ strtoupper(app()->getLocale()) }}
                        </a>
                        <ul class="dropdown-menu main-color-bg">
                            @foreach ($locals as $lang)
                                <li class="text-center ">
                                    <a class="dropdown-item" href=" {{ LaravelLocalization::getLocalizedURL($lang) }} ">
                                        {{ $lang == 'en' ? 'English' : 'العربية' }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>


                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"  ></div>
    </div>
</header>
<!-- Header End -->

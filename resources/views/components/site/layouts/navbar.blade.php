<header id="mainNav" class="site-nav overlay {{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}
      @if (Route::is('site.products.show') ||
              Route::is('site.products.index') ||
              Route::is('site.contact-us') ||
              Route::is('site.faq-questions') ||
              Route::is('site.about-us') ||
              Route::is('site.news.index') ||
              Route::is('site.news.show') ||
              Route::is('site.jobs.index') ||
              Route::is('site.jobs.show') ||
              Route::is('site.jobs.apply') ||
              Route::is('site.site.blogs.index') ||
              Route::is('site.site.blogs.show')) othernav navbar-shadow @endif
    
    " data-overlay="true" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="nav-inner">
        <div class="logo">
            <a class="navImg-a" href="{{ route('site.home') }}">
                <img class="navImg" src="{{ asset($settings->getItem(app()->getLocale() == 'en' ? 'logo_en' : 'logo_ar')) }}" alt="Tetra Pharma">
            </a>
        </div>
        <nav class="links" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" id="mainNav">
            @php
            $items = Cache::get('menus');
            if ($items == null) {
            $items = Cache::rememberForever('menus', function () {
            return App\Models\Menue::with('trans')->orderBy('sort', 'ASC')->main()->active()->get();
            });
            }
            @endphp
            @include('site.layouts.menuItem')
            <a class="career_btn" href="{{ route('site.jobs.index') }}" target="_blank"> {{ __(key: 'site.career') }}
            </a>
        </nav>
        <div class="right">
            <div class="dropdown d-none d-sm-block">
                <a class=" dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
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
            <!-- Burger -->
            <button class="burger" aria-controls="offcanvas" aria-expanded="false" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>

    <aside id="offcanvas" class="offcanvas" aria-hidden="true">
        <nav class="mobile-links" aria-label="Mobile menu">
            @include('site.layouts.menuItem')
            <a class="career_btn" href="{{ route('site.jobs.index') }}" target="_blank"> {{ __(key: 'site.career') }}
            </a>
            <div class="dropdown">
                <button class="dropdown-toggle btn text-white bg-body" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-globe text-white main-color m-0 p-0 "></i>
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu text-center  main-color-bg">
                    @foreach ($locals as $lang)
                    <li class="text-center  ">
                        <a class="dropdown-item text-center" href="{{ LaravelLocalization::getLocalizedURL($lang) }}">
                            {{ $lang == 'en' ? 'English' : 'العربية' }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </nav>

        <div class="mobile-actions">
            {{-- <a class="career_btn" href="{{ route('site.jobs.index') }}" target="_blank"> {{ __(key: 'site.career') }}
            </a> --}}

        </div>

    </aside>

    <div class="backdrop" hidden></div>


</header>

{{-- Mobile / tablet menu panel (≤ 991px). Opened by the .mobile-nav-toggle button in the navbar. --}}
@php
    $locale = app()->getLocale();
    $currentPath = trim(request()->path(), '/');
    $homePaths = [$locale, ''];

    $menuUrl = fn ($item) => LaravelLocalization::getLocalizedURL(
        $locale,
        $item->type === 'dynamic' ? $item->dynamic_url : $item->url,
    );

    // same rule as the desktop menu: home matches only home, other pages match themselves and their sub-pages
    $isCurrent = function ($url) use ($currentPath, $homePaths) {
        $path = trim(parse_url($url, PHP_URL_PATH) ?? '', '/');

        if (in_array($path, $homePaths, true)) {
            return in_array($currentPath, $homePaths, true);
        }

        return $path === $currentPath || ($path !== '' && \Illuminate\Support\Str::startsWith($currentPath, $path));
    };

    $menuTitle = fn ($item) => $item->trans?->where('locale', $locale)->first()->title ?? 'No Title';
@endphp

<nav class="mobile-nav" id="mobileNav" aria-label="{{ $locale == 'ar' ? 'القائمة الرئيسية' : 'Main menu' }}"
    dir="{{ $locale == 'ar' ? 'rtl' : 'ltr' }}">
    <ul class="mobile-nav__list">
        @foreach ($items->where('parent_id', 0) as $item)
            @php $children = $items->where('parent_id', $item->id); @endphp

            @if ($children->count())
                @php $childActive = $children->contains(fn ($child) => $isCurrent($menuUrl($child))); @endphp
                <li class="mobile-nav__item">
                    <button type="button" class="mobile-nav__link mobile-nav__toggle {{ $childActive ? 'is-active' : '' }}"
                        aria-expanded="{{ $childActive ? 'true' : 'false' }}" aria-controls="mobileSub{{ $item->id }}">
                        <span>{{ $menuTitle($item) }}</span>
                        <span class="mobile-nav__chevron" aria-hidden="true"></span>
                    </button>

                    <ul class="mobile-nav__sub" id="mobileSub{{ $item->id }}" @unless ($childActive) hidden @endunless>
                        @foreach ($children as $child)
                            @php $childUrl = $menuUrl($child); @endphp
                            <li>
                                <a href="{{ $childUrl }}"
                                    class="mobile-nav__sublink {{ $isCurrent($childUrl) ? 'is-active' : '' }}"
                                    @if ($isCurrent($childUrl)) aria-current="page" @endif>
                                    {{ $menuTitle($child) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                @php $url = $menuUrl($item); @endphp
                <li class="mobile-nav__item">
                    <a href="{{ $url }}" class="mobile-nav__link {{ $isCurrent($url) ? 'is-active' : '' }}"
                        @if ($isCurrent($url)) aria-current="page" @endif>
                        {{ $menuTitle($item) }}
                    </a>
                </li>
            @endif
        @endforeach

        <li class="mobile-nav__item">
            <a href="{{ asset('site/img/HULUL.EG (1).pdf') }}" class="mobile-nav__link" target="_blank" rel="noopener">
                @lang('messages.Profile')
            </a>
        </li>
    </ul>

    <div class="mobile-nav__footer">
        <a href="{{ route('site.service_request.index') }}" class="mobile-nav__cta">
            <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
            <span>@lang('messages.request_meeting')</span>
        </a>

        @foreach ($locals as $lang)
            <a href="{{ LaravelLocalization::getLocalizedURL($lang) }}" class="mobile-nav__lang" rel="alternate"
                hreflang="{{ $lang }}">
                <i class="fa-solid fa-globe" aria-hidden="true"></i>
                <span>{{ $lang == 'en' ? 'English' : 'عربي' }}</span>
            </a>
        @endforeach
    </div>
</nav>

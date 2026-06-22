@php
    // ensure locale variables exist
    $locale = app()->getLocale();
    $current_lang = $locale;

    // current normalized path (no leading/trailing slash)
    $currentPath = trim(request()->path(), '/'); // '' for home

    // helper (use fully qualified name to avoid needing `use` statement)
    $Str = \Illuminate\Support\Str::class;
@endphp

@foreach ($items->where('parent_id', $parent_id ?? 0) as $item)
    @php
        // compute the item's localized url
$itemUrl = LaravelLocalization::getLocalizedURL(
    $locale,
    $item->type === 'dynamic' ? $item->dynamic_url : $item->url,
);

// normalized path (no leading slash)
$itemPath = trim(parse_url($itemUrl, PHP_URL_PATH) ?? '', '/');

// children collection (one level)
$children = $items->where('parent_id', $item->id);

// Normalize home for sites that use locale prefix or empty path
$localeHomePaths = [$locale, '']; // e.g. ['en', '']

if (in_array($itemPath, $localeHomePaths, true)) {
    // item points to home for this locale
    $isActive = in_array($currentPath, $localeHomePaths, true);
} else {
    // normal pages: exact match or startsWith to cover subpages
    $isActive = $itemPath === $currentPath || ($itemPath !== '' && $Str::startsWith($currentPath, $itemPath));
        }
    @endphp

    @if ($children->count())
        {{-- Parent (dropdown toggle) — never gets the active class, regardless of itself or its children matching the current path --}}
        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="nav-link dropdown-toggle" id="navbarDropdown{{ $item->id }}"
                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>{{ $item->trans?->where('locale', $current_lang)->first()->title ?? 'No Title' }}</span>
                <span class="dropdown-caret" aria-hidden="true"></span>
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $item->id }}">
                @include('site.layouts.menuItem', ['parent_id' => $item->id])
            </ul>
        </li>
    @else
        {{-- Leaf link — active class applies here only --}}
        <li class="{{ $isActive ? 'active' : '' }}">
            <a href="{{ $itemUrl }}">
                {{ $item->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}
            </a>
        </li>
    @endif
@endforeach
<style>
    /* ===== Premium Header Dropdown ===== */

    .header__nav__menu .nav-item.dropdown {
        position: relative;
    }

    .header__nav__menu .nav-link.dropdown-toggle {
        display: inline-flex !important;
        align-items: center;
        gap: 7px;
    }

    /* hide bootstrap default caret */
    .header__nav__menu .nav-link.dropdown-toggle::after {
        display: none !important;
    }

    /* small custom arrow */
    .header__nav__menu .dropdown-caret {
        width: 7px;
        height: 7px;
        border-right: 2px solid #00bfe7;
        border-bottom: 2px solid #00bfe7;
        transform: rotate(45deg);
        margin-top: -4px;
        transition: transform 0.25s ease, margin 0.25s ease;
    }

    .header__nav__menu .nav-link.dropdown-toggle[aria-expanded="true"] .dropdown-caret {
        transform: rotate(-135deg);
        margin-top: 4px;
    }

    .header__nav__menu .dropdown-menu {
        display: none !important;
        position: absolute;
        top: 48px !important;
        right: 0 !important;
        left: auto !important;
        min-width: 220px;
        background: rgba(8, 12, 42, 0.96);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        padding: 10px;
        margin: 0;
        border: 1px solid rgba(0, 191, 231, 0.22);
        border-radius: 14px;
        z-index: 99999;
        box-shadow: 0 18px 45px rgba(0, 0, 0, 0.38);
        transform: none !important;
    }

    /* show only on click */
    .header__nav__menu .dropdown-menu.show {
        display: block !important;
        animation: dropdownFade 0.22s ease both;
    }

    /* small triangle */
  .header__nav__menu .dropdown-menu::before {
    content: "";
    position: absolute;
    top: -7px;
    right: 24px;
    width: 14px;
    height: 14px;
    background: rgba(8, 12, 42, 0.96);
    border-left: 1px solid rgba(0, 191, 231, 0.22);
    border-top: 1px solid rgba(0, 191, 231, 0.22);
    transform: rotate(45deg);
}

    /* menu items */
    .header__nav__menu .dropdown-menu li {
        display: block !important;
        margin: 0 !important;
        width: 100%;
    }

    .header__nav__menu .dropdown-menu li a {
        display: flex !important;
        align-items: center;
        justify-content: flex-start;
        color: #ffffff !important;
        padding: 11px 14px !important;
        font-size: 14px;
        font-weight: 500;
        text-transform: none !important;
        white-space: nowrap;
        border-radius: 10px;
        transition: all 0.25s ease;
    }

    .header__nav__menu .dropdown-menu li a:hover {
        background: linear-gradient(135deg, rgba(0, 191, 231, 0.18), rgba(124, 140, 251, 0.18));
        color: #ffffff !important;
        padding-inline-start: 18px !important;
    }

    .header__nav__menu .dropdown-menu li a:after {
        display: none !important;
    }

    /* prevent hover opening */
    .header__nav__menu .nav-item.dropdown:hover>.dropdown-menu:not(.show) {
        display: none !important;
    }

    /* RTL */
    [dir="rtl"] .header__nav__menu .dropdown-menu {
        right: 0;
        left: auto;
        text-align: right;
    }

    [dir="rtl"] .header__nav__menu .dropdown-menu::before {
        right: 26px;
        left: auto;
    }

    [dir="rtl"] .header__nav__menu .dropdown-menu li a {
        justify-content: flex-start;
    }

    .header__nav__menu>ul>li>a {
        white-space: nowrap;
    }

  @keyframes dropdownFade {
    from {
        opacity: 0;
        transform: translateY(10px) scale(0.98);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}
</style>

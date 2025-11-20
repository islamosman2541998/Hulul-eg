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
            $item->type === 'dynamic' ? $item->dynamic_url : $item->url
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
            $isActive = ($itemPath === $currentPath) || ($itemPath !== '' && $Str::startsWith($currentPath, $itemPath));
        }

        // check children (one-level) using same normalization
        $hasActiveChild = $children->contains(function ($c) use ($locale, $currentPath) {
            $cUrl = LaravelLocalization::getLocalizedURL(
                $locale,
                $c->type === 'dynamic' ? $c->dynamic_url : $c->url
            );
            $cPath = trim(parse_url($cUrl, PHP_URL_PATH) ?? '', '/');

            $localeHomePaths = [$locale, ''];
            if (in_array($cPath, $localeHomePaths, true)) {
                return in_array($currentPath, $localeHomePaths, true);
            }

            return ($cPath === $currentPath) || ($cPath !== '' && \Illuminate\Support\Str::startsWith($currentPath, $cPath));
        });

        $liClass = ($isActive || $hasActiveChild) ? 'active' : '';
    @endphp

    @if ($children->count())
        <li class="nav-item dropdown {{ $liClass }}">
            <a href="{{ $itemUrl }}"
               class="nav-link dropdown-toggle"
               id="navbarDropdown{{ $item->id }}"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false">
                {{ $item->trans?->where('locale', $current_lang)->first()->title ?? 'No Title' }}
            </a>

            <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $item->id }}">
                @include('site.layouts.menuItem', ['parent_id' => $item->id])
            </ul>
        </li>
    @else
        <li class="{{ $liClass }}">
            <a href="{{ $itemUrl }}">
                {{ $item->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}
            </a>
        </li>
    @endif
@endforeach

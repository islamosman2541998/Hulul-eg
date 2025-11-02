@foreach ($menus->where('parent_id', $parent_id) as $item)
    @php
        $totalChildren = $item->children()->count();
        $isActive = LaravelLocalization::getCurrentLocale() . '/' . ltrim($item->dynamic_url, '/') == Request::path();
        
    @endphp

    @if ($totalChildren)
        <li class="nav-item dropdown {{ $isActive ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" id="navbarDropdown{{ $item->id }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ $item->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $item->id }}">
                @include('components.site.layouts.menuItem', ['menus' => $menus, 'parent_id' => $item->id])
            </ul>
        </li>
    @else
        <li class="nav-item {{ $isActive ? 'active' : '' }}">
            <a class="nav-link" aria-current="page" href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), $item->type == 'dynamic' ? $item->dynamic_url : $item->url) }}">
                {{ $item->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}
            </a>
        </li>
    @endif
@endforeach
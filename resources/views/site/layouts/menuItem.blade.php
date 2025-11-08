@foreach ($items->where('parent_id', $parent_id ?? 0) as $item)
    @php
        $totalChildren = $items->where('parent_id', $item->id)->count();
        $first = false;
        $isActive = LaravelLocalization::getCurrentLocale() . '/' . ltrim($item->dynamic_url, '/') == Request::path();
    @endphp


    @if ($totalChildren)
        <li class="nav-item dropdown {{ $isActive ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" id="navbarDropdown{{ $item->id }}" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                {{ @$item->trans?->where('locale', $current_lang)->first()->title }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $item->id }}">
                @include('site.layouts.menuItem', ['parent_id' => $item->id])
            </ul>
        </li>
    @else
        
            <li class="{{ $isActive ? 'active' : '' }}">
                <a
                    href="{{ LaravelLocalization::getLocalizedURL(app()->getLocale(), $item->type == 'dynamic' ? $item->dynamic_url : $item->url) }}">
                    {{ $item->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}
                </a>
            </li>
       
    @endif
@endforeach

{!! '<?xml version="1.0" encoding="UTF-8"?>' !!}
{{-- the declaration is echoed (and must stay on line 1) so short_open_tag can never read it as PHP --}}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">
@foreach ($pages as $page)
    @foreach ($page['urls'] as $url)
    <url>
        <loc>{{ $url }}</loc>
        @if ($page['lastmod'])
        <lastmod>{{ $page['lastmod']->toAtomString() }}</lastmod>
        @endif
        @foreach ($page['urls'] as $locale => $alternate)
        <xhtml:link rel="alternate" hreflang="{{ $locale }}" href="{{ $alternate }}" />
        @endforeach
        @isset($page['urls']['ar'])
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $page['urls']['ar'] }}" />
        @endisset
    </url>
    @endforeach
@endforeach
</urlset>

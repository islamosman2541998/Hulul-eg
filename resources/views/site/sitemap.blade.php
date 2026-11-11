{{-- no XML declaration here: with short_open_tag on, Blade's tokenizer reads it as PHP; the controller adds it --}}
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
        @if ($page['x_default'])
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $page['x_default'] }}" />
        @endif
    </url>
    @endforeach
@endforeach
</urlset>

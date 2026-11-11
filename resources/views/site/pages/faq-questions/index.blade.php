@extends('site.app')

@section('title', @$metaSetting->where('key', 'faq_meta_title_' . $current_lang)->first()->value ?: __('home.faq-index'))
@section('meta_key', @$metaSetting->where('key', 'faq_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'faq_meta_description_' . $current_lang)->first()->value)

@if ($questions->isEmpty())
    {{-- nothing answered yet: keep the empty page out of search results (it is left out of the sitemap too) --}}
    @section('robots', 'noindex, follow')
@else
    @push('schema')
        @php
            $faqSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'inLanguage' => app()->getLocale(),
                'url' => url()->current(),
                'mainEntity' => $questions->map(fn ($faq) => [
                    '@type' => 'Question',
                    'name' => trim(html_entity_decode(strip_tags((string) $faq->question), ENT_QUOTES | ENT_HTML5, 'UTF-8')),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        // the answer as visitors read it: links kept, editor markup dropped
                        'text' => trim(strip_tags(html_entity_decode((string) $faq->answer, ENT_QUOTES | ENT_HTML5, 'UTF-8'), '<a><br><ul><ol><li><strong><b><p>')),
                    ],
                ])->all(),
            ];
        @endphp
        <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @endpush
@endif

@section('content')
    <!-- ===== HERO ===== -->
    <section class="hero wow bounceInLeft" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
        <div class="container">
            <h1 class="color_blue">@lang('home.faq-index')</h1>
            <p class="breadcrumb"><a href="{{ route('site.home') }}" target="_blank">@lang('home.home')</a> / @lang('home.faq')</p>
        </div>
    </section>

    @livewire('site.faq.index', ['categories' => $categories], key($user->id))


@endsection

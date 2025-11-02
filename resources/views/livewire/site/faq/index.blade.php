<section dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container faq-wrap">
        <!-- Sidebar -->
        <aside class="faq-side  wow fadeInLeft">
            <h3>@lang('home.faq-index_h3')</h3>
            <p class="mini">@lang('home.faq-index_pp')</p>
            <div class="faq-cta">
                <a class="btn primary blue_btn" href="{{ route('site.contact-us')}}">@lang('home.contact')</a>
                <a class="btn light blue_btn" href="{{ route('site.site.blogs.index')}}">@lang('home.read')</a>
            </div>
        </aside>

        <!-- Main -->
        <div class="category  wow fadeInRight">
            <!-- Filter chips -->
            <div class="faq-controls controls">
                <span class="chip  {{ $selectedCategory == 0 ? 'active': '' }}" data-tag="@lang('All')" wire:click="changeCategory(0)"> @lang('All')</span>
                @forelse ($categories as $key => $category)
                <span class="chip {{ $selectedCategory == $category->id ? 'active': '' }} wow fadeInUp" style="animation-delay: 0.{{ ($key + 1) }}s;"" data-tag=" {{ @$category->transNow->title }}" wire:click="changeCategory({{ $category->id }})"> {{ @$category->transNow->title }} </span>
                @empty
                <p>@lang('home.no_faq')</p>
                @endforelse

        </div>

            <div class="faq">
                @forelse ($faq_questions as $key => $question)
                <details data-tags="science,quality" class=" wow fadeInRight" style="animation-delay: 0.{{ ($key + 1) }}s;" open>
                    <summary><span class="dot text-primary"></span> <span class="text-primary">{{ $question->question }}</span></summary>
                    <div class="content">
                        <p> {!! $question->answer !!} </p>
                    </div>
                </details>
                @empty
                <p>@lang('home.no_faq')</p>
                @endforelse
            </div>


        </div>
    </div>
</section>

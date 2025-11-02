<!-- OUR PARTNERS -->
	@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_partners    = (int) $settings->getHome('show_partners');
@endphp
@if ($show_partners)
    <section class="OurPartner" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <h3 class="PartnerH3">@lang('site.our_partners')</h3>

    <div class="parner">
        <div class="partnercompanies">


            @forelse ($partners as $partner)
                <a class="text-decoration-none" target="_blank" href="{{ $partner->url }}">
                    <div class="ImgDiv d-flex flex-column align-items-center">
                        <img class="PartnerImg" src="{{ asset('storage/attachments/partners/' . $partner->image) }}"
                            alt="Client 1">
                        {{-- @if ($partner->translate(app()->getLocale())->title)
                            <h4 class="pt-3">{{ $partner->translate(app()->getLocale())->title ?? '' }}</h4>
                        @endif --}}
                    </div>
                </a>

            @empty

                <h3>@lang('site.no_partners')</h3>
            @endforelse



        </div>
    </div>
</section>
@endif


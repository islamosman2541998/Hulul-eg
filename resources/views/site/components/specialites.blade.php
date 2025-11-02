<div class="OURSPECIALTIES  py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center py-3">
                <h1 class="text-secound">@lang('OUR') <span class="display-lg-3 w">@lang('specialties.SPECIALTIES')</span></h1>
            </div>

            @forelse ($specialties as $key => $specialty)
                @if (fmod($key, 4) == 0 && $key == 0)
                    <div class="cards col-12 row text-center wow bounceInLeft">
                    @elseif(fmod($key, 4) == 0)
                    </div>
                    <div class="cards col-12 row text-center wow bounceInRight">
                @endif
                <a href="{{ route('site.specialites.show', $specialty->trans->where('locale', $current_lang)->first()->slug) }}?doctor={{ @$specialty->trans->where('locale', $current_lang)->first()->slug }}"
                    class="col-12 col-lg  S_card mt-3 bg-white p-3 ms-2">
                    <img src="{{ asset($specialty->image) }}" class="mt-3" alt="">
                    <h4 class="mt-3 ">
                        {{ @$specialty->trans->where('locale', $current_lang)->first()->title }}
                    </h4>
                    <p class="text-secound">
                        {!! removeHTML(substr(@$specialty->trans->where('locale', $current_lang)->first()->description, 0, 400)) !!}

                    </p>
                </a>
            @empty
            @endforelse
        </div>
        <div class="col-12 justify-content-center text-center">
            <a href="{{ route('site.specialites') }}" class="btn text-white q me-3 px-5 my-5">@lang('ALL SPECIALTIES')</a>
        </div>


    </div>
</div>
</div>

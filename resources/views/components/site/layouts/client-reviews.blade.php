<div class="clients">
    <div class="container">
        <div class="row py-5">

            <div class="col-12 navigation text-center mb-5">
                <h1 class="text-secound">@lang('WHAT') <span> @lang('CLIENTS SAY')</span></h1>
                <div class="arrow">
                </div>
            </div>

            <div class="col-12">
                <div class="swiper X">
                    <div class="swiper-wrapper  flex--wrap flex-xl-nowrap">

                        @forelse ($reviews as $key => $review)
                        @if(fmod($key, 2) == 0 && $key == 0)
                            <div class="swiper-slide d-flex  justify-content-xl-center">
                        @elseif(fmod($key, 2) == 0 )
                            </div>
                            <div class="swiper-slide d-flex  justify-content-xl-center">
                        @endif
                            <div class="ClientsCard col-12 col-xl-5 me-xl-3">
                                <p>
                                    {!! @$review->trans->where('locale', $current_lang)->first()->description !!}
                                </p>
                                <div class="card-footer d-flex bg-transparent mt-5">
                                    <img class="avatar" src="{{ asset($review->image) }}" alt="{{ @$review->trans->where('locale', $current_lang)->first()->title }}">
                                    <div class="Slideinfo ">
                                        <h6 class="text-main">
                                            {{ @$review->trans->where('locale', $current_lang)->first()->title }}
                                        </h6>
                                        <span class="user-name ">
                                            {{ @$review->trans->where('locale', $current_lang)->first()->type }}
                                        </span>
                                    </div>
                                </div>
                            </div>


                        @empty

                        @endforelse
                        </div>
                    </div>
                    <div class="swiper-button swiper-button-next text-white px-3 mx-3"></div>
                    <div class=" swiper-button swiper-button-prev  text-white px-3 mx-3 "></div>
                </div>

            </div>

        </div>
    </div>
</div>

<div class="Gallery py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 navigation text-center text-lg-left">
                <h1 class="text-secound">@lang('OUR') <span class="display-lg-3 w">@lang('gallery.GALLERY')</span></h1>

                <div class="arrow">
                </div>
            </div>


            <div class=" G_Cards col-12 row mt-5 wow bounceInUp">

                @forelse ($galleries as $key => $gallery)

                 <div class=" col-12 col-lg-4 my-lg-0 my-3 G_Card">
                    <div class="card shadow myCursor" onclick="window.location.href='{{url(app()->getLocale().'/gallery/'.$gallery->slug)}}'" style="width: 100%;">
                        <img class="card-img-top" src="{{ asset($gallery->image) }}" alt="Card image cap">
{{--                        <div class="card-body">--}}
{{--                            <p class="card-text">--}}
{{--                                {!! @$gallery->trans->where('locale', $current_lang)->first()->description !!}--}}
{{--                            </p>--}}
{{--                        </div>--}}
                    </div>
                </div>
                @empty

                @endforelse

            </div>

            <div class="col-12 justify-content-center text-center">
                <a href="{{ route('site.gallery.index') }}" class="btn text-white q me-3 px-5 my-5">@lang('SEE ALL')</a>
            </div>
        </div>
    </div>
</div>

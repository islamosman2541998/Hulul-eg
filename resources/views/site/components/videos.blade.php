<div class="Videos py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 navigation text-lg-left text-center">
                <h1 class="text-secound">@lang('OUR') <span class="display-lg-3 w">@lang('videos.VIDEOS')</span></h1>
            </div>
            <div class=" vedio col-12 mt-5 row  wow bounceInLeft">
                <div class=" col-12 col-lg-6 row  text-center ">

                    @forelse ($videos as $video)
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <img src="{{ asset($video->image) }}" class="img-fluid" alt="">
                            <p>
                                {!! @$video->trans->where('locale', $current_lang)->first()->description !!}
                            </p>
                        </div>
                    @empty
                        
                    @endforelse
                </div>


                <div class="col-12 col-lg-6 text-center">
                    @forelse ($videos as $video)

                        <div class="z mb-2 video-frame">
                            <iframe width="95%" height="90%" src="{{ $video->url }}"> </iframe>
                        </div>
                        
                    @empty
                        
                    @endforelse
                  
                </div>
            </div>
        </div>
    </div>
</div>
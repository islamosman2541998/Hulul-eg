<div class="ourdoctors">
    <div class="container">
        <div class="row py-5">
            <div class="col-lg-8 col-12 text text-center wow bounceInLeft" id='x'>
                <h1 class="text-secound"> {{ @$meetDoctor->trans->where('locale', $current_lang)->first()->title }}</h1>
                <h5 class="my-5">
                    {!! removeHTML(@$mission->trans->where('locale', $current_lang)->first()->description) !!}
                </h5>
                
                <p class="mb-5"> 
                    {!! @$meetDoctor->trans->where('locale', $current_lang)->first()->description !!}
                </p>
                <a href="{{ route('site.doctors') }}" class="btn btn-success text-white me-3  px-5 my-5">@lang('DETAILS')</a>
            </div>
            <div class="col-lg-4 col-12 wow bounceInRight" id='y'>
                <img src="{{ asset(@$meetDoctor->image) }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</div>
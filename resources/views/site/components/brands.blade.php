<div class="insurances py-5">
    <div class="container">
        <div class="row">
            <div class=" col-12 col-lg-6 my-2 my-lg-0">
                <img src="{{ asset($insurance->image) }}" class="img-fluid" alt="">
            </div>
            <div class=" text  col-12 col-lg-6 text-center my-auto text-white wow bounceInUp">
                <h1>
                    {{ @$insurance->trans->where('locale', $current_lang)->first()->title }}
                </h1>
                <span class="text-white">
                    {!! @$insurance->trans->where('locale', $current_lang)->first()->description !!}
                </span>
            </div>
        </div>
    </div>
</div>
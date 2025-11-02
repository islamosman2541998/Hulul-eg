<div class="visions container my-5">
    <div class="row">
        <div class="col-12 text-center py-3 p-5">
            <h1 class="text-secound">@lang('OUR') <span class="display-lg-3 w">
                {{ @$visions?->trans()->where('locale', $current_lang)->first()->title }}
            </span></h1>
        </div>
        <div class="col  col-md-7 p-3 m-auto">
            <p class="text-secound fw-bold">{!! @$visions?->trans()->where('locale', $current_lang)->first()->description !!}</p>
        </div>
        <div class=" col col-md-5 d-flex justify-content-center ">
            <img src="{{ asset(@$visions->image) }}" class="img-fluid m-auto rounded" alt="">
        </div>
    </div>
</div>


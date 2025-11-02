<div class="community">
    <div class="container">
        <div class="row py-5 justify-content-center align-items-center wow bounceInUp">
            <div class="Text col-lg-6 col-12 text-center p-5">
                <h1 class="text-white">
                    {{ @$makeAppointment->trans->where('locale', $current_lang)->first()->title }}
                </h1>
                <h5 class="text-white">
                    {!! @$makeAppointment->trans->where('locale', $current_lang)->first()->description !!}
                </h5>
            </div>
            <div class="col-lg-6 col-12 Btn text-center">
                <a class="btn bg-white" href="{{ route('site.booking') }}"> <i class="fa-solid fa-calendar-days mx-2"></i> @lang('MAKE AN APPOINTMENT') </a>
            </div>
        </div>
    </div>
</div>

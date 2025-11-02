<div class="info py-5">
    <div class="container">
        <div class="row text-center justify-content-center align-content-center wow slideInLeft" >

            @php 
                $settings = App\Settings\SettingSingleton::getInstance();
            @endphp
            <div class=" col-12 col-lg-3 my-lg-0 my-3 d-flex  justify-content-center align-items-center text-center">
                <i class="fa-solid fa-phone fs-1 mx-2 "></i>
                <span class="text-center">
                    @lang('Emergency Cases')<br>
                    {{ $settings->getItem('mobile') }}
                </span>
            </div>


            <div class="col-12 col-lg-3 my-lg-0 my-3 d-flex  justify-content-center align-items-center text-center">
                <i class="fa-solid fa-location-dot fs-1 mx-2"></i>
                <span class="text-center">
                    <a href="{{ $settings->getItem('address_links') }}">
                        {{ $settings->getItem('address') }}
                    </a>
                </span>
            </div>


            <div class="col-12 col-lg-3 my-lg-0 my-3 d-flex  justify-content-center align-items-center text-center">
                <i class="fa-regular fa-envelope fs-1 mx-2"></i>
                <span class="text-center">
                    @lang('Email Address')
                    <br>
                        {{ $settings->getItem('email') }}
                </span>
            </div>

            <div class="col-12 col-lg-3 my-lg-0 my-3 d-flex  justify-content-center align-items-center text-center">
                <i class="fa-regular fa-calendar-days fs-1 mx-2""></i>
            <a href="{{ route('site.booking') }}">
                <span class=" text-center">
                    @lang('Booking Online')<br>
                    @lang('Appointment Now')
                    </span>
            </a>
            </div>
        </div>
    </div>
</div>
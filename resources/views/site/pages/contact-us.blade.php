@extends('site.app')
@section('title', @$metaSetting->where('key', 'contact_us_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'contact_us_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'contact_us_meta_description_' .
    $current_lang)->first()->value)

    @php
        $settings = \App\Settings\SettingSingleton::getInstance();

    @endphp

@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ asset('site/img/111.jpeg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>@lang('home.contact-us')</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('site.home') }}">@lang('home.home')/</a>
                            <span>@lang('home.contact-us')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

<!-- Contact Widget Section Begin -->
<section class="contact-widget spad" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
        <div class="row contact-info-row">

            <div class="col-lg-4 col-md-6 col-12">
                <div class="contact__widget__item contact-info-item d-flex align-items-center gap-3">
                    <div class="contact__widget__item__icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="contact__widget__item__text">
                        <h4>@lang('admin.address')</h4>
                        <p>{{ $settings->getItem('address') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="contact__widget__item contact-info-item d-flex align-items-center gap-3">
                    <div class="contact__widget__item__icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <div class="contact__widget__item__text">
                        <h4>@lang('admin.address_ksa')</h4>
                        <p>{{ $settings->getItem('address_ksa') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="contact__widget__item contact-info-item d-flex align-items-center gap-3">
                    <div class="contact__widget__item__icon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div class="contact__widget__item__text">
                        <h4>@lang('admin.phone')</h4>
                        <p>{{ $settings->getItem('mobile') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="contact__widget__item contact-info-item d-flex align-items-center gap-3">
                    <div class="contact__widget__item__icon">
                        <i class="fa fa-whatsapp"></i>
                    </div>
                    <div class="contact__widget__item__text">
                        <h4>@lang('admin.mobile_ksa')</h4>
                        <p>{{ $settings->getItem('mobile_ksa') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="contact__widget__item contact-info-item d-flex align-items-center gap-3">
                    <div class="contact__widget__item__icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div class="contact__widget__item__text">
                        <h4>@lang('admin.email')</h4>
                        <p>{{ $settings->getItem('email') }}</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Contact Widget Section End -->

    <!-- Call To Action Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__map">
                        <iframe src="{{ $settings->getItem('maps') }}" height="450" style="border: 0"></iframe>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    @livewire('site.contact-form')
                </div>
            </div>
        </div>
    </section>
    <!-- Call To Action Section End -->

@endsection
<style>
    .contact-info-row {
        row-gap: 35px;
    }

    .contact-info-item {
        justify-content: flex-start !important;
        text-align: start !important;
        height: 100%;
        margin-bottom: 0 !important;
        gap: 14px !important;
    }

   .contact-info-item .contact__widget__item__icon {
    width: 50px !important;
    height: 50px !important;
    min-width: 50px !important;
    border: 1px solid rgba(255, 255, 255, 0.35) !important;
    border-radius: 50% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    margin: 0 !important;
    padding: 0 !important;
    line-height: normal !important;
    position: relative !important;
    overflow: hidden;
}

.contact-info-item .contact__widget__item__icon i {
    font-size: 18px !important;
    line-height: 1 !important;
    margin: 0 !important;
    padding: 0 !important;
    display: block !important;
    position: static !important;
    top: auto !important;
    left: auto !important;
    right: auto !important;
    bottom: auto !important;
    transform: none !important;
}

@media only screen and (max-width: 767px) {
    .contact-info-item .contact__widget__item__icon {
        width: 44px !important;
        height: 44px !important;
        min-width: 44px !important;
    }

    .contact-info-item .contact__widget__item__icon i {
        font-size: 17px !important;
    }
}

    .contact-info-item .contact__widget__item__text {
        text-align: start !important;
        flex: 1;
    }

    .contact-info-item .contact__widget__item__text h4 {
        font-size: 17px !important;
        line-height: 1.4;
        margin-bottom: 5px;
    }

    .contact-info-item .contact__widget__item__text p {
        font-size: 13px !important;
        line-height: 1.7;
        margin-bottom: 0;
        word-break: break-word;
        overflow-wrap: anywhere;
    }

    @media only screen and (max-width: 991px) {
        .contact-info-row {
            row-gap: 28px;
        }
    }

    @media only screen and (max-width: 767px) {
        .contact-info-row > div {
            width: 100%;
            max-width: 100%;
            flex: 0 0 100%;
        }

        .contact-info-item {
            width: 100%;
            align-items: center !important;
            padding-inline: 18px;
            gap: 14px !important;
        }

        .contact-info-item .contact__widget__item__icon {
            width: 44px !important;
            height: 44px !important;
            min-width: 44px !important;
            line-height: 44px !important;
        }

        .contact-info-item .contact__widget__item__icon i {
            font-size: 17px !important;
            line-height: 44px !important;
        }

        .contact-info-item .contact__widget__item__text h4 {
            font-size: 16px !important;
        }

        .contact-info-item .contact__widget__item__text p {
            font-size: 13px !important;
        }
    }
</style>

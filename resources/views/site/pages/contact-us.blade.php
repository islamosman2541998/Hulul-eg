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
            <div class="row country-contact-row">

                <!-- Egypt -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="country-contact-card">
                        <h3 class="country-contact-title">🇪🇬 @lang('admin.egypt')</h3>

                        <ul class="country-contact-list">
                            <li>
                                <i class="fa fa-map-marker"></i>
                                <span>
                                    <strong>@lang('admin.address'):</strong>
                                    {{ $settings->getItem('address') }}
                                </span>
                            </li>

                            <li>
                                <i class="fa fa-phone"></i>
                                <span>
                                    <strong>@lang('admin.phone'):</strong>
                                    <a href="tel:{{ $settings->getItem('mobile') }}">
                                        {{ $settings->getItem('mobile') }}
                                    </a>
                                </span>
                            </li>

                            <li>
                                <i class="fa fa-envelope"></i>
                                <span>
                                    <strong>@lang('admin.email'):</strong>
                                    <a href="mailto:{{ $settings->getItem('email') }}">
                                        {{ $settings->getItem('email') }}
                                    </a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Saudi Arabia -->
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="country-contact-card">
                        <h3 class="country-contact-title">🇸🇦 @lang('admin.saudi_arabia')</h3>

                        <ul class="country-contact-list">
                            <li>
                                <i class="fa fa-map-marker"></i>
                                <span>
                                    <strong>@lang('admin.address'):</strong>
                                    {{ $settings->getItem('address_ksa') }}
                                </span>
                            </li>

                            <li>
                                <i class="fa fa-whatsapp"></i>
                                <span>
                                    <strong>@lang('admin.mobile'):</strong>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->getItem('mobile_ksa')) }}"
                                        target="_blank" rel="noopener noreferrer">
                                        {{ $settings->getItem('mobile_ksa') }}
                                    </a>
                                </span>
                            </li>

                            <li>
                                <i class="fa fa-envelope"></i>
                                <span>
                                    <strong>@lang('admin.email'):</strong>
                                    <a href="mailto:INFO@HOLOLNET.COM">
                                        INFO@HOLOLNET.COM
                                    </a>
                                </span>
                            </li>
                        </ul>
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
    footer i {
        margin-top: 13px !important;
    }

 .country-contact-row {
    row-gap: 30px;
}

.country-contact-card {
    height: 100%;
    padding: 28px 30px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 14px;
}

.country-contact-title {
    color: #ffffff !important;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 22px;
}

.country-contact-list {
    padding: 0;
    margin: 0;
    list-style: none;
}

.country-contact-list li {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 16px;
    color: #ffffff !important;
    font-size: 15px;
    line-height: 1.8;
}

.country-contact-list li:last-child {
    margin-bottom: 0;
}

.country-contact-list li i {
    width: 22px;
    min-width: 22px;
    margin-top: 6px !important;
    color: #ffffff !important;
    font-size: 17px;
    text-align: center;
    line-height: 1 !important;
}

.country-contact-list li span,
.country-contact-list li strong,
.country-contact-list li a {
    color: #ffffff !important;
}

.country-contact-list li span {
    display: block;
    word-break: break-word;
    overflow-wrap: anywhere;
}

.country-contact-list li strong {
    font-weight: 700;
}

.country-contact-list li a {
    text-decoration: none !important;
}

.country-contact-list li a:hover {
    color: #ffffff !important;
    text-decoration: none !important;
}

@media only screen and (max-width: 767px) {
    .country-contact-card {
        padding: 22px 18px;
    }

    .country-contact-title {
        font-size: 19px;
        margin-bottom: 18px;
    }

    .country-contact-list li {
        font-size: 14px;
        gap: 10px;
        margin-bottom: 14px;
    }

    .country-contact-list li i {
        font-size: 15px;
        width: 20px;
        min-width: 20px;
    }
}
</style>

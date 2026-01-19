@extends('site.app')
@section('title', @$metaSetting->where('key', 'contact_us_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'contact_us_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'contact_us_meta_description_' . $current_lang)->first()->value)

  @php
      $settings = \App\Settings\SettingSingleton::getInstance();
      

  @endphp

@section('content')
  <!-- Breadcrumb Begin -->
    <div
      class="breadcrumb-option spad set-bg"
      data-setbg="{{ asset('site/img/breadcrumb-bg.jpg') }}">
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
        <div class="row">
          <div class="col-lg-4 col-md-6 col-md-6 col-md-3">
            <div class="contact__widget__item d-flex align-items-center justify-content-center gap-3">
              <div class="contact__widget__item__icon">
                <i class="fa fa-map-marker"></i>
              </div>
              <div class="contact__widget__item__text">
                <h4>@lang('admin.address')</h4>
                <p>{{ $settings->getItem('address') }}</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-md-6 col-md-3">
            <div class="contact__widget__item d-flex align-items-center justify-content-center gap-3">
              <div class="contact__widget__item__icon">
                <i class="fa fa-phone"></i>
              </div>
              <div class="contact__widget__item__text">
                <h4>@lang('admin.phone')</h4>
                <p>{{ $settings->getItem('mobile') }}</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-md-6 col-md-3">
            <div class="contact__widget__item d-flex align-items-center justify-content-center gap-3">
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
              <iframe
                src="{{ $settings->getItem('maps') }}"
                height="450"
                style="border: 0"
              ></iframe>
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
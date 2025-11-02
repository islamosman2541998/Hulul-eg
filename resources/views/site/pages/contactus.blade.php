@extends('site.app')
@php
$settings = \App\Settings\SettingSingleton::getInstance();
@endphp
@section('title', $settings->getMeta('contact_us_meta_title_' . $current_lang) ?? 'Default Title ')
@section('meta_key', $settings->getMeta('contact_us_meta_key_' . $current_lang) ?? 'Default Keywords')
@section('meta_description', $settings->getMeta('contact_us_meta_description_' . $current_lang) ?? 'Default Description')


@section('content')


<!-- Content Us -->
<section class="ContentUs  pt-5">
    <div class="container">

      <div class="row ContentUs ">
        <div class="title col-12 text-center my-5">
          <h1 class="">Contact Us</h1>
          <h3 class="mbr-section-title">
            Have questions or need assistance? Contact us today we are here to help
          </h3>
        </div>
  
        <div class="col-12 col-lg-5 ">
          <div class="items">
            <div class="item features-without-image item-mb">
              <div class="card-box">
                <h5 class="card-title">Location</h5>
                <ul class="list">
                  <li>{{ $settings->getItem('address') }}</li>
                </ul>
              </div>
            </div>
  
            <div class="item features-without-image item-mb">
              <div class="card-box">
                <h5 class="card-title">Phone</h5>
                <ul class="list">
                  <li>{{ $settings->getItem('mobile') }}</li>
                </ul>
              </div>
            </div>
  
            <div class="item features-without-image item-mb">
              <div class="card-box">
                <h5 class="card-title">Email</h5>
                <ul class="list">
                  <li>{{ $settings->getItem('email') }}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
  
        <div class="col-12 col-lg-7">
          <form action="{{ route('site.contact.store') }}" method="POST">
            @csrf
            <div class="dragArea row">
              <div class="col-12">
                <h2 class="mbr-section-title">Send your messages</h2>
              </div>
  
              <div class="col-12 form-group">
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Name" class="form-control" required>
              </div>
  
              <div class="col-12 form-group">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="form-control" required>
              </div>
  
              <div class="col-12 form-group">
                <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="010XXXXXXXXX" class="form-control" required>
              </div>
  
              <div class="col-12 form-group">
                <input type="text" name="subject" value="{{ old('subject') }}" placeholder="Subject (optional)" class="form-control">
              </div>
  
              <div class="col-12 form-group">
                <textarea name="message" placeholder="Message" class="form-control" required>{{ old('message') }}</textarea>
              </div>
  
              <div class="col-md-auto col mbr-section-btn">
                <button type="submit" class="btn btn-primary">Send</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    </div>
  </section>
  <!-- Content Us -->
  
  @endsection
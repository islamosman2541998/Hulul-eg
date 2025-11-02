@extends('site.app')

@section('title', @$metaSetting->where('key', 'contact_us_meta_title_' . $current_lang)->first()->value)
@section('meta_key', @$metaSetting->where('key', 'contact_us_meta_key_' . $current_lang)->first()->value)
@section('meta_description', @$metaSetting->where('key', 'contact_us_meta_description_' . $current_lang)->first()->value)

@section('content')
 <section class="page-hero wow bounceInRight" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    <div class="container">
      <div class="kicker">@lang('home.contact')</div>
      <h1 class="title">@lang('home.contact-us')</h1>
    </div>
  </section>
    @include('site.pages.contact-us.home')
@endsection
<style>
    .page-hero{
      margin-top: 80px !important; 
    }
    .subtitle{
      color: #000 !important;
    }
</style>
@extends('site.app')

@section('title','Dalia El Haggar' . ' | ' .  'Search')
@section('content')
<div class="container search  py-5 w-75 mx-auto">
    <h2 class="mb-4 text-center">{{ __('Search') }}</h2>

    @livewire('site.search-live')
</div>
@endsection
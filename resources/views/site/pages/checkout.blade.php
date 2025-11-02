@extends('site.app')

@section('title', 'Dalia El Haggar' . ' | ' .  'Checkout')

@section('content')
    @if (session('success'))
        <p class="text-center text-bg-primary">{{ session('success') }}</p>
    @endif

    <div class="container checkout pt-5">
        @livewire('checkout-form', [
            'deliveryOption' => $deliveryOption,
            'deliveryDate' => $deliveryDate,
            'deliveryTime' => $deliveryTime,
        ])
    </div>

    <style>
        body {
            background-color: #FFFFFF !important;
        }
    </style>
@endsection
@extends('site.app')

@section('title', 'Careers')



@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="img/breadcrumb-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>We are hiring</h2>
                        <h1 class="cp-title text-white">Join the HULUL team</h1>
                        <p class="cp-lead">
                            We're looking for creative minds in marketing, design, and technology 
                            to build meaningful results together.
                        </p>
                    </div>
                </div>
            </div>
            
            {{-- Livewire Component --}}
            @livewire('site.job-list')
        </div>
    </div>
    <!-- Breadcrumb End -->
@endsection




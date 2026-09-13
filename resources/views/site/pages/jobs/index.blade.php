@extends('site.app')

@section('title', 'Careers')



@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option spad set-bg" data-setbg="{{ asset('site/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>@lang('job.We_are_hiring')</h2>
                        <h1 class="cp-title text-white">@lang('job.Join_the_HULUL_team')</h1>
                        <p class="cp-lead">
                            @lang('job.We_are_looking_for')
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <section class="jobs-list-section">
        <div class="container">
            {{-- Livewire Component --}}
            @livewire('site.job-list')
        </div>
    </section>

    <style>
        .jobs-list-section {
            padding: 50px 0 80px;
        }

        @media (max-width: 767px) {
            .jobs-list-section {
                padding: 30px 0 60px;
            }
        }
    </style>
@endsection





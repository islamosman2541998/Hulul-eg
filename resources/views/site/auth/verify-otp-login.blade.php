@extends('siteapp')

@section('content')
    <main class="LoginSection pt-5">
        <div class="Login">
            <div class="container text-center">
                <div class="row justify-content-center">

                    {{-- Logo & Site Name --}}
                    <div class="col-12">
                        <div class="title d-flex justify-content-center align-items-center my-md-5 my-3">
                            <img class="img-fluid login-icon" src="{{ asset('site/img/logo.png') }}"
                                alt="{{ __('messages.site_name') }}" />
                            <h1 class="mx-md-3 mx-1">{{ __('messages.site_name') }}</h1>
                        </div>
                    </div>

                    {{-- OTP Verification Form --}}
                    <div class="col-12 col-md-6 mx-md-auto">
                        <div class="login_form rounded text-center border p-3 mb-4">
                            <div class="head py-3 rounded-3">
                                <h4>{{ __('messages.verify_otp') }}</h4>
                            </div>
                            <div class="body my-3 d-flex flex-column align-items-center">

                                {{-- Display Errors --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger w-75">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <h2 class="my-4">{{ __('messages.enter_otp_code') }}</h2>

                                {{-- OTP Form --}}
                                <form method="POST" action="{{ route('site.auth.verify.otp.login', $user->id) }}">
                                    @csrf
                                    <input type="text" name="otp" placeholder="{{ __('messages.otp_placeholder') }}" >
                                    <button type="submit">{{ __('messages.verify') }}</button>
                                    @error('otp')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection



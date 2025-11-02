@extends('site.app')

@section('content')
    <main class="LoginSection pt-5">
        <div class="Login">
            <div class="container text-center">
                <div class="row justify-content-center">

                    <div class="col-12">
                        <div class="title d-flex justify-content-center align-items-center my-md-5 my-3">
                            <img class="img-fluid login-icon" src="{{ asset('site/img/logo.png') }}"
                                alt="{{ __('messages.site_name') }}" />
                            <h1 class="mx-md-3 mx-1">{{ __('messages.site_name') }}</h1>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mx-md-auto">
                        <div class="login_form rounded text-center border mb-4">
                            <div class="head mt-2 rounded-3">
                                <h4>{{ __('messages.login') }}</h4>
                            </div>
                            <div class="body d-flex flex-column align-items-center">
                                <h2 class="my-4">{{ __('messages.enter_mobile') }}</h2>

                                @if ($errors->has('mobile'))
                                    <div class="alert alert-danger text-center w-75 mx-auto">
                                        {{ $errors->first('mobile') }}<br>
                                        <a href="{{ route('site.register') }}">{{ __('messages.create_account_link') }}</a>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('site.login') }}">
                                    @csrf
                                    <input type="text" name="mobile"  value="{{ old('mobile') }}"
                                        placeholder="{{ __('messages.mobile_placeholder') }}" class="w-100 form-control p-2 mt-3"
                                        maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
                                

                                    <button type="submit" id="btnSend" class="d-block mx-auto my-5 px-5 py-2 btn-send">
                                        {{ __('messages.send_otp') }}
                                    </button>
                                </form>

                                <p>
                                    {{ __('messages.no_account') }}
                                    <a href="{{ route('site.register') }}">{{ __('messages.create_account') }}</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection

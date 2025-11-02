@extends('site.app')

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

                    {{-- Registration Form --}}
                    <div class="col-12 col-md-6 mx-md-auto">
                        <div class="login_form rounded text-center border p-3 mb-4">
                            <div class="head py-3 rounded-3">
                                <h4>{{ __('messages.register') }}</h4>
                            </div>
                            <div class="body my-3 d-flex flex-column align-items-center">

                                @if ($errors->any())
                                    <div class="alert alert-danger w-75">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('site.register') }}" class="w-75">
                                    @csrf

                                    <div class="mb-3">
                                        <input type="text" name="mobile" value="{{ old('mobile') }}"
                                            placeholder="{{ __('messages.mobile_placeholder') }}" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            placeholder="{{ __('messages.name_placeholder') }}" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="{{ __('messages.email_placeholder') }}" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <input type="password" name="password"
                                            placeholder="{{ __('messages.password_placeholder') }}" class="form-control">
                                    </div>

                                    <button type="submit" id="btnSend" class="d-block mx-auto my-5 px-5 py-2 btn-send">
                                        {{ __('messages.send_otp') }}
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection

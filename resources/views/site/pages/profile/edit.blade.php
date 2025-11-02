@extends('site.app')

@section('content')
<main class="ProfileSection">
    <div class="profile">
        <div class="container bg-light mt-5 rounded-3">
            <div class="row gx-2">
                <div class="col-12 order-1 col-lg-3 my-4">
                    <div class="rounded-3 bg-white mt-2 overflow-hidden">
                        <div class="row">
                            <a href="{{ route('site.profile.show') }}" class=" text-decoration-none col-12 meun-li">
                                <div class="d-flex align-items-center p-3">
                                    <i class="fa-solid fa-user fs-4 mx-3"></i>
                                    <h1 class="fs-4">{{ __('messages.account_info') }}</h1>
                                </div>
                                <hr />
                            </a>
                            <a href="{{ route('site.profile.edit') }}" class="text-decoration-none col-12 meun-li">
                                <div class="d-flex align-items-center p-3">
                                    <i class="fa-solid fa-pen-to-square fs-4 mx-3"></i>
                                    <h1 class="fs-4">{{ __('messages.edit_profile') }}</h1>
                                </div>
                                <hr />
                            </a>
                            <a href="{{ route('site.profile.orders') }}" class="text-decoration-none col-12 meun-li">
                                <div class="d-flex align-items-center p-3">
                                    <i class="fa-solid fa-list fs-4 mx-3"></i>
                                    <h1 class="fs-4">{{ __('messages.my_orders') }}</h1>
                                </div>
                                <hr />
                            </a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="col-12 meun-li text-decoration-none">
                                <div class="d-flex align-items-center p-3 ">
                                    <i class="fa-solid fa-arrow-right-from-bracket fs-4 mx-3"></i>
                                    <h1 class="fs-4">{{ __('messages.logout') }}</h1>
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('site.login') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </div>
                </div>
                <div class="col-12 order-2 col-lg-9 mx-auto">
                    <div class="info row px-lg-5 bg-white m-md-5">
                        <h1 class="col-12 fs-2 text-center mt-5">{{ __('messages.edit_profile') }}</h1>
                        @if(session('success'))
                            <div class="alert alert-success w-75 mx-auto">{{ session('success') }}</div>
                        @endif
                        <form method="POST" action="{{ route('site.profile.update') }}" class="d-flex flex-column personl_info mt-3 mb-5 px-0 w-75 mx-auto">
                            @csrf
                            <label class="mt-3">{{ __('messages.name') }}</label>
                            <input type="text" name="name" class="border-0 fs-4" value="{{ old('name', $user->name) }}" />
                            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            <hr class="spater" />
                            <label class="mt-3">{{ __('messages.email') }}</label>
                            <input type="email" name="email" class="border-0 fs-4" value="{{ old('email', $user->email) }}" />
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                            <hr class="spater" />
                            <label class="mt-3">{{ __('messages.mobile') }}</label>
                            <input type="text" name="mobile" class="border-0 fs-4" value="{{ old('mobile', $user->mobile) }}" />
                            @error('mobile') <div class="text-danger">{{ $message }}</div> @enderror
                            <hr />
                            <button type="submit" class="btn btn-save text-center px-md-0 px-2 col-md-3 col-12 fs-3 my-3 mx-auto">
                                {{ __('messages.save') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
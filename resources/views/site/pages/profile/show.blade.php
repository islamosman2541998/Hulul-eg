@extends('site.app')

@section('content')
<main class="ProfileSection">
    <div class="profile">
        <div class="container bg-light mt-5 rounded-3">
            <div class="row gx-2">
                <div class="col-12 order-1 col-lg-3 my-4">
                    <div class="rounded-3 bg-white mt-2 overflow-hidden">
                        <div class="row">
                            <a href="{{ route('site.profile.show') }}" class="col-12 meun-li text-decoration-none">
                                <div class="d-flex align-items-center p-3">
                                    <i class="fa-solid fa-user fs-4 mx-3"></i>
                                    <h1 class="fs-4">{{ __('messages.account_info') }}</h1>
                                </div>
                                <hr />
                            </a>
                            <a href="{{ route('site.profile.edit') }}" class="col-12 meun-li text-decoration-none">
                                <div class="d-flex align-items-center p-3">
                                    <i class="fa-solid fa-pen-to-square fs-4 mx-3"></i>
                                    <h1 class="fs-4">{{ __('messages.edit_profile') }}</h1>
                                </div>
                                <hr />
                            </a>
                            <a href="{{ route('site.profile.orders') }}" class="col-12 meun-li text-decoration-none">
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
                        <h1 class="col-12 fs-2 text-center mt-5">{{ __('messages.profile_info') }}</h1>
                        <div class="d-flex flex-column personl_info mt-3 mb-5 px-0 w-75 mx-auto">
                            <label class="mt-3">{{ __('messages.name') }}</label>
                            <p class="fs-4">{{ $user->name }}</p>
                            <hr class="spater" />
                            <label class="mt-3">{{ __('messages.email') }}</label>
                            <p class="fs-4">{{ $user->email }}</p>
                            <hr class="spater" />
                            <label class="mt-3">{{ __('messages.mobile') }}</label>
                            <p class="fs-4">{{ $user->mobile }}</p>
                            <hr />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
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
                            <a href="{{ route('site.profile.orders') }}" class="col-12 meun-li text-decoration-none ">
                                <div class="d-flex align-items-center p-3">
                                    <i class="fa-solid fa-list fs-4 mx-3"></i>
                                    <h1 class="fs-4">{{ __('messages.my_orders') }}</h1>
                                </div>
                                <hr />
                            </a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="col-12 meun-li text-decoration-none">
                                <div class="d-flex align-items-center p-3">
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
                        <h1 class="col-12 fs-2 text-center mt-5">{{ __('messages.my_orders') }}</h1>
                        <div class="col-12 Table_section">
                            <div class="table-responsive row text-center mt-3">
                                <table class="col-12 shadow table text-center align-content-center table-striped table-bordered">
                                    <thead>
                                        <tr class="align-content-center">
                                            <th scope="col" class="col-lg-2 col-md-3 col-sm-4 col-6">{{ __('messages.order_id') }}</th>
                                            <th scope="col" class="col-lg-2 col-md-3 col-sm-4 col-6">{{ __('messages.order_date') }}</th>
                                            <th scope="col" class="col-lg-2 col-md-3 col-sm-4 col-6">{{ __('messages.total') }}</th>
                                            <th scope="col" class="col-lg-2 col-md-3 col-sm-4 col-6">{{ __('messages.status') }}</th>
                                            <th scope="col" class="col-lg-2 col-md-3 col-sm-4 col-6">{{ __('messages.shipped_status') }}</th>
                                            <th scope="col" class="col-lg-2 col-md-3 col-sm-4 col-6">{{ __('messages.details') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                            <tr class="active-row">
                                                <td>{{ $order->identifier }}</td>
                                                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ $order->total }} {{ __('messages.currency') }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>{{ $order->shipped_status }}</td>
                                                <td>
                                                    <button class="btn btn-primary gg" data-bs-toggle="modal" data-bs-target="#orderDetailsModal{{ $order->id }}">
                                                        {{ __('messages.view_details') }}
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">{{ __('messages.no_orders') }}</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-center">{{ $orders->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@foreach($orders as $order)
    <div class="modal fade" id="orderDetailsModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailsModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderDetailsModalLabel{{ $order->id }}">{{ __('messages.order_details') }} - {{ $order->identifier }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4>{{ __('messages.order_details') }}</h4>
                    <ul>
                        @foreach($order->orderDetails as $detail)
                            <li>
                                {{ $detail->product->transNow->title ?? 'N/A' }} -
                                {{ __('messages.quantity') }}: {{ $detail->quantity }} -
                                {{ __('messages.price') }}: {{ $detail->price }} {{ __('messages.currency') }}
                            </li>
                        @endforeach
                    </ul>

                    <h4>{{ __('messages.order_status') }}</h4>
                    <ul>
                        @foreach($order->orderStatus as $status)
                            <li>{{ $status->status }} - {{ $status->description }} ({{ $status->created_at->format('d/m/Y H:i') }})</li>
                        @endforeach
                    </ul>

                    <h4>{{ __('messages.shipping_status') }}</h4>
                    <ul>
                        @foreach($order->shippingOrderStatus as $shippingStatus)
                            <li>{{ $shippingStatus->status }} - {{ $shippingStatus->description }} ({{ $shippingStatus->created_at->format('d/m/Y H:i') }})</li>
                        @endforeach
                    </ul>

                    @if($order->receipentsDetails)
                        <h4>{{ __('messages.recipient_details') }}</h4>
                        <p>{{ __('messages.name') }}: {{ $order->receipentsDetails->name }}</p>
                        <p>{{ __('messages.mobile') }}: {{ $order->receipentsDetails->mobile }}</p>
                    @endif

                

                 

                 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
@endsection

<style>
    .gg {
       background-color: #431934 !important;
         border: none !important;
         color: white;
    }
</style>
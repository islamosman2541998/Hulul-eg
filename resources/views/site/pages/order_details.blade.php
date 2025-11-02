@extends('site.app')


@section('content')
    <div class="container order_compeleted py-5">
        <div class="text-center mb-5">
            <div class="div_success text-white  d-inline-flex align-items-center justify-content-center rounded-circle"
                style="width:100px; height:100px;">
                <i class="fa-solid  fa-check"></i>
            </div>
            <h1 class="mt-3 fw-bold">{{ __('orders.order_complete_title') }}</h1>
            <p class="text-muted">{{ __('orders.thank_you') }}</p>
        </div>

        <!-- Order Summary -->
        <div class="p-4  mb-4 order-card" id="invoiceSection">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">{{ __('orders.order_summary') }}</h5>
                <span class="badge bg-success bg-opacity-10 text-success">{{ __('orders.confirmed') }}</span>
            </div>
            <div class=" mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.order_number') }}</dt>
                    <dd class="">{{ $order->id }}</dd>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.order_date') }}</dt>
                    <dd class="">{{ $order->created_at }}</dd>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.customer_mobile') }}</dt>
                    <dd class="">{{ $order->customer_mobile }}</dd>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.address') }}</dt>
                    <dd class="">{{ $order->address }}</dd>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.payment_method') }}</dt>
                    <dd class="">{{ $order->paymentMethod->title }}</dd>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.payment_image') }}</dt>
                    @if ($order->image)
                        <img class="img_payment" src="{{ url($order->image) }}" alt="image">
                    @endif
                </div>
                {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                    @if ($order->extraOrderDetails->same_day == 1)
                        <p><strong>موعد التوصيل:</strong> التوصيل في نفس اليوم.</p>
                    @elseif($order->extraOrderDetails->delivery_date)
                        <p><strong>موعد التوصيل:</strong>
                            {{ $order->extraOrderDetails->delivery_date->translatedFormat('d F Y H:i') }}</p>
                    @endif
                </div> --}}


                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.total') }}</dt>
                    <dd class="">{{ number_format($order->orderDetails->sum('total'), 2) }} EGP</dd>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.discount') }}</dt>
                    <dd class="">{{ $order->discount }} EGP</dd>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.shipped_price') }}</dt>
                    <dd class="">{{ $order->shipped_price }} EGP </dd>
                </div>


                <div class="d-flex justify-content-between align-items-center mb-3">
                    <dt class="">{{ __('orders.total_amount') }}</dt>
                    <dd class=" text-success">{{ $order->total }} EGP</dd>
                </div>

                <hr>
                <h5 class="mb-3">{{ __('orders.items_ordered') }}</h5>
                <ul class="list-unstyled mb-0">
                    @foreach ($order->orderDetails as $detail)
                        <li class="d-flex justify-content-between align-items-center">

                            <span>{{ $detail->product->name ?? $detail->product_name }} ×{{ $detail->quantity }}</span>
                            <div class="d-flex justify-content-between align-items-center gap-3">
                                <span class=" mb-2"><img class=" img_order rounded-circle text-center"
                                        src="{{ asset($detail->product->pathInView()) }}" alt=""></span>
                                <span>{{ number_format($detail->price_after_sale ?? $detail->price, 2) }} EGP</span>
                            </div>

                        </li>
                    @endforeach
                </ul>
            </div>

            {{-- <!-- Order Status -->
    <div class="p-4 mb-4 status-card bg-white">
      <h5 class="mb-3">Order Status</h5>
      <ul class="list-unstyled mb-0">
        <li class="status-step active mb-2">
          <i class="bi bi-check-circle-fill text-success me-2"></i>
          <span class="text-success">Order Confirmed</span>
        </li>
        <li class="status-step mb-2">
          <i class="bi bi-box-seam text-muted me-2"></i>
          <span class="text-muted">Processing</span>
        </li>
        <li class="status-step mb-2">
          <i class="bi bi-truck text-muted me-2"></i>
          <span class="text-muted">Shipped</span>
        </li>
        <li class="status-step">
          <i class="bi bi-check2-all text-muted me-2"></i>
          <span class="text-muted">Delivered</span>
        </li>
      </ul>
    </div> --}}


            <!-- Actions -->
            <div class="text-center mb-5">
                <button id="printInvoice" class="btn main-color-bg text-white me-2 px-4 py-2 rounded-pill">
                    {{ __('orders.print_invoice') }}
                </button>
                <button class="btn btn-track px-4 py-2 rounded-pill">
                    <a class="text-decoration-none text-white"
                        href="{{ route('site.shop') }}">{{ __('orders.continue_shopping') }}</a>
                </button>
            </div>

            <p class="text-center text-muted small">
                {{ __('orders.thank_you_for_shopping') }}
            </p>
        </div>
    </div>


    <style>
        body {
            background-color: #ffffff;
        }

        .order_compeleted {
            padding-top: 120px !important;
        }

        .div_success {
            background-color: #28a745;

            i {
                color: #fff;
                font-size: 2rem;
            }
        }

        .img_order {
            width: 70px;
            height: 70px;

        }


        .status-step .bi {
            font-size: 1.2rem;
            vertical-align: middle;
        }

        .status-step.active .bi-check-circle-fill,
        .status-step.active .text-success {
            color: #28a745;
        }

        .status-step .text-muted {
            color: #6c757d;
        }

        .order-card,
        .status-card,
        .next-card {
            border-radius: .5rem;
            box-shadow: 2px 2px 6px 4px rgba(0, 0, 0, 0.1);
        }

        .order-card {
            background: #ffffff;
        }

        .btn-continue {
            background-color: #f3fdf7;
            border: none;
            color: #28a745;
        }

        .btn-track {
            background-color: #28a745;
            color: #fff;
        }

        /* @media screen and (max-width: 768px) { */
        @media (max-width: 576px) {
            .order_compeleted {
                padding-top: 200px !important;
            }

             .img_payment {
                width: 70px;
                height: 70px;

            }

        }

        @media print {

            body * {
                visibility: hidden;
            }

            #invoiceSection,
            #invoiceSection * {
                visibility: visible;
            }

            #invoiceSection {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>
    @push('scripts')
        <script>
            function printSection(sectionId) {
                const originalContent = document.body.innerHTML;
                const sectionContent = document.getElementById(sectionId).innerHTML;
                document.body.innerHTML = sectionContent;
                window.print();
                document.body.innerHTML = originalContent;
                location.reload();
            }

            document.getElementById('printInvoice')
                .addEventListener('click', () => printSection('invoiceSection'));
        </script>
    @endpush
@endsection

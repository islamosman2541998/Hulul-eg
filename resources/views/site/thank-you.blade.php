@extends('site.app')

@php
    $locale = $current_lang ?? app()->getLocale();

    $thankYouMetaTitle = isset($metaSetting)
        ? optional(
            $metaSetting->firstWhere(
                'key',
                'thank_you_meta_title_' . $locale
            )
        )->value
        : null;

    $thankYouMetaKeywords = isset($metaSetting)
        ? optional(
            $metaSetting->firstWhere(
                'key',
                'thank_you_meta_key_' . $locale
            )
        )->value
        : null;

    $thankYouMetaDescription = isset($metaSetting)
        ? optional(
            $metaSetting->firstWhere(
                'key',
                'thank_you_meta_description_' . $locale
            )
        )->value
        : null;
@endphp

@section(
    'title',
    $thankYouMetaTitle ?: __('messages.thank_you_meta_title')
)

@section(
    'meta_key',
    $thankYouMetaKeywords ?: __('messages.thank_you_meta_keywords')
)

@section(
    'meta_description',
    $thankYouMetaDescription ?: __('messages.thank_you_meta_description')
)

@section('content')

    {{-- Breadcrumb Begin --}}
    <div
        class="breadcrumb-option set-bg"
        data-setbg="{{ asset('site/img/111.jpeg') }}"
        style="background-image: url('{{ asset('site/img/111.jpeg') }}');"
    >
        <div class="container">

            <div class="row">

                <div class="col-lg-12 text-center">

                    <div class="breadcrumb__text">

                        <h2>
                            {{ __('messages.thank_you_title') }}
                        </h2>

                        <div class="breadcrumb__links">

                            <a href="{{ route('site.home') }}">
                                {{ __('site.home') }} /
                            </a>

                            <span>
                                {{ __('messages.thank_you_title') }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>
    {{-- Breadcrumb End --}}


    {{-- Thank You Section Begin --}}
    <section class="thank-you-section spad">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-xl-8 col-lg-9 col-md-10">

                    <div class="thank-you-card">

                        <div class="thank-you-icon">
                            <i class="fa-solid fa-check"></i>
                        </div>

                        <h1>
                            {{ __('messages.thank_you_title') }}
                        </h1>

                        <p class="thank-you-message">
                            {{ __('messages.thank_you_message') }}
                        </p>

                        <p class="thank-you-description">
                            {{ __('messages.thank_you_description') }}
                        </p>

                        <div class="thank-you-actions">

                            <a
                                href="{{ route('site.home') }}"
                                class="thank-you-button thank-you-button-primary"
                            >
                                <i class="fa-solid fa-house"></i>

                                <span>
                                    {{ __('messages.back_to_home') }}
                                </span>
                            </a>

                            <a
                                href="{{ route('site.services.index') }}"
                                class="thank-you-button thank-you-button-outline"
                            >
                                <i class="fa-solid fa-layer-group"></i>

                                <span>
                                    {{ __('messages.browse_services') }}
                                </span>
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>
    {{-- Thank You Section End --}}


    <style>
        /*
        |--------------------------------------------------------------------------
        | Thank You Section
        |--------------------------------------------------------------------------
        */

        .thank-you-section {
            position: relative;
            min-height: 520px;
            display: flex;
            align-items: center;
            background: #100022;
            padding: 100px 15px;
            overflow: hidden;
        }

        .thank-you-section::before {
            content: "";
            position: absolute;
            top: -180px;
            left: -180px;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: rgba(0, 215, 225, 0.08);
            filter: blur(20px);
            pointer-events: none;
        }

        .thank-you-section::after {
            content: "";
            position: absolute;
            right: -180px;
            bottom: -200px;
            width: 450px;
            height: 450px;
            border-radius: 50%;
            background: rgba(99, 102, 241, 0.1);
            filter: blur(20px);
            pointer-events: none;
        }

        .thank-you-section .container {
            position: relative;
            z-index: 2;
        }

        /*
        |--------------------------------------------------------------------------
        | Thank You Card
        |--------------------------------------------------------------------------
        */

        .thank-you-card {
            width: 100%;
            padding: 55px 45px;
            text-align: center;
            background: rgba(255, 255, 255, 0.97);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
        }

        .thank-you-icon {
            width: 90px;
            height: 90px;
            margin: 0 auto 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: linear-gradient(
                135deg,
                rgba(0, 209, 224, 0.15),
                rgba(82, 105, 255, 0.15)
            );
            color: #00aeca;
            font-size: 40px;
            box-shadow: 0 12px 35px rgba(0, 174, 202, 0.15);
        }

        .thank-you-card h1 {
            margin: 0 0 18px;
            color: #16032d;
            font-size: clamp(30px, 4vw, 44px);
            font-weight: 700;
            line-height: 1.4;
        }

        .thank-you-message {
            margin: 0 0 10px;
            color: #252037;
            font-size: 21px;
            font-weight: 600;
            line-height: 1.8;
        }

        .thank-you-description {
            max-width: 570px;
            margin: 0 auto;
            color: #6d687a;
            font-size: 16px;
            line-height: 1.9;
        }

        /*
        |--------------------------------------------------------------------------
        | Actions
        |--------------------------------------------------------------------------
        */

        .thank-you-actions {
            margin-top: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .thank-you-button {
            min-height: 52px;
            padding: 13px 25px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            border: 2px solid transparent;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .thank-you-button:hover {
            transform: translateY(-3px);
            text-decoration: none;
        }

        .thank-you-button-primary {
            background: linear-gradient(
                135deg,
                #00bfd7,
                #6375f6
            );
            color: #ffffff;
            box-shadow: 0 12px 28px rgba(0, 191, 215, 0.25);
        }

        .thank-you-button-primary:hover {
            color: #ffffff;
            box-shadow: 0 16px 35px rgba(0, 191, 215, 0.35);
        }

        .thank-you-button-outline {
            border-color: #00b7d1;
            background: transparent;
            color: #069bb2;
        }

        .thank-you-button-outline:hover {
            background: #00b7d1;
            color: #ffffff;
        }

        /*
        |--------------------------------------------------------------------------
        | RTL
        |--------------------------------------------------------------------------
        */

        html[dir="rtl"] .thank-you-button i {
            margin-left: 2px;
        }

        html[dir="ltr"] .thank-you-button i {
            margin-right: 2px;
        }

        /*
        |--------------------------------------------------------------------------
        | Responsive
        |--------------------------------------------------------------------------
        */

        @media (max-width: 991px) {
            .thank-you-section {
                padding: 80px 15px;
            }

            .thank-you-card {
                padding: 50px 35px;
            }
        }

        @media (max-width: 767px) {
            .thank-you-section {
                min-height: auto;
                padding: 65px 12px;
            }

            .thank-you-card {
                padding: 40px 22px;
                border-radius: 18px;
            }

            .thank-you-icon {
                width: 75px;
                height: 75px;
                margin-bottom: 20px;
                font-size: 32px;
            }

            .thank-you-card h1 {
                font-size: 30px;
            }

            .thank-you-message {
                font-size: 18px;
            }

            .thank-you-description {
                font-size: 15px;
            }

            .thank-you-actions {
                flex-direction: column;
                align-items: stretch;
            }

            .thank-you-button {
                width: 100%;
            }
        }

        @media (max-width: 400px) {
            .thank-you-section {
                padding: 55px 10px;
            }

            .thank-you-card {
                padding: 35px 16px;
            }

            .thank-you-card h1 {
                font-size: 27px;
            }

            .thank-you-message {
                font-size: 17px;
            }
        }
    </style>

@endsection
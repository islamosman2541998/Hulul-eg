   @php
       $settings = \App\Settings\SettingSingleton::getInstance();

   @endphp

   <!-- Footer Section Begin -->
   <footer class="footer">
       <div class="container footer-container">
           <div class="footer__top">
               <div class="row">
                   <div class="col-lg-6 col-md-6">
                       <div class="footer__top__logo">
                           <a href="#"><img
                                   src="{{ asset($settings->getItem(app()->getLocale() == 'en' ? 'logo_en' : 'logo_ar')) }}"
                                   class="logoImg" alt=""></a>
                       </div>
                   </div>
                   <div class="col-lg-6 col-md-6">
                       <div class="footer__top__social">
                           <a href="{{ $settings->getItem('facebook') }}"><i class="fa fa-facebook"></i></a>
                           <a href="{{ $settings->getItem('youtube') }}"><i class="fa fa-youtube"></i></a>
                           <a href="{{ $settings->getItem('tiktok') }}"><i class="fa fa-tiktok"></i></a>
                           <a href="{{ $settings->getItem('instagram') }}"><i class="fa fa-instagram"></i></a>
                       </div>
                   </div>
               </div>
           </div>
           <div class="footer__option">
               <div class="row">
                   <div class="col-lg-4 col-md-6 col-sm-6">
                       <div class="footer__option__item">
                           <h5>@lang('about.about_us')</h5>
                           <p>{{ $settings->getItem('footer_description') }}</p>
                           <a href="{{ route('site.about-us') }}" class="read__more">@lang('admin.read_more')</a>
                       </div>
                   </div>
                   <div class="col-lg-2 col-md-3 col-sm-3">
                       <div class="footer__option__item">
                           <h5>@lang('admin.quicklinks')</h5>
                           <ul>
                               @forelse ($footerLinks as $link)
                                   <li><a
                                           href="{{ $link->type === 'static' && $link->url ? url($link->url) : ($link->dynamic_url ? url($link->dynamic_url) : '#') }}">{{ $link->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}</a>
                                   </li>
                               @empty

                                   <p>No links available</p>
                               @endforelse
                           </ul>
                       </div>
                   </div>
                   <div class="col-lg-2 col-md-3 col-sm-3">
                       <div class="footer__option__item">
                           <h5>@lang('admin.our_work')</h5>

                           <ul>
                               @foreach ($our_work as $work)
                                   @php
                                       $workTrans = $work->transNow;
                                   @endphp

                                   @if ($workTrans)
                                       <li>
                                           <a href="{{ route('site.portfolio.index', ['tag' => $workTrans->slug]) }}">
                                               {{ $workTrans->title }}
                                           </a>
                                       </li>
                                   @endif
                               @endforeach
                           </ul>
                       </div>
                   </div>
                   <div class="col-lg-4 col-md-12">
                       <div class="footer__option__item footer-contact-info">
                           <h5>@lang('home.contact-us')</h5>

                           <div class="footer-country-box">
                               {{-- <h6 class="footer-country-title text-white">
                                   @lang('admin.egypt')
                                   <img src="https://flagcdn.com/w40/eg.png" alt="Egypt Flag"
                                       class="footer-country-flag">
                               </h6> --}}

                               <ul>
                                   <li>
                                       <i class="fa fa-map-marker"></i>
                                       <span><strong>@lang('admin.address_eg'):</strong>
                                           {{ $settings->getItem('address') }}</span>
                                   </li>
                                   <li>
                                       <i class="fa fa-phone"></i>
                                       <span>
                                           <strong>@lang('admin.phone'):</strong>
                                           <a
                                               href="tel:{{ $settings->getItem('mobile') }}">{{ $settings->getItem('mobile') }}</a>
                                       </span>
                                   </li>
                                   <li>
                                       <i class="fa fa-envelope"></i>
                                       <span>
                                           <strong>@lang('admin.email'):</strong>
                                           <a
                                               href="mailto:{{ $settings->getItem('email') }}">{{ $settings->getItem('email') }}</a>
                                       </span>
                                   </li>
                               </ul>
                           </div>

                           <div class="footer-country-box">
                               {{-- <h6 class="footer-country-title text-white">
                                   @lang('admin.saudi_arabia')
                                   <img src="https://flagcdn.com/w40/sa.png" alt="Saudi Arabia Flag"
                                       class="footer-country-flag">
                               </h6> --}}

                               <ul>
                                   <li>
                                       <i class="fa fa-map-marker"></i>
                                       <span><strong>@lang('admin.address_ks'):</strong>
                                           {{ $settings->getItem('address_ksa') }}</span>
                                   </li>
                                   <li>
                                       <i class="fa fa-whatsapp"></i>
                                       <span>
                                           <strong>@lang('admin.mobile'):</strong>
                                           <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->getItem('mobile_ksa')) }}"
                                               target="_blank" rel="noopener noreferrer">
                                               {{ $settings->getItem('mobile_ksa') }}
                                           </a>
                                       </span>
                                   </li>
                                   <li>
                                       <i class="fa fa-envelope"></i>
                                       <span>
                                           <strong>@lang('admin.email'):</strong>
                                           <a href="mailto:INFO@HOLOLNET.COM">INFO@HOLOLNET.COM</a>
                                       </span>
                                   </li>
                               </ul>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="footer__copyright">
               <div class="row">
                   <div class="col-lg-12 text-center">
                       <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                       <p class="footer__copyright__text">@lang('site.copyright') &copy;

                           @lang('site.all_right_reserved')
                           <script>
                               document.write(new Date().getFullYear());
                           </script>
                           <!-- <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
                       </p>
                       <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                   </div>
               </div>
           </div>
       </div>
   </footer>
   <!-- Footer Section End -->
   <style>
       .footer-container {
           padding: 0px !important;
       }

       @media only screen and (max-width: 767px) {
           footer {
               padding: 30px 0px !important;
           }
       }

       .footer-contact-info h5 {
           color: #ffffff !important;
       }

       .footer-contact-info ul {
           padding: 0;
           margin: 0;
           list-style: none;
       }

       .footer-contact-info ul li {
           display: flex;
           align-items: flex-start;
           gap: 10px;
           margin-bottom: 5px;
           color: #ffffff !important;
           font-size: 13px;
           line-height: 1.8;
       }

       .footer-contact-info ul li i {
           width: 18px;
           min-width: 18px;
           margin-top: 4px !important;
           color: #ffffff !important;
           font-size: 14px;
           text-align: center;
       }

       .footer-contact-info ul li span {
           display: block;
           word-break: break-word;
           overflow-wrap: anywhere;
           color: #ffffff !important;
       }

       .footer-contact-info ul li strong {
           display: inline;
           color: #ffffff !important;
           font-size: 14px;
           margin-bottom: 0;
       }

       .footer-contact-info ul li a {
           color: #ffffff !important;
           text-decoration: none;
       }

       .footer-contact-info ul li a:hover {
           color: #ffffff !important;
           text-decoration: none;
       }
   </style>
@php
    $settings = \App\Settings\SettingSingleton::getInstance();

    $whatsappNumber = preg_replace(
        '/[^0-9]/',
        '',
        $settings->getItem('mobile')
    );

    $whatsappMessage = app()->getLocale() === 'ar'
        ? 'مرحبًا، أريد الاستفسار عن خدماتكم.'
        : 'Hello, I would like to ask about your services.';
@endphp

<div class="floating-site-actions"
    dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

    {{-- زر طلب ميتنج --}}
    <a href="{{ route('site.service_request.index') }}"
        class="floating-meeting-btn"
        aria-label="@lang('messages.request_meeting')">

        <i class="fa-regular fa-pen-to-square"></i>

        <span>
            @lang('messages.request_meeting')
        </span>
    </a>

    {{-- زر واتساب --}}
    @if ($whatsappNumber)
        <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}"
            class="floating-whatsapp-btn"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="WhatsApp">

            <i class="fa fa-whatsapp"></i>
        </a>
    @endif

</div>

<style>
    /* ==============================
       Floating Website Actions
    ============================== */

    .floating-site-actions {
        position: fixed;
        right: 22px;
        bottom: max(22px, env(safe-area-inset-bottom));
        z-index: 9998;

        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 9px;
    }

    .floating-meeting-btn,
    .floating-whatsapp-btn {
        text-decoration: none !important;

        transition:
            transform 0.25s ease,
            box-shadow 0.25s ease,
            background-color 0.25s ease;
    }

    /* ==============================
       Meeting Button
    ============================== */

    .floating-meeting-btn {
        min-height: 45px;
        padding: 0 16px;

        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        background: #00bfe7;
        color: #ffffff !important;

        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 30px;

        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        white-space: nowrap;

        box-shadow:
            0 7px 20px rgba(0, 191, 231, 0.27),
            0 3px 8px rgba(0, 0, 0, 0.15);
    }

    .floating-meeting-btn i {
        font-size: 14px;
    }

    .floating-meeting-btn:hover {
        background: #00a9cc;
        color: #ffffff !important;

        transform: translateY(-2px);

        box-shadow:
            0 10px 25px rgba(0, 191, 231, 0.35),
            0 4px 10px rgba(0, 0, 0, 0.18);
    }

    /* ==============================
       WhatsApp Button
    ============================== */

    .floating-whatsapp-btn {
        width: 47px;
        height: 47px;
        min-width: 47px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        background: #25d366;
        color: #ffffff !important;

        border: 1px solid rgba(255, 255, 255, 0.22);
        border-radius: 50%;

        font-size: 23px;

        box-shadow:
            0 7px 20px rgba(37, 211, 102, 0.28),
            0 3px 8px rgba(0, 0, 0, 0.15);
    }

    .floating-whatsapp-btn:hover {
        background: #1fbd59;
        color: #ffffff !important;

        transform: translateY(-2px) scale(1.03);

        box-shadow:
            0 10px 25px rgba(37, 211, 102, 0.36),
            0 4px 10px rgba(0, 0, 0, 0.18);
    }

    /* Keyboard accessibility */

    .floating-meeting-btn:focus-visible,
    .floating-whatsapp-btn:focus-visible {
        outline: 3px solid rgba(0, 191, 231, 0.35);
        outline-offset: 3px;
    }

    /* ==============================
       Mobile
    ============================== */

    @media only screen and (max-width: 767px) {
        .floating-site-actions {
            right: 12px;
            bottom: max(16px, env(safe-area-inset-bottom));
            gap: 7px;
        }

        .floating-meeting-btn {
            min-height: 41px;
            padding: 0 13px;

            gap: 6px;

            font-size: 11px;
            border-radius: 25px;
        }

        .floating-meeting-btn i {
            font-size: 13px;
        }

        .floating-whatsapp-btn {
            width: 43px;
            height: 43px;
            min-width: 43px;

            font-size: 21px;
        }
    }

    /* ==============================
       Very Small Mobile
    ============================== */

    @media only screen and (max-width: 380px) {
        .floating-site-actions {
            right: 9px;
            bottom: max(12px, env(safe-area-inset-bottom));
            gap: 6px;
        }

        .floating-meeting-btn {
            min-height: 39px;
            padding: 0 11px;

            font-size: 10px;
        }

        .floating-meeting-btn i {
            font-size: 12px;
        }

        .floating-whatsapp-btn {
            width: 41px;
            height: 41px;
            min-width: 41px;

            font-size: 20px;
        }
    }
</style>
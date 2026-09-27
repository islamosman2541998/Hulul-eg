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
                           <a href="{{ $settings->getItem('facebook') }}"><i class="fa-brands fa-facebook-f"></i></a>
                           <a href="{{ $settings->getItem('youtube') }}"><i class="fa-brands fa-youtube"></i></a>
                           <a href="{{ $settings->getItem('tiktok') }}"><i class="fa-brands fa-tiktok"></i></a>
                           <a href="{{ $settings->getItem('instagram') }}"><i class="fa-brands fa-instagram"></i></a>
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
                                           @php $ksaWhatsapp = \App\Support\WhatsApp::link($settings->getItem('mobile_ksa'), \App\Support\WhatsApp::SAUDI_ARABIA); @endphp
                                           @if ($ksaWhatsapp)
                                               <a href="{{ $ksaWhatsapp }}" target="_blank" rel="noopener noreferrer">
                                                   {{ $settings->getItem('mobile_ksa') }}
                                               </a>
                                           @else
                                               {{ $settings->getItem('mobile_ksa') }}
                                           @endif
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

       $whatsappMessage =
           app()->getLocale() === 'ar'
               ? 'مرحبًا، أريد الاستفسار عن خدماتكم.'
               : 'Hello, I would like to ask about your services.';

       // Saudi + Egypt WhatsApp numbers from the site settings; numbers that are not set are skipped
       $whatsappNumbers = collect([
           [
               'label' => __('messages.whatsapp_saudi'),
               'flag' => 'sa',
               'raw' => $settings->getItem('whatsapp_ksa') ?: $settings->getItem('mobile_ksa'),
               'code' => \App\Support\WhatsApp::SAUDI_ARABIA,
           ],
           [
               'label' => __('messages.whatsapp_egypt'),
               'flag' => 'eg',
               'raw' => $settings->getItem('whatsapp') ?: $settings->getItem('mobile'),
               'code' => \App\Support\WhatsApp::EGYPT,
           ],
       ])
           ->map(fn($item) => $item + [
               'url' => \App\Support\WhatsApp::link($item['raw'], $item['code'], $whatsappMessage),
           ])
           ->filter(fn($item) => $item['url'])
           ->values();
   @endphp

   <div class="floating-site-actions" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

       <a href="{{ route('site.service_request.index') }}" class="floating-meeting-btn"
           aria-label="@lang('messages.request_meeting')">

           <i class="fa-regular fa-pen-to-square"></i>

           <span>
               @lang('messages.request_meeting')
           </span>
       </a>

       @if ($whatsappNumbers->count() === 1)
           <a href="{{ $whatsappNumbers->first()['url'] }}" class="floating-whatsapp-btn" target="_blank"
               rel="noopener noreferrer" aria-label="WhatsApp">
               <i class="fa-brands fa-whatsapp"></i>
           </a>
       @elseif ($whatsappNumbers->count() > 1)
           {{-- more than one number: the button opens a small menu to pick one --}}
           <div class="floating-whatsapp">
               <div class="wa-menu" id="waMenu" hidden>
                   <div class="wa-menu__head">
                       <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                       <div class="wa-menu__head-text">
                           <strong>@lang('messages.whatsapp_title')</strong>
                           <span>@lang('messages.whatsapp_subtitle')</span>
                       </div>
                   </div>

                   <ul class="wa-menu__list">
                       @foreach ($whatsappNumbers as $number)
                           <li>
                               <a href="{{ $number['url'] }}" class="wa-menu__item" target="_blank"
                                   rel="noopener noreferrer">
                                   <img class="wa-menu__flag" src="https://flagcdn.com/w40/{{ $number['flag'] }}.png"
                                       width="28" height="21" loading="lazy" alt="">
                                   <span class="wa-menu__label">{{ $number['label'] }}</span>
                                   <i class="fa-brands fa-whatsapp wa-menu__icon" aria-hidden="true"></i>
                               </a>
                           </li>
                       @endforeach
                   </ul>
               </div>

               <button type="button" class="floating-whatsapp-btn" id="waToggle" aria-expanded="false"
                   aria-controls="waMenu" aria-label="WhatsApp">
                   <i class="fa-brands fa-whatsapp"></i>
               </button>
           </div>
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

       /* keep the icons centered even if a page styles every <i> */
       .floating-site-actions i {
           margin: 0 !important;
           line-height: 1 !important;
       }

       /* ==============================
       WhatsApp numbers menu
    ============================== */

       .floating-whatsapp {
           position: relative;
           display: flex;
           flex-direction: column;
           align-items: flex-end;
       }

       .wa-menu {
           position: absolute;
           bottom: calc(100% + 12px);
           /* the buttons sit on the right of the screen in both languages, so anchor right */
           right: 0;
           left: auto;
           z-index: 1;

           width: 290px;
           max-width: calc(100vw - 32px);
           overflow: hidden;

           border-radius: 16px;
           background: #ffffff;
           box-shadow: 0 18px 44px rgba(0, 0, 0, 0.28);

           opacity: 0;
           visibility: hidden;
           transform: translateY(10px) scale(0.97);
           transform-origin: bottom right;
           transition: opacity 0.22s ease, transform 0.22s ease, visibility 0s linear 0.22s;
       }

       .wa-menu[hidden] {
           display: none;
       }

       .wa-menu.is-open {
           opacity: 1;
           visibility: visible;
           transform: none;
           transition: opacity 0.22s ease, transform 0.22s ease;
       }

       .wa-menu__head {
           display: flex;
           align-items: center;
           gap: 10px;

           padding: 14px 16px;

           background: linear-gradient(135deg, #25d366 0%, #128c7e 100%);
           color: #ffffff;
       }

       .wa-menu__head i {
           font-size: 22px;
       }

       .wa-menu__head-text {
           display: flex;
           flex-direction: column;
           line-height: 1.35;
           text-align: start;
       }

       .wa-menu__head-text strong {
           font-size: 14px;
           font-weight: 700;
       }

       .wa-menu__head-text span {
           font-size: 12px;
           opacity: 0.9;
       }

       .wa-menu__list {
           margin: 0;
           padding: 6px;
           list-style: none;
       }

       .wa-menu__list li {
           list-style: none;
       }

       .wa-menu__item {
           display: flex;
           align-items: center;
           gap: 12px;

           padding: 13px 12px;
           border-radius: 12px;

           color: #111b21 !important;
           text-decoration: none !important;
           transition: background 0.2s ease;
       }

       .wa-menu__item:hover,
       .wa-menu__item:focus-visible {
           background: #f0f5f3;
           outline: none;
       }

       .wa-menu__flag {
           flex-shrink: 0;
           width: 28px;
           height: 21px;
           border-radius: 4px;
           object-fit: cover;
           box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.08);
       }

       .wa-menu__label {
           flex-grow: 1;
           min-width: 0;

           color: #111b21;
           font-size: 15px;
           font-weight: 600;
           line-height: 1.35;
           text-align: start;

           overflow: hidden;
           text-overflow: ellipsis;
           white-space: nowrap;
       }

       .wa-menu__icon {
           flex-shrink: 0;
           color: #25d366;
           font-size: 18px;
       }

       @media only screen and (max-width: 380px) {
           .wa-menu {
               width: 260px;
           }
       }

       @media (prefers-reduced-motion: reduce) {
           .wa-menu {
               transition: none;
           }
       }

       .floating-whatsapp-btn i {
           font-size: inherit !important;
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

<script>
    (function() {
        const toggle = document.getElementById('waToggle');
        const menu = document.getElementById('waMenu');

        if (!toggle || !menu) {
            return;
        }

        const isOpen = () => menu.classList.contains('is-open');

        const setOpen = function(open) {
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');

            if (open) {
                menu.hidden = false;
                requestAnimationFrame(() => requestAnimationFrame(() => menu.classList.add('is-open')));
                return;
            }

            menu.classList.remove('is-open');
            setTimeout(() => {
                if (!isOpen()) {
                    menu.hidden = true;
                }
            }, 250);
        };

        toggle.addEventListener('click', function(e) {
            e.stopPropagation();
            setOpen(!isOpen());
        });

        // tapping anywhere else, or picking a number, closes the menu
        document.addEventListener('click', function(e) {
            if (isOpen() && !menu.contains(e.target)) {
                setOpen(false);
            } else if (isOpen() && e.target.closest('.wa-menu__item')) {
                setOpen(false);
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen()) {
                setOpen(false);
                toggle.focus();
            }
        });
    })();
</script>

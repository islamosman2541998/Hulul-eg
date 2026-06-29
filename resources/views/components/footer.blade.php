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

                           <ul>
                               <li>
                                   <i class="fa fa-map-marker"></i>
                                   <span>
                                       <strong>@lang('admin.address')</strong>
                                       {{ $settings->getItem('address') }}
                                   </span>
                               </li>

                               <li>
                                   <i class="fa fa-map-marker"></i>
                                   <span>
                                       <strong>@lang('admin.address_ksa')</strong>
                                       {{ $settings->getItem('address_ksa') }}
                                   </span>
                               </li>

                               <li>
                                   <i class="fa fa-phone"></i>
                                   <span>
                                       <strong>@lang('admin.phone')</strong>
                                       <a href="tel:{{ $settings->getItem('mobile') }}">
                                           {{ $settings->getItem('mobile') }}
                                       </a>
                                   </span>
                               </li>

                               <li>
                                   <i class="fa fa-whatsapp"></i>
                                   <span>
                                       <strong>@lang('admin.mobile_ksa')</strong>
                                       <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->getItem('mobile_ksa')) }}"
                                           target="_blank" rel="noopener noreferrer">
                                           {{ $settings->getItem('mobile_ksa') }}
                                       </a>
                                   </span>
                               </li>

                               <li>
                                   <i class="fa fa-envelope"></i>
                                   <span>
                                       <strong>@lang('admin.email')</strong>
                                       <a href="mailto:{{ $settings->getItem('email') }}">
                                           {{ $settings->getItem('email') }}
                                       </a>
                                   </span>
                               </li>

                               {{-- <li>
                                   <i class="fa fa-globe"></i>
                                   <span>
                                       <strong>@lang('admin.website_ksa')</strong>
                                       <a href="https://www.hololnet.com" target="_blank" rel="noopener noreferrer">
                                           https://www.hololnet.com
                                       </a>
                                   </span>
                               </li> --}}
                           </ul>
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
   </style>

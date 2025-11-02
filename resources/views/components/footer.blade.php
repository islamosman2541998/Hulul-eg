 <!-- =============== FOOTER =============== -->
 @php
     $settings = \App\Settings\SettingSingleton::getInstance();
     $footer_description = $settings->getItem('footer_description');
         $show_footer    = (int) $settings->getHome('show_footer');


 @endphp
 @if ($show_footer)
      <footer dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}  h-25 ">
     <div class="container-fluid">
         <div class="row  ">
             <div class=" col-md-4 text-center">
                 <div class="logoContent">
                     <img class="LogoImg"
                         src="{{ asset($settings->getItem(app()->getLocale() == 'en' ? 'logo_en' : 'logo_ar')) }}"
                         alt="Tetra Pharma">
                 </div>
                 <div class="p-3">
                     <h5>
                         {{ $settings->getItem('footer_description') }}
                     </h5>
                 </div>
                 <div class="social d-flex justify-content-center">
                     {{-- <div class="socialDiv color_blue">@lang('home.social')</div> --}}
                     <div class="socials ">
                         <a class="Social1 color_blue" href="{{ $facebookLink }}"><i
                                 class="fa-brands fa-facebook"></i></a>
                         <a class="Social2 color_blue" href="{{ $instagramLink }}"><i
                                 class="fa-brands fa-instagram"></i></a>
                         <a class="Social3 color_blue" href="{{ $tiktokLink }}"><i
                                 class="fa-brands fa-tiktok"></i></a>
                         <a class="Social4 color_blue" href="{{ $linkedinLink }}"><i
                                 class="fa-brands fa-linkedin"></i></a>
                     </div>
                 </div>
             </div>
             <div class=" col-md-4 text-center">
                 <!-- Contact blocks -->
                 <div class="socialDiv color_blue">@lang('home.contact_information')</div>

                 <ul class="contact-list d-flex flex-column align-items-center">
                     <li class="d-flex align-items-center"> <span class="icon">📍</span> <a
                             class="nv-noninteractive fw-bold fs-5" href="#">{{ $settings->getItem('address') }}</a>
                     </li>
                     <li class="d-flex align-items-center"><span class="icon">✉️</span> <a class="fw-bold fs-5"
                             href="mailto:{{ $settings->getItem('email') }}">{{ $settings->getItem('email') }}</a>
                     </li>
                     <li class="d-flex align-items-center"><span class="icon">📞</span> <a class="fw-bold fs-5"
                             href="tel:{{ $settings->getItem('mobile') }}">{{ $settings->getItem('mobile') }}</a>
                     </li>
                 </ul>
                 <div class="col-12 text-center">
                     <p class="copyright mb-0">
                         @lang('home.copyright', ['year' => date('Y'), 'company' => 'Tetra Pharma'])
                     </p>
                 </div>
             </div>
             <div class="col-md-4 text-center">
                 <div class="socialDiv color_blue">@lang('home.links')</div>

                 <div class="Link text-center mt-2">
                     <ul class="d-flex flex-column align-items-center fw-bold">
                         @foreach ($footerLinks as $link)
                            <li class="m-0 p-0">
                                 <a href="{{ $link->type === 'static' && $link->url ? url($link->url) : ($link->dynamic_url ? url($link->dynamic_url) : '#') }}"
                                     style="color: #000000;" class="m-0 p-0">
                                     {{ $link->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}
                                 </a>
                             </li>
                         @endforeach
                     </ul>
                 </div>
             </div>
         </div>
     </div>
 </footer>
 @endif


 <!-- ============ /FOOTER ============ -->

 <style>
     footer {
         padding: 30px !important
     }

     .map {
         height: 200px !important;
     }

     .footer-content {
         display: flex !important;
         justify-content: space-between !important;
         align-items: center !important;
     }

     .Link ul {

         list-style: none !important;
         text-align: center !important;


     }

     .Link ul li {

         text-align: center !important;
         margin-bottom: 10px !important;
     }

     .copyright {
         font-size: 1.1rem;
         color: #1d1c1c;
         padding-top: 45px !important;

     }

     @media (max-width: 576px) {
         .copyright {
             font-size: 0.8rem;
         }
     }
 </style>

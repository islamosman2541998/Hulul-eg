   @php
       $settings = \App\Settings\SettingSingleton::getInstance();

   @endphp

   <!-- Footer Section Begin -->
   <footer class="footer">
       <div class="container">
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
                           <a href="{{ $settings->getItem('twitter') }}"><i class="fa fa-twitter"></i></a>
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
                           <a href="{{ route('site.about-us') }}" class="read__more">@lang('admin.read_more') <span
                                   class="arrow_right"></span></a>
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
                                   <li><a
                                           href="#">{{ $work->trans->where('locale', app()->getLocale())->first()->title ?? 'No Title' }}</a>
                                   </li>
                               @endforeach
                               {{-- <li><a href="#">Brand Identity</a></li> --}}

                           </ul>
                       </div>
                   </div>
                   <div class="col-lg-4 col-md-12">
                       <div class="footer__option__item">
                           <h5>@lang('admin.newsletter')</h5>
                           <p>@lang('admin.newsletter_description')</p>
                           <form method="POST" action="{{ route('site.subscribe.store') }}">
                               @csrf

                               <input type="email" name="email" required placeholder="Email">
                               <button type="submit" class="applicationRequest"><i class=" fa fa-send"></i></button>
                               @if (session('success'))
                                   <div class="alert alert-success mt-2">
                                       {{ session('success') }}
                                   </div>
                               @endif
                               @if (session('error'))
                                   <div class="alert alert-danger mt-2">
                                       {{ session('error') }}
                                   </div>
                               @endif
                           </form>
                       </div>
                   </div>
               </div>
           </div>
           <div class="footer__copyright">
               <div class="row">
                   <div class="col-lg-12 text-center">
                       <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                       <p class="footer__copyright__text">@lang('site.copyright') &copy;
                           <script>
                               document.write(new Date().getFullYear());
                           </script>
                           @lang('site.all_right_reserved')
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

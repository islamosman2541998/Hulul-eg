  @php
      $settings = \App\Settings\SettingSingleton::getInstance();
      
    $show_contact_us    = (int) $settings->getHome('show_contact_us');

  @endphp
  <!-- ========== CONTACT SECTION ========== -->

  @if ( $show_contact_us)
  <section class="section hero pt-0 con-section" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

      @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
      <div class="container">
          <div class="grid">

              <!-- left: details -->
              <div class="card contact-left  wow bounceInRight">
                  <div class="bigline">
                      @lang('home.questions')
                  </div>

                  <ul class="contact-list">
                      <li class="d-flex align-items-center"> <span class="icon">📍</span> <a
                              class="nv-noninteractive fw-bold" href="#">{{ $settings->getItem('address') }}</a>
                      </li>
                      <li class="d-flex align-items-center"><span class="icon">✉️</span> <a class="fw-bold"
                              href="mailto:{{ $settings->getItem('email') }}">{{ $settings->getItem('email') }}</a></li>
                      <li class="d-flex align-items-center"><span class="icon">📞</span> <a class="fw-bold"
                              href="tel:{{ $settings->getItem('mobile') }}">{{ $settings->getItem('mobile') }}</a></li>
                  </ul>

                  <div class="contactDiv">@lang('home.social')</div>
                  <div class="socials">
                      <a class="chip" href="{{ $settings->getItem('facebook') }}"><i><i
                                  class="fa-brands fa-facebook"></i></i></a>
                      <a class="chip" href="{{ $settings->getItem('instagram') }}"><i><i
                                  class="fa-brands fa-instagram"></i></i></a>
                      <a class="chip" href="{{ $settings->getItem('tiktok') }}"><i><i
                                  class="fa-brands fa-tiktok"></i></i></a>
                      <a class="chip" href="{{ $settings->getItem('linkedin') }}"><i><i
                                  class="fa-brands fa-linkedin"></i></i></a>
                  </div>
                  <!-- RIGHT: Google map -->
                  <div class="pt-3">
                      <div class="map">
                          <section class="map1">
                              <div class="map2">
                                  <div class="map3">
                                      <iframe class="Iframe" title="Tetra pharma Ltd. location"
                                          src="{{ $settings->getItem('maps') }}" loading="lazy"
                                          referrerpolicy="no-referrer-when-downgrade" allowfullscreen>
                                      </iframe>
                                  </div>
                                  <div class="google">
                                      <a class="google_Link" href="{{ $settings->getItem('maps') }}" target="_blank">
                                          @lang('home.google_map')
                                      </a>
                                  </div>
                              </div>
                          </section>
                      </div>
                  </div>
              </div>

              <!-- right: form -->
            
                  @livewire('site.contact-form')
            
          </div>
      </div>
  </section>

  <div class="contact__form">
    @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
              <h3>@lang('admin.get_in_touch')</h3>
              <form action="#">
                <input type="text" placeholder="Name" />
                <input type="email" placeholder="Email" />
                <input type="number" placeholder="Phone" />
                <textarea placeholder="Message"></textarea>
                <button type="submit" class="site-btn">Send Message</button>
              </form>
            </div>
  @endif
 

 

 <!-- Call To Action Section Begin -->
 <section class="callto spad set-bg careerImg" data-setbg="">
     <div class="container appcontainer">
         <div class="row">
             <img src="{{ asset($services_section->image) }}" class="applicationImg d-none d-sm-block" />
             <div class="col-lg-8">
                 <div class="callto__text">
                     <h2> {{ $services_section->transNow->title }}</h2>
                     <p>{!! $services_section->transNow->description !!}</p>
                     <a class="btn" href="{{ route('site.services.index') }}">@lang('home.Services')</a>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- Call To Action Section End -->

 <style>
     [dir="rtl"] .applicationImg {
         position: absolute !important;
         right: 41rem !important;
         top: 0.5rem !important;
         height: 22rem !important;
         width: auto;
     }
 </style>

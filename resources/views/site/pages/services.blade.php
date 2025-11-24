   <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="services__title">
                        <div class="section-title">
                            <span>@lang('home.Services')</span>
                            <h2>@lang('home.what_we_do')</h2>
                        </div>
                        <p>@lang('home.services_description')
                        </p>
                        <a href="{{ route('site.services.index') }}" class="primary-btn">@lang('admin.see_more')</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        @forelse ($servicesCategories as  $service)
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="services__item">
                                <div class="services__item__icon">
                                    <img src="{{ $service->pathInView()}}" class="iconImg" alt="">
                                </div>
                                <h4>{{ $service->transNow->title}}</h4>
                                <p>{!! $service->description !!}</p>
                            </div>
                        </div>
                        @empty
                                            <p class="">@lang('home.no_services')</p>

                        @endforelse
                        
                   
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->
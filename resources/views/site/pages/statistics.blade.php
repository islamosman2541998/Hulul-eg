  @php
      $settings = \App\Settings\SettingSingleton::getInstance();
      $show_statistics = (int) $settings->getHome('show_statistics');
  @endphp

  @if ($show_statistics)
      <!-- Counter Section Begin -->
    <section class="counter">
        <div class="container">
            <div class="counter__content">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter__item">
                            <div class="counter__item__text">
                                <i class="fa-solid fa-clipboard-list iconImg"></i>
                                <h2 class="counter_num">{{ @$statistics[0]->count }}</h2>
                                <p>{{ $statistics[0]->transNow->title }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter__item second__item">
                            <div class="counter__item__text">
                                <i class="fa-solid fa-user iconImg"></i>
                                <h2 class="counter_num">{{ @$statistics[1]->count }}</h2>
                                <p>{{ $statistics[1]->transNow->title }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter__item third__item">
                            <div class="counter__item__text">
                                <i class="fa-solid fa-hand-holding-heart iconImg"></i>
                                <h2 class="counter_num">{{ @$statistics[2]->count }}</h2>
                                <p>{{ $statistics[2]->transNow->title }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="counter__item four__item">
                            <div class="counter__item__text">
                                <i class="fa-regular fa-lightbulb iconImg"></i>
                                <h2 class="counter_num">{{ @$statistics[3]->count }}</h2>
                                <p>{{ $statistics[3]->transNow->title }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Counter Section End -->
  @endif

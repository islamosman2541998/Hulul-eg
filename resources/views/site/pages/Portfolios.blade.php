    <!-- Work Section Begin -->
    <section class="work">
        <div class="work__gallery">
            <div class="grid-sizer"></div>
            <a href="./portfolio.html">

                <div class="work__item wide__item set-bg portfolioImg1">

                    <img src="{{ asset($portfolios[6]->image) }}" alt="">

                    <div class="work__item__hover">
                        <h4>{{ @$portfolios[6]->title }}</h4>
                        <ul>
                            <li>{!! Str::limit($portfolios[6]->description, 100) !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="work__item small__item set-bg portfolioImg2 " data-setbg="img/work/work-2.jpg">
                    <img src="{{ asset($portfolios[5]->image) }}" alt="">

                    <div class="work__item__hover">
                        <h4>{{ @$portfolios[5]->title }}</h4>
                        <ul>
                            <li>{!! Str::limit($portfolios[5]->description, 100) !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="work__item small__item set-bg portfolioImg3" data-setbg="img/work/work-3.jpg">
                    <img src="{{ asset($portfolios[4]->image) }}" alt="">

                    <div class="work__item__hover">
                        <h4>{{ @$portfolios[4]->title }}</h4>
                        <ul>
                            <li>{!! Str::limit($portfolios[4]->description, 100) !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="work__item large__item set-bg portfolioImg4" data-setbg="img/work/work-4.jpg">
                    <img src="{{ asset($portfolios[0]->image) }}" alt="">

                    <div class="work__item__hover">
                        <h4>{{ @$portfolios[0]->title }}</h4>
                        <ul>
                            <li>{!! Str::limit($portfolios[0]->description, 100) !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="work__item small__item set-bg portfolioImg5" data-setbg="img/work/work-5.jpg">
                    <img src="{{ asset($portfolios[1]->image) }}" alt="">

                    <div class="work__item__hover">
                        <h4>{{ @$portfolios[1]->title }}</h4>
                        <ul>
                            <li>{!! Str::limit($portfolios[1]->description, 100) !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="work__item small__item set-bg portfolioImg6" data-setbg="img/work/work-6.jpg">
                    <img src="{{ asset($portfolios[3]->image) }}" alt="">

                    <div class="work__item__hover">
                        <h4>{{ @$portfolios[3]->title }}</h4>
                        <ul>
                            <li>{!! Str::limit($portfolios[3]->description, 100) !!}</li>
                        </ul>
                    </div>
                </div>
                <div class="work__item wide__item set-bg portfolioImg7" data-setbg="img/work/work-7.jpg">
                    <img src="{{ asset($portfolios[2]->image) }}" alt="">

                    <div class="work__item__hover">
                        <h4>{{ @$portfolios[2]->title }}</h4>
                        <ul>
                            <li>{!! Str::limit($portfolios[2]->description, 100) !!}</li>
                        </ul>
                    </div>
                </div>
        </div>
        </a>
    </section>
    <!-- Work Section End -->

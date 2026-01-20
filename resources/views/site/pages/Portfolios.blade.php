
<!-- Work Section Begin -->
<section class="work">
    <div class="work__gallery">
        <div class="grid-sizer"></div>
        <a href="./portfolio.html">
            <div class="work__item wide__item" style="background: url('{{ asset($portfolios[6]->image) }}') center/cover no-repeat;">
                <div class="work__item__hover">
                    <h4>{{ @$portfolios[6]->title }}</h4>
                    <ul>
                        <li>{!! Str::limit(@$portfolios[6]->description, 100) !!}</li>
                    </ul>
                </div>
            </div>
            
            <div class="work__item small__item" style="background: url('{{ asset($portfolios[5]->image) }}') center/cover no-repeat;">
                <div class="work__item__hover">
                    <h4>{{ @$portfolios[5]->title }}</h4>
                    <ul>
                        <li>{!! Str::limit(@$portfolios[5]->description, 100) !!}</li>
                    </ul>
                </div>
            </div>
            
            <div class="work__item small__item" style="background: url('{{ asset($portfolios[4]->image) }}') center/cover no-repeat;">
                <div class="work__item__hover">
                    <h4>{{ @$portfolios[4]->title }}</h4>
                    <ul>
                        <li>{!! Str::limit(@$portfolios[4]->description, 100) !!}</li>
                    </ul>
                </div>
            </div>
            
            <div class="work__item large__item" style="background: url('{{ asset($portfolios[0]->image) }}') center/cover no-repeat;">
                <div class="work__item__hover">
                    <h4>{{ @$portfolios[0]->title }}</h4>
                    <ul>
                        <li>{!! Str::limit(@$portfolios[0]->description, 100) !!}</li>
                    </ul>
                </div>
            </div>
            
            <div class="work__item small__item" style="background: url('{{ asset($portfolios[1]->image) }}') center/cover no-repeat;">
                <div class="work__item__hover">
                    <h4>{{ @$portfolios[1]->title }}</h4>
                    <ul>
                        <li>{!! Str::limit(@$portfolios[1]->description, 100) !!}</li>
                    </ul>
                </div>
            </div>
            
            <div class="work__item small__item" style="background: url('{{ asset($portfolios[3]->image) }}') center/cover no-repeat;">
                <div class="work__item__hover">
                    <h4>{{ @$portfolios[3]->title }}</h4>
                    <ul>
                        <li>{!! Str::limit(@$portfolios[3]->description, 100) !!}</li>
                    </ul>
                </div>
            </div>
            
            <div class="work__item wide__item" style="background: url('{{ asset($portfolios[2]->image) }}') center/cover no-repeat;">
                <div class="work__item__hover">
                    <h4>{{ @$portfolios[2]->title }}</h4>
                    <ul>
                        <li>{!! Str::limit(@$portfolios[2]->description, 100) !!}</li>
                    </ul>
                </div>
            </div>
        </a>
    </div>
</section>
<!-- Work Section End -->

<style>
.work__item {
    min-height: 250px;
    position: relative;
    overflow: hidden;
}
</style>
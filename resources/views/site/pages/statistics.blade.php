  @php
      $settings = \App\Settings\SettingSingleton::getInstance();
      $show_statistics = (int) $settings->getHome('show_statistics');
  @endphp

@if ($show_statistics)
<section class="statistics-section py-5">
    <div class="container">
        <div class="row g-4">

            @foreach($statistics as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="stat-card">
                        <div class="stat-icon">
                            @switch($loop->index)
                                @case(0)
                                    <i class="fa-solid fa-clipboard-list"></i>
                                    @break
                                @case(1)
                                    <i class="fa-solid fa-user"></i>
                                    @break
                                @case(2)
                                    <i class="fa-solid fa-hand-holding-heart"></i>
                                    @break
                                @default
                                    <i class="fa-regular fa-lightbulb"></i>
                            @endswitch
                        </div>

                        <h2 class="counter_num">{{ $item->count }}</h2>

                        <p>{{ $item->transNow->title }}</p>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
@endif
<style>
    .statistics-section {
    background: #100028;
    padding: 100px 0;
}

.stat-card {
    background: #1a083d;
    border-radius: 20px;
    padding: 40px 25px;
    text-align: center;
    height: 100%;
    transition: all .3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        135deg,
        rgba(255,255,255,0.05),
        transparent
    );
}

.stat-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0,0,0,.3);
}

.stat-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 25px;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-icon i {
    color: #fff;
    font-size: 32px;
}

.stat-card h2 {
    color: #fff;
    font-size: 48px;
    font-weight: 700;
    margin-bottom: 10px;
}

.stat-card p {
    color: rgba(255,255,255,.8);
    font-size: 16px;
    margin: 0;
}

@media(max-width:768px){
    .stat-card h2{
        font-size: 36px;
    }
}
</style>

{{-- Reviews --}}

	@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_reviews    = (int) $settings->getHome('show_reviews');
@endphp
@if ($show_reviews)
 
{{-- Reviews --}}

 <section class="testimonial spad set-b testimonialbg" data-setbg="img/testimonial-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title center-title">
                        <span>@lang('reviews.reviews')</span>
                        <h2>@lang('reviews.what_clients_say')</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class=" swiper testimonials-swiper">
                        <div class="swiper-wrapper">

                          
                              @forelse ($reviews as $review)
                                   <div class="swiper-slide">
                                <div class="testimonial__item">
                                    <div class="testimonial__text">
                                        <p>{!!  $review->description !!}</p>
                                    </div>
                                    <div class="testimonial__author">
                                        <div class="testimonial__author__pic">
                                            <img src="{{ asset($review->pathInView()) }}" alt="">
                                        </div>
                                        <div class="testimonial__author__text">
                                            <h5>{{ $review->customer_name }}</h5>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                              @empty
                                  <p>No reviews available</p>
                              @endforelse
                           

                            
                         

                            
                        </div>

                        <!-- Pagination + Navigation -->
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev testimonials-button-prev" aria-label="Previous"></div>
                        <div class="swiper-button-next testimonials-button-next" aria-label="Next"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var reviewModal = document.getElementById('reviewModal');
        reviewModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; 
            var name = button.getAttribute('data-name');
            var description = button.getAttribute('data-description');
            var image = button.getAttribute('data-image');
            var rate = parseFloat(button.getAttribute('data-rate'));

            document.getElementById('modalImage').src = image;
            document.getElementById('modalName').textContent = name;
            document.getElementById('modalDescription').textContent = description;

            var modalRate = document.getElementById('modalRate');
            modalRate.innerHTML = '';
            var filledStars = Math.floor(rate);
            var hasHalfStar = rate - filledStars >= 0.5;
            for (var i = 1; i <= 5; i++) {
                var star = document.createElement('i');
                star.className = 'fa-solid fa-star';
                if (i <= filledStars) {
                    star.classList.add('text-warning');
                } else if (i == filledStars + 1 && hasHalfStar) {
                    star.classList.add('text-warning', 'half');
                } else {
                    star.classList.add('text-secondary');
                }
                modalRate.appendChild(star);
            }
            modalRate.innerHTML += `<span class="text-muted">(${rate.toFixed(1)})</span>`;
        });
    });
</script>
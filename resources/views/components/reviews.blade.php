
{{-- Reviews --}}

	@php
    $settings     = \App\Settings\SettingSingleton::getInstance();
    $show_reviews    = (int) $settings->getHome('show_reviews');
@endphp
@if ($show_reviews)
    <div class="Review testimonial my-4 p-5 text-center  wow fadeInUp">

    <div class="container">
            <h2 class="testimonialh2">@lang('reviews.reviews')</h2>

        
        <div class="swiper ReviewSlider">
            <div class="swiper-wrapper mt-3">
                @forelse ($reviews as $review)
                    <div class="swiper-slide">
                        <div class="Reviewbox d-flex flex-column align-items-center mx-auto p-3 rounded" 
                             data-bs-toggle="modal" 
                             data-bs-target="#reviewModal" 
                             data-name="{{ $review->customer_name }}" 
                             data-description="{{ $review->description }}" 
                             data-image="{{ asset($review->pathInView()) }}" 
                             data-rate="{{ $review->rate }}">
                            <img src="{{ asset($review->pathInView()) }}" class="img-fluid rounded-circle" alt="{{ $review->customer_name }}" style="width: 100px; height: 100px; object-fit: cover;">
                            <h4 class="mt-3">
                                {{ Str::limit($review->customer_name, 20, '...') }}
                              </h4>
                              <p class="mt-2">
                                {{ Str::limit($review->description, 30, '...') }}
                              </p>
                         
                        </div>
                    </div>
                @empty
                    <p>{{ app()->getLocale() == 'ar' ? 'لا يوجد تقييمات متاحة' : 'No reviews available' }}</p>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">{{ app()->getLocale() == 'ar' ? 'تفاصيل التقييم' : 'Review Details' }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-column align-items-center mx-auto text-center">
                <img id="modalImage" src="" class="img-fluid rounded-circle" alt="" style="width: 100px; height: 100px; object-fit: cover;">
                <h4 id="modalName" class="mt-3"></h4>
                <p id="modalDescription" class="mt-2"></p>
                {{-- <div class="rate text-center mt-2" id="modalRate"></div> --}}
            </div>
        </div>
    </div>
</div>
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
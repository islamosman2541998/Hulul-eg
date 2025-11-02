<div class="Btns d-flex align-items-center mt-3 mt-lg-0 justify-content-center">
    <a href="{{ route('site.cart') }}" class=" position-relative">

        <i class="fa-solid fa-cart-plus cart-icon main-color"></i> <span
            class="position-absolute top-0 start-100 translate-middle badge cart-count rounded-pill m-2 main-color-bg">
            {{ $cartCount }}
            <span class="visually-hidden">cart items</span>
        </span>

    </a>

</div>

{{-- -------- SHOP ----- --}}
<div class="Shop  shop-page">
    @php
        $settings = \App\Settings\SettingSingleton::getInstance();
    @endphp

    @section('title', 'Dalia El Haggar' . ' | ' .  'Shop')
    @section('title', $settings->getMeta('shop_meta_title_' . $current_lang) ?? 'Default Title ')
    @section('meta_key', $settings->getMeta('shop_meta_key_' . $current_lang) ?? 'Default Keywords')
    @section('meta_description', $settings->getMeta('shop_meta_description_' . $current_lang) ?? 'Default Description')

    <div class="container shop-page ">

        <div class="row">
            <div class="col-3">
                <div class="collapsebar d-none d-lg-block">


                    {{-- Sidebar Sort Filter --}}

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filtersDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('messages.Sort By') }}: {{ $sortfilters }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="filtersDropdown">
                                <li>
                                    <a href="#" class="dropdown-item"
                                        wire:click.prevent="setsortfilters('Price: High to Low')">
                                        {{ __('messages.Price: High to Low') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item"
                                        wire:click.prevent="setsortfilters('Price: Low to High')">
                                        {{ __('messages.Price: Low to High') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="dropdown-item"
                                        wire:click.prevent="setsortfilters('Latest Arrival')">
                                        {{ __('messages.Latest Arrival') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Sidebar Categories -->

                    <div class="occain">
                        <button class="btn btn-collapse d-flex justify-content-between align-items-center"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                            aria-expanded="false" aria-controls="collapseExample">
                            <span class="text-dark">{{ $settings->getItem('categories') }}</span>
                            {{-- <span class="main-color fw-bold fs-5">{{ $settings->getItem('categories') }}</span> --}}

                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="collapse" id="collapseExample" wire:ignore.self>
                            @foreach ($categories as $category)
                                <div class="content d-flex justify-content-between align-items-center px-3"
                                    wire:key="category-{{ $category->id }}">
                                    <div class="checkBox d-flex align-items-center pt-3">
                                        <input type="checkbox" name="labelId" id="category-{{ $category->id }}"
                                            wire:model="filterCategory.{{ $category->id }}" class="me-2" />
                                        <label for="category-{{ $category->id }}" class="mb-1 me-2">
                                            {{ $category->transNow?->title ?? __('messages.No Title') }}</label>
                                    </div>
                                    <span class="number">{{ $category->products->count() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sidebar Occasions -->

                    <div class="occain">
                        <button class="btn btn-collapse d-flex justify-content-between align-items-center"
                            type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false"
                            aria-controls="collapse1">
                            <span class="text-dark">{{ $settings->getItem('occassions') }}</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="collapse" id="collapse1" wire:ignore.self>

                            @foreach ($occasions as $occasion)
                                <div class="content d-flex justify-content-between align-items-center px-3"
                                    wire:key="occasion-{{ $occasion->id }}">
                                    <div class="checkBox d-flex align-items-center pt-3">
                                        <input type="checkbox" name="labelId" id="occasion-{{ $occasion->id }}"
                                            wire:model="filterOccasion.{{ $occasion->id }}" class="me-2" />
                                        <label for="occasion-{{ $occasion->id }}" class="mb-1 me-2">
                                            {{ $occasion->transNow?->title ?? __('messages.No Title') }}
                                        </label>
                                    </div>
                                    <span class="number">{{ $occasion->products->count() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>




                    <!-- Sidebar Filters -->


                    @foreach ($parents as $parent)
                        <div class="occain">
                            <button class="btn btn-collapse d-flex justify-content-between align-items-center"
                                type="button" data-bs-toggle="collapse" data-bs-target="#filter-{{ $parent->id }}"
                                aria-expanded="false" aria-controls="filter-{{ $parent->id }}">
                                <span class="text-dark">{{ $parent->name }}</span>
                                <i class="fa-solid fa-chevron-down"></i>
                            </button>
                            <div class="collapse" id="filter-{{ $parent->id }}" wire:ignore.self>
                                @foreach ($parent->children as $child)
                                    <div class="content d-flex justify-content-between align-items-center px-3"
                                        wire:key="child-{{ $child->id }}">
                                        <div class="checkBox d-flex align-items-center pt-3">
                                            <input type="checkbox" id="child-{{ $child->id }}"
                                                wire:model="filterAttribute.{{ $child->id }}" class="me-2" />
                                            <label for="child-{{ $child->id }}" class="mb-1 me-2">
                                                {{ $child->name }}
                                            </label>
                                        </div>
                                        <span class="number">{{ $child->products->count() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <!-- Sidebar Price Filter -->
                    <div wire:ignore x-data="priceSlider({
                        lower: @entangle('currentMin'),
                        upper: @entangle('currentMax'),
                        min: {{ $minPrice }},
                        max: {{ $maxPrice }}
                    })" class="price-filter p-4 border rounded">

                        <div class="font-semibold mb-2 text-center">filter by price </div>
                        <div x-ref="slider" class="mb-2"></div>

                        <div class="price-values flex justify-between text-sm">
                            <span>from <span x-text="lower"></span> EGP</span>
                            <span>to <span x-text="upper"></span> EGP</span>
                        </div>
                    </div>



                </div>

            </div>

            <!-- Main Content (Products) -->
            <div class="col-12 col-lg-9">
                <div class="row">
                    @forelse ($products ?? [] as $product)
                        <div class="col-6 col-lg-4" wire:key="product-{{ $product->id }}">
                            <div class="top-0  p-0 d-flex align-items-center">
                                <span
                                    class="bg-{{ $product->in_stock ? 'success' : 'danger' }} rounded-circle d-inline-block me-1"
                                    style="width:8px; height:8px;"></span>
                                <span
                                    class="fst-italic stock_shop small text-{{ $product->in_stock ? 'success' : 'danger' }}">
                                    {{ $product->in_stock ? __('messages.in_stock') : __('messages.out_of_stock') }}
                                </span>
                            </div>
                            <a href="{{ route('site.products.show', array_merge(['id' => $product->id], request()->query())) }}"
                                class="text-decoration-none text-dark">
                                <div class="card mt-0 position-relative">


                                    <img src="{{ $product->pathInView() }}" class="card-img-top rounded-top"
                                        alt="{{ $product->transNow?->title ?? __('messages.No Title') }}" />

                                    <div class="card-body shadow-sm rounded-0">
                                        <h6 class="card-title">
                                            {{ $product->transNow?->title ?? __('messages.No Title') }}
                                        </h6>

                                        @if ($product->price_after_sale !== $product->price)
                                            <div class="d-flex align-items-center">
                                                <span class="text-danger main-color">
                                                    {{ number_format($product->price_after_sale, 2) }} EGP
                                                </span>
                                                <span class="text-danger text-decoration-line-through mx-2">
                                                    {{ number_format($product->price, 2) }} EGP
                                                </span>
                                            </div>
                                        @else
                                            <span>
                                                {{ number_format($product->price, 2) }} EGP
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </a>

                            <button type="button"
                                class="btn w-100 m-auto text-white main-color-bg mb-4 rounded-0 rounded-bottom"
                                @if ($product->user_input == 1) onclick="window.location='{{ route('site.products.show', $product->id) }}'"
                                @elseif($product->in_stock > 0)
                                    wire:click="addToCart({{ $product->id }})"
                                @else
                                    disabled @endif>
                                @if ($product->user_input == 1)
                                    {{ __('messages.view_product') }}
                                @elseif($product->in_stock > 0)
                                    {{ __('messages.Add to Cart') }}
                                @else
                                    {{ __('messages.Out of Stock') }}
                                @endif
                            </button>

                        </div>


                    @empty
                        <p class="text-center">{{ __('messages.No Products') }}</p>
                    @endforelse
                </div>

                <div id="load-more-trigger" class="h-1"></div>
                <div wire:loading wire:target="loadMore" class="text-center my-4">
                    <div class="spinner-border text-primary"></div>
                </div>

                {{-- <div class="d-flex flex-wrap flex-lg-nowrap justify-content-center gap-2 mt-4">
                    {{ $products->onEachSide(1)->links() }}
                </div> --}}

            </div>
        </div>

        <div class="row">
            <!-- Modal -->
            <div class="modal fade @if ($show_modal) show @endif"
                @if ($show_modal) style="display: block;" @endif id="cartModal" tabindex="-1"
                aria-labelledby="cartModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #431934; color: white;">
                            <button type="button" wire:click="closeModal" class="btn-close btn-close-white text-end"
                                data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center">
                            <p>{{ __('messages.Product added to cart') }}</p>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                wire:click="closeModal">
                                {{ __('messages.Continue') }}
                            </button>
                            <a href="{{ route('site.cart') }}" class="btn btn-primary"
                                style="background-color: #431934; border: none;">{{ __('messages.Go to Cart') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>

        </style>

        <!--Sort offcanves-->
        <button class="btn-sort mb-5  main-color-bg rounded d-block d-lg-none" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvas1" aria-controls="offcanvas1">
            {{ __('messages.Filter_By') }}
            {{-- <i class="fa-solid fa-arrow-down-short-wide"></i> --}}
        </button>

        <div class="offcanvas mt-5 offcanvas-end Sort-offcanves" tabindex="-1" id="offcanvas1"
            aria-labelledby="offcanvasExampleLabel" data-bs-scroll="true" data-bs-backdrop="false">

            <div class="offcanvas-header">
                <h5 class="offcanvas-title " id="offcanvasExampleLabel">{{ __('messages.Filter_By') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">



                {{-- Sidebar Sort Filter --}}

                <div class="mb-4 d-flex justify-content-between align-items-center">
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filtersDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Sort by : {{ $sortfilters }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="filtersDropdown">
                            <li>
                                <a href="#" class="dropdown-item"
                                    wire:click.prevent="setsortfilters('Price: High to Low')">
                                    Price: High to Low
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item"
                                    wire:click.prevent="setsortfilters('Price: Low to High')">
                                    Price: Low to High
                                </a>
                            </li>
                            <li>
                                <a href="#" class="dropdown-item"
                                    wire:click.prevent="setsortfilters('Latest Arrival')">
                                    Latest Arrival
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Sidebar Categories -->

                <div class="occain">
                    <button class="btn btn-collapse d-flex justify-content-between align-items-center" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false"
                        aria-controls="collapseExample">
                        <span>{{ __('messages.Categories') }}</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="collapseExample" wire:ignore.self>
                        @foreach ($categories as $category)
                            <div class="content d-flex justify-content-between align-items-center px-3"
                                wire:key="category-{{ $category->id }}">
                                <div class="checkBox d-flex align-items-center pt-3">
                                    <input type="checkbox" name="labelId" id="category-{{ $category->id }}"
                                        wire:model="filterCategory.{{ $category->id }}" class="me-2" />
                                    <label for="category-{{ $category->id }}" class="mb-1 me-2">
                                        {{ $category->transNow?->title ?? __('messages.No Title') }}</label>
                                </div>
                                <span class="number">{{ $category->products->count() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar Occasions -->

                <div class="occain">
                    <button class="btn btn-collapse d-flex justify-content-between align-items-center" type="button"
                        data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false"
                        aria-controls="collapse1">
                        <span>{{ __('messages.Occasions') }}</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="collapse" id="collapse1" wire:ignore.self>

                        @foreach ($occasions as $occasion)
                            <div class="content d-flex justify-content-between align-items-center px-3"
                                wire:key="occasion-{{ $occasion->id }}">
                                <div class="checkBox d-flex align-items-center pt-3">
                                    <input type="checkbox" name="labelId" id="occasion-{{ $occasion->id }}"
                                        wire:model="filterOccasion.{{ $occasion->id }}" class="me-2" />
                                    <label for="occasion-{{ $occasion->id }}" class="mb-1 me-2">
                                        {{ $occasion->transNow?->title ?? __('messages.No Title') }} </label>
                                </div>
                                <span class="number">{{ $occasion->products->count() }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar Filters -->

                @foreach ($parents as $parent)
                    <div class="occain">
                        <button class="btn btn-collapse d-flex justify-content-between align-items-center"
                            type="button" data-bs-toggle="collapse" data-bs-target="#filter-{{ $parent->id }}"
                            aria-expanded="false" aria-controls="filter-{{ $parent->id }}">
                            <span class="text-dark">{{ $parent->name }}</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>
                        <div class="collapse" id="filter-{{ $parent->id }}" wire:ignore.self>
                            @foreach ($parent->children as $child)
                                <div class="content d-flex justify-content-between align-items-center px-3"
                                    wire:key="child-{{ $child->id }}">
                                    <div class="checkBox d-flex align-items-center pt-3">
                                        <input type="checkbox" id="child-{{ $child->id }}"
                                            wire:model="filterAttribute.{{ $child->id }}" class="me-2" />
                                        <label for="child-{{ $child->id }}" class="mb-1 me-2">
                                            {{ $child->transNow?->name }}
                                        </label>
                                    </div>
                                    <span class="number">{{ $child->products->count() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Sidebar Price Filter -->
                <div wire:ignore x-data="priceSlider({
                    lower: @entangle('currentMin'),
                    upper: @entangle('currentMax'),
                    min: {{ $minPrice }},
                    max: {{ $maxPrice }}
                })" class="price-filter p-4 border rounded">

                    <div class="font-semibold mb-2 text-center">filter by price </div>
                    <div x-ref="slider" class="mb-2"></div>

                    <div class="price-values flex justify-between text-sm">
                        <span>from <span x-text="lower"></span> EGP</span>
                        <span>to <span x-text="upper"></span> EGP</span>
                    </div>
                </div>
            </div>
        </div>
        <!--Sort offcanves-->


    </div>

    <script>
        document.addEventListener('livewire:load', () => {
            const trigger = document.getElementById('load-more-trigger');
            const observer = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting) {
                    @this.call('loadMore');
                }
            }, {
                rootMargin: '200px'
            });
            observer.observe(trigger);
        });
    </script>

    <style>
        @media (max-width: 576px) {
            .pagination .page-link {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
            }

        }

        #filtersDropdown {

            background-color: #431934;
            border-color: #431934;
            color: #ffffff;

        }

        #filtersDropdown:hover,
        #filtersDropdown:focus {
            background-color: #431934;
            border-color: #431934;
            color: #ffffff;
        }


        #filtersDropdown .dropdown-toggle::after {
            border-top-color: #ffffff;
        }


        .dropdown-menu {
            background-color: #431934;
            border: 1px solid #ddd;
        }


        .dropdown-menu .dropdown-item {
            color: #ffffff;
        }

        .dropdown-menu .dropdown-item:hover,
        .dropdown-menu .dropdown-item:focus {
            background-color: #431934;
            color: #ffffff;
        }

        .dropdown-menu .dropdown-item.active,
        .dropdown-menu .dropdown-item.active:hover {
            background-color: #431934;
            color: #ffffff;
        }
    </style>

</div>

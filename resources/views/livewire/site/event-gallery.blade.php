<div class="Fliter">
    <div class="container">
        <div class="Imgs">
            <div class="Img-wrapper">
                <!-- Filter Section -->
                <div class="gallery-filter">
                    <ul class="list">
                        <li class="{{ is_null($selectedOccasionId) ? 'active' : '' }}">
                            <span wire:click="resetGallery" class="Btn display7"> All </span>
                        </li>
                        @foreach($occasions as $occasion)
                            <li class="{{ $selectedOccasionId === $occasion->id ? 'active' : '' }}">
                                <span wire:click="updateEvents({{ $occasion->id }})" class="Btn display7">
                                    {{ $occasion->transNow->title }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Gallery Section -->
                <div class="gallery-row">
                    <div class="row">
                        <div class="d-flex flex-wrap justify-content-center">
                            @foreach ($images as $image)
                                <div class="item">
                                    <img src="{{ $image }}" alt="Event Image" class="img-fluid m-1" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


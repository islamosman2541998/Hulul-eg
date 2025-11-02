<div class="gallery-component  wow bounceInLeft">
    @if(empty($images))
        <div class="no-image text-center p-4">
            <p>No image</p>
        </div>
    @else
        <div class="lg mb-3">
            <img id="mainImg" src="{{ $images[$activeIndex]['url'] }}" alt="{{ $images[$activeIndex]['alt'] ?? 'Image' }}" style="width:100%; max-height:500px; object-fit:contain;">
        </div>

        <div class="thumbs d-flex gap-2 flex-wrap">
            @foreach($images as $i => $img)
                <button wire:click.prevent="setActiveImage({{ $i }})" class="thumb btn p-0 {{ $i === $activeIndex ? 'active' : '' }}" aria-label="Image {{ $i+1 }}">
                    <img src="{{ $img['url'] }}" alt="{{ $img['alt'] }}" style="width:80px; height:80px; object-fit:cover; border: 2px solid {{ $i === $activeIndex ? '#d6103d' : '#e6e6e6' }};">
                </button>
            @endforeach
        </div>
    @endif
</div>
<style>
    .gallery {
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 800px;
        margin: 0 auto;
    }

    .lg {
        width: 100%;
        max-height: 400px;
        overflow: hidden;
    }

    .lg img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .thumbs {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .thumb {
        width: 80px;
        height: 80px;
        border: 2px solid transparent;
        background: none;
        padding: 0;
        cursor: pointer;
    }

    .thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumb.active {
        border-color: #007bff;
    }
</style>

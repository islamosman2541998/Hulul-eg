<div>
    <!-- Filters -->
    <div class="portfolio__filter text-center mb-5">
        <ul class="list-inline d-inline-block">
            <li class="list-inline-item {{ $activeTag === 'all' ? 'active' : '' }}">
                <button type="button" wire:click="filterByTag('all')" class="btn-filter">
                    {{ __('admin.all') }}
                </button>
            </li>

            @foreach ($tags as $tag)
                <?php
                $currentTrans = $tag->trans->where('locale', app()->getLocale())->first();
                ?>
                <li class="list-inline-item {{ $activeTag === ($currentTrans->slug ?? '') ? 'active' : '' }}">
                    <button type="button" wire:click="filterByTag('{{ $currentTrans->slug ?? '' }}')" class="btn-filter">
                        {{ @$currentTrans->title ?? 'غير معروف' }}
                    </button>
                </li>
            @endforeach



        </ul>
    </div>

   <div class="row portfolio__gallery" id="portfolio-container">
    @forelse($portfolios as $item)
        <div class="col-lg-4 col-md-6 col-sm-6 mb-4 mix">
            <div class="portfolio__item position-relative overflow-hidden">
                @if ($item->image)
                    @if ($item->type == 'image')
                        {{-- عرض الصورة --}}
                        <a href="{{ asset($item->image) }}" 
                           class="work__link image-popup"
                           title="{{ $item->transNow->title ?? '' }}">
                            <img src="{{ asset($item->image) }}" 
                                 class="img-fluid w-100"
                                 alt="{{ $item->transNow->title ?? '' }}"
                                 style="height: 15rem; object-fit: cover; border-radius: 1rem;">

                            <div class="portfolio__item__text position-absolute bottom-0 start-0 end-0 p-3 text-white">
                                <h4>{{ $item->transNow->title ?? 'No Title' }}</h4>
                                <ul class="list-unstyled mb-0">
                                    @if ($item->tag && $item->tag->transNow)
                                        <li>{{ $item->tag->transNow->title }}</li>
                                    @endif
                                    <li>{{ __('Image') }}</li>
                                </ul>
                            </div>
                        </a>

                    @elseif($item->type == 'video')
                        {{-- عرض الفيديو --}}
                        <div class="video-wrapper position-relative">
                            <video width="100%" 
                                   style="height: 15rem; object-fit: cover; border-radius: 1rem;" 
                                   controls>
                                <source src="{{ asset($item->image) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>

                            <div class="portfolio__item__text position-absolute bottom-0 start-0 end-0 p-3 text-white">
                                <h4>{{ $item->transNow->title ?? 'No Title' }}</h4>
                                <ul class="list-unstyled mb-0">
                                    @if ($item->tag && $item->tag->transNow)
                                        <li>{{ $item->tag->transNow->title }}</li>
                                    @endif
                                    <li>{{ __('Video') }}</li>
                                </ul>
                            </div>
                        </div>

                    @elseif($item->type == 'pdf')
                        {{-- عرض الـ PDF --}}
                        <a href="{{ asset($item->image) }}" 
                           class="work__link popup-iframe" 
                           target="_blank"
                           title="{{ $item->transNow->title ?? '' }}">
                            
                            {{-- Preview للـ PDF (أيقونة أو صورة معاينة) --}}
                            <div class="pdf-preview d-flex align-items-center justify-content-center"
                                 style="height: 15rem; background: #f8f9fa; border-radius: 1rem;">
                                <i class="fas fa-file-pdf fa-5x text-danger"></i>
                            </div>

                            <div class="portfolio__item__text position-absolute bottom-0 start-0 end-0 p-3 text-white"
                                 style="background: rgba(0,0,0,0.7);">
                                <h4>{{ $item->transNow->title ?? 'No Title' }}</h4>
                                <ul class="list-unstyled mb-0">
                                    @if ($item->tag && $item->tag->transNow)
                                        <li>{{ $item->tag->transNow->title }}</li>
                                    @endif
                                    <li>{{ __('PDF Document') }}</li>
                                </ul>
                            </div>
                        </a>

                    @else
                        {{-- لو في نوع تاني أو external link --}}
                        <a href="{{ $item->link ?? '#' }}" 
                           class="work__link external-link" 
                           target="_blank"
                           title="{{ $item->transNow->title ?? '' }}">
                            <img src="{{ asset($item->image) }}" 
                                 class="img-fluid w-100"
                                 alt="{{ $item->transNow->title ?? '' }}"
                                 style="height: 15rem; object-fit: cover; border-radius: 1rem;">

                            <div class="portfolio__item__text position-absolute bottom-0 start-0 end-0 p-3 text-white">
                                <h4>{{ $item->transNow->title ?? 'No Title' }}</h4>
                                <ul class="list-unstyled mb-0">
                                    @if ($item->tag && $item->tag->transNow)
                                        <li>{{ $item->tag->transNow->title }}</li>
                                    @endif
                                    @if($item->type)
                                        <li>{{ ucfirst($item->type) }}</li>
                                    @endif
                                </ul>
                            </div>
                        </a>
                    @endif
                @endif
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h4>{{ __('admin.no_portfolios') }}</h4>
        </div>
    @endforelse
</div>

    <!-- Pagination -->
    {{-- <div class="row mt-5">
        <div class="col-lg-12">
            <div class="pagination__option text-center">
                {{ $portfolios->links() }}
            </div>
        </div>
    </div> --}}
</div>

<style>
  .btn-filter {
        background: transparent;
        border: none;
        color: #fff;
        padding: 10px 20px;
        margin: 0 5px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-filter:hover,
    .btn-filter.active {
        background: #007bff;
        border-radius: 30px;
    }
     .portfolio__item {
        transition: transform 0.3s ease;
    }
    
    .portfolio__item:hover {
        transform: translateY(-5px);
    }
    
    .portfolio__item__text {
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    }
    
    .video-wrapper video {
        cursor: pointer;
    }
    
    .pdf-preview {
        transition: all 0.3s ease;
    }
    
    .pdf-preview:hover {
        background: #e9ecef !important;
    }
    
    .pdf-preview i {
        transition: transform 0.3s ease;
    }
    
    .pdf-preview:hover i {
        transform: scale(1.1);
    }
    
</style>

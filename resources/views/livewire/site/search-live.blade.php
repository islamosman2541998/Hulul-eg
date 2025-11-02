<div>


    <div class="input-group input-search mx-auto w-50">
        <span class="input-group-text bg-white border-end-0">
            <i class="fas fa-search"></i>
        </span>

        <input type="text" wire:model.debounce.200ms="query" wire:keydown.enter.prevent="redirectToShop"
            class="form-control border-start-0" placeholder="{{ __('messages.live_search') }}" autocomplete="on" />
    </div>

    @if ($results->isEmpty() && $query !== '')
        <p class="text-center text-muted">{{ __('messages.no_results_found') }}</p>
    @else
        <div class="results-container w-50 mx-auto text-center">
            @foreach ($results as $item)
                @php $type = $item->search_type; @endphp
                <div
                    class="result-item p-1 d-flex justify-content-center align-content-center align-items-center gap-3 text-center border-bottom">
                    <div class="text-start w-100">
                        <h6 class="mb-1">{{ $item->transNow->title }}</h6>

                        @if ($type === 'product')
                            <small class="text-muted d-block">Code: <strong>{{ $item->code }}</strong></small>
                        @endif
                    </div>

                    @if ($type === 'product')
                        {{-- <small class="text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($item->transNow->description), 100) }}</small> --}}
                        <a href="{{ route('site.products.show', $item->id) }}" class="stretched-link"></a>
                    @elseif($type === 'category')
                        <a href="{{ route('site.shop', ['category_id' => $item->id]) }}" class="stretched-link">
                            <small class="text-muted">{{ __('messages.Category') }}</small>
                        </a>
                    @elseif($type === 'occasion')
                        <a href="{{ route('site.shop', ['occasion_id' => $item->id]) }}" class="stretched-link">
                            <small class="text-muted">{{ __('messages.Occasion') }}</small>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
    .results-container {
        max-height: 400px;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: .25rem;
    }

    .result-item {
        position: relative;
    }

    .result-item .stretched-link {
        z-index: 1;
    }
</style>

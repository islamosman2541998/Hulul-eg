@extends('site.app')

@section('content')

    <div class="container search w-75 py-5 mx-auto">
<h3 class="mb-4"> {{ __('messages.Search_results') }} “<strong>{{ $q }}</strong>”</h3>


        @if ($results->isEmpty())
            <p class="text-center">{{ __('No results found.') }}</p>
        @else
            <div class="row">
                @foreach ($results as $item)
                    @php $type = $item->search_type; @endphp
                    <div class="col-12 col-md-4 mb-4">
                        <div class="card h-100 position-relative">

                            @if ($type === 'product')
                                <img src="{{ asset($item->pathInView()) }}" class="card-img-top"
                                    alt="{{ $item->transNow->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->transNow->title }}</h5>
                                    <p class="card-text">{!! \Illuminate\Support\Str::limit(strip_tags($item->transNow->description), 100) !!}</p>
                                </div>
                                <a href="{{ route('site.products.show', $item->id) }}" class="stretched-link"></a>
                            @elseif($type === 'category')
                                <div class="card-body text-center">
                                    <img src="{{ asset($item->pathInView()) }}" class="img-fluid mb-2"
                                        style="max-width: 100px;" alt="{{ $item->transNow->title }}">
                                    <h5 class="card-title">
                                        {{ $item->trans->firstWhere('locale', app()->getLocale())->title }}</h5>
                                </div>
                                <a href="{{ route('site.shop', ['category_id' => $item->id]) }}" class="stretched-link"></a>
                            @elseif($type === 'occasion')
                                <div class="card-body text-center">
                                    <img src="{{ asset($item->pathInView()) }}" class="img-fluid mb-2"
                                        style="max-width: 100px;" alt="{{ $item->transNow->title }}">
                                    <h5 class="card-title">
                                        {{ $item->trans->firstWhere('locale', app()->getLocale())->title }}</h5>
                                </div>

                                <a href="{{ route('site.shop', ['occasion_id' => $item->id]) }}"
                                    class="stretched-link"></a>
                            @elseif($type === 'filter')
                                <div class="card-body text-center h-50 d-flex flex-column justify-content-center">
                                   
                                    <h5 class="card-title"> {{ __('messages.filter_roses_by_color') }} : {{ $item->transNow->name }}</h5>
                                </div>
                                <a href="{{ route('site.shop', ['filterAttribute' => [$item->id => 1]]) }}"
                                    class="stretched-link"></a>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        @endif


    </div>
@endsection


{{-- @extends('site.app')

@section('content')
<div class="container search w-75">
    <h3 class="mb-4">
        Results for “<strong>{{ $query }}</strong>” ({{ ucfirst($type) }})
    </h3>

    @if ($results->isEmpty())
        <p>No results found.</p>
    @else
        <div class="row">
            @foreach ($results as $item)
                <div class="col-12 col-md-4 mb-3">
                    <div class="card h-100 position-relative">
                        @if ($type === 'products')
                            <img src="{{ asset($item->pathInView()) }}"
                                 class="card-img-top"
                                 alt="{{ $item->transNow->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->transNow->title }}</h5>
                                <p class="card-text">{!! $item->transNow->description !!}</p>
                            </div>
                            <a href="{{ route('site.products.show', ['id' => $item->id]) }}"
                               class="stretched-link"></a>

                        @elseif($type === 'occasions')
                            <div class="card-body text-center">
                                <img src="{{ asset($item->pathInView()) }}"
                                     class="img-fluid mb-2"
                                     style="max-width: 100px;"
                                     alt="{{ $item->transNow->title }}">
                                <h5 class="card-title">{{ $item->transNow->title }}</h5>
                            </div>
                            <a href="{{ route('site.shop', ['occasion_id' => $item->id]) }}"

                               class="stretched-link"></a>

                        @else 
                            <div class="card-body text-center">
                                <img src="{{ asset($item->pathInView()) }}"
                                     class="img-fluid mb-2"
                                     style="max-width: 100px;"
                                     alt="{{ $item->transNow->title }}">
                                <h5 class="card-title">{{ $item->transNow->title }}</h5>
                            </div>
                            <a href="{{ route('site.shop', ['category_id' => $item->id]) }}"
                                class="stretched-link"></a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection --}}

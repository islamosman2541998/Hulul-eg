@extends('site.app')

@section('content')
    <div class="container pt-5">
        <div class="row justify-content-center p-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-6 p-3">
                            <img src="{{ asset($card['image']) }}" class="img-fluid h-100 w-100 rounded-start" alt="{{ $card['title'] }}">
                        </div>
                        <div class="col-md-6 p-3 d-flex align-items-center justify-content-center">
                            <div class="card-body text-center">
                                <h2 class="card-title">{{ $card['title'] }}</h2>
                                <p class="card-text">{{ $card['description'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
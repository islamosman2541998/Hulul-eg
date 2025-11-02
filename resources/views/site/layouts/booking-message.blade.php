@if(session()->has('success'))
    <h5 class="text-center text-success" dir="rtl">
        {{ session('success') }}
    </h5>
@endif


@if(session()->has('error'))
    <h5 class="text-center text-danger" dir="rtl">
        {{ session('error') }}
    </h5>
@endif


@if(count($errors->all()) > 0)
<div class="alert alert-danger text-center alert-message" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <li class="list-group-item">{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

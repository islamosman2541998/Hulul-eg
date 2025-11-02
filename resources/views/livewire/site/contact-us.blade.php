<form method="POST" wire:submit.prevent="sendForm()">

    <div class="my-3">
        @include('site.layouts.booking-message')
    </div>

    <div class="form-group d-flex flex-wrap flex-lg-nowrap ">
      <input type="text" wire:model="name" class="form-control @error('text') is-invalid @enderror" id="Name" placeholder="@lang('Name') *" required>
    </div>

    <div class="form-group my-3 d-flex flex-wrap flex-lg-nowrap ">
        <input type="email" wire:model="email" class="form-control me-lg-3 my-lg-0 my-3 @error('email') is-invalid @enderror" id="Email" aria-describedby="emailHelp" placeholder="@lang('Email') "  >
        <input type="tel" wire:model="phone" class="form-control @error('phone') is-invalid @enderror" id="Email" aria-describedby="emailHelp" placeholder="@lang('Mobile') *" required>
    </div>

    <div class="col-12 my-3">
        <textarea wire:model="message" class="form-control @error('message') is-invalid @enderror"  id="exampleTextarea" rows="6" placeholder="@lang('Message ...')"></textarea>
    </div>

    <button type="submit" class="btn bg-main  text-lg-start text-center px-5"> @lang('Send') </button>

  </form>

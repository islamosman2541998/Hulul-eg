<div class="card p-4 wow bounceInLeft">


    <form wire:submit.prevent="submit" class="form-wrap">
       
        
        <div class="form-row mb-2">
            <label class="label">@lang('home.full_name')</label>
            <input class="input form-control" type="text" wire:model.defer="name" placeholder="@lang('home.full_name')" />
            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="form-row mb-2">
            <label class="label">@lang('home.phone')</label>
            <input class="input form-control" type="text" wire:model.defer="phone" placeholder="@lang('home.phone')" />
            @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="form-row mb-2">
            <label class="label">@lang('home.email')</label>
            <input class="input form-control" type="email" wire:model.defer="email" placeholder="@lang('home.email')" />
            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

        <div class="form-row mb-2">
            <label class="label">@lang('home.your_message')</label>
            <textarea class="textarea form-control"  wire:model.defer="message" rows="10" placeholder="@lang('home.your_message')"></textarea>
            @error('message') <div class="text-danger small">{{ $message }}</div> @enderror
        </div>

     

        <div class="d-grid">
            <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">
                <span wire:loading.remove>@lang('home.send')</span>
                <span wire:loading>... @lang('home.sending')</span>
            </button>
        </div>
    </form>
</div>

<div class="position-fixed top-0 end-0 p-3" style="z-index: 1080">
  <div id="livewireToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white rounded-2 bg-success "></div>
  </div>
</div>

<script>
window.addEventListener('contact-sent', event => {
    const toastEl = document.getElementById('livewireToast');
    toastEl.querySelector('.toast-body').textContent = event.detail.message;
    const toast = new bootstrap.Toast(toastEl);
    toast.show();
});
</script>


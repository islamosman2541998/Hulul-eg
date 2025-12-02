



<div class="contact__form">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        
    @endif
    <h3>@lang('admin.get_in_touch')</h3>
    <form wire:submit.prevent="submit">
        <div>
            <input type="text" wire:model.defer="name" placeholder="@lang('home.full_name')" />
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

        </div>
        <div>
            <input type="email" wire:model.defer="email" placeholder="@lang('home.email')" />
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

        </div>
        <div>
            <input type="number" wire:model.defer="phone" placeholder="@lang('home.phone')" />
            @error('phone')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

        </div>
        <div>
            <textarea wire:model.defer="message" placeholder="@lang('home.your_message')"></textarea>
            @error('message')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="site-btn" wire:loading.attr="disabled">
             <span wire:loading.remove>@lang('home.send')</span>
            <span wire:loading>... @lang('home.sending')</span>
        </button>
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


<div>
    @include('admin.layouts.message')

    <div class="form">
        <form method="POST" wire:submit.prevent="sendForm()">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="" class="col-form-label">@lang('contact_us.name') <span>*</span></label>
                    <input type="text" class="custom-input @error('name') is-invalid @enderror"
                        wire:model="name" id="name" placeholder="{{ trans('contact_us.name') }}">
                </div>
                <div class="col-md-6 form-group">
                    <label for="" class="col-form-label">@lang('contact_us.email') <span>*</span></label>
                    <input type="text" class="custom-input @error('email') is-invalid @enderror" id="email"
                        placeholder="{{ trans('contact_us.email') }}" wire:model="email">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="" class="col-form-label">@lang('contact_us.phone') <span>*</span></label>
                    <input type="text" class="custom-input @error('phone') is-invalid @enderror" id="phone"
                        placeholder="{{ trans('contact_us.phone') }}" wire:model="phone">
                </div>
                <div class="col-md-6 form-group">
                    <label for="" class="col-form-label">@lang('contact_us.company')</label>
                    <input type="text" class="custom-input" name="company" id="company" wire:model="company"
                        placeholder="{{ trans('contact_us.company') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label for="message" class="col-form-label">@lang('contact_us.message') <span>*</span></label>
                    <textarea class="custom-input" wire:model="message" id="message" placeholder="@lang('contact_us.message')"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <button type="submit" class="btn ">@lang('site.send_message')</button>

                </div>
            </div>
        </form>
    </div>
























</div>

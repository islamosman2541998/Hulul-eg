<div class="request-content">
    <a class="home-fab" href="{{ route('site.home') }}" title="{{ __('messages.back_to_home') }}">
        <i class="fa-solid fa-house"></i>
    </a>

    <main class="stage">
        <section class="switcher show-form" id="switcher">

            {{-- LEFT SIDE --}}
            <div class="visual form-visual">

                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($activeForm === 'service')
                    <div class="form-card active-form-card">
                        <div class="form-header">
                            <h2 class="form-title textwhite">{{ __('messages.request_service') }}</h2>
                        </div>

                        <form wire:submit.prevent="submitService" class="slide">
                            <div class="grid">
                                <div>
                                    <label>{{ __('messages.full_name') }} *</label>
                                    <input
                                        class="input @error('name') error @enderror"
                                        type="text"
                                        wire:model="name"
                                        placeholder="{{ __('messages.your_name') }}"
                                    >
                                    @error('name')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.email') }} *</label>
                                    <input
                                        class="input @error('email') error @enderror"
                                        type="email"
                                        wire:model="email"
                                        placeholder="{{ __('messages.email_placeholder') }}"
                                    >
                                    @error('email')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.phone') }}</label>
                                    <input
                                        class="input @error('phone') error @enderror"
                                        type="tel"
                                        wire:model="phone"
                                        placeholder="{{ __('messages.phone_placeholder') }}"
                                    >
                                    @error('phone')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.company') }}</label>
                                    <input
                                        class="input @error('company') error @enderror"
                                        type="text"
                                        wire:model="company"
                                        placeholder="{{ __('messages.company_name') }}"
                                    >
                                    @error('company')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.service') }} *</label>
                                    <select
                                        class="input @error('service_category_id') error @enderror"
                                        wire:model="service_category_id"
                                    >
                                        <option value="">{{ __('messages.select_service') }}</option>

                                        @foreach($serviceCategories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->transNow->title ?? $category->service_unique_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('service_category_id')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.timeline') }}</label>
                                    <select class="input" wire:model="timeline">
                                        <option value="Flexible">{{ __('messages.flexible') }}</option>
                                        <option value="ASAP">{{ __('messages.asap') }}</option>
                                        <option value="2–4 weeks">{{ __('messages.two_four_weeks') }}</option>
                                        <option value="1–3 months">{{ __('messages.one_three_months') }}</option>
                                    </select>
                                </div>

                                <div class="full">
                                    <label>{{ __('messages.project_brief') }}</label>
                                    <textarea
                                        class="input @error('message') error @enderror"
                                        wire:model="message"
                                        placeholder="{{ __('messages.project_brief_placeholder') }}"
                                    ></textarea>

                                    @error('message')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="full">
                                    <label>{{ __('messages.attach_file_optional') }}</label>

                                    <div class="file-upload-wrapper">
                                        <input
                                            type="file"
                                            wire:model="attachment"
                                            id="fileUpload"
                                            style="display: none;"
                                        >

                                        <label for="fileUpload" class="drop" style="cursor: pointer;">
                                            <i class="fa-regular fa-folder-open"></i>

                                            <span wire:loading.remove wire:target="attachment">
                                                {{ __('messages.drag_drop') }}
                                                <u>{{ __('messages.browse') }}</u>
                                            </span>

                                            <span wire:loading wire:target="attachment">
                                                {{ __('messages.uploading') }}
                                            </span>
                                        </label>

                                        @if ($attachment)
                                            <div style="margin-top: 10px; color: var(--accent);">
                                                <i class="fa-solid fa-check-circle"></i>
                                                {{ $attachment->getClientOriginalName() }}
                                            </div>
                                        @endif

                                        @error('attachment')
                                            <span class="error-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="actions">
                                <button class="btn" type="submit" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="submitService">
                                        <i class="fa-solid fa-paper-plane"></i>
                                        {{ __('messages.submit') }}
                                    </span>

                                    <span wire:loading wire:target="submitService">
                                        <i class="fa-solid fa-spinner fa-spin"></i>
                                        {{ __('messages.submitting') }}
                                    </span>
                                </button>

                                <button class="btn btn-ghost" type="button" wire:click="goBack">
                                    <i class="fa-solid fa-arrow-left-long"></i>
                                    {{ __('messages.back') }}
                                </button>
                            </div>
                        </form>
                    </div>

                @elseif ($activeForm === 'meeting')
                    <div class="form-card active-form-card">
                        <div class="form-header">
                            <h2 class="form-title textwhite">{{ __('messages.request_meeting') }}</h2>
                        </div>

                        <form wire:submit.prevent="submitMeeting" class="slide">
                            <div class="grid">
                                <div>
                                    <label>{{ __('messages.full_name') }} *</label>
                                    <input
                                        class="input @error('meeting_name') error @enderror"
                                        type="text"
                                        wire:model="meeting_name"
                                        placeholder="{{ __('messages.your_name') }}"
                                    >
                                    @error('meeting_name')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.email') }} *</label>
                                    <input
                                        class="input @error('meeting_email') error @enderror"
                                        type="email"
                                        wire:model="meeting_email"
                                        placeholder="{{ __('messages.email_placeholder') }}"
                                    >
                                    @error('meeting_email')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.phone') }}</label>
                                    <input
                                        class="input @error('meeting_phone') error @enderror"
                                        type="tel"
                                        wire:model="meeting_phone"
                                        placeholder="{{ __('messages.phone_placeholder') }}"
                                    >
                                    @error('meeting_phone')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.company') }}</label>
                                    <input
                                        class="input @error('meeting_company') error @enderror"
                                        type="text"
                                        wire:model="meeting_company"
                                        placeholder="{{ __('messages.company_name') }}"
                                    >
                                    @error('meeting_company')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.meeting_type') }}</label>
                                    <select class="input" wire:model="meeting_type">
                                        <option value="Online">{{ __('messages.online') }}</option>
                                        <option value="Phone call">{{ __('messages.phone_call') }}</option>
                                        <option value="Office meeting">{{ __('messages.office_meeting') }}</option>
                                    </select>
                                </div>

                                <div>
                                    <label>{{ __('messages.preferred_date') }}</label>
                                    <input
                                        class="input @error('preferred_date') error @enderror"
                                        type="date"
                                        wire:model="preferred_date"
                                    >
                                    @error('preferred_date')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label>{{ __('messages.preferred_time') }}</label>
                                    <input
                                        class="input @error('preferred_time') error @enderror"
                                        type="time"
                                        wire:model="preferred_time"
                                    >
                                    @error('preferred_time')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="full">
                                    <label>{{ __('messages.message') }}</label>
                                    <textarea
                                        class="input @error('meeting_message') error @enderror"
                                        wire:model="meeting_message"
                                        placeholder="{{ __('messages.meeting_message_placeholder') }}"
                                    ></textarea>

                                    @error('meeting_message')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="actions">
                                <button class="btn" type="submit" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="submitMeeting">
                                        <i class="fa-solid fa-calendar-check"></i>
                                        {{ __('messages.submit') }}
                                    </span>

                                    <span wire:loading wire:target="submitMeeting">
                                        <i class="fa-solid fa-spinner fa-spin"></i>
                                        {{ __('messages.submitting') }}
                                    </span>
                                </button>

                                <button class="btn btn-ghost" type="button" wire:click="goBack">
                                    <i class="fa-solid fa-arrow-left-long"></i>
                                    {{ __('messages.back') }}
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            {{-- RIGHT SIDE --}}
            <div class="content">
                <div class="intro">
                    <h1 class="textwhite">{{ __('messages.build_something_great') }}</h1>

                    <p>{{ __('messages.share_project_24h') }}</p>

                    <div class="point">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ __('messages.dedicated_account_manager') }}
                    </div>

                    <div class="point">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ __('messages.clear_timelines_pricing') }}
                    </div>

                    <div class="point">
                        <i class="fa-solid fa-circle-check"></i>
                        {{ __('messages.measurable_results_support') }}
                    </div>

                    <div class="request-buttons">
                        <button
                            class="btn {{ $activeForm === 'service' ? 'active-request-btn' : '' }}"
                            wire:click="showServiceForm"
                            type="button"
                        >
                            <i class="fa-regular fa-pen-to-square"></i>
                            {{ __('messages.request_service') }}
                        </button>

                        <button
                            class="btn {{ $activeForm === 'meeting' ? 'active-request-btn' : '' }}"
                            wire:click="showMeetingForm"
                            type="button"
                        >
                            <i class="fa-regular fa-calendar"></i>
                            {{ __('messages.request_meeting') }}
                        </button>
                    </div>
                </div>
            </div>

        </section>
    </main>
</div>

<style>
    .request-buttons {
        margin-top: 22px;
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }

    .active-request-btn {
        box-shadow: 0 0 0 2px rgba(255,255,255,.25), 0 12px 30px rgba(66, 211, 255, .25);
    }

    .form-visual {
        align-items: flex-start !important;
        justify-content: center !important;
        padding: 35px !important;
        overflow-y: auto;
    }

    .active-form-card {
        width: 100%;
        max-width: 100%;
        background: transparent;
        box-shadow: none;
        border: 0;
        padding: 0;
    }

    .form-visual .form-card {
        width: 100%;
    }

    .form-visual .grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .form-visual .grid .full {
        grid-column: 1 / -1;
    }

    .form-visual label {
        display: block;
        margin-bottom: 7px;
        color: #dce8ff;
        font-size: 14px;
    }

    .form-visual .input {
        width: 100%;
    }

    .form-visual textarea.input {
        min-height: 110px;
        resize: vertical;
    }

    .error-message {
        color: #ff6b6b;
        font-size: 0.85rem;
        margin-top: 5px;
        display: block;
    }

    .input.error {
        border-color: #ff6b6b;
    }

    .alert {
        width: 100%;
        border-radius: 10px;
        padding: 13px 15px;
        margin-bottom: 18px;
        font-size: 14px;
    }

    .alert-success {
        background-color: rgba(40, 167, 69, .14);
        color: #7dff9d;
        border: 1px solid rgba(40, 167, 69, .35);
    }

    .alert-danger {
        background-color: rgba(220, 53, 69, .14);
        color: #ff9aa6;
        border: 1px solid rgba(220, 53, 69, .35);
    }

    @media (max-width: 991px) {
        .form-visual .grid {
            grid-template-columns: 1fr;
        }

        .request-buttons {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
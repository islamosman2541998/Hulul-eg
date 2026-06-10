<div class="request-content">
    <a class="home-fab" href="{{ route('site.home') }}" title="Back to Home">
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
                            <h2 class="form-title textwhite">Request Service</h2>
                        </div>

                        <form wire:submit.prevent="submitService" class="slide">
                            <div class="grid">
                                <div>
                                    <label>Full name *</label>
                                    <input class="input @error('name') error @enderror" type="text" wire:model="name" placeholder="Your name">
                                    @error('name') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Email *</label>
                                    <input class="input @error('email') error @enderror" type="email" wire:model="email" placeholder="you@email.com">
                                    @error('email') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Phone</label>
                                    <input class="input @error('phone') error @enderror" type="tel" wire:model="phone" placeholder="+20 1X XXX XXXX">
                                    @error('phone') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Company</label>
                                    <input class="input @error('company') error @enderror" type="text" wire:model="company" placeholder="Company Name">
                                    @error('company') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Service *</label>
                                    <select class="input @error('service_category_id') error @enderror" wire:model="service_category_id">
                                        <option value="">Select a service</option>
                                        @foreach($serviceCategories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->transNow->title ?? $category->service_unique_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('service_category_id') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Timeline</label>
                                    <select class="input" wire:model="timeline">
                                        <option value="Flexible">Flexible</option>
                                        <option value="ASAP">ASAP</option>
                                        <option value="2–4 weeks">2–4 weeks</option>
                                        <option value="1–3 months">1–3 months</option>
                                    </select>
                                </div>

                                <div class="full">
                                    <label>Project brief</label>
                                    <textarea class="input @error('message') error @enderror" wire:model="message" placeholder="Goals, audience, references, must-haves..."></textarea>
                                    @error('message') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div class="full">
                                    <label>Attach file optional</label>
                                    <div class="file-upload-wrapper">
                                        <input type="file" wire:model="attachment" id="fileUpload" style="display: none;">

                                        <label for="fileUpload" class="drop" style="cursor: pointer;">
                                            <i class="fa-regular fa-folder-open"></i>
                                            <span wire:loading.remove wire:target="attachment">
                                                Drag & drop or <u>browse</u>
                                            </span>
                                            <span wire:loading wire:target="attachment">
                                                Uploading...
                                            </span>
                                        </label>

                                        @if ($attachment)
                                            <div style="margin-top: 10px; color: var(--accent);">
                                                <i class="fa-solid fa-check-circle"></i>
                                                {{ $attachment->getClientOriginalName() }}
                                            </div>
                                        @endif

                                        @error('attachment') <span class="error-message">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="actions">
                                <button class="btn" type="submit" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="submitService">
                                        <i class="fa-solid fa-paper-plane"></i> Submit
                                    </span>
                                    <span wire:loading wire:target="submitService">
                                        <i class="fa-solid fa-spinner fa-spin"></i> Submitting...
                                    </span>
                                </button>

                                <button class="btn btn-ghost" type="button" wire:click="goBack">
                                    <i class="fa-solid fa-arrow-left-long"></i> Back
                                </button>
                            </div>
                        </form>
                    </div>

                @elseif ($activeForm === 'meeting')
                    <div class="form-card active-form-card">
                        <div class="form-header">
                            <h2 class="form-title textwhite">Request Meeting</h2>
                        </div>

                        <form wire:submit.prevent="submitMeeting" class="slide">
                            <div class="grid">
                                <div>
                                    <label>Full name *</label>
                                    <input class="input @error('meeting_name') error @enderror" type="text" wire:model="meeting_name" placeholder="Your name">
                                    @error('meeting_name') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Email *</label>
                                    <input class="input @error('meeting_email') error @enderror" type="email" wire:model="meeting_email" placeholder="you@email.com">
                                    @error('meeting_email') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Phone</label>
                                    <input class="input @error('meeting_phone') error @enderror" type="tel" wire:model="meeting_phone" placeholder="+20 1X XXX XXXX">
                                    @error('meeting_phone') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Company</label>
                                    <input class="input @error('meeting_company') error @enderror" type="text" wire:model="meeting_company" placeholder="Company Name">
                                    @error('meeting_company') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Meeting type</label>
                                    <select class="input" wire:model="meeting_type">
                                        <option value="Online">Online</option>
                                        <option value="Phone call">Phone call</option>
                                        <option value="Office meeting">Office meeting</option>
                                    </select>
                                </div>

                                <div>
                                    <label>Preferred date</label>
                                    <input class="input @error('preferred_date') error @enderror" type="date" wire:model="preferred_date">
                                    @error('preferred_date') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label>Preferred time</label>
                                    <input class="input @error('preferred_time') error @enderror" type="time" wire:model="preferred_time">
                                    @error('preferred_time') <span class="error-message">{{ $message }}</span> @enderror
                                </div>

                                <div class="full">
                                    <label>Message</label>
                                    <textarea class="input @error('meeting_message') error @enderror" wire:model="meeting_message" placeholder="Tell us what you want to discuss..."></textarea>
                                    @error('meeting_message') <span class="error-message">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="actions">
                                <button class="btn" type="submit" wire:loading.attr="disabled">
                                    <span wire:loading.remove wire:target="submitMeeting">
                                        <i class="fa-solid fa-calendar-check"></i> Submit
                                    </span>
                                    <span wire:loading wire:target="submitMeeting">
                                        <i class="fa-solid fa-spinner fa-spin"></i> Submitting...
                                    </span>
                                </button>

                                <button class="btn btn-ghost" type="button" wire:click="goBack">
                                    <i class="fa-solid fa-arrow-left-long"></i> Back
                                </button>
                            </div>
                        </form>
                    </div>

               
                @endif
            </div>

            {{-- RIGHT SIDE --}}
            <div class="content">
                <div class="intro">
                    <h1 class="textwhite">Let's build something great together</h1>
                    <p>Share your project and our team will get back within 24 hours.</p>

                    <div class="point">
                        <i class="fa-solid fa-circle-check"></i> Dedicated account manager
                    </div>

                    <div class="point">
                        <i class="fa-solid fa-circle-check"></i> Clear timelines & transparent pricing
                    </div>

                    <div class="point">
                        <i class="fa-solid fa-circle-check"></i> Measurable results & on-going support
                    </div>

                    <div class="request-buttons">
                        <button class="btn {{ $activeForm === 'service' ? 'active-request-btn' : '' }}" wire:click="showServiceForm" type="button">
                            <i class="fa-regular fa-pen-to-square"></i> Request Service
                        </button>

                        <button class="btn {{ $activeForm === 'meeting' ? 'active-request-btn' : '' }}" wire:click="showMeetingForm" type="button">
                            <i class="fa-regular fa-calendar"></i> Request Meeting
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
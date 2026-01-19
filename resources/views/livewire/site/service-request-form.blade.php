<div class="request-content">
    <a class="home-fab" href="{{ route('site.home') }}" title="Back to Home">
        <i class="fa-solid fa-house"></i>
    </a>

    <main class="stage">
        <!-- switcher: default intro (image left). When .show-form => image right -->
        <section class="switcher {{ $showForm ? 'show-form' : '' }}" id="switcher">
            <!-- VISUAL -->
            <div class="visual">
                <div class="logo-wrap Hulul">HULUL</div>
            </div>

            <!-- CONTENT -->
            <div class="content">
                <!-- Intro (default) -->
                <div class="intro" id="introPane" style="{{ $showForm ? 'display:none' : '' }}">
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
                    <div style="margin-top:22px">
                        <button class="btn" wire:click="startRequest" type="button">
                            <i class="fa-regular fa-pen-to-square"></i> Request Service
                        </button>
                    </div>
                </div>

                <!-- Form (hidden until show-form) -->
                <div class="form-card" id="formPane" style="{{ !$showForm ? 'display:none' : '' }}">
                    <div class="form-header">
                        <h2 class="form-title textwhite">Request Service</h2>
                    </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success" style="margin-bottom: 20px; padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-danger" style="margin-bottom: 20px; padding: 15px; background-color: #f8d7da; color: #721c24; border-radius: 5px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="submit" id="reqForm" class="slide">
                        <div class="grid">
                            <div>
                                <label>Full name *</label>
                                <input 
                                    class="input @error('name') error @enderror" 
                                    type="text" 
                                    wire:model="name"
                                    placeholder="your name"
                                >
                                @error('name')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Email *</label>
                                <input 
                                    class="input @error('email') error @enderror" 
                                    type="email"
                                    wire:model="email"
                                    placeholder="you@email.com"
                                >
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Phone</label>
                                <input 
                                    class="input @error('phone') error @enderror" 
                                    type="tel"
                                    wire:model="phone"
                                    placeholder="+20 1X XXX XXXX"
                                >
                                @error('phone')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Company</label>
                                <input 
                                    class="input @error('company') error @enderror" 
                                    type="text"
                                    wire:model="company"
                                    placeholder="Company Name"
                                >
                                @error('company')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label>Service *</label>
                                <select 
                                    class="input @error('service_category_id') error @enderror"
                                    wire:model="service_category_id"
                                >
                                    <option value="" selected>Select a service</option>
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
                                <textarea 
                                    class="input @error('message') error @enderror"
                                    wire:model="message"
                                    placeholder="Goals, audience, references, must-haves..."
                                ></textarea>
                                @error('message')
                                    <span class="error-message">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="full">
                                <label>Attach file (optional)</label>
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
                                    @error('attachment')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="actions">
                            <button class="btn" type="submit" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="submit">
                                    <i class="fa-solid fa-paper-plane"></i> Submit
                                </span>
                                <span wire:loading wire:target="submit">
                                    <i class="fa-solid fa-spinner fa-spin"></i> Submitting...
                                </span>
                            </button>
                            <button class="btn btn-ghost" type="button" wire:click="goBack">
                                <i class="fa-solid fa-arrow-left-long"></i> Back
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
</div>

<style>
    request-content {
margin-top: 150px !important;
    }
    .error-message {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 5px;
        display: block;
    }

    .input.error {
        border-color: #e74c3c;
    }

    .alert {
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>
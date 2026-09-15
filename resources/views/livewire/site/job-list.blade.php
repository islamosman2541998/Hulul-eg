<div>
    {{-- Filters Section --}}
    <div class="cp-filters">
        <div class="row g-2 align-items-center">
            {{-- Category Filter --}}
            <div class="col-md-4">
                <select wire:model="category" class="form-select cp-input">
                    <option value="">@lang('job.All_Departments')</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">
                            {{ $cat->transNow->title ?? ($cat->title ?? 'N/A') }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Employment Type Filter --}}
            <div class="col-md-4">
                <select wire:model="employmentType" class="form-select cp-input">
                    <option value="">@lang('job.Any_Type')</option>
                    @foreach ($employmentTypes as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Search Input --}}
            <div class="col-md-4">
                <input wire:model.debounce.300ms="search" type="text" class="form-control cp-input"
                    placeholder="@lang('job.Search_by_Title')">
            </div>
        </div>
    </div>

    {{-- Jobs Grid --}}
    <section class="careers-page">
    <div class="container mt-4">
        <div class="row g-3">
            @forelse($jobs as $job)
                <div class="col-lg-4 col-md-6 pt-3">
                    <article class="cp-job">
                        <div class="cp-topline">
                            @if ($job->career_category)
                                <span class="cp-chip">
                                    <i class="fa fa-tag"></i>
                                    {{ $job->career_category->transNow->title ?? '' }}
                                </span>
                            @endif
                            <span class="cp-chip">
                                <i class="fa fa-clock-o"></i>
                                {{ ucfirst($job->employment_type) }}
                            </span>
                            <span class="cp-chip">
                                <i class="fa fa-map-marker"></i>
                                {{ $job->location }}
                            </span>
                        </div>

                        <h3 class="cp-job-title text-white">
                            {{ $job->transNow->title ?? 'N/A' }}
                        </h3>

                        <p class="cp-desc">
                            {!! Str::limit($job->transNow->short_description ?? '', 120) !!}
                        </p>

                        <div class="cp-actions">
                            <div class="d-flex gap-2 mt-3">
                                <button wire:click="showApplyForm({{ $job->id }})" type="button"
                                    class="btn btn-info apply-btn">
                                    <i class="fa fa-paper-plane"></i> @lang('job.apply_now')
                                </button>

                                <button wire:click="showJobDetails({{ $job->id }})" type="button"
                                    class="btn btn-outline-light job-btn jobdetailsbtn">
                                    @lang('job.Job_Details')
                                </button>
                            </div>
                        </div>
                     
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">@lang('job.no_jobs')</h4>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $jobs->links() }}
        </div>

        

        {{-- <p class="cp-foot mt-3">
            @lang('job.For_any_questions_about_careers'),
            <a href="mailto:careers@hululeg.com" class="cp-link">careers@hululeg.com</a>.
        </p> --}}
    </div>

</section>

    {{-- Job Details Modal --}}
    @if ($selectedJob)
        <div class="modal fade" id="jobModal" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content bg-dark text-light" style="border-radius:18px;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white">
                            {{ $selectedJob->transNow->title ?? '' }}
                        </h5>
                        <button type="button" class="close text-light" data-dismiss="modal">
                            <span style="font-size:30px;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-inline small text-muted mb-3">
                            <li class="list-inline-item">
                                <i class="fa fa-map-marker"></i> {{ $selectedJob->location }}
                            </li>
                            <li class="list-inline-item">
                                <i class="fa fa-briefcase"></i> {{ ucfirst($selectedJob->employment_type) }}
                            </li>
                            @if ($selectedJob->career_category)
                                <li class="list-inline-item">
                                    <i class="fa fa-tag"></i>
                                    {{ $selectedJob->career_category->transNow->title ?? '' }}
                                </li>
                            @endif
                        </ul>

                        <h6 class="mb-2 text-white">@lang('job.Description')</h6>
                        <p>{!! $selectedJob->transNow->description ?? '' !!}</p>

                         @if ($selectedJob->transNow->job_desc)
                             <h6 class="mb-2 text-white mt-4">@lang('job.job_desc')</h6>
                             <div>{!! $selectedJob->transNow->job_desc !!}</div>
                         @endif
                         

                        @if ($selectedJob->transNow->requirements)
                            <h6 class="mb-2 text-white mt-4">@lang('job.requirements')</h6>
                            <div>{!! $selectedJob->transNow->requirements !!}</div>
                        @endif

                        <div class="text-right mt-4">
                            <button wire:click="showApplyForm({{ $selectedJob->id }})" class="btn btn-info"
                                data-dismiss="modal">
                                Apply Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Apply Form Modal --}}
    @if ($selectedJob)
        <div class="modal fade" id="applyModal" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content bg-dark text-light" style="border-radius:18px;">
                    <div class="modal-header border-0">
                        <h5 class="modal-title text-white">
                            Apply for {{ $selectedJob->transNow->title ?? '' }}
                        </h5>
                        <button type="button" class="close text-light" data-dismiss="modal">
                            <span style="font-size:30px;">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @livewire('site.job-form', ['jobId' => $selectedJob->id], key('job-form-' . $selectedJob->id))
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- "Application received" popup, opened by the job-application-sent event from JobForm --}}
    <div class="job-success" id="jobSuccessPopup" role="dialog" aria-modal="true"
        aria-labelledby="jobSuccessTitle" aria-describedby="jobSuccessText" hidden wire:ignore>
        <div class="job-success__backdrop" data-close></div>

        <div class="job-success__card" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
            <button type="button" class="job-success__close" data-close aria-label="{{ __('job.close') }}">
                <span aria-hidden="true">&times;</span>
            </button>

            <div class="job-success__icon" aria-hidden="true">
                <svg viewBox="0 0 52 52">
                    <circle class="job-success__circle" cx="26" cy="26" r="24" />
                    <path class="job-success__check" d="M15 27.5l7 7 15-15" />
                </svg>
            </div>

            <h3 class="job-success__title" id="jobSuccessTitle">{{ __('job.application_received_title') }}</h3>

            <p class="job-success__text" id="jobSuccessText"
                data-template="{{ __('job.application_received_text', ['job' => '__JOB__']) }}"
                data-generic="{{ __('job.application_received_text_generic') }}">
                {{ __('job.application_received_text_generic') }}
            </p>

            <p class="job-success__hint">
                <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                <span>{{ __('job.application_received_hint') }}</span>
            </p>

            <button type="button" class="job-success__btn" data-close>{{ __('job.got_it') }}</button>
        </div>
    </div>

    <style>
        .job-success {
            position: fixed;
            inset: 0;
            /* above the fixed header, which is z-index 99999 on mobile/tablet */
            z-index: 100000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
        }

        .job-success[hidden] {
            display: none;
        }

        .job-success__backdrop {
            position: absolute;
            inset: 0;
            background: rgba(5, 0, 18, 0.72);
            -webkit-backdrop-filter: blur(4px);
            backdrop-filter: blur(4px);
            opacity: 0;
            transition: opacity 0.25s ease;
        }

        .job-success__card {
            position: relative;
            width: 100%;
            max-width: 440px;
            max-height: calc(100vh - 32px);
            overflow-y: auto;
            padding: 40px 30px 28px;
            border: 1px solid rgba(0, 191, 231, 0.25);
            border-radius: 22px;
            background: linear-gradient(160deg, #1a0b45 0%, #100028 55%, #0b0320 100%);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.55);
            color: #ffffff;
            text-align: center;
            opacity: 0;
            transform: translateY(16px) scale(0.94);
            transition: opacity 0.3s ease, transform 0.3s cubic-bezier(0.2, 0.9, 0.3, 1.2);
        }

        .job-success.is-open .job-success__backdrop,
        .job-success.is-open .job-success__card {
            opacity: 1;
        }

        .job-success.is-open .job-success__card {
            transform: none;
        }

        .job-success__close {
            position: absolute;
            top: 12px;
            inset-inline-end: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            padding: 0;
            border: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.75);
            font-size: 24px;
            line-height: 1;
            cursor: pointer;
            transition: background 0.2s ease, color 0.2s ease;
        }

        .job-success__close:hover {
            background: rgba(255, 255, 255, 0.16);
            color: #ffffff;
        }

        .job-success__icon {
            width: 88px;
            height: 88px;
            margin: 0 auto 20px;
            border-radius: 50%;
            background: rgba(34, 197, 94, 0.12);
            box-shadow: 0 0 0 10px rgba(34, 197, 94, 0.06), 0 0 40px rgba(34, 197, 94, 0.25);
        }

        .job-success__icon svg {
            width: 100%;
            height: 100%;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .job-success__circle {
            stroke: #22c55e;
            stroke-width: 2.5;
            stroke-dasharray: 151;
            stroke-dashoffset: 151;
        }

        .job-success__check {
            stroke: #22c55e;
            stroke-width: 3.5;
            stroke-dasharray: 34;
            stroke-dashoffset: 34;
        }

        .job-success.is-open .job-success__circle {
            animation: jobSuccessDraw 0.6s ease 0.15s forwards;
        }

        .job-success.is-open .job-success__check {
            animation: jobSuccessDraw 0.4s ease 0.65s forwards;
        }

        @keyframes jobSuccessDraw {
            to {
                stroke-dashoffset: 0;
            }
        }

        .job-success__title {
            margin: 0 0 12px;
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            line-height: 1.35;
        }

        .job-success__text {
            margin: 0 0 16px;
            color: rgba(255, 255, 255, 0.82);
            font-size: 15.5px;
            line-height: 1.8;
            overflow-wrap: break-word;
        }

        .job-success__hint {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 0 0 24px;
            padding: 10px 14px;
            border-radius: 12px;
            background: rgba(0, 191, 231, 0.08);
            color: #7fdcf0;
            font-size: 13.5px;
            line-height: 1.6;
        }

        .job-success__hint i {
            flex-shrink: 0;
            margin: 0 !important;
        }

        .job-success__btn {
            display: block;
            width: 100%;
            min-height: 50px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, #00bfe7 0%, #7c8cfb 100%);
            box-shadow: 0 10px 24px rgba(0, 191, 231, 0.25);
            color: #ffffff;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .job-success__btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(0, 191, 231, 0.35);
        }

        .job-success__btn:focus-visible,
        .job-success__close:focus-visible {
            outline: 3px solid rgba(0, 191, 231, 0.55);
            outline-offset: 2px;
        }

        /* the site forces overflow-y: auto !important on html/body */
        html.job-success-open,
        html.job-success-open body {
            overflow-y: hidden !important;
        }

        @media (max-width: 480px) {
            .job-success__card {
                padding: 34px 20px 22px;
                border-radius: 18px;
            }

            .job-success__icon {
                width: 76px;
                height: 76px;
                margin-bottom: 16px;
            }

            .job-success__title {
                font-size: 21px;
            }

            .job-success__text {
                font-size: 15px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .job-success__card,
            .job-success__backdrop {
                transition: none;
            }

            .job-success__circle,
            .job-success__check {
                animation: none !important;
                stroke-dashoffset: 0;
            }
        }
    </style>
</div>

@push('scripts')
    <script>
        window.addEventListener('open-job-modal', () => {
            $('#jobModal').modal('show');
        });

        window.addEventListener('open-apply-modal', () => {
            $('#jobModal').modal('hide');
            setTimeout(() => {
                $('#applyModal').modal('show');
            }, 300);
        });

        // "Application received" popup
        (function() {
            const popup = document.getElementById('jobSuccessPopup');
            if (!popup) {
                return;
            }

            const text = document.getElementById('jobSuccessText');
            const okButton = popup.querySelector('.job-success__btn');
            let lastFocus = null;

            const open = function(job) {
                text.textContent = job ? text.dataset.template.replace('__JOB__', job) : text.dataset.generic;
                lastFocus = document.activeElement;
                popup.hidden = false;
                document.documentElement.classList.add('job-success-open');
                requestAnimationFrame(() => requestAnimationFrame(() => popup.classList.add('is-open')));
                okButton.focus({
                    preventScroll: true
                });
            };

            const close = function() {
                if (popup.hidden) {
                    return;
                }
                popup.classList.remove('is-open');
                document.documentElement.classList.remove('job-success-open');
                setTimeout(() => {
                    popup.hidden = true;
                }, 300);
                if (lastFocus && document.body.contains(lastFocus)) {
                    lastFocus.focus({
                        preventScroll: true
                    });
                }
            };

            popup.addEventListener('click', function(e) {
                if (e.target.closest('[data-close]')) {
                    close();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    close();
                }
            });

            window.addEventListener('job-application-sent', function(e) {
                const job = e.detail && e.detail.job ? e.detail.job : '';

                // close the apply form first, then show the popup once its fade-out is done
                if (window.jQuery && jQuery('#applyModal').length) {
                    jQuery('#applyModal').modal('hide');
                    setTimeout(() => open(job), 350);
                } else {
                    open(job);
                }
            });
        })();
    </script>
@endpush

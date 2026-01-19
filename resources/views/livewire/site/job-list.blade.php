<div>
    {{-- Filters Section --}}
    <div class="cp-filters">
        <div class="row g-2 align-items-center">
            {{-- Category Filter --}}
            <div class="col-md-4">
                <select wire:model="category" class="form-select cp-input">
                    <option value="">All Departments</option>
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
                    <option value="">Any Type</option>
                    @foreach ($employmentTypes as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Search Input --}}
            <div class="col-md-4">
                <input wire:model.debounce.300ms="search" type="text" class="form-control cp-input"
                    placeholder="Search job title, skills…">
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
                                    <i class="fa fa-paper-plane"></i> Apply Now
                                </button>

                                <button wire:click="showJobDetails({{ $job->id }})" type="button"
                                    class="btn btn-outline-light job-btn jobdetailsbtn">
                                    Job Details
                                </button>
                            </div>
                        </div>
                     
                    </article>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h4 class="text-muted">No jobs found matching your criteria</h4>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $jobs->links() }}
        </div>

        

        <p class="cp-foot mt-3">
            Don't see a match? Send an open application to
            <a href="mailto:careers@hululeg.com" class="cp-link">careers@hululeg.com</a>.
        </p>
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

                        <h6 class="mb-2 text-white">Role Overview</h6>
                        <p>{!! $selectedJob->transNow->description ?? '' !!}</p>

                        @if ($selectedJob->transNow->requirements)
                            <h6 class="mb-2 text-white mt-4">Requirements</h6>
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

        window.addEventListener('close-apply-modal', () => {
            $('#applyModal').modal('hide');
        });
    </script>
@endpush

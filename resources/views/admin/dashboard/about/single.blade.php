@extends('admin.app')

@section('title', __('about.page'))
@section('title_page', __('about.page'))

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.about.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-9">
                    @foreach ($languages as $key => $locale)
                        <div class="accordion mt-3" id="acc{{ $locale }}">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="h{{ $locale }}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#c{{ $locale }}" aria-expanded="true">
                                        {{ trans('lang.' . \Locale::getDisplayName($locale)) }} ({{ strtoupper($locale) }})
                                    </button>
                                </h2>
                                <div id="c{{ $locale }}" class="accordion-collapse collapse show"
                                    aria-labelledby="h{{ $locale }}">
                                    <div class="accordion-body">
                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.title')</label>
                                            <input type="text" name="{{ $locale }}[title]" class="form-control"
                                                value="{{ old($locale . '.title', optional($about->translate($locale))->title) }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.subtitle')</label>
                                            <input type="text" name="{{ $locale }}[subtitle]" class="form-control"
                                                value="{{ old($locale . '.subtitle', optional($about->translate($locale))->subtitle) }}">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.description')</label>
                                            <textarea name="{{ $locale }}[description]" class="form-control" rows="5">{{ old($locale . '.description', optional($about->translate($locale))->description) }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.sub_description')</label>
                                            <textarea name="{{ $locale }}[sub_description]" class="form-control" rows="3">{{ old($locale . '.sub_description', optional($about->translate($locale))->sub_description) }}</textarea>
                                        </div>

                                        <hr>
                                        <h2 class="my-3">@lang('about.our_story')</h2>
                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.our_story_title')</label>
                                            <input type="text" name="{{ $locale }}[our_story_title]"
                                                class="form-control"
                                                value="{{ old($locale . '.our_story_title', optional($about->translate($locale))->our_story_title) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.our_story_description')</label>
                                            <textarea name="{{ $locale }}[our_story_description]" class="form-control" rows="3">{{ old($locale . '.our_story_description', optional($about->translate($locale))->our_story_description) }}</textarea>
                                        </div>

                                        <hr>
                                        <h2 class="my-3">@lang('about.ceo_message')</h2>
                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.ceo_title')</label>
                                            <input type="text" name="{{ $locale }}[ceo_title]"
                                                class="form-control"
                                                value="{{ old($locale . '.ceo_title', optional($about->translate($locale))->ceo_title) }}">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.ceo_description')</label>
                                            <textarea name="{{ $locale }}[ceo_description]" class="form-control" rows="4">{{ old($locale . '.ceo_description', optional($about->translate($locale))->ceo_description) }}</textarea>
                                        </div>

                                        <hr>
                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.vision')</label>
                                            <textarea name="{{ $locale }}[vision]" class="form-control" rows="2">{{ old($locale . '.vision', optional($about->translate($locale))->vision) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.mission')</label>
                                            <textarea name="{{ $locale }}[mission]" class="form-control" rows="2">{{ old($locale . '.mission', optional($about->translate($locale))->mission) }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">@lang('about.at_a_glance')</label>
                                            <textarea name="{{ $locale }}[at_a_glance]" class="form-control" rows="2">{{ old($locale . '.at_a_glance', optional($about->translate($locale))->at_a_glance) }}</textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label>@lang('about.core_values') ({{ strtoupper($locale) }})</label>

                                            <div id="core-values-{{ $locale }}">
                                                @php
                                                    $existing = old(
                                                        $locale . '.core_values',
                                                        $about->translate($locale)->core_values ?? [],
                                                    );
                                                @endphp

                                                @foreach ($existing as $i => $cv)
                                                    <div class="core-value-item mb-2">
                                                        <input type="text"
                                                            name="{{ $locale }}[core_values][{{ $i }}][title]"
                                                            value="{{ $cv['title'] ?? '' }}" placeholder="Title"
                                                            class="form-control mb-1">
                                                        <textarea name="{{ $locale }}[core_values][{{ $i }}][description]" class="form-control"
                                                            placeholder="Description">{{ $cv['description'] ?? '' }}</textarea>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-core">@lang('about.remove')</button>
                                                    </div>
                                                @endforeach


                                                @if (empty($existing))
                                                    <div class="core-value-item mb-2">
                                                        <input type="text"
                                                            name="{{ $locale }}[core_values][0][title]"
                                                            placeholder="Title" class="form-control mb-1">
                                                        <textarea name="{{ $locale }}[core_values][0][description]" class="form-control" placeholder="Description"></textarea>
                                                        <button type="button"
                                                            class="btn btn-sm btn-danger remove-core">@lang('about.remove')</button>
                                                    </div>
                                                @endif
                                            </div>

                                            <button type="button" class="btn btn-sm btn-primary mt-2 add-core"
                                                data-locale="{{ $locale }}">@lang('about.add_core_value')</button>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-3">
                    <div class="card p-3">
                        <h5>@lang('admin.settings')</h5>

                        <div class="mb-3">
                            <label class="form-label">@lang('about.ceo_image')</label>
                            @if ($about->ceo_image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $about->ceo_image) }}"
                                        style="width:100%; max-height:150px; object-fit:cover;">
                                </div>
                            @endif
                            <span class="text-danger">@lang('admin.image_site', ['width' => '300px', 'height' => '300px'])</span>

                            <input type="file" name="ceo_image" class="form-control" accept="ceo_image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@lang('about.image')</label>
                            @if ($about->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $about->image) }}"
                                        style="width:100%; max-height:150px; object-fit:cover;">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">@lang('about.image_background')</label>
                            @if ($about->image_background)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $about->image_background) }}"
                                        style="width:100%; max-height:120px; object-fit:cover;">
                                </div>
                            @endif
                            <input type="file" name="image_background" class="form-control" accept="image/*">
                        </div>
                        {{-- 
                    <div class="mb-3">
                        <label class="form-label">@lang('about.sort')</label>
                        <input type="number" name="sort" class="form-control" value="{{ old('sort', $about->sort) }}">
                    </div> --}}
                        {{-- 
                    <div class="mb-3 form-check form-switch">
                        <input type="checkbox" class="form-check-input" name="status" id="about_status" value="1" {{ $about->status ? 'checked' : '' }}>
                        <label for="about_status" class="form-check-label">@lang('admin.status')</label>
                    </div> --}}



                        {{-- <div class="d-grid">
                            <button type="submit" class="btn btn-success">@lang('button.save')</button>
                        </div> --}}


                    </div>
                </div>
                <div class="row mb-3 text-end">
                    <div>
                        {{-- <a href="{{ route('admin') }}"
                            class="btn btn-primary waves-effect waves-light ml-3 btn-sm">@lang('button.cancel')</a> --}}
                        <button type="submit"
                            class="btn btn-outline-success waves-effect waves-light ml-3 btn-sm">@lang('button.save')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
<script>
    document.addEventListener('click', function(e) {
        if (e.target.matches('.add-core')) {
            const locale = e.target.dataset.locale;
            const container = document.getElementById('core-values-' + locale);
            const index = container.querySelectorAll('.core-value-item').length;
            const tpl = document.createElement('div');
            tpl.className = 'core-value-item mb-2';
            tpl.innerHTML = `
            <input type="text" name="${locale}[core_values][${index}][title]" placeholder="Title" class="form-control mb-1">
            <textarea name="${locale}[core_values][${index}][description]" class="form-control" placeholder="Description"></textarea>
            <button type="button" class="btn btn-sm btn-danger remove-core">Remove</button>
        `;
            container.appendChild(tpl);
        }

        if (e.target.matches('.remove-core')) {
            e.target.closest('.core-value-item').remove();

        }
    });
</script>

@extends('admin.app')

@section('title', trans('admin.meetingRequests'))
@section('title_page', trans('admin.meetingRequests'))

@section('content')
    @php
        // the stored values are English; show them in the dashboard language
        $meetingTypes = [
            'Online' => trans('messages.online'),
            'Phone call' => trans('messages.phone_call'),
            'Office meeting' => trans('messages.office_meeting'),
        ];
    @endphp
    <div class="container-fluid">
        <div class="card">
            <div class="card-body search-group">
                <form action="{{ route('admin.meeting_request.index') }}" method="get">
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <input type="text"
                                   value="{{ request('name') }}"
                                   name="name"
                                   placeholder="{{ trans('admin.name') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-2">
                            <input type="text"
                                   value="{{ request('email') }}"
                                   name="email"
                                   placeholder="{{ trans('admin.email') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-2">
                            <input type="text"
                                   value="{{ request('phone') }}"
                                   name="phone"
                                   placeholder="{{ trans('admin.phone') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-2">
                            <input type="text"
                                   value="{{ request('company') }}"
                                   name="company"
                                   placeholder="{{ trans('admin.company') }}"
                                   class="form-control">
                        </div>

                        <div class="col-md-3 mb-2">
                            <select name="meeting_type" class="form-control">
                                <option value="">@lang('admin.meeting_type')</option>
                                @foreach ($meetingTypes as $value => $label)
                                    <option value="{{ $value }}" {{ request('meeting_type') == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3 mb-2">
                            <input type="date"
                                   value="{{ request('preferred_date') }}"
                                   name="preferred_date"
                                   class="form-control">
                        </div>

                        <div class="search-input col-md-2">
                            <button class="btn btn-primary btn-sm" type="submit" title="{{ trans('button.search') }}">
                                <i class="fas fa-search"></i>
                            </button>

                            <a class="btn btn-warning btn-sm"
                               href="{{ route('admin.meeting_request.index') }}"
                               title="{{ trans('button.reset') }}">
                                <i class="refresh ion ion-md-refresh"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($meeting_requests->count())
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('admin.name')</th>
                                    <th>@lang('admin.email')</th>
                                    <th>@lang('admin.phone')</th>
                                    <th>@lang('admin.company')</th>
                                    <th>@lang('admin.meeting_type')</th>
                                    <th>@lang('admin.preferred_date')</th>
                                    <th>@lang('admin.preferred_time')</th>
                                    <th>@lang('admin.message')</th>
                                    <th>@lang('admin.status')</th>
                                    <th class="text-center">@lang('admin.actions')</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($meeting_requests as $meeting_request)
                                    <tr>
                                        <td>{{ $meeting_request->id }}</td>
                                        <td>{{ $meeting_request->name }}</td>
                                        <td>{{ $meeting_request->email }}</td>
                                        <td>{{ $meeting_request->phone ?? '—' }}</td>
                                        <td>{{ $meeting_request->company ?? '—' }}</td>
                                        <td>{{ $meetingTypes[$meeting_request->meeting_type] ?? ($meeting_request->meeting_type ?? '—') }}</td>
                                        <td>{{ $meeting_request->preferred_date ?? '—' }}</td>
                                        <td>{{ $meeting_request->preferred_time ?? '—' }}</td>

                                        <td class="message-cell">
                                            @if (filled($meeting_request->message))
                                                <button type="button" class="js-message-preview"
                                                    data-message="{{ $meeting_request->message }}"
                                                    data-sender="{{ $meeting_request->name }}"
                                                    title="@lang('admin.full_message')">
                                                    {{ Str::limit($meeting_request->message, 40) }}
                                                </button>
                                            @else
                                                —
                                            @endif
                                        </td>

                                        <td>
                                            @php $status = $meeting_request->status ?: 'new'; @endphp
                                            <span class="badge bg-info">
                                                {{ trans()->has('admin.status_' . $status) ? trans('admin.status_' . $status) : $status }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <form action="{{ route('admin.meeting_request.destroy', $meeting_request->id) }}"
                                                  method="POST"
                                                  style="display:inline"
                                                  onsubmit="return confirm('{{ trans('admin.are_you_sure') }}');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-danger btn-sm"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="{{ trans('admin.delete') }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-3">
                        {{ $meeting_requests->links() }}
                    </div>
                @else
                    <div class="alert alert-info">@lang('admin.no_data')</div>
                @endif
            </div>
        </div>
    </div>

    @include('admin.dashboard.partials.message-modal')
@endsection
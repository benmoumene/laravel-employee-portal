@extends('layouts.app')

@section('content')

<div class="container" id="employee_container">
    <div class="row">
        <div class="col-md-12">
            <br>
            @include('hr.employees.menu')
            <br>
        </div>
        <div class="col-md-12">
            @include('status', ['errors' => $errors->all()])
        </div>
        <div class="col-md-12 mb-3">
            <div class="row d-flex align-items-center">
                <div class="col-md-3">
                    <h3 class="mb-0">{{ $employee->name }}</h3>
                </div>
                <div class="col-md-9 d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Timeline</h4>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newTimelineEventModal">Add event</button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    @include('hr.employees.sidebar')
                </div>
                <div class="col-md-9">
                    @if(sizeof($employee->timelineEvents))
                        @foreach($timelineEventsByDate as $date => $timelineEvents)
                            <div class="mb-3">
                                <div class="font-italic text-secondary mb-1 text-center position-relative flex-center">
                                   <hr class="my-0 w-100 position-absolute">
                                    <span class="position-relative bg-light px-2">{{ \Carbon\Carbon::parse($date)->format(config('constants.full_display_date_format')) }}</span>
                                </div>
                                @foreach($timelineEvents as $timelineEvent)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card mb-3 shadow-sm border-0 rounded-0">
                                                <div class="card-body">
                                                    <h4>{{ $timelineEvent->name }}</h4>
                                                    <p class="text-secondary">{{ $timelineEvent->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    @else
                        <p class="text-secondary font-italic">No timeline for user yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- New event modal -->
<div class="modal fade" id="newTimelineEventModal" tabindex="-1" role="dialog" aria-labelledby="newTimelineEventModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{ route('employees.timeline-event.store', $employee) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="newTimelineEventModalTitle">Add new event for {{ $employee->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="field-required">Event name</label>
                        <input type="text" class="form-control" placeholder="Event name" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="field-required">Event description</label>
                        <textarea name="description" id="description" rows="4" placeholder="Event description" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="document">Document</label>
                        <div><input type="file" name="document"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add event</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

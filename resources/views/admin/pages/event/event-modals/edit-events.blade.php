<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEvent" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- If you're using PUT to update -->

                    <!-- Success and Error Messages -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="row">
                        <!-- Event Name -->
                        <div class="form-group col-md-6">
                            <label for="eventName" class="form-label">Event Name</label>
                            <input type="text" id="eventName" name="event_name" class="form-control" value="{{ old('event_name', $event->event_name) }}">
                            @error('event_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Place -->
                        <div class="form-group col-md-6 mb-3">
                            <label for="eventPlace" class="form-label">Event Venue</label>
                            <input type="text" id="eventPlace" name="event_venue" class="form-control" value="{{ old('event_venue', $event->event_venue) }}">
                            @error('event_venue')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Type -->
                        <div class="form-group col-md-6 mb-3">
                            <label for="eventType" class="form-label">Event Type</label>
                            <select id="eventType" name="event_type" class="form-select" required>
                                <option value="" disabled selected>Select an Event Type</option>
                                <option value="1" {{ old('event_type', $event->event_type) == 1 ? 'selected' : '' }}>Wholeday</option>
                                <option value="2" {{ old('event_type', $event->event_type) == 2 ? 'selected' : '' }}>Half-Day Morning</option>
                                <option value="3" {{ old('event_type', $event->event_type) == 3 ? 'selected' : '' }}>Half-Day Afternoon</option>
                            </select>
                            @error('event_type')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="dateofEvent" class="form-label">Event Date</label>
                            <div class="input-group">
                                <!-- Hidden fields for start and end date -->
                                <input type="hidden" id="event_start_date" name="event_start_date" class="form-control" value="{{ old('event_start_date', $event->event_start_date) }}">
                                <input type="hidden" id="event_end_date" name="event_end_date" class="form-control" value="{{ old('event_end_date', $event->event_end_date) }}">

                                <!-- Date Range Picker Input -->
                                <input id="daterange" name="daterange" class="form-control" value="{{ old('daterange', $event->event_start_date . ' - ' . $event->event_end_date) }}">
                            </div>
                            @error('event_start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            @error('event_end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Time Schedule (Morning / Afternoon) -->
                    <div class="container mb-4">
                        <div class="row">
                            <!-- Morning Schedule -->
                            <div class="col-md-6 schedule-section" id="morningSchedule" style="display:none;">
                                <div class="div-title">Morning Schedule</div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Start Time</label>
                                        <input type="time" name="event_starttime_am" class="form-control" value="{{ old('event_starttime_am', $event->event_starttime_am) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">End Time</label>
                                        <input type="time" name="event_endtime_am" class="form-control" value="{{ old('event_endtime_am', $event->event_endtime_am) }}">
                                    </div>
                                </div>
                            </div>

                            <!-- Afternoon Schedule -->
                            <div class="col-md-6 schedule-section" id="afternoonSchedule" style="display:none;">
                                <div class="div-title">Afternoon Schedule</div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Start Time</label>
                                        <input type="time" name="event_starttime_pm" class="form-control" value="{{ old('event_starttime_pm', $event->event_starttime_pm) }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">End Time</label>
                                        <input type="time" name="event_endtime_pm" class="form-control" value="{{ old('event_endtime_pm', $event->event_endtime_pm) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



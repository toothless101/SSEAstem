@foreach ($events as $event)
<div class="modal fade" id="editEventModal{{$event->id}}" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEvent" action="" method="" enctype="multipart/form-data">
                    @csrf

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
                            <label for="eventName{{$event->id}}" class="form-label">Event Name</label>
                            <input type="text" id="eventName{{$event->id}}" name="event_name" class="form-control" value="{{$event->event_name}}">
                            
                            @error('event_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Place -->
                        <div class="form-group col-md-6 mb-3">
                            <label for="event_venue{{$event->id}}" class="form-label">Event Venue</label>
                            <input type="text" id="event_venue{{$event->id}}" name="event_venue" class="form-control" value="{{$event->event_venue}}">
                           
                            @error('event_venue')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Type -->
                        <div class="form-group col-md-6 mb-3">
                        <label for="eventType{{$event->id}}" class="form-label">Event Type</label>
                           <select id="eventType{{$event->id}}" name="event_type" class="form-select" required>
                                <option value="" disabled selected>Select an Event Type</option>
                                <option value="1" {{$event->event_type == 1 ? 'selected' : ''}}>Wholeday</option>
                                <option value="2" {{$event->event_type == 2 ? 'selected' : ''}}>Half-Day Morning</option>
                                <option value="3" {{$event->event_type == 3 ? 'selected' : ''}}>Half-Day Afternoon</option>
                            </select>
                        
                            @error('event_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="dateofEvent{{$event->id}}" class="form-label" id="eventDate">Event Date</label>
                            <div class="input-group">
                                <!-- Hidden fields for start and end date -->
                                <input type="hidden" id="event_start_date{{$event->id}}" name="event_start_date" class="form-control" value="{{ $event->event_start_date}}">
                                <input type="hidden" id="event_end_date{{$event->id}}" name="event_end_date" class="form-control" value="{{ $event->event_end_date}}">

                                <!-- Date Range Picker Input -->
                                <input id="daterange{{$event->id}}" name="daterange" class="form-control" value="{{$event->startDate}} - {{$event->endDate}}">
                            </div>
                            
                            @error('event_start_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror

                            @error('event_end_date')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Time Schedule -->
                    <div class="container mb-4">
                        <div class="row">
                            <!-- Morning Schedule -->
                            <div class="col-md-6 schedule-section" id="morningSchedule{{ $event->id }}" style="display:none;">
                                <div class="div-title">Morning Schedule</div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label" for="event_starttime_am{{ $event->id }}">Start Time</label>
                                        <input type="time" name="event_starttime_am" class="form-control" value="{{ $event->event_starttime_am ? \Carbon\Carbon::parse($event->event_starttime_am)->format('H:i') : '' }}">                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="event_endtime_am{{$event->id}}">End Time</label>
                                        <input type="time" name="event_endtime_am" class="form-control" value="{{$event->event_endtime_am ? \Carbon\Carbon::parse($event->event_endtime_am)->format('H:i') : ''}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Attendance Time In</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning_in_start{{ $event->id }}" name="morning_in_start" class="form-control" value="{{$event->morning_in_start ? \Carbon\Carbon::parse($event->morning_in_start)->format('H:i') : ''}}">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning_in_end{{ $event->id }}" name="morning_in_end" class="form-control" value="{{$event->morning_in_end ? \Carbon\Carbon::parse($event->morning_in_end)->format('H:i') : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Attendance Time Out</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning_out_start{{ $event->id }}" name="morning_out_start" class="form-control" value="{{$event->morning_out_start ? \Carbon\Carbon::parse($event->morning_out_start)->format('H:i') : ''}}">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning_out_end{{ $event->id }}" name="morning_out_end" class="form-control" value="{{$event->morning_out_end ? \Carbon\Carbon::parse($event->morning_out_end)->format('H:i') : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Afternoon Schedule -->
                            <div class="col-md-6 schedule-section" id="afternoonSchedule{{ $event->id }}" style="display:none;">
                                <div class="div-title">Afternoon Schedule</div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Start Time</label>
                                        <input type="time" id="event_starttime_pm{{$event->id}}" name="event_starttime_pm" class="form-control" value="{{$event->event_starttime_pm ? \Carbon\Carbon::parse($event->event_starttime_pm)->format('H:i') : ''}}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">End Time</label>
                                        <input type="time" id="event_endtime_pm{{$event->id}}" name="event_endtime_pm" class="form-control" value="{{$event->event_endtime_pm ? \Carbon\Carbon::parse($event->event_endtime_pm)->format('H:i') : ''}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Attendance Time In</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon_in_start{{ $event->id }}" name="afternoon_in_start" class="form-control" value="{{$event->afternoon_in_start ? \Carbon\Carbon::parse($event->afternoon_in_start)->format('H:i') : ''}}">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon_out_end{{ $event->id }}" name="afternoon_in_end" class="form-control" value="{{$event->afternoon_in_end ? \Carbon\Carbon::parse($event->afternoon_in_end)->format('H:i') : ''}}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Attendance Time Out</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon_out_start{{ $event->id }}" name="afternoon_out_start" class="form-control" value="{{$event->afternoon_out_start ? \Carbon\Carbon::parse($event->afternoon_out_start)->format('H:i') : ''}}">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon_out_end{{ $event->id }}" name="afternoon_out_end" class="form-control" value="{{$event->afternoon_out_end ? \Carbon\Carbon::parse($event->afternoon_out_end)->format('H:i') : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="assignedOfficersList" class="mt-3">
                        <h6>Assigned Officers:</h6>
                        <ul id="officerNameList">
                            @foreach ($event->users()->wherePivot('assignment_type', '!=', 'unassigned')->get() as $officer)
                                <li id="officer{{$officer->id}}">
                                    {{ $officer->firstname }} {{ $officer->lastname }} - {{ $officer->pivot->assignment_type }}
                                    {{-- <button type="button" class="btn-close" aria-label="Close" onclick="removeOfficer({{ $officer->id }})"></button> --}}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Hidden input to send assigned officer IDs -->
                    <input type="hidden" id="assigned_officers" name="assigned_officers">

                    <!-- Assign Officer Button -->
                    <div class="assign_event_officer mb-5 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" id="assignOfficerBtn" data-bs-toggle="modal" data-bs-target="#assignOfficerModal">Edit Officer</button>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit">Update Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="successUpdateEventModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 500px;">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <div class="mb-3">
                    <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-uppercase text-success">Success</h3>
                <p class="mt-2">Event Updated Successfully</p>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
  </div>
  
  {{-- Error Modal --}}
  <div class="modal fade" id="errorUpdateEventModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="width: 500px;">
          <div class="modal-content text-center p-4">
              <div class="modal-body">
                  <div class="mb-3">
                      <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                          <i class="bi bi-x-circle-fill"></i>
                      </div>
                  </div>
                  <h3 class="fw-bold text-uppercase text-success">Error!</h3>
                  <p class="mt-2">Error Updating Event {{session('error')}}</p>
                  <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
              </div>
          </div>
      </div>
    </div>


<script>

    $(document).ready(function() {
    // Initialize Date Range Picker for each event modal
    @foreach ($events as $event)
        $('#daterange{{$event->id}}').daterangepicker({
            startDate: moment('{{$event->event_start_date}}'),
            endDate: moment('{{$event->event_end_date}}'),
            locale: { format: 'YYYY-MM-DD' }
        }, function(start, end) {
            $('#event_start_date{{$event->id}}').val(start.format('YYYY-MM-DD'));
            $('#event_end_date{{$event->id}}').val(end.format('YYYY-MM-DD'));
        });
    @endforeach

    // Event Listener for Dynamic Modals
    $(document).on('shown.bs.modal', function (e) {
        var modal = $(e.target);
        var eventId = modal.attr('id').replace('editEventModal', '');

        // Check and initialize daterangepicker if needed
        if (!$('#daterange' + eventId).data('daterangepicker')) {
            $('#daterange' + eventId).daterangepicker({
                locale: { format: 'YYYY-MM-DD' }
            }, function(start, end) {
                $('#event_start_date' + eventId).val(start.format('YYYY-MM-DD'));
                $('#event_end_date' + eventId).val(end.format('YYYY-MM-DD'));
            });
        }

        // Toggle Schedule Based on Event Type
        $('#eventType' + eventId).change(function () {
            var eventType = $(this).val();
            if (eventType == 1) {
                $('#morningSchedule' + eventId).show();
                $('#afternoonSchedule' + eventId).show();
            } else if (eventType == 2) {
                $('#morningSchedule' + eventId).show();
                $('#afternoonSchedule' + eventId).hide();
            } else if (eventType == 3) {
                $('#morningSchedule' + eventId).hide();
                $('#afternoonSchedule' + eventId).show();
            }else{
                $('#morningSchedule' + eventId + ', #afternoonSchedule' + eventId).hide();
            }
        }).trigger('change');
    });
});


    //SUCCESS/ERROR MODALS
    @if(session('success_add_event'))
        document.addEventListener('DOMContentLoaded', function () {
            const successModal = new bootstrap.Modal(document.getElementById('successAddEventModal'));
            successModal.show();
        });
    @endif

    @if (session('error_add_event'))
        document.addEventListener('DOMContentLoaded', function () {
            const errorModal = new bootstrap.Modal(document.getElementById('errorAddEventModal'));
            errorModal.show();
        });
    @endif
</script>
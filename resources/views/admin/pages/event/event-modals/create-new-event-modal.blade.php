<script src="{{asset("js/create-event.js")}}"></script>

<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/admin/pages/event.css') }}">


<div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Create New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="addEvent" action="{{route('create_event') }}" method="POST" enctype="multipart/form-data">
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
                            <label for="eventName" class="form-label">Event Name</label>
                            <input type="text" id="eventName" name="event_name" class="form-control" value="{{old('event_name')}}">
                            
                            @error('event_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Event Place -->
                        <div class="form-group col-md-6 mb-3">
                            <label for="eventPlace" class="form-label">Event Venue</label>
                            <input type="text" id="eventPlace" name="event_venue" class="form-control" value="{{old('event_venue')}}">
                           
                            @error('event_venue')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Event Type -->
                        <div class="form-group col-md-6 mb-3">
                        <label for="eventType" class="form-label">Event Type</label>
                           <select id="eventType" name="event_type" class="form-select" required>
                                <option value="" disabled selected>Select an Event Type</option>
                                <option value="1" {{old('event_type') == 1 ? 'selected' : ''}}>Wholeday</option>
                                <option value="2" {{old('event_type') == 2 ? 'selected' : ''}}>Half-Day Morning</option>
                                <option value="3" {{old('event_type') == 3 ? 'selected' : ''}}>Half-Day Afternoon</option>
                            </select>
                        
                            @error('event_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="dateofEvent" class="form-label" id="eventDate">Event Date</label>
                            <div class="input-group">
                                <!-- Hidden fields for start and end date -->
                                <input type="hidden" id="event_start_date" name="event_start_date" class="form-control" value="{{ old('event_start_date') }}">
                                <input type="hidden" id="event_end_date" name="event_end_date" class="form-control" value="{{ old('event_end_date') }}">

                                <!-- Date Range Picker Input -->
                                <input id="daterange" name="daterange" class="form-control" value="{{ old('daterange') }}">
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
                            <div class="col-md-6 schedule-section" id="morningSchedule" style="display:none;">
                                <div class="div-title">Morning Schedule</div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Start Time</label>
                                        <input type="time" name="event_starttime_am" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">End Time</label>
                                        <input type="time" name="event_endtime_am" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Attendance Time In</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning-checkin" name="morning_in_start" class="form-control" value="">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning-checkin-end" name="morning_in_end" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Attendance Time Out</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning-checkout" name="morning_out_start" class="form-control" value="">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning-checkout-end" name="morning_out_end" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Afternoon Schedule -->
                            <div class="col-md-6 schedule-section" id="afternoonSchedule" style="display:none;">
                                <div class="div-title">Afternoon Schedule</div>
                                <div class="row mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Start Time</label>
                                        <input type="time" name="event_starttime_pm" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">End Time</label>
                                        <input type="time" name="event_endtime_pm" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Attendance Time In </h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon-checkin-start" name="afternoon_in_start" class="form-control" value="">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon-checkin-end" name="afternoon_in_end" class="form-control" value="">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Attendance Time Out</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon-checkout-start" name="afternoon_out_start" class="form-control" value="">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon-checkout-end" name="afternoon_out_end" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit">Create Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="successAddEventModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <div class="mb-3">
                    <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-uppercase text-success">Success</h3>
                <p class="mt-2">Event Created Successfully</p>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
  </div>
  
  {{-- Error Modal --}}
  <div class="modal fade" id="errorAddEventModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content text-center p-4">
              <div class="modal-body">
                  <div class="mb-3">
                      <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                          <i class="bi bi-x-circle-fill"></i>
                      </div>
                  </div>
                  <h3 class="fw-bold text-uppercase text-success">Error!</h3>
                  <p class="mt-2">Error Creting Event {{session('error')}}</p>
                  <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
              </div>
          </div>
      </div>
    </div>

@include('admin.pages.event.event-modals.assign-event-officer')

<script>
  
    $(document).ready(function() {
        // Initialize the date range picker
        $('#daterange').daterangepicker({
        startDate: moment().startOf('day'),  // Default start date
        endDate: moment().endOf('day'),      // Default end date
        locale: {
            format: 'YYYY-MM-DD'  // Date format
        }
    }, function(start, end, label) {
        // Update the hidden fields with the selected start and end dates
        $('#event_start_date').val(start.format('YYYY-MM-DD'));  // Set start date
        $('#event_end_date').val(end.format('YYYY-MM-DD'));      // Set end date

        // Update the daterange input field to reflect the selected range
        if (start.isSame(end)) {
            // If it's the same day, only one date is selected
            $('#daterange').val(start.format('YYYY-MM-DD'));  // Single date selected
        } else {
            // If it's a range, show the range
            $('#daterange').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));  // Date range
        }
        });
    });


    @if(session('success_add_event'))
        document.addEventListener('DOMContentLoaded', function () {
            const successModal = new bootstrap.Modal(document.getElementById('successAddEventModal'));
            const assignOfficer = new bootstrap.Modal(document.getElementById('assignOfficerModal'));
            successModal.show();
            
            document.getElementById('successAddEventModal').addEventListener('hidden.bs.modal', function(){
                assignOfficer.show();
            });
        });
    @endif

    @if (session('error_add_event'))

        document.addEventListener('DOMContentLoaded', function () {
            const errorModal = new bootstrap.Modal(document.getElementById('errorAddEventModal'));
            errorModal.show();
        });
    @endif


</script>
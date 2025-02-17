
<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Create New Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEvent" action="" method="POST" enctype="multipart/form-data">
                    <div class="row">
                        <!-- Event Name -->
                        <div class="form-group col-md-6">
                            <label for="eventName" class="form-label">Event Name</label>
                            <input type="text" id="eventName" name="event_name" class="form-control" value="">
                            @error('event_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Event Place -->
                        <div class="form-group col-md-6 mb-3">
                            <label for="eventPlace" class="form-label">Event Venue</label>
                            <input type="text" id="eventPlace" name="event_venue" class="form-control" value="">
                            @error('event_venue')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <!-- Event Type -->
                        <div class="form-group col-md-6 mb-3">
                        <label for="eventType" class="form-label">Event Type</label>
                           <select id="eventType" name="event_type" class="form-select" required>
                                <option value="" disabled selected>Select an Event Type</option>
                                <option value="1">Wholeday</option>
                                <option value="2">Half-Day Morning</option>
                                <option value="3">Half-Day Afternoon</option>
                            </select>
                            @error('event_type')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="dateofEvent" class="form-label" id="eventDate">Event Date</label>
                            <div class="input-group">
                                <!-- Hidden fields for start and end date -->
                                <input type="hidden" id="event_start_date" name="event_start_date" class="form-control" value="">
                                <input type="hidden" id="event_end_date" name="event_end_date" class="form-control" value="">
                                <!-- Date Range Picker Input -->
                                <input id="daterange" name="daterange" class="form-control" value="">
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
                        <button type="submit" class="btn btn-submit">Update Event</button>
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
                <p class="mt-2">Event Updated Successfully</p>
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
                  <p class="mt-2">Error Updating Event {{session('error')}}</p>
                  <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
              </div>
          </div>
      </div>
    </div>


<script>
  
  document.addEventListener('DOMContentLoaded', function () {
    // Get references to the DOM elements
    const eventType = document.getElementById("eventType");
    const morningSchedule = document.getElementById("morningSchedule");
    const afternoonSchedule = document.getElementById("afternoonSchedule");

    // Function to update the layout based on selected event type
    function updateLayout() {
        const selectedType = parseInt(eventType.value, 10); // Get the selected value as an integer

        // Handle the different schedule types
        switch (selectedType) {
            case 1: // Whole day
                morningSchedule.style.display = 'block'; // Show morning schedule
                afternoonSchedule.style.display = 'block'; // Show afternoon schedule
                break;
            case 2: // Half-Day Morning
                morningSchedule.style.display = 'block'; // Show morning schedule
                afternoonSchedule.style.display = 'none'; // Hide afternoon schedule
                break;
            case 3: // Half-Day Afternoon
                morningSchedule.style.display = 'none'; // Hide morning schedule
                afternoonSchedule.style.display = 'block'; // Show afternoon schedule
                break;
            default: // None selected
                morningSchedule.style.display = 'none';
                afternoonSchedule.style.display = 'none';
                break;
        }
    }

    // Attach event listener to the dropdown to call updateLayout on change
    eventType.addEventListener('change', updateLayout);

    // Initialize layout when the page loads
    updateLayout();
});

    $(document).ready(function() {
        $('#daterange').daterangepicker({
        autoUpdateInput: false,  // Prevents automatic filling before user selects
        locale: {
            format: 'YYYY-MM-DD', // Change format as needed
            cancelLabel: 'Clear'
        }
    });

    // When a date range is selected, update the input values
    $('#daterange').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));

        // Update hidden inputs
        $('#event_start_date').val(picker.startDate.format('YYYY-MM-DD'));
        $('#event_end_date').val(picker.endDate.format('YYYY-MM-DD'));
    });

    // Clear the input when "Cancel" is clicked
    $('#daterange').on('cancel.daterangepicker', function () {
        $(this).val('');
        $('#event_start_date').val('');
        $('#event_end_date').val('');
    });
    });


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
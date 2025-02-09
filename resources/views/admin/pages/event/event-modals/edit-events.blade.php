
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Datepicker CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

<!--MULTISELECT DROPDOWN-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/css/multi-select-tag.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="{{ asset('css/admin/pages/event.css') }}">

<div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEventModalLabel">Edit Event Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addEvent">
                    <div class="row mt-1">
                        <!-- Event Name -->
                        <div class="form-group col-md-6">
                            <input type="text" id="eventName" class="form-control">
                            <label for="eventName" class="form-label">Event Name</label>
                        </div>

                        <!-- Event Type -->
                        <div class="form-group col-md-6 mb-3">
                            <select id="eventType" class="form-select">
                                <option value="none" disabled>Select an Event Type</option>
                                <option value="whole-day">Wholeday</option>
                                <option value="half-day-morning">Half-Day Morning</option>
                                <option value="half-day-afternoon">Half-Day Afternoon</option>
                            </select>
                            <label for="eventType" class="form-label">Event Type</label>
                        </div>

                        <!-- Event Place -->
                        <div class="form-group col-md-6 mb-3">
                            <input type="text" id="eventPlace" class="form-control">
                            <label for="eventPlace" class="form-label">Event Venue</label>
                        </div>


                        <!-- Date of Event -->
                        <div class="form-group col-md-6 mb-3">
                            <div class="input-group">
                                <input type="text" id="dateofEvent" class="form-control datepicker">
                                <button class="btn btn-outline-secondary" type="button" id="datepicker-trigger">
                                    <i class="bi bi-calendar2-event"></i>
                                </button>
                            </div>
                            <label for="dateofEvent" class="form-label" id="eventDate">Event Date</label>
                        </div>

                    </div>


                      <div class="assigned-officers mt-2">
                        <div class="ass-div-title">
                            <h6>Assign Officers</h6>
                        </div>
                        <div class="container-border border rounded border-dark">
                            <div class="officer-icon">
                                <img src="{{asset('img/officer-icon.png')}}" alt="">
                            </div>
                            <div class="form-group col-md-4">
                                <select  name="selectOfficer" id="editselectedOfficer" placeholder="Select Officer" multiple>
                                    <option value="1">Hilary Poralan</option>
                                    <option value="2">Hannah Mae Lumangtad</option>
                                </select>
                            </div>
                            <div class="addOfficer">
                                <button class="btn btn-new-officer">
                                    Add Officer
                                </button>
                            </div>
                            <div class="checkbox-container col-md-6">
                                <div class="checkbox-item" id="day1">
                                  Day 1 <input type="checkbox" id="cb_day1">
                                </div>
                                <div class="checkbox-item" id="day2">
                                  Day 2 <input type="checkbox" id="cb_day2">
                                </div>
                                <div class="checkbox-item" id="day3">
                                  Day 3 <input type="checkbox" id="cb_day3">
                                </div>
                                <div class="checkbox-item" id="day4">
                                  Day 4 <input type="checkbox" id="cb_day4">
                                </div>
                                <div class="checkbox-item" id="day5">
                                  Day 5 <input type="checkbox" id="cb_day5">
                                </div>
                                <div class="checkbox-item" id="day6">
                                  Day 6 <input type="checkbox" id="cb_day6">
                                </div>
                                <div class="checkbox-item" id="day7">
                                  Day 7 <input type="checkbox" id="cb_day7">
                                </div>
                              </div>
                        </div>
                      </div>

                      <!--TIME SCHEDULE-->
                      <div class="container mt-4">
                        <div class="row">
                            <!-- Morning Schedule -->
                            <div class="col-md-6 schedule-section" id="morningSchedule" style="display:none;">
                                <div class="div-title">Morning Schedule</div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Check In</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning-checkin" class="form-control">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning-checkin-end" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Check Out</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning-checkout" class="form-control">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="morning-checkout-end" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Afternoon Schedule -->
                            <div class="col-md-6 schedule-section" id="afternoonSchedule" style="display:none;">
                                <div class="div-title">Afternoon Schedule</div>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Check In</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon-checkin-start" class="form-control">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon-checkin-end" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <h6 class="checkInLabel">Check Out</h6>
                                        <div class="startEndLabel">Start Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon-checkout-start" class="form-control">
                                        </div>
                                        <div class="startEndLabel">End Time</div>
                                        <div class="input-group">
                                            <input type="time" id="afternoon-checkout-end" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-submit">Create Event</button>
            </div>
        </div>
    </div>
</div>



<!--SUCCESS MODAL
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <!-- Success Icon 
                <div class="mb-3">
                    <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>-->
                <!-- Success Message 
                <h3 class="fw-bold text-uppercase text-success">Success</h3>
                <p class="mt-2">Officer Successfully Added</p>-->
                <!-- OK Button
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>-->

<!-- Bootstrap and jQuery -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!--MULTISELECT DROPDOWN-->
<script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@3.1.0/dist/js/multi-select-tag.js"></script>

<script>
  $(document).ready(function () {
    // Initialize the datepicker (using jQuery)
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true
    });

    // Trigger the datepicker on calendar icon click
    $('#datepicker-trigger').click(function () {
        $('#date-of-an-event').focus();
    });

    // Get references to the DOM elements by their IDs
    const eventType = document.getElementById("eventType");
    const morningSchedule = document.getElementById("morningSchedule");
    const afternoonSchedule = document.getElementById("afternoonSchedule");

    // Function to update the layout based on selected event type
    function updateLayout() {
        const selectedType = eventType.value; // Get the selected value from the dropdown

        // Handle the different schedule types
        if (selectedType === "whole-day") {
            morningSchedule.style.display = 'block'; // Show morning schedule
            afternoonSchedule.style.display = 'block'; // Show afternoon schedule
            
        } else if (selectedType === "half-day-morning") {
            morningSchedule.style.display = 'block'; // Show morning schedule
            afternoonSchedule.style.display = 'none'; // Hide afternoon schedule
        } else if (selectedType === "half-day-afternoon") {
            morningSchedule.style.display = 'none'; // Hide morning schedule
            afternoonSchedule.style.display = 'block'; // Show afternoon schedule
        
        }
        else if(selectedType === "none"){
            morningSchedule.style.display = "none";
            afternoonSchedule.style.display = "none";
        }
    }

    // Attach event listener to the dropdown to call updateLayout on change
    eventType.addEventListener('change', updateLayout);

    // Initialize with "whole-day" selected by default
    eventType.value = 'none';
    updateLayout(); // Update layout when page loads
});

//MULTISELECT DROPDOWN
new MultiSelectTag("editselectedOfficer", {
        rounded: true,
        shadow: false,
        placeholder: 'Search',
        tagColor:{
            textColor: '#550000',
            borderColor: '#550000',
            bgColor: 'transparent',
        },
        onChange:function(values){
            console.log(value)
        }
    });
</script>

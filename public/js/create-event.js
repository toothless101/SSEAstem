
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
    
    //FOR ADDING EVENTS WITH ASSIGNING STUDENT OFFICERS!    
    const addEventModal = document.getElementById('addEventModal');
    const assignOfficerModal = document.getElementById('assignOfficerModal');
    const assignOfficerButton = document.getElementById('assignOfficerBtn');
    const assignEventNameDisplay = document.getElementById('assign_event_name');
    const eventNameInput = document.getElementById('eventName');
    const confirmAssignmentButton = document.getElementById('confirmAssignment');
    const assignedOfficerList = document.getElementById('officerNameList');
    const assignedOfficerInput = document.getElementById('assigned_officers');

    let assignedOfficers = {};  // store the assigned officers

    //ensure that focus is properly set when the create event modal is closed
    addEventModal.addEventListener('hidden.bs.modal', function(){
        document.activeElement.blur();
    });

    //open assign officer modal and set event name
    assignOfficerButton.addEventListener('click', function(){
        let eventName = eventNameInput.value.trim();
        assignEventNameDisplay.textContent = eventName ? eventName : '[No Event Name]';

        //properly hide the first modal (create event modal)
        let bootstrapAddEventModal = bootstrap.Modal.getInstance(addEventModal);
        if(bootstrapAddEventModal){
            bootstrapAddEventModal.hide();
        }

        //show the second modal (assign officer modal)
        let bootstrapAssignOfficerModal = new bootstrap.Modal.getInstance(assignOfficerModal);
        bootstrapAssignOfficerModal.show();

        //focus on th first focusable element in the assign officer modal
        setTimeout(()=>{
            const firstFocusableElement = assignOfficerModal.querySelector('button, input, select, textarea');
            if(firstFocusableElement){
                firstFocusableElement.focus();
            }
        }, 200);
    });

    //confirm officer assignement
    confirmAssignmentButton.addEventListener('click', function(){
        assignedOfficers = {};      //reset beofre adding new assignmemnts
        assignedOfficerList.innerHTML = ''; //clear the displayed list

        document.querySelectorAll('.assign-dropdown').forEach(dropdown =>{
            let officerId = dropdown.getAttribute('data-officer-id');
            let officerName = dropdown.getAttribute('data-officer-name');
            let role = dropdown.value;

            if(role){
                assignedOfficers[officerId] = role;
                let listItem = document.createElement('li');
                listItem.textContent = `${officerName} - ${role}`;
                assignedOfficerList.appendChild(listItem);
            }
        });

        //convert assugned officers to JSOn for form submission
        assignedOfficerInput.value = JSON.stringify(assignedOfficers);

        //close the assign officer modal
        let bootstrapAssignOfficerModal = bootstrap.Modal.getInstance(assignOfficerModal);
        if(bootstrapAssignOfficerModal){
            bootstrapAssignOfficerModal.hide();
        }

        //show create event modal after assigning officers
        assignOfficerModal.addEventListener('hidden.bs.modal', function(){
            let bootstrapAddEventModal = bootstrap.Modal.getInstance(addEventModal);
            if(!bootstrapAddEventModal){
                bootstrapAddEventModal = new bootstrap.Modal(addEventModal);
            }
            bootstrapAddEventModal.show();

            //refocus on the event form
            setTimeout(()=>{
                eventNameInput.focus();
            }, 200);
        }, {once: true});

        //move focus back to the create event modal
        setTimeout(()=>{
            assignOfficerButton.focus();
        }, 200);

        //ensure when assign officer is closed, focus returns to assign officer button
        assignOfficerModal.addEventListener('hidden.bs.modal', function(){
            setTimeout(()=>{
                assignOfficerButton.focus();
            }, 200);
        });
    });

    //FOR SETTING ASSIGNMENT TYPES IF WHOLE DAY OR HALF DAY EVENT
   const event_Type = document.getElementById('eventType');
   const assignDropdowns = document.querySelectorAll(".assign-dropdown");

   function updateAssignDropdowns(){
        const selectedType = parseInt(event_Type.value, 10); // Get the selected value as an integer

        assignDropdowns.forEach(dropdown=>{
            dropdown.innerHTML = ""; //clear the previous options

            //Default option
            let defaultOption = document.createElement("option");
            defaultOption.value = "";
            defaultOption.textContent = "Select";
            dropdown.appendChild(defaultOption);


            if(selectedType === 1){ //wholeDay
                addOption(dropdown, "wholeday", "Whole Day");
                addOption(dropdown, "halfday_morning", "Half Day (Morning)");
                addOption(dropdown, "halfday_afternoon", "Half Day (Afternoon)");
            }else if(selectedType === 2 || selectedType === 3){ //half day morning or half day afternoon
                addOption(dropdown, "assigned", "Assigned");
            }

        });
   }

   function addOption(dropdown, value, text){
        let option = document.createElement("option");
        option.value = value;
        option.textContent = text;
        dropdown.appendChild(option);
   }

   //Update when event type changes
   event_Type.addEventListener('change', updateAssignDropdowns);

   //run once on page load
   updateAssignDropdowns();
});

   






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

    const addEventModal = document.getElementById('addEventModal');

    addEventModal.addEventListener('hidden.bs.modal', function () {
        // When the modal is hidden, move focus to the button that opened it or any safe element
        document.activeElement.blur();
    });

   





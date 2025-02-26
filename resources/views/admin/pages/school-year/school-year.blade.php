@extends('layout.app')
@section('title', 'SSEA | School Year')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/pages/schoolyear.css') }}">


@include('partials.sidebar')
<x-header-section>
    School Year
</x-header-section>

<section class="main" id="main">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- New Officer Button -->
        <button class="btn btn-new-sy" data-bs-toggle="modal" data-bs-target="#addSchoolYear">
            + New School Year
        </button>

    
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search">
            <button class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="officer-table mt-5">
        <table id="sy_datatable" class="display">
        <thead>
            <tr>
                <th class="col-1">No.</th>
                <th>School Year</th>
                <th class="col-2">Action</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($schoolyears as $key => $schoolyear )
                <tr>
                    <td>{{ ++$key}}</td>
                    <td>{{ $schoolyear->schoolyear}}</td>
                    <td><!-- Edit Button -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#editSchoolYear{{$schoolyear->id}}" style="background-color: transparent; border: none;">
                            <i class="bi bi-pencil-fill" style="color: #550000;"></i>
                        </a>
                    </td>
                    <td> 
                        {{-- toggle active --}}
                        <form action="{{ route('toggle_active', ['schoolyear' => $schoolyear->id]) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-check form-switch">
                                <input class="form-check-input toggle-schoolyear" type="checkbox" role="switch" id="schoolyear_{{$schoolyear->id}}" {{$schoolyear->is_active ? 'checked' : ''}}>
                                <label class="form-check-label label-switch" for="schoolyear_{{$schoolyear->id}}"></label>
                                <span class="info-text">{{$schoolyear->is_active ? 'Active' : 'Inactive'}}</span>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</section>

{{-- confirmation --}}
<div class="modal fade" id="confirmActivationModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Confirm Action</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalBody">
                Are you sure you want to proceed?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-submit" id="confirmActivationBtn">Yes, Proceed</button>
            </div>
        </div>
    </div>
</div>
{{-- validation --}}
<div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="validationModalTitle">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="validationModalBody">
                The selected school year status has been updated.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-submit" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

@include('admin.pages.school-year.schoolyear-modal.addSchoolYear') 
@include('admin.pages.school-year.schoolyear-modal.edit-SchoolYear') 

<script>
    $(document).ready(function(){
        $('#sy_datatable').DataTable({
            dom: 'lt<"d-flex justify-content-between mt-2"<"table-info"i><"table-pagination"p>>r', 
            language:{
                lengthMenu: "Show _MENU_ entries"
            }      
        });

        //Searchbar
        $('.search-input').on('keyup', function(){
            $('#sy_datatable').DataTable().search(this.value).draw();
        });
    });

 //for toggle active
    document.addEventListener("DOMContentLoaded", function () {
    // Ensure correct colors are applied on page load
    document.querySelectorAll(".toggle-schoolyear").forEach(function (switchInput) {
        let infoText = switchInput.closest(".form-check").querySelector(".info-text");
        if (switchInput.checked) {
            infoText.style.color = "#28a745"; // Green for active
        } else {
            infoText.style.color = "#dc3545"; // Red for inactive
        }
    });

    document.addEventListener("change", function (event) {
        if (event.target.classList.contains("toggle-schoolyear")) {
            let switchInput = event.target;
            let form = switchInput.closest("form");
            let formData = new FormData(form);
            let actionUrl = form.action;
            let isActivating = switchInput.checked;

            // Get modal elements
            let confirmModal = new bootstrap.Modal(document.getElementById('confirmActivationModal'));
            let modalTitle = document.getElementById("modalTitle");
            let modalBody = document.getElementById("modalBody");
            let confirmBtn = document.getElementById("confirmActivationBtn");

            let validationModal = new bootstrap.Modal(document.getElementById('validationModal'));
            let validationModalTitle = document.getElementById("validationModalTitle");
            let validationModalBody = document.getElementById("validationModalBody");

            // Update modal text
            if (isActivating) {
                modalTitle.textContent = "Activate School Year";
                modalBody.textContent = "Are you sure you want to activate this school year? This will deactivate the currently active one.";
            } else {
                modalTitle.textContent = "Deactivate School Year";
                modalBody.textContent = "Are you sure you want to deactivate this school year?";
            }

            confirmModal.show();

            confirmBtn.onclick = function () {
                confirmModal.hide();

                // Proceed with AJAX request
                fetch(actionUrl, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Accept": "application/json"
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        let infoText = switchInput.closest(".form-check").querySelector(".info-text");

                        //Update the text & color after successful change
                        infoText.textContent = data.status ? "Active" : "Inactive";
                        infoText.style.color = data.status ? "#28a745" : "#dc3545"; // Green for active, red for inactive

                        // Deactivate all other school years instantly
                        if (isActivating) {
                            document.querySelectorAll(".toggle-schoolyear").forEach(function (otherSwitch) {
                                if (otherSwitch !== switchInput) {
                                    otherSwitch.checked = false;
                                    let otherInfoText = otherSwitch.closest(".form-check").querySelector(".info-text");
                                    otherInfoText.textContent = "Inactive";
                                    otherInfoText.style.color = "#dc3545"; // Set to red
                                }
                            });
                        }

                        // Show validation modal
                        validationModalTitle.textContent = data.status ? "School Year Activated" : "School Year Deactivated";
                        validationModalBody.textContent = data.status
                            ? "The selected school year is now active. Other school years have been deactivated."
                            : "The selected school year has been deactivated.";

                        validationModal.show();
                    } else {
                        alert("Failed to update school year status: " + data.error);
                        switchInput.checked = !switchInput.checked;
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("An error occurred while updating.");
                    switchInput.checked = !switchInput.checked;
                });
            };
        }
    });
});

</script>

@endsection
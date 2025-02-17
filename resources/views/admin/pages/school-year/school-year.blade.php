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
                        <a href="#" data-bs-toggle="modal" data-bs-target="#editSchoolYear{{$schoolyear->sy_id}}" style="background-color: transparent; border: none;">
                            <i class="bi bi-pencil-fill" style="color: #550000;"></i>
                        </a>
                    </td>
                    <td>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label label-switch" for="flexSwitchCheckDefault"></label>
                            <span class="info-text"></span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</section>

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

    document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".form-check-input").forEach(function (switchInput) {
        let infoText = switchInput.closest(".form-check").querySelector(".info-text");

        function updateLabel() {
            infoText.textContent = switchInput.checked ? "Active" : "Inactive";
            infoText.style.color = switchInput.checked ? "#28a745" : "#dc3545"; // Green for active, red for inactive
        }

        // Initialize the text on page load
        updateLabel();

        // Listen for changes
        switchInput.addEventListener("change", updateLabel);
        });
    });
</script>
@endsection
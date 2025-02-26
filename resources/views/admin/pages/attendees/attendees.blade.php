@extends('layout.app')
@section('title', 'SSEAS | Attendees')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/pages/attendees.css') }}">
@include('partials.sidebar')

<x-header-section>
    Attendees
</x-header-section>


<section id="main" class="main">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- New Student Button -->
        <button class="btn btn-add-student" data-bs-toggle="modal" data-bs-target="#addStudentAttendeesModal">
            <i class="fa-solid fa-user-plus"></i> Student
        </button>

    
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search">
            <button class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>


    <div class="mt-5">
    <!--STUDENT INFO TABLE-->
        <table id="student_dataTable">
            <thead>
                <tr>
                    <th class="text-start">Roll No.</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Details</th>
                    <th>QR Code</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="student_info">
                <tr>
                    <td>1</td>
                    <td>Hilary Mae Poralan</td>
                    <td>College</td>
                    <td class="text-start">
                        <small>Gr/Yr Level: </small>
                        <small><br>Section:</small>
                        <small></br>Program/Track:</small>
                        <small><br>Major:</small>
                        <small><br>S.Y.:</small>
                    </td>
                    <td></td>
                    <td>
                        <div class="action-btn">
                            <a href="" class="" data-bs-toggle="modal" data-bs-target="#EditStudentAttendeesModal">
                                <i class="bi bi-pencil-fill" style="color: #550000;"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

@include('admin.pages.attendees.attendees-modals.add-student-attendees')
@include('admin.pages.attendees.attendees-modals.edit-student-modal')

<script>
    $(document).ready(function(){
        $('#student_dataTable').DataTable({
            dom: 'lt<"d-flex justify-content-between mt-2"<"table-info"i><"table-pagination"p>>r',
            language: {
                lengthMenu: "Show _MENU_ entries"
            }
        });

        $('.search-input').on('keyup', function(){
            $('#student_dataTable').DataTable().search(this.value).draw();
        });

    });
</script>
@endsection 
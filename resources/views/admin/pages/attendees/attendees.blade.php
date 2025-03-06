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
                    <th>No.</th>
                    <th class="text-start">Roll No.</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Details</th>
                    <th>QR Code</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="student_info">
                @foreach ($attendees as $key => $attendee )
                    <tr>
                        <td class="text-center">{{ ++$key}}</td>
                        <td class="text-start">{{$attendee->rollno}}</td>
                        <td class="text-start">{{$attendee->firstname}} {{$attendee->middlename}} {{$attendee->lastname}}</td>
                        <td>{{$attendee->department}}</td>
                        <td class="text-start">
                            @if($attendee->department === 'Junior High School')
                                <small>Grade Level: <span id="grade_level"><strong>{{$attendee->grade_level}}</strong></span></small>
                                <small><br>Section: <span id="section"><strong>{{$attendee->section}}</strong></span></small>
                            @elseif($attendee->department === 'Senior High School')
                                <small>Grade Level: <span id="grade_level"><strong>{{$attendee->grade_level}}</strong></span></small>
                                <small><br>Section: <span id="section"><strong>{{$attendee->section}}</strong></span></small>
                                <small></br>Track: <span id="track"><strong>{{$attendee->track}}</strong></span></small>
                                <small><br>Strand: <span id="strand"><strong>{{$attendee->strand}}</strong></span> </small>
                            @elseif($attendee->department === 'College')
                                <small>Program: <span id="program"><strong>{{$attendee->program}}</strong></span></small>
                                <small><br>Major: <span id="major"><strong>{{$attendee->major}}</strong></span></small>
                                <small><br>Year Level: <span id="year_level"><strong>{{$attendee->year_level}}</strong></span></small>
                            @endif
                                <small><br>S.Y.: <span><strong>{{$attendee->schoolyear->schoolyear}}</strong></span></small>
                            </td>
                        <td>
                            <a href="#" class="open-qr-modal" data-rollno="{{$attendee->rollno}}">
                                <i class="fa-solid fa-qrcode" style="color: #550000"></i>
                            </a>
                        </td>
                        <td>
                            <button type="button" class="" data-bs-toggle="modal" data-bs-target="#EditStudentAttendeesModal" style="background-color: transparent; border: none;">
                                <i class="bi bi-pencil-fill" style="color: #550000;"></i>
                            </button>
                    
                            <button type="button" class="view-officer" data-id="" style="background-color: transparent; border: none;">
                                <i class="bi bi-eye-fill" style="color: #550000; margin-left: 5px;"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

@include('admin.pages.attendees.attendees-modals.add-student-attendees')
@include('admin.pages.attendees.attendees-modals.edit-student-modal')
@include('admin.pages.attendees.attendees-modals.qrcode')

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
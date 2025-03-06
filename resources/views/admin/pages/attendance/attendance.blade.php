@extends('layout.app')

@section('title', 'SSEA | Attendance')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/pages/attendance.css') }}">

@include('partials.sidebar')

<x-header-section>
    Attendance
</x-header-section>

<section id="main"  class="main">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!--SCAN BUTTON-->
        <button class="btn btn-scan" data-bs-toggle="modal" data-bs-target="#qrScannerModal">
            <i class="fa-solid fa-qrcode"></i> Scan
        </button>

        <div class="search-container">
            <input type="text" class="search-input" placeholder="Search">
            <button class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>

    </div>

    <div class="todays-event">
        <h6>Today's Event</h6>
    </div>

    <div class="todays-event-name d-flex justify-content-center">
        <h5 id="event-name">Intramurals 2024</h5>
    </div>

    <div class="event-details-container">
        <div class="event-details d-flex justify-content-around mt-3">
            <div class="details-content column-1">
                <div class="e-item event-date">
                    <h5><span class="label">Date: </span> <span class="date" id="date">12-22-2024</span></h5>
                </div>
                <div class="e-item e-type">
                    <h5><span class="label">Event Type: </span> <span class="event-type" id="event-type">Wholeday</span></h5>
                </div>
            </div>
            <div class="details-content column-2">
                <div class="e-item event-s-time">
                    <h5><span class="label">Event Start Time: </span> <span class="s-time" id="s-time">8:00 AM</span></h5>
                </div>
                <div class="e-item event-e-time">
                    <h5><span class="label">Event End Time: </span> <span class="e-time" id="e-time">5:00 PM</span></h5>
                </div>
            </div>
        </div>

        <hr>

         <!--NUMBER OF ENTRIES TO SHOW-->
    

        <div class="attendance-table">
            <table id="student-attendance_dataTable">
            <thead>
                <tr>
                    <th rowspan="2">Roll No.</th>
                    <th rowspan="2">Name</th>
                    <th rowspan="2">Department</th>
                    <th rowspan="2">Gr./Yr Level</th>
                    <th rowspan="2">Date</th>
                    <th class="colspan-header" colspan="2">Time In (AM)</th>
                    <th class="colspan-header" colspan="2">Time Out (PM)</th>
                </tr>
                <tr>
                    <!--time IN-->
                    <th class="sub-column"><i class="fa-solid fa-right-to-bracket"></i></th>
                    <th class="sub-column"><i class="fa-solid fa-right-from-bracket"></i></th>

                    <!---Time OUt-->
                    <th class="sub-column"><i class="fa-solid fa-right-to-bracket"></i></th>
                    <th class="sub-column"><i class="fa-solid fa-right-from-bracket"></i></th>

                </tr>
            </thead>
    
            <tbody id="student-attendance_info">
                <tr>
                    <td>2024001</td>
                    <td>Hilary Mae Poralan</td>
                    <td>College</td>
                    <td>4th Year</td>
                    <td>12-22-2024</td>
                    <td class="sub-column1">07:30</td>
                    <td class="sub-column1">07:30</td>
                    <td class="sub-column1">07:30</td>
                    <td class="sub-column1">12:30</td>
                </tr>
                <tr>
                    <td>2024001</td>
                    <td>Hilary Mae Poralan</td>
                    <td>College</td>
                    <td>4th Year</td>
                    <td>12-22-2024</td>
                    <td class="sub-column1">07:30</td>
                    <td class="sub-column1">07:30</td>
                    <td class="sub-column1">07:30</td>
                    <td class="sub-column1">12:30</td>
                </tr>
            </tbody>
        </table>
        </div>
        
    </div>
</section>

@include('admin.pages.attendance.attendance-modals.scanner-modal')

<script>
    $(document).ready(function(){
        $('#student-attendance_dataTable').DataTable({
            dom: 'lt<"d-flex justify-content-between mt-2"<"table-info"i><"table-pagination"p>>r',
            language: {
                lengthMenu: "Show _MENU_ entries"
            }
        });

        $('.search-input').on('keyup', function(){
            $('#student-attendance_dataTable').DataTable().search(this.value).draw();
        });

    });
</script>
@endsection
@extends('layout.app')
@section('title', 'SSEA | Officer Profile')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/pages/officers.css') }}">

    <div class="d-flex justify-content-start align-items-center mb-3 profile-card">
            <a href="{{ route('manage_officer') }}" style="text-decoration: none; color: #550000; font-size: 15px">
                  <i class="fa-solid fa-circle-arrow-left"></i> 
            </a>
        <div class="officer_profile_title">
            <label for="officers_profile">Officer's Profile</label>
        </div>
    </div>

    <div class="officer-detail-container mt-4">
        <div class="officer-detail">
            <div class="off_name">
             <h6>Name: <span id="name" class="officer_name"><strong>{{$officer->firstname}} {{$officer->lastname}}</strong></span></h6>
            </div>
            <div class="off_position">
                <h6>Position: <span id="position" class="position"><strong>@if($officer->usertype == 1)
                    Admin
                @elseif($officer->usertype == 2)
                    Student Officer
                @else
                Unknown
                @endif </strong></span></h6>
            </div>
        </div>
    </div>

    <!--TABLE-->
    <table id="officer-profile-table">
        <thead>
            <tr>
                <th>Event</th>
                <th>Date</th>
                <th>Schedule</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody id="officers-profile">
            <tr>
                <td id="event-clm"></td>
                <td id="date-clm"></td>
                <td id="status-cls"></td>
                <td id="edit-clm"></td>
            </tr>
        </tbody>
    </table>

<script>
    $(document).ready(function(){
        $('#officer-profile-table').DataTable({
            dom: '<"mt-3"<"table-list"l>t<"d-flex justify-content-between mt-2"<"table-info"i><"table-pagination"p>>r', 
            language:{
                lengthMenu: "Show _MENU_ entries"
            }      
        });

        $('.search-input').on('keyup', function(){
            $('#officer-profile-table').DataTable().search(this.value).draw();
        });
    });
</script>
@endsection
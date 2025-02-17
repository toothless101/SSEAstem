@extends('layout.app')
@section('title', 'SSEA | Event')
@section('content')

<script src="{{asset("js/create-event.js")}}"></script>
<link rel="stylesheet" href="{{ asset('css/admin/pages/event.css') }}">

@include('partials.sidebar')

<x-header-section>
    Events
</x-header-section>

<section id="main" class="main">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <!-- New Officer Button -->
        <button class="btn btn-new-event" data-bs-toggle="modal" data-bs-target="#addEventModal">
            + New Event
        </button>

        <div class="search-container">
            <input 
                type="text" 
                class="search-input" 
                placeholder="Search"
                id="search_bar"
            >
            <button class="search-btn">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>

    <div class="mt-5">
        <table id="eventdataTable" class="display">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Event Name</th>
                    <th>Details</th>
                    <th>Officer Assigned</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="event-list">
                @foreach ($events as $key =>  $event )
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$event->event_name}}</td>
                        <td>
                            <small>Event Venue:<strong> {{$event->event_venue}}</strong></small>
                            <small><br>Event Type: <strong>@if($event->event_type == 1)</strong>Wholeday
                                @elseif($event->event_type == 2) Half Day-Morning
                                @elseif($event->event_type == 3) Half Day-Afternoon
                                @else Unknown
                                @endif
                            </small>
                            <small><br>Start Time: <strong> {{ $event->start_time }}</strong></small>
                            <small></br>End Time:  <strong> {{ $event->end_time }}</strong></small>
                            <small><br>Date: <strong> {{$event->startDate}} to {{$event->endDate}}</strong></small>
                            <small><br>S.Y.: <strong></strong></small>
                        </td>
                        <td>Officer Name</td>
                        <td>Ongoing</td>
                        <td>
                            <a href="" class="" data-bs-toggle="modal" data-bs-target="#editEventModal">
                                <i class="bi bi-pencil-fill" style="color: #550000;"></i>
                            </a>

                            <!-- Delete Button -->
                            <form action="" method="" style="display:inline;">
                                <button type="submit" style="background-color: transparent; border: none;">
                                    <i class="bi bi-trash-fill" style="color: #550000; margin-left: 5px;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table> 
    </div>
    <!--TABLE-->
        
</section>

@include('admin.pages.event.event-modals.create-new-event-modal')
@include('admin.pages.event.event-modals.edit-events')


<script>
    $(document).ready(function () {
        $('#eventdataTable').DataTable({
            dom: 'lt<"d-flex justify-content-between mt-2"<"table-info"i><"table-pagination"p>>r',
            language: {
                lengthMenu: "Show _MENU_ entries"
            }
        });

        $('.search-input').on('keyup', function(){
            $('#eventdataTable').DataTable().search(this.value).draw();
        });

    });
</script>

@endsection

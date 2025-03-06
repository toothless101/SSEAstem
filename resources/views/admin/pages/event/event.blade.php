@extends('layout.app')
@section('title', 'SSEA | Event')
<script src="{{asset("js/create-event.js")}}"></script>
<link rel="stylesheet" href="{{ asset('css/admin/pages/event.css') }}">

@section('content')


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
                            <small><br>Date: <strong> {{ \Carbon\Carbon::parse($event->event_start_date)->format('F d, Y') }} to {{ \Carbon\Carbon::parse($event->event_end_date)->format('F d, Y') }}</strong></small>
                            <small><br>S.Y.: <strong>2024-2025</strong></small>
                        </td>
                        <td> 
                            @foreach ($event->users()->wherePivot('assignment_type', '!=', 'unassigned')->get() as $officer)
                                {{ $officer->firstname }} {{ $officer->lastname }}
                                @if (!$loop->last) 
                                    ,<br> 
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <span class="badge {{$event->status == 'Ongoing' ? 'bg-success' : ($event->status == 'Upcoming' ? 'bg-primary' : 'bg-secondary') }}">
                                {{$event->status}}
                            </span>
                        </td>
                        <td>
                            <button class="editeventBtn" style="background: transparent; border: none;" data-bs-toggle="modal" data-bs-target="#editEventModal{{$event->id}}">
                                <i class="bi bi-pencil-fill" style="color: #550000;"></i>
                            </button>
                            
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
@include('admin.pages.event.event-modals.edit-event-modal')

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

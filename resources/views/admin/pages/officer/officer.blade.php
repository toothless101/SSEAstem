@extends('layout.app')
@section('title', 'SSEA | Officers')
@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/pages/officers.css') }}">

@include('partials.sidebar')
<x-header-section>
    Student Officers
</x-header-section>

    

<section id="main" class="main">

            <!-- Officer profile div -->
        <div id="officerProfileSection" style="display: none;">
            <div id="officerProfileContent">
                <!-- Officer profile content -->
            </div>
         </div>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div id="officerListSection">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- New Officer Button -->
                <button class="btn btn-new-officer" data-bs-toggle="modal" data-bs-target="#addOfficerModal">
                    + New Officer
                </button>

            
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Search">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="officer-table mt-5">
                <table id="officer-datatable" class="display">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>User Type</th>
                        <th>Action</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="assigned_officer">
                    @foreach ($users as $key => $user) <!--$user variable--->
                        <tr>
                            <td>{{ ++$key}}</td>
                            <td><img src="/images/{{ $user->user_img}}" style="width: 30px; height: 30px; border-radius: 50px"></td>
                            <td>{{ $user->firstname}} {{ $user->lastname}}</td>
                            <td>@if($user->org_type == 1)
                                SSC
                                 @elseif($user->org_type == 2)
                                SSLG
                                @else
                                Unknown
                                @endif
                            </td>
                            <td>@if($user->usertype == 1)
                                    Admin
                                @elseif($user->usertype == 2)
                                    Student Officer
                                @else
                                Unknown
                                @endif
                            </td>
                            
                            <td>
                                <!-- Edit Button -->
                                <button href="#" data-bs-toggle="modal" data-bs-target="#editOfficerModal{{$user->id}}" style="background-color: transparent; border: none;">
                                    <i class="bi bi-pencil-fill" style="color: #550000;"></i>
                                </button>
                    
                                <!-- View Profile Button -->
                                <button type="button" class="view-officer" data-id="{{$user->id}}" style="background-color: transparent; border: none;">
                                    <i class="bi bi-eye-fill" style="color: #550000; margin-left: 5px;"></i>
                                </button>
                    
                                <!-- Delete Button -->
                                <form action="{{ route('delete_officer', ['user' => $user->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background-color: transparent; border: none;">
                                        <i class="bi bi-trash-fill" style="color: #550000; margin-left: 5px;"></i>
                                    </button>
                                </form>
                            </td>  

                            <td>Assigned </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
            </div>
        </div>
        <!--TABLE-->
        
    </section>

{{-- manage officer modals --}}
@include('admin.pages.officer.officer-modals.add-officer-modal') 
@include('admin.pages.officer.officer-modals.edit-officers')

<script>
    $(document).ready(function(){
        $('#officer-datatable').DataTable({
            dom: 'lt<"d-flex justify-content-between mt-2"<"table-info"i><"table-pagination"p>>r', 
            language:{
                lengthMenu: "Show _MENU_ entries"
            }      
        });

        //Searchbar
        $('.search-input').on('keyup', function(){
            $('#officer-datatable').DataTable().search(this.value).draw();
        });
    

        //Auto-hide alert Message
        const alertTime = document.querySelector('.alert');
        if(alertTime){
            setTimeout(() => {
                alertTime.style.display = 'none';
            }, 3000);//3 seconds
        }


    //View Officers Profile
        // When clicking eye icon
        $(document).on('click', '.view-officer', function() {
            let officerId = $(this).data('id');

            // AJAX request to fetch officer profile data
            $.ajax({
                url: '/officer/profile/' + officerId,
                method: 'GET',
                success: function(response) {
                    // Inject the profile into the section
                    $('#officerProfileContent').html(response);
                    // Hide the officer list
                    $('#officerListSection').hide();
                    // Show the profile section
                    $('#officerProfileSection').fadeIn();
                },
                error: function(error) {
                    console.log('Error:', error);
                    alert('Error loading officer profile.');
                }
            });
        });

        // When clicking "Back" button, show the list again but 
        $('#backToList').on('click', function() {
            $('#officerProfileSection').hide();
            $('#officerListSection').fadeIn();
        });
    });
</script>
@endsection



@extends('layout.app')
@section('title', 'SSEA | Officers')

@section('content')

<link rel="stylesheet" href="{{ asset('css/admin/pages/officers.css') }}">
@include('partials.sidebar')
<x-header-section>
    Officers
</x-header-section>

    <section id="main" class="main">
       
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
                    <th>Email</th>
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
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->email}} </td>
                        <td>@if($user->usertype == 1)
                                Admin
                            @elseif($user->usertype == 2)
                                Student Officer
                            @else
                            Unknown
                            @endif
                        </td>
                        
                        <td>
                            <button style="background-color: transparent; border: none;">
                                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#editOfficerModal{{$user->id}}">
                                    <i class="bi bi-pencil-fill" style="color: #550000;"></i>
                                </a>
                           </button>
                           <button style="background-color: transparent; border: none;">
                                <a href="{{route('officer_show', $user->id)}}" class="">
                                    <i class="bi bi-eye-fill" style="color: #550000; margin-left: 5px;"></i>
                                </a>
                           </button>
                        </td>    

                        <td>Assigned </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        </div>
        <!--TABLE-->
        
        


    </section>
    
@include('admin.pages.officer.officer-modals.add-officer-modal') 
{{-- @include('admin.pages.officer.officer-modals.edit-officers')  --}}

    

<script>
    $(document).ready(function(){
        $('#officer-datatable').DataTable({
            dom: 'lt<"d-flex justify-content-between mt-2"<"table-info"i><"table-pagination"p>>r', 
            language:{
                lengthMenu: "Show _MENU_ entries"
            }      
        });

        $('.search-input').on('keyup', function(){
            $('#officer-datatable').DataTable().search(this.value).draw();
        });
    

    const alertTime = document.querySelector('.alert');
    if(alertTime){
            setTimeout(() => {
                alertTime.style.display = 'none';
            }, 3000);//2 seconds
        }
});
</script>
@endsection



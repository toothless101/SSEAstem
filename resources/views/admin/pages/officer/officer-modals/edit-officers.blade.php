<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@foreach ($users as $user)
<div class="modal fade" id="editOfficerModal{{$user->id}}" tabindex="-1" aria-labelledby="editOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editOfficerModalLabel">Edit Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{route('update_officer', ['user' => $user->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Centered Image Preview -->
                    <div class="d-flex mb-3 flex-column flex-wrap align-items-center">
                        <div class="image-holder text-center">
                            <img id="output{{$user->id}}" src="{{ asset('images/' . $user->user_img) }}" 
                                 alt="Officer Image" class="img-thumbnail" width="150" height="150">
                        </div>

                        <div class="col-md-6">
                            <label for="user_img{{$user->id}}" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="user_img{{$user->id}}" name="user_img" 
                                   accept="image/*" onchange="previewImage(event, {{$user->id}})">
                            @error('user_img')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstname{{$user->id}}" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname{{$user->id}}" name="firstname" value="{{ $user->firstname }}">
                            @error('firstname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="lastname{{$user->id}}" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname{{$user->id}}" name="lastname" value="{{ $user->lastname }}">
                            @error('lastname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Input Fields -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="email{{$user->id}}" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email{{$user->id}}" name="email" value="{{ $user->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="usertype{{$user->id}}" class="form-label">Position</label>
                            <select class="form-select" name="usertype" id="usertype{{$user->id}}">
                                <option selected>--</option>
                                <option value="1" {{ $user->usertype == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ $user->usertype == 2 ? 'selected' : '' }}>Student Officer</option>
                            </select>
                            @error('usertype')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="position" class="form-label">Ogranization</label>
                            <select class="form-select" name="org_type" id="org_type">
                                <option selected>--</option>
                                <option value="1" {{$user ->org_type == 1 ? 'selected' : ''}}>SSC</option>
                                <option value="2" {{$user ->org_type == 2 ? 'selected' : ''}}>SSLG</option>
                            </select>
                            @error('org_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="username{{$user->id}}" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username{{$user->id}}" name="username" value="{{ $user->username }}" required readonly>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span> 
                            @enderror
                        </div>

                        

                    </div>

                    <div class="col-md-6">
                         <div class="col-md-12 d-flex justify-content-start align-items-center">
                            <a href="" class="form-label forgot_pass" style="font-size:15px; text-decoration: none; color: #550000; font-weight: 500;">Forgot Password?</a>
                         </div>
                    </div>


                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

{{-- Success Modal --}}
<div class="modal fade" id="successUpdateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 500px;">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <div class="mb-3">
                    <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-uppercase text-success">Success</h3>
                <p class="mt-2">Officer Successfully Updated</p>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>

{{-- Error Modal --}}
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 500px;">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <div class="mb-3">
                    <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-uppercase text-danger">Error!</h3>
                <p class="mt-2">Error {{ session('error') }}</p>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<script>
    function previewImage(event, userId) {
        let output = document.getElementById('output' + userId);
        if (output) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    output.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }

    @if(session('success_update'))
        document.addEventListener('DOMContentLoaded', function () {
            const successModal = new bootstrap.Modal(document.getElementById('successUpdateModal'));
            successModal.show();
        });
    @endif

    @if(session('error'))
        document.addEventListener('DOMContentLoaded', function () {
            const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
            errorModal.show();
        });
    @endif
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
{{-- <link rel="stylesheet" href="{{  asset('css/admin/pages/officers.css') }}"> --}}

<div class="modal fade" id="addOfficerModal" tabindex="-1" aria-labelledby="addOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficerModalLabel">Add New Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
          <div class="modal-body">
            <form method="POST" action="{{route('create_officer')}}" enctype="multipart/form-data">
                @csrf
        
                <!-- Centered Image Preview -->
                <div class="d-flex mb-3 flex-column flex-wrap align-items-center">
                    <div class="image-holder text-center">
                        <img id="output" src="{{ asset('img/no-image-available.png') }}" alt="Placeholder Image">
                    </div>

                    <div class="col-md-6">
                        <label for="user_img" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="user_img" name="user_img" accept="image/*" onchange="loadFile(event)">
                        @error('user_img')
                            <span class="text-danger">{{ $message }}</span>     
                        @enderror
                    </div>
                </div>
        
                <!-- Full Name and File Upload -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fullname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="{{old ('firstname')}}" required oninput="generateUsername()">
                        @error('firstname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="fullname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname')}}" required oninput="generateUsername()">
                        @error('lastname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    
                </div>
        
                <!--  Input Fields -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{old ('email')}}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
        
                    <div class="col-md-6">
                        <label for="position" class="form-label">Position</label>
                        <select class="form-select" name="usertype" id="usertype">
                            <option selected>--</option>
                            <option value="1" {{old('usertype') == 1 ? 'selected' : ''}}>Admin</option>
                            <option value="2" {{old('usertype') == 2 ? 'selected' : ''}}>Student Officer</option>
                        </select>
                        @error('usertype')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="position" class="form-label">Ogranization</label>
                        <select class="form-select" name="org_type" id="org_type">
                            <option selected>--</option>
                            <option value="1" {{old('org_type') == 1 ? 'selected' : ''}}>SSC</option>
                            <option value="2" {{old('org_type') == 2 ? 'selected' : ''}}>SSLG</option>
                        </select>
                        @error('org_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{old ('username')}}" required readonly>
                        @error('username')
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
                    </div>
        
                    <div class="col-md-6 mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Default Password is set Automatically" disabled>
                    </div>
                </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-submit">Add</button>
                </div>
            </form>
        </div>        
      </div>
  </div>
</div>   

{{-- Successmodal --}}
<div class="modal fade" id="successAddModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="width: 500px;">
      <div class="modal-content text-center p-4">
          <div class="modal-body">
              <div class="mb-3">
                  <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                      <i class="bi bi-check-circle-fill"></i>
                  </div>
              </div>
              <h3 class="fw-bold text-uppercase text-success">Success</h3>
              <p class="mt-2">Officer Successfully Added</p>
              <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
          </div>
      </div>
  </div>
</div>

{{-- Error Modal --}}
<div class="modal fade" id="errorAddModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="width: 500px;">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <div class="mb-3">
                    <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                        <i class="bi bi-x-circle-fill"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-uppercase text-success">Error!</h3>
                <p class="mt-2">Error {{session('error')}}</p>
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
  </div>

<script>
  function loadFile(event) {
    const output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src); // Free up memory
    }
  }

    @if(session('success_add'))
        document.addEventListener('DOMContentLoaded', function () {
            const successModal = new bootstrap.Modal(document.getElementById('successAddModal'));
            successModal.show();
        });
    @endif

    @if (session('error_add'))

        document.addEventListener('DOMContentLoaded', function () {
            const errorModal = new bootstrap.Modal(document.getElementById('errorAddModal'));
            errorModal.show();
        });
    @endif

    function generateUsername(){
        let firstname = document.getElementById('firstname').value.trim();
        let lastname = document.getElementById('lastname').value.trim();

        if(firstname.length > 0 && lastname.length > 0){
            let firstletter = firstname.charAt(0).toUpperCase();
            let username = firstletter + lastname.toLowerCase();
            document.getElementById('username').value = username;
        } else{
            document.getElementById('username').value = " ";
        }
        
    }

        document.getElementById('firstname').addEventListener('input', generateUsername);
        document.getElementById('lastname').addEventListener('input', generateUsername);
     // Run the function when the page loads (in case of pre-filled values)
     window.onload = function() {
        generateUsername();
    };
</script>
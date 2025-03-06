<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="modal fade" id="addStudentAttendeesModal" tabindex="-1" aria-labelledby="addStudentAttendeesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentAttendeesModalLabel">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('create_attendees')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                     <!-- Success and Error Messages -->
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
                    <div class="row">
                        <!-- Left Side: Image Upload and Preview -->
                        <div class="col-md-6">
                            <div class="d-flex mb-3 flex-column flex-wrap align-items-center">
                                <div class="image-holder text-center">
                                    <img id="output" src="{{ asset('img/no-image-available.png') }}" alt="Placeholder Image">
                                </div>
                                <div class="col-md-6">
                                    <label for="img" class="form-label">Profile Image</label>
                                    <input type="file" class="form-control" id="img" name="img" accept="image/*" onchange="loadFile(event)">
                                    @error('img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Fields -->
                        <div class="col-md-6">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="rollno" class="form-label">Roll No.</label>
                                    <input type="text" class="form-control" id="rollno" name="rollno" value="{{$newRollNo ?? ''}}" disabled readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="department" class="form-label">Department</label>
                                    <select name="department" class="form-select" id="department" >
                                        <option disabled selected>--</option>
                                        <option value="College" {{old('department') == 'College' ? 'selected' : ''}}>College</option>
                                        <option value="Senior High School" {{old('department') == 'Senior High School' ? 'selected' : ''}}>Senior High School</option>
                                        <option value="Junior High School" {{old('department') == 'Junior High School' ? 'selected' : '' }}>Junior High School</option>
                                    </select>
                                    @error('department')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="program" class="form-label">Program</label>
                                    <select name="program" class="form-select" id="program">
                                      <option disabled selected>--</option>
                                      <option value="BTVTED" {{old('program') == 'BTVTED' ? 'selected' :'' }}>BTVTED</option>
                                      <option value="BSTM" {{old('program') == 'BSTM' ? 'selected' : ''}}>BSTM</option>
                                      <option value="BSCS" {{old('program') == 'BSCS' ? 'selected' : ''}}>BSCS</option>
                                    </select>
                                    @error('program')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                  <label for="major" class="form-label">Major</label>
                                  <select name="major" class="form-select" id="major">
                                    <option disabled selected>--</option>
                                    <option value="Automotive" {{old('major') == 'Automotive' ? 'selected' : ''}}>Automotive</option>
                                    <option value="Drafting" {{old('major') == 'Drafting' ? 'selected' : ''}}>Drafting</option>
                                    <option value="Electrical" {{old('major') == 'Electrical' ? 'selected' : ''}}>Electrical</option>
                                    <option value="FSM" {{old('major') == 'FSM' ? 'selected' : ''}}>FSM</option>
                                  </select>
                                  @error('major')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                                <div class="col-md-6">
                                  <label for="year_level" class="form-label">Year Level</label>
                                  <select name="year_level" class="form-select" id="year_level">
                                    <option disabled selected>--</option>
                                    <option value="1st Year" {{old('year_level') == '1st Year' ? 'selected' : ''}}>1st Year</option>
                                    <option value="2nd Year" {{old('year_level') == '2nd Year' ? 'selected' : ''}}>2nd Year</option>
                                    <option value="3rd Year" {{old('year_level') == '3rd Year' ? 'selected' : ''}}>3rd Year</option>
                                    <option value="4th Year" {{old('year_level') == '4th Year' ? 'selected' : ''}}>4th Year</option>
                                  </select>
                                  @error('year_level')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                                <div class="col-md-6">
                                  <label for="track" class="form-label">Track</label>
                                  <select name="track" class="form-select" id="track">
                                    <option disabled selected>--</option>
                                    <option value="Academic Track" {{old('track') == 'Academic Track' ? 'selected' : ''}} >Academic Track</option>
                                    <option value="TVL Track" {{old('track') == 'TVL Track' ? 'selected' : ''}}>TVL Track</option>
                                  </select>
                                  @error('track')
                                    <span class="text-danger">{{$message}}</span>
                                  @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Fields -->
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label for="strand" class="form-label">Strand</label>
                            <select name="strand" class="form-select" id="strand">
                                <option disabled selected>--</option>
                                <option value="Automotive" {{old('strand') == 'Automotive' ? 'selected' : '' }}>Automotive</option>
                                <option value="Drafting" {{old('strand') == 'Drafting' ? 'selected' : '' }}>Drafting</option>
                                <option value="Electrical" {{old('strand') == 'Electrical' ? 'selected' : '' }}>Electrical</option>
                                <option value="CSS" {{old('strand') == 'CSS' ? 'selected' : '' }}>CSS</option>
                                <option value="FBS" {{old('strand') == 'FBS' ? 'selected' : '' }}>FBS</option>
                                <option value="GAS" {{old('strand') == 'GAS' ? 'selected' : '' }}>GAS</option>
                                <option value="HUMSS" {{old('strand') == 'HUMSS' ? 'selected' : '' }}>HUMSS</option>
                                <option value="STEM" {{old('strand') == 'STEM' ? 'selected' : '' }}>STEM</option>
                                <option value="ABM" {{old('strand') == 'ABM' ? 'selected' : '' }}>ABM</option>
                            </select>
                            @error('strand')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="grade_level" class="form-label">Grade Level</label>
                            <select name="grade_level" class="form-select" id="grade_level">
                                <option disabled selected>--</option>
                                <option value="Grade 7" {{old('grade_level') == 'Grade 7' ? 'selected' : '' }}>Grade 7</option>
                                <option value="Grade 8" {{old('grade_level') == 'Grade 8' ? 'selected' : '' }}>Grade 8</option>
                                <option value="Grade 9" {{old('grade_level') == 'Grade 9' ? 'selected' : '' }}>Grade 9</option>
                                <option value="Grade 10" {{old('grade_level') == 'Grade 10' ? 'selected' : '' }}>Grade 10</option>
                                <option value="Grade 11" {{old('grade_level') == 'Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                <option value="Grade 12" {{old('grade_level') == 'Grade 12' ? 'selected' : '' }}>Grade 12</option>
                            </select>
                            @error('grade_level')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="section" class="form-label">Section</label>
                            <select name="section" class="form-select" id="section">
                                <option disabled selected>--</option>
                                <option value="Mercury" {{old('section') == 'Mercury' ? 'selelcted' : ''}}>Mercury</option>
                                <option value="Narra" {{old('section') == 'Narra' ? 'selelcted' : ''}}>Narra</option>
                                <option value="Rizal" {{old('section') == 'Rizal' ? 'selelcted' : ''}}>Rizal</option>
                                <option value="Diamond" {{old('section') == 'Diamond' ? 'selelcted' : ''}}>Diamond</option>
                                <option value="Gold" {{old('section') == 'Gold' ? 'selelcted' : ''}}>Gold</option>
                                <option value="Silver" {{old('section') == 'Silver' ? 'selelcted' : ''}}>Silver</option>
                                <option value="Ruby" {{old('section') == 'Ruby' ? 'selelcted' : ''}}>Ruby</option>
                                <option value="Garnet" {{old('section') == 'Garnet' ? 'selelcted' : ''}}>Garnet</option>
                                <option value="Opal" {{old('section') == 'Opal' ? 'selelcted' : ''}}>Opal</option>
                                <option value="Topaz" {{old('section') == 'Topaz' ? 'selelcted' : ''}}>Topaz</option>
                                <option value="Reverent" {{old('section') == 'Reverent' ? 'selelcted' : ''}}>Reverent</option>
                                <option value="Sapphire" {{old('section') == 'Sapphire' ? 'selelcted' : ''}}>Sapphire</option>
                                <option value="Aquamarine" {{old('section') == 'Aquamarine' ? 'selelcted' : ''}}>Aquamarine</option>
                                <option value="Beryl" {{old('section') == 'Beryl' ? 'selelcted' : ''}}>Beryl</option>
                                <option value="Jade" {{old('section') == 'Jade' ? 'selelcted' : ''}}>Jade</option>
                                <option value="Emerald" {{old('section') == 'Emerald' ? 'selelcted' : ''}}>Emerald</option>
                                <option value="Onyx" {{old('section') == 'Onyx' ? 'selelcted' : ''}}>Onyx</option>
                                <option value="Friendly" {{old('section') == 'Friendly' ? 'selelcted' : ''}}>Friendly</option>
                                <option value="Caring" {{old('section') == 'Caring' ? 'selelcted' : ''}}>Caring</option>
                                <option value="Kind" {{old('section') == 'Kind' ? 'selelcted' : ''}}>Kind</option>
                                <option value="Optimistic" {{old('section') == 'Optimistic' ? 'selelcted' : ''}}>Optimistic</option>
                                <option value="Obidient" {{old('section') == 'Obidient' ? 'selelcted' : ''}}>Obidient</option>
                                <option value="Lovable" {{old('section') == 'Lovable' ? 'selelcted' : ''}}>Lovable</option>
                                <option value="Helpful" {{old('section') == 'Helpful' ? 'selelcted' : ''}}>Helpful</option>
                                <option value="Loyal" {{old('section') == 'Loyal' ? 'selelcted' : ''}}>Loyal</option>
                                <option value="Cheerful" {{old('section') == 'Cheerful' ? 'selelcted' : ''}}>Cheerful</option>
                                <option value="Industrious" {{old('section') == 'Industrious' ? 'selelcted' : ''}}>Industrious</option>
                                <option value="Responsible" {{old('section') == 'Responsible' ? 'selelcted' : ''}}>Responsible</option>
                                <option value="Brave" {{old('section') == 'Brave' ? 'selelcted' : ''}}>Brave</option>
                            </select>
                            @error('section')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" class="form-select" id="gender">
                                <option disabled selected>--</option>
                                <option value="Male" {{old('gender') == 'Male' ? 'selected' : ''}}>Male</option>
                                <option value="Female" {{old('gender') == 'Female' ? 'selected' : ''}}>Female</option>
                            </select>
                        </div>
                    </div>

                    <!-- Text Fields -->
                    <div class="row mt-2 g-3 mb-3">
                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{old('firstname')}}">
                            @error('firstname')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="mobile_no" class="form-label">Mobile No.</label>
                            <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{old('mobile_no')}}">
                            @error('mobile_no')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename" value="{{old('middlename')}}">
                            @error('middlename')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email_add" class="form-label">Email Address</label>
                            <input type="text" class="form-control" id="email_add" name="email_add" value="{{old('email_add')}}">
                            @error('email_add')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{old('lastname')}}">
                            @error('lastname')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{old('address')}}">
                            @error('address')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-submit">Submit</button>
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
              <p class="mt-2">Attendee Successfully Added</p>
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
            URL.revokeObjectURL(output.src);
        };
    }

     //SUCCESS/ERROR MODALS
     @if(session('success_adding_student'))
        document.addEventListener('DOMContentLoaded', function () {
            const successModal = new bootstrap.Modal(document.getElementById('successAddModal'));
            successModal.show();
        });
    @endif

    @if (session('error_adding_student'))
        document.addEventListener('DOMContentLoaded', function () {
            const errorModal = new bootstrap.Modal(document.getElementById('errorAddModal'));
            errorModal.show();
        });
    @endif

    $(document).ready(function(){
      //call the generated roll number --
      $.ajax({
        url: "{{route('attendees_rollno')}}",
        type: "GET",
        success: function(response){
          if(response.rollno){
            $("#rollno").val(response.rollno);
          }else{
            alert("Failed to generate Roll Number");
          }
        },
        error: function(){
          alert("Error fetching Roll Number")
        }
      });
    });
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="modal fade" id="EditStudentAttendeesModal" tabindex="-1" aria-labelledby="EditStudentAttendeesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="EditStudentAttendeesModalLabel">Edit Student Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form>
                    <div class="row">
                    <!-- Left Side: Image Upload and Preview -->
      <div class="col-md-6">
        <div class="form-group">
          <!-- Image Preview Section -->
          <div class="d-flex justify-content-center">
            <div class="image-holder">
              <img id="output" src="{{asset('img/no-image-available.png')}}" alt="Placeholder Image">
            </div>
          </div>
          <!-- File Upload Label 
          <label for="customFile" class="control-label mt-3">Upload Image</label>-->
          <!-- File Input -->
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="customFile" name="img" accept="image/*" onchange="loadFile(event)">
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>
        </div>
      </div>

      <!-- Right Side: Fields -->
      <div class="col-md-6">
        <div class="row g-3">
          <!-- Row 1 Program -->
          <div class="col-md-6">
            <label for="rollNo" class="form-label">Roll No.</label>
            <input type="text" class="form-control" id="rollNo" placeholder="">
          </div>
          <div class="col-md-6">
            <label for="department" class="form-label">Department</label>
            <select class="form-select" id="department">
              <option selected>--</option>
              <option>College</option>
              <option>Senior High School</option>
              <option>Junior High School</option>
            </select>
          </div>

          <!-- Row 2 Department -->
          <div class="col-md-6">
            <label for="program" class="form-label">Program/Track</label>
            <select class="form-select" id="program">
              <option selected>--</option>
              <option>BTVTED</option>
              <option>BSTM</option>
              <option>BSCS</option>
              <option>Academic Track</option>
              <option>TVL Track</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="major" class="form-label">Major/Strand</label>
            <select class="form-select" id="major">
              <option selected>--</option>
              <option>None</option>
              <option>Automotive</option>
              <option>Drafting</option>
              <option>Electrical</option>
              <option>FSM</option>
              <option>CSS</option>
              <option>FBS</option>
              <option>GAS</option>
              <option>HUMSS</option>
              <option>STEM</option>
            </select>
          </div>

          <!-- Row 3 -->
          <div class="col-md-6">
            <label for="gr_yr_level" class="form-label">Gr/Yr Level</label>
            <select class="form-select" id="gr_yr_level">
              <option selected>--</option>
              <option>Grade 7</option>
              <option>Grade 8</option>
              <option>Grade 9</option>
              <option>Grade 10</option>
              <option>Grade 11</option>
              <option>Grade 12</option>
              <option>1st Year</option>
              <option>2nd Year</option>
              <option>3rd Year</option>
              <option>4th Year</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="section" class="form-label">Section</label>
            <select class="form-select" id="section">
              <option selected>--</option>
              <option>Section A</option>
              <option>Section B</option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <!-- Text Fields -->
    <div class="row mt-4 g-3">
      <div class="col-md-6">
        <label for="firstName" class="form-label">First Name</label>
        <input type="text" class="form-control" id="firstName">
      </div>
      <div class="col-md-6">
        <label for="mobile" class="form-label">Mobile No.</label>
        <input type="text" class="form-control" id="mobile">
      </div>

      <div class="col-md-6">
        <label for="middleName" class="form-label">Middle Name</label>
        <input type="text" class="form-control" id="middleName">
      </div>
      <div class="col-md-6">
        <label for="email_add" class="form-label">Email Address</label>
        <input type="text" class="form-control" id="email_add">
      </div>

      <div class="col-md-6">
        <label for="lastName" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="lastName">
      </div>
      <div class="col-md-6">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address">
      </div>
    </div>
</div>
                    <!--BUTTONS-->
  <div class="modal-footer">
    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
    <button type="button" class="btn btn-submit">Update</button>
  </div>    
</form>
</div>
 </div>
    </div>
    
</div>   

<!--SUCCESS MODAL
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <div class="modal-body">
                <!-- Success Icon 
                <div class="mb-3">
                    <div class="success-icon d-flex justify-content-center align-items-center mx-auto">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>-->
                <!-- Success Message 
                <h3 class="fw-bold text-uppercase text-success">Success</h3>
                <p class="mt-2">Officer Successfully Added</p>-->
                <!-- OK Button
                <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>-->


<script>
    function loadFile(event) {
      const output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function() {
        URL.revokeObjectURL(output.src); // Free up memory
      }
    }
</script>
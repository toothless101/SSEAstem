<div class="modal fade" id="addSchoolYear" tabindex="-1" aria-labelledby="addSchoolYearModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSchoolYearModalLabel">Add New School Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('create_schoolyear')}}" method="POST">
                    @csrf
                    <!-- Success and Error Messages -->
                    @if (session('success_add_sy'))
                        <div class="alert alert-success">
                            {{ session('success_add_sy') }}
                        </div>
                    @endif

                    @if (session('error_add_sy'))
                        <div class="alert alert-danger">
                            {{ session('error_add_sy') }}
                        </div>
                    @endif
                    <div class="col-md-12 mb-3" style="margin-top:-15px;">
                        <label for="schoolyear" class="form-label">School Year</label>
                        <input type="text" class="form-control" id="schoolyear" name="schoolyear" value="{{old('schoolyear')}}">
                        @error('schoolyear')
                            <span class="text-danger">{{ $message }}</span> 
                        @enderror
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
                <p class="mt-2">School Year Successfully Added</p>
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
    @if(session('success_add_sy'))
    document.addEventListener('DOMContentLoaded', function(){
        const successAddModal = new bootstrap.Modal(document.getElementById('successAddModal'));
        successAddModal.show();
    });
    @endif

    @if(session('error_add_sy'))
    document.addEventListener('DOMContentLoaded', function(){
        const errorAddModal = new bootstrap.Modal(document.getElementById('errorAddModal'));
        errorAddModal.show();
    })
    @endif


</script>
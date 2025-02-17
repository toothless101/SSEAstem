<div class="modal fade" id="assignOfficerModal" tabindex="-1" aria-labelledby="assignOfficerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Centered and larger modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Assign Officers for Event: <strong id="assign_event_name"></strong>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="assignOfficerForm">
                    <div class="assign_officers_list">
                        @foreach($officers as $officer)
                            <div class="row align-items-center mb-2">
                                <div class="col-7">
                                    <label class="form-label mb-0 fw-semibold">
                                        {{ $officer->firstname }} {{ $officer->lastname }}
                                    </label>
                                </div>
                                <div class="col-5">
                                    <select class="form-select form-select-sm assign-dropdown"
                                            data-officer-id="{{ $officer->id }}" 
                                            data-officer-name="{{ $officer->firstname }} {{ $officer->lastname }}">
                                        {{-- <option value="">Select</option>
                                        <option value="assigned">Assigned</option> 
                                        <option value="wholeday">Whole Day</option>
                                        <option value="halfday_morning">Half Day (Morning)</option>
                                        <option value="halfday_afternoon">Half Day (Afternoon)</option> --}}
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary mt-3" id="confirmAssignment">Confirm Assignment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

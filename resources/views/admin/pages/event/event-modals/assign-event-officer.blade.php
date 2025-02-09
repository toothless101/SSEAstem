
<div class="modal fade" id="assignOfficerModal" tabindex="-1" aria-labelledby="addOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog d-flex justify-content-center">
        <div class="modal-content" style="width:71%;">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficerModalLabel">Assign Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('assign_officer_form', ['event_id' => $event->id]) }}" method="POST">
                    @csrf
                    <div class="assign_event_officer mb-5">
                        <h6>Assign Officers for Event: <strong>{{ $event->event_name ?? 'No event name' }}</strong></h6>
                    </div>

                    @foreach($officers as $officer)
                    <div class="form-group d-flex justify-content-between align-items-center mb-3 g-6">
                    
                        <h6 for="officer_{{ $officer->id }}" style="width: 50%;"> {{ $officer->name }}</h6>
                    
                        <select name="assignment[{{ $officer->id }}]" id="officer_{{ $officer->id }}" class="form-control md-2">
                            <option value="unassigned">Unassigned</option>
                            <option value="wholeday">Whole Day</option>
                            <option value="halfday_morning">Half Day (Morning)</option>
                            <option value="halfday_afternoon">Half Day (Afternoon)</option>
                        </select>
                    </div>
                    @endforeach
             
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Assign Officers</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

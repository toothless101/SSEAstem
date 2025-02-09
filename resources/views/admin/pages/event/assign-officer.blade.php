@extends('layout.app')

<div class="modal fade" id="assignOfficerModal" tabindex="-1" aria-labelledby="addOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addOfficerModalLabel">Assign Officer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
          
          <div class="modal-body">
            <form action="" method="POST">
                @csrf
            
                <h4>Assign Officers for Event: </h4>
            
                {{-- @foreach($officers as $officer) --}}
                    <div class="form-group d-flex">
                        <label for="officer">Assign Officer: </label>
                        <select name="assignment" id="officer" class="form-control md-2">
                            <option value="unassigned" >Unassigned</option>
                            <option value="wholeday" >Whole Day</option>
                            <option value="halfday_morning">Half Day (Morning)</option>
                            <option value="halfday_afternoon" >Half Day (Afternoon)</option>
                        </select>
                    </div>
                {{-- @endforeach
             --}}
                <button type="submit" class="btn btn-primary">Assign Officers</button>
            </form>
            
        </div>
        
        
      </div>
    
  </div>
</div>
<div class="modal fade" id="popupAddShift" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add user shift</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="col">
          <input id="datepickerAddShift" width="266" />
          <input id="timepickerStartShift" width="266" />
          <input id="timepickerEndShift" width="266" />
        </div>
        
        <br>Select shift and start time<br>Select user
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#datepickerAddShift').datepicker({
        uiLibrary: 'bootstrap5',
        format: 'dd/mm/yyyy',
    }).on("change",function(){
        getScheduleByDate();
    });
    $('#timepickerStartShift').timepicker({
        uiLibrary: 'bootstrap5',
        format: 'dd/mm/yyyy',
    }).on("change",function(){
        getScheduleByDate();
    });
    $('#timepickerEndShift').timepicker({
        uiLibrary: 'bootstrap5',
        format: 'dd/mm/yyyy',
    }).on("change",function(){
        getScheduleByDate();
    });

</script>
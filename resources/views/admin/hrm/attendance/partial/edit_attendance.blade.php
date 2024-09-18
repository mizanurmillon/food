<form action="{{ route('update.attendance') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="row">
    <div class="form-group col-6">
      <label for="exampleInputEmail1">Employee<span class="text-danger">*</span></label>
        <select class="form-control" name="employee_id">
          @foreach($employee as $row)
            <option value="{{ $row->id }}" @if($row->id==$data->employee_id) selected="" @endif >{{ $row->name }}</option>
          @endforeach
        </select>
    </div>
   
    <div class="form-group col-6">
      <label for="date">Attendance Date<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="date" name="date" readonly="" required value="{{ $data->date }}">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
      <label for="time">Clock In<span class="text-danger">*</span></label>
      <input type="time" class="form-control" id="time" name="clock_in" required value="{{ $data->clock_in }}">
    </div>
    <div class="form-group col-6">
      <label for="clockOut">Clock Out<span class="text-danger">*</span></label>
      <input type="time" class="form-control" id="clockOut" name="clock_out" required value="{{ $data->clock_out }}">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
      <label for="clock_in_note">ClockIn Note</label>
      <input type="text" class="form-control" id="clock_in_note" name="clock_in_note" value="{{ $data->clock_in_note }}">
    </div>
    <div class="form-group col-6">
      <label for="clock_note">ClockOut Note</label>
      <input type="text" class="form-control" id="clock_note" name="clock_out_note" value="{{ $data->clock_out_note }}">
    </div>
  </div>
  
  <button type="submit" class="btn btn-success float-right"><span class="e_loader d-none">....</span>Update</button>
</form>
<script type="text/javascript">
  //Update Form Submit
    $('#edit_form').submit(function(e){
      e.preventDefault();
      $('.e_loader').removeClass('d-none');
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $.ajax({
        url:url,
        type:'post',
        async:false,
        data:request,
        success:function(data){
          toastr.success(data);
          $('#edit_form')[0].reset();
          $('.e_loader').addClass('d-none');
          $('#editModal').modal('hide');
          $('.dataTable').DataTable().ajax.reload();
        }
      });
    });
</script>
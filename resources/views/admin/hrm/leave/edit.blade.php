<form action="{{ route('update.leave') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
 <div class="row">
  <div class="form-group col-6">
    <label for="exampleInputEmail1">Emplyee<span class="text-danger">*</span></label>
    <select class="form-control" name="employee_id" required>
      @foreach($employee as $row)
      <option value="{{ $row->id }}"  @if($row->id==$data->employee_id) selected="" @endif >{{ $row->name }}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-6">
    <label for="exampleInputEmail1">Leave Type<span class="text-danger">*</span></label>
    <select class="form-control" name="leavetype_id">
      @foreach($leavetype as $row)
      <option value="{{ $row->id }}" @if($row->id==$data->leavetype_id) selected="" @endif >{{ $row->type_name }}</option>
      @endforeach
    </select>
  </div>
</div>
  <div class="row">
    <div class="form-group col-4">
      <label for="From">From<span class="text-danger">*</span></label>
      <input type="date" class="form-control startdate" id="From" name="start_date" required value="{{ $data->start_date }}">
    </div>
    <div class="form-group col-4">
      <label for="to">To<span class="text-danger">*</span></label>
      <input type="date" class="form-control enddate" id="to" name="end_date" required value="{{ $data->end_date }}">
    </div>
    <div class="form-group col-4">
      <label for="num_of_days">Total Days</label>
      <input type="text" class="form-control numofdays" id="num_of_days" name="leave_day" readonly="" value="{{ $data->leave_day }}">
    </div>
  </div>
  	<div class="form-group">
	    <label for="status">Status<span class="text-danger">*</span></label>
	    <select class="form-control" name="status" required>
	      <option value="1" @if($data->status==1) selected="" @endif >Approved</option>
	      <option value="3" @if($data->status==3) selected="" @endif >Declined</option>
	      <option value="0" @if($data->status==0) selected="" @endif >Pending</option>
	    </select>
	</div>
  <button type="submit" class="btn btn-success float-right"><span class="e_loader d-none">....</span>Update</button>
</form>
<script type="text/javascript">

  function dataDiffInDays(date1, date2) {
      //round to the nearest whole number
      return Math.round((date2-date1)/(1000*60*60*24));
    }
    $(document).ready(function(){
      $('.enddate').on('change',function(e){
        var date1=$('.startdate').val();
        var date2=$('.enddate').val();
        var daysDiff=dataDiffInDays(new Date(date1) , new Date(date2));
        var totaldays=daysDiff+1;
        $('.numofdays').val(totaldays);
      });
      $('.startdate').on('change',function(e){
        var date1=$('.startdate').val();
        var date2=$('.enddate').val();
        var daysDiff=dataDiffInDays(new Date(date1) , new Date(date2));
        var totaldays=daysDiff+1;
        $('.numofdays').val(totaldays);
      });
    });

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
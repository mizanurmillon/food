<form action="{{ route('update.holiday') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Type<span class="text-danger">*</span></label>
    <select class="form-control" name="type" required>
      <option value="Holiday" @if($data->type=="Holiday") selected="" @endif >Holiday</option>
      <option value="Offday" @if($data->type=="Offday") selected="" @endif >Offday</option>
    </select>
  </div>
  <div class="form-group">
      <label for="name">Holiday Name<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="name" name="name" required value="{{ $data->name }}">
    </div>
  <div class="row">
    <div class="form-group col-4">
      <label for="From">From<span class="text-danger">*</span></label>
      <input type="date" class="form-control startdate" id="From" name="from" required value="{{ $data->from }}">
    </div>
    <div class="form-group col-4">
      <label for="to">To<span class="text-danger">*</span></label>
      <input type="date" class="form-control enddate" id="to" name="to" required value="{{ $data->to }}">
    </div>
    <div class="form-group col-4">
      <label for="num_of_days">Total Days</label>
      <input type="text" class="form-control numofdays" id="num_of_days" name="num_of_days" readonly="" value="{{ $data->num_of_days }}">
    </div>
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
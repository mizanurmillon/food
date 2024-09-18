<form action="{{ route('update.award') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="row">
    <div class="form-group col-4">
      <label>Employee<span class="text-danger">*</span></label>
      <select class="form-control" name="employee_id">
        @foreach($employee as $row)
        <option value="{{ $row->id }}" @if($row->id==$data->employee_id) selected="" @endif >{{ $row->name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-4">
      <label for="name">Award Name<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="name" name="award_name" value="{{ $data->award_name }}">
    </div>
    <div class="form-group col-4">
      <label for="award">Award<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="award" name="award" value="{{ $data->award }}">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-4">
      <label for="exampleInputEmail1">Award Date<span class="text-danger">*</span></label>
      <input type="date" class="form-control" id="exampleInputEmail1" name="award_date" value="{{ $data->award_date }}" >
    </div>
    <div class="form-group col-4">
      <label for="month">Award Month<span class="text-danger">*</span></label>
      <select class="form-control" name="award_month" id="month" required>
        <option value="January" @if($data->award_month=="January") selected="" @endif >January</option>
        <option value="February" @if($data->award_month=="February") selected="" @endif >February</option>
        <option value="March" @if($data->award_month=="March") selected="" @endif >March</option>
        <option value="April" @if($data->award_month=="April") selected="" @endif >April</option>
        <option value="May" @if($data->award_month=="May") selected="" @endif >May</option>
        <option value="June" @if($data->award_month=="June") selected="" @endif >June</option>
        <option value="July" @if($data->award_month=="July") selected="" @endif >July</option>
        <option value="August" @if($data->award_month=="August") selected="" @endif >August</option>
        <option value="September" @if($data->award_month=="September") selected="" @endif >September</option>
        <option value="Octeber" @if($data->award_month=="Octeber") selected="" @endif >Octeber</option>
        <option value="November" @if($data->award_month=="November") selected="" @endif >November</option>
        <option value="December" @if($data->award_month=="December") selected="" @endif >December</option>
      </select>
    </div>
    <div class="form-group col-4">
      <label for="award_year">Award Year<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="award_year" name="award_year" value="{{ $data->award_year }}">
    </div>
  </div>
    <div class="form-group">
      <label>Details<span class="text-danger">*</span></label>
      <textarea class="form-control" name="details">{{ $data->details }}</textarea>
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
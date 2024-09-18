<form action="{{ route('update.reservation') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="date">Date<span class="text-danger">*</span></label>
    <input type="date" class="form-control" id="date" name="r_date" required value="{{ $data->r_date }}">
  </div>
  <div class="form-group">
    <label for="Time">Time<span class="text-danger">*</span></label>
    <input type="time" class="form-control" id="Time" name="r_time" value="{{ $data->r_time }}">
  </div>
  <div class="form-group">
    <label for="name">Name<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="name" required value="{{ $data->name }}">
  </div>
  <div class="form-group">
    <label for="phone">Phone<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="phone" name="phone" required value="{{ $data->phone }}">
  </div>
  <div class="form-group">
    <label for="people">Person<span class="text-danger">*</span></label>
    <input type="number" min="1" class="form-control" id="people" name="people" required value="{{ $data->people }}">
  </div>
  <div class="form-group">
    <label for="details">Details<span class="text-danger">*</span></label>
    <textarea class="form-control" name="details" id="details">{{ $data->details }}</textarea>
  </div>
  <div class="form-group">
    <select class="form-control" name="status">
      <option value="Approved" class="text-info" @if($data->status=="Approved") selected @endif>Approved</option>
      <option value="Success" class="text-success" @if($data->status=="Success") selected @endif>Success</option>
      <option value="Reject" class="text-danger" @if($data->status=="Reject") selected @endif>Reject</option>
      <option value="Pending" class="text-warning" @if($data->status=="Pending") selected @endif>Pending</option>
    </select>
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
<form action="{{ route('update.review') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label>Customer:</label>
     <h2>{{ $data->name }}</h2>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Message:</label>
    <p>{{ $data->message }}</p>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Rating: {{ $data->rating }} Star</label>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Status:</label>
    <select class="form-control" name="status">
      <option value="0" @if($data->status==0) selected="" @endif>Pending</option>
      <option value="1" @if($data->status==1) selected="" @endif>Approved</option>
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
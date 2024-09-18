<form method="post" action="{{ route('update.floor') }}" id="edit_form">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Floor Name<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="floor_name" required value="{{ $data->floor_name }}">
    <input type="hidden" name="id" value="{{ $data->id }}">
    <small id="emailHelp" class="form-text text-muted">This is your main Floor</small>
  </div>
  <button type="submit" class="btn btn-success float-right"><span class="e_loader d-none">....</span> Update</button>
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
<form action="{{ route('update.customer') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="form-group">
	  <label for="name">Customer Name<span class="text-danger">*</span></label>
	  <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
	</div>
	<div class="form-group">
	  <label for="email">Customer Email<span class="text-danger">*</span></label>
	  <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}">
	</div>
	<div class="form-group">
	  <label for="phone">Customer Phone<span class="text-danger">*</span></label>
	  <input type="text" class="form-control" id="phone" name="phone" value="{{ $data->phone }}">
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
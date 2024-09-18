<form method="post" action="{{ route('update.blogcategory') }}" id="edit_form">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Blog Category Name<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="category_name" value="{{ $data->category_name }}">
    <small id="emailHelp" class="form-text text-muted">This is your main blog category</small>
  </div>
  <input type="hidden" name="id" value="{{ $data->id }}">
  <button type="submit" class="btn btn-success float-right"><span class="e_loader d-none">....</span> update</button>
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
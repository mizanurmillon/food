<form method="post" action="{{ route('update.table') }}" id="edit_form">
@csrf
  <div class="form-group">
    <label for="exampleInputEmail1">Select Floor<span class="text-danger">*</span></label>
    <select class="form-control"name="floor_id">
      @foreach($floor as $row)
      <option value="{{ $row->id }}" @if($row->id==$data->floor_id) selected @endif>{{ $row->floor_name }}</option>
      @endforeach
    </select>
  </div>
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Table Code<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="table_code" required value="{{ $data->table_code }}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Table Sit<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="table_sit" required value="{{ $data->table_sit }}">
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
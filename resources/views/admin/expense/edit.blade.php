<form method="post" action="{{ route('update.expense') }}" id="edit_form">
@csrf
  <div class="form-group">
    <label for="date">Expense Date<span class="text-danger">*</span></label>
    <input type="date" class="form-control" id="date" name="date" required value="{{ $data->date }}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Select Expense Type<span class="text-danger">*</span></label>
    <select class="form-control"name="expenstype_id">
      @foreach($expenstype as $row)
      <option value="{{ $row->id }}" @if($row->id==$data->expenstype_id) selected @endif>{{ $row->type_name }}</option>
      @endforeach
    </select>
  </div>
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="amount">Expense Amount<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="amount" name="amount" required value="{{ $data->amount }}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Expense Details<span class="text-danger">*</span></label>
    <textarea class="form-control" name="details">{{ $data->details }}</textarea>
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
<link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/dropify.css">
<form action="{{ route('update.blog') }}" method="post" id="edit_form" enctype='multipart/form-data'>
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Select Category<span class="text-danger">*</span></label>
   	<select class="form-control"name="category_id">
   		@foreach($blogcategory as $row)
   		<option value="{{ $row->id }}" @if($row->id==$data->category_id) selected="selected" @endif >{{ $row->category_name }}</option>
   		@endforeach
   	</select>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Blog Title<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" name="title" value="{{ $data->title }}">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description<span class="text-danger">*</span></label>
    <textarea class="form-control textarea" name="description">{{ $data->description }}</textarea>
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">Image<span class="text-danger">*</span></label>
    <input type="file" class="dropify" name="image" data-default-file="{{ asset('public/files/blog/'.$data->image) }}"/>
    <input type="hidden" name="old_image" value="{{ $data->image }}">
  </div>
  <button type="submit" class="btn btn-success float-right submit_button"><span class="loader d-none">....</span> Update</button>
</form>
<script src="{{ asset('public/backend') }}/plugins/dropify.min.js"></script>
<script type="text/javascript">
  $('#edit_form').submit(function(e){
      e.preventDefault();
      $('.loading_button').removeClass('d-none');
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $('.submit_button').prop('type','button');
      $.ajax({
        url:url,
        type:'post',
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          toastr.success(data);
          $('#edit_form')[0].reset();
          $('.loading_button').hide();
          $('.submit_button').prop('type','submit');
          $('.dataTable').DataTable().ajax.reload();
          $('#editModal').modal('hide');
          $(".dropify-clear").trigger("click");
        }
      });
    });
    //Dropify image
    $('.dropify').dropify();
    // Summernote
    $(function () {
      $('.textarea').summernote()
    });
</script>
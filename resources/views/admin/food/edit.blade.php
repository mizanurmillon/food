<link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/dropify.css">

<form action="{{ route('update.food') }}" method="post" id="edit_form" enctype='multipart/form-data'>
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="form-group">
    <label for="exampleInputEmail1">Select Category<span class="text-danger">*</span></label>
   	  <select class="form-control"name="subcategory_id" required>
        <option>--Select category--</option>
        @foreach($category as $row)
          @php
            $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
          @endphp
          <option value="{{ $row->id }}" disabled="" class="text-danger">{{ $row->category_name }}</option>
          @foreach($subcategory as $row)
            <option value="{{ $row->id }}" @if($row->id==$data->subcategory_id) selected=""@endif>--{{ $row->subcategory_name }}</option>
          @endforeach
        @endforeach
      </select>
  </div>
  <div class="form-group">
    <label for="name">Food Name<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="food_name" value="{{ $data->food_name }}">
  </div>
  <div class="row">
    <div class="form-group col-6">
      <label for="price">Price<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="price" name="price" value="{{ $data->price }}">
    </div>
    <div class="form-group col-6">
      <label for="discount_price">Discount Price</label>
      <input type="text" class="form-control" id="discount_price" name="discount_price" value="{{ $data->discount_price }}">
    </div>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Description<span class="text-danger">*</span></label>
    <textarea class="form-control textarea" name="description">{{ $data->description }}</textarea>
  </div>
  <div class="row">
    <div class="form-group col-4">
      <label for="status">Status<span class="text-danger">*</span></label>
      <select class="form-control"name="status" required>
        <option value="1" @if($data->status==1) selected="" @endif>Publish</option>
        <option value="0" @if($data->status==0) selected="" @endif>Unpublish</option>
      </select>
    </div>
    <div class="form-group col-4">
      <label for="status">Top Recipes<span class="text-danger">*</span></label>
      <select class="form-control" name="top">
        <option value="1" @if($data->top==1) selected="" @endif>Show</option>
        <option value="0" @if($data->top==0) selected="" @endif>Hide</option>
      </select>
    </div>
    <div class="form-group col-4">
      <label for="status">Slider<span class="text-danger">*</span></label>
      <select class="form-control" name="slider">
        <option value="1" @if($data->slider==1) selected="" @endif>Slider</option>
        <option value="0" @if($data->slider==0) selected="" @endif>Hide</option>
      </select>
    </div>
  </div>
   <div class="form-group">
     <label for="exampleInputEmail1">Image<span class="text-danger">*</span></label>
      <input type="file" class="dropify" name="image" data-default-file="{{ asset('public/files/food/'.$data->image) }}"/>
      <input type="hidden" name="old_image" value="{{ $data->image }}">
  </div>
  
  <button type="submit" class="btn btn-success float-right submit_button"><span class="loader d-none">....</span> Update</button>
</form>

<script src="{{ asset('public/backend') }}/plugins/dropify.min.js"></script>

<script type="text/javascript">
  //Update Form Submit
    $('#edit_form').submit(function(e){
      e.preventDefault();
      $('.loader').removeClass('d-none');
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
          $('.loader').hide();
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
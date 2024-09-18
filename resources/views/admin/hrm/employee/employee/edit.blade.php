<link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/dropify.css">

<form action="{{ route('update.employee') }}" method="post" id="edit_form">
  @csrf
  <input type="hidden" name="id" value="{{ $data->id }}">
  <div class="row">
    <div class="form-group col-6">
      <label for="id">Employee Id<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="id" name="employee_id" required value="{{ $data->employee_id }}" >
    </div>
    <div class="form-group col-6">
      <label for="name">Employee Name<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="name" name="name" required value="{{ $data->name }}">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
      <label for="exampleInputEmail1">Department<span class="text-danger">*</span></label>
      <select class="form-control" name="department_id">
        @foreach($department as $row)
        <option value="{{ $row->id }}" @if($row->id==$data->department_id) selected="" @endif>{{ $row->department_name }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-6">
      <label for="exampleInputEmail1">Designation<span class="text-danger">*</span></label>
      <select class="form-control" name="designation_id">
        @foreach($designation as $row)
        <option value="{{ $row->id }}" @if($row->id==$data->designation_id) selected="" @endif>{{ $row->designation_name }}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="row">
    <div class="form-group col-6">
      <label for="phone">Employee Phone<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="phone" name="phone" required value="{{ $data->phone }}">
    </div>
    <div class="form-group col-6">
      <label for="address">Employee Address</label>
      <input type="text" class="form-control" id="address" name="address" value="{{ $data->address }}">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-4">
      <label for="phone">Gender<span class="text-danger">*</span></label>
       <select class="form-control" name="gender">
         <option value="Male" @if($data->gender=="Male") selected="" @endif>Male</option>
         <option value="Female" @if($data->gender=="Female") selected="" @endif>Female</option>
         <option value="Other" @if($data->gender=="Other") selected="" @endif>Other</option>
       </select>
    </div>
    <div class="form-group col-4">
      <label for="blood">Blood</label>
      <input type="text" class="form-control" id="blood" name="blood" value="{{ $data->blood }}">
    </div>
    <div class="form-group col-4">
      <label for="nid">Nid<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="nid" name="nid" required value="{{ $data->nid }}">
    </div>
  </div>
  <div class="row">
    <div class="form-group col-4">
      <label for="joining_date">Joining Date<span class="text-danger">*</span></label>
      <input type="date" class="form-control" id="joining_date" name="joining_date" value="{{ $data->joining_date }}">
    </div>
    <div class="form-group col-4">
      <label for="salary">Salary<span class="text-danger">*</span></label>
      <input type="text" class="form-control" id="salary" name="salary" required value="{{ $data->salary }}">
    </div>
    <div class="form-group col-4">
      <label for="status">Status<span class="text-danger">*</span></label>
        <select class="form-control" name="status" required>
         <option value="1" @if($data->status==1) selected="" @endif>Active</option>
         <option value="0" @if($data->status==0) selected="" @endif>Deactive</option>
       </select>
    </div>
  </div>
   <div class="form-group">
     <label for="exampleInputEmail1">Employee Photo<span class="text-danger">*</span></label>
      <input type="file" class="dropify" name="image" data-default-file="{{ asset('public/files/employee/'.$data->image) }}"/>
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
</script>
@extends('layouts.admin')
@section('admin_content')
  @push('css')
  @endpush
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card content-header" style="padding: 10px;">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Employee Manage</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('employee') }}">Employee</a></li>
              <li class="breadcrumb-item active">All Employee</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="card">
          <div class="card-header bg-dark">
             <button type="submit" class="btn btn-success btn-sm float-right" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus"></i> Add New</button>
            <h3 class="card-title">Employee Manage List</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline " role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th>Sl</th>
                          <th>Employee Id</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Department</th>
                          <th>Designation</th>
                          <th>Salary</th>
                          <th>Image</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row">
                          
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr role="row">
                          <th>Sl</th>
                          <th>Employee Id</th>
                          <th>Name</th>
                          <th>Phone</th>
                          <th>Department</th>
                          <th>Designation</th>
                          <th>Salary</th>
                          <th>Image</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    </table>
                    <form id="delete_form" action="" method="post">
                      @method('DELETE')
                      @csrf
                    </form>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div> 
      </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!--Add Modal -->
  <div class="modal fade loading_button" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Employee Insert</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('store.employee') }}" method="post" id="add_form">
          @csrf
            <div class="row">
              <div class="form-group col-6">
                <label for="exampleInputEmail1">Employee Id<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="employee_id" required >
              </div>
              <div class="form-group col-6">
                <label for="name">Employee Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-6">
                <label for="exampleInputEmail1">Department<span class="text-danger">*</span></label>
                <select class="form-control" name="department_id">
                  @foreach($department as $row)
                  <option value="{{ $row->id }}">{{ $row->department_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-6">
                <label for="exampleInputEmail1">Designation<span class="text-danger">*</span></label>
                <select class="form-control" name="designation_id">
                  @foreach($designation as $row)
                  <option value="{{ $row->id }}">{{ $row->designation_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-6">
                <label for="phone">Employee Phone<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phone" name="phone" required>
              </div>
              <div class="form-group col-6">
                <label for="address">Employee Address</label>
                <input type="text" class="form-control" id="address" name="address">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-4">
                <label for="phone">Gender<span class="text-danger">*</span></label>
                 <select class="form-control" name="gender">
                   <option value="Male">Male</option>
                   <option value="Female">Female</option>
                   <option value="Other">Other</option>
                 </select>
              </div>
              <div class="form-group col-4">
                <label for="blood">Blood</label>
                <input type="text" class="form-control" id="blood" name="blood">
              </div>
              <div class="form-group col-4">
                <label for="nid">Nid<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="nid" name="nid" required>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-4">
                <label for="joining_date">Joining Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="joining_date" name="joining_date">
              </div>
              <div class="form-group col-4">
                <label for="salary">Salary<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="salary" name="salary" required>
              </div>
              <div class="form-group col-4">
                <label for="status">Status<span class="text-danger">*</span></label>
                  <select class="form-control" name="status" required>
                   <option value="1">Active</option>
                   <option value="0">Deactive</option>
                 </select>
              </div>
            </div>
             <div class="form-group">
              <label for="exampleInputEmail1">Employee Photo<span class="text-danger">*</span></label>
              <input type="file" class="dropify" name="image" required data-default-file="url_of_your_file"/>
            </div>
            <button type="submit" class="btn btn-success float-right submit_button"><span class="loader d-none">....</span> Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Employee Update</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body" id="edit_part">
         
        </div>
      </div>
    </div>
  </div>
  @push('js')
  <script>
    //index data showing
    $(function employee(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('employee') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'employee_id' , name:'employee_id'},
          {data:'name' , name:'name'},
          {data:'phone' , name:'phone'},
          {data:'department_name' , name:'department_name'},
          {data:'designation_name' , name:'designation_name'},
          {data:'salary' , name:'salary'},
          {data:'image' , name:'image'},
          {data:'status' , name:'status'},
          {data:'action' , name:'action'},
        ]
      });
    });
    //add Form Submit
    $('#add_form').submit(function(e){
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
          $('#add_form')[0].reset();
          $('.loader').addClass('d-none');
          $('.submit_button').prop('type','submit');
          $('.dataTable').DataTable().ajax.reload();
          $('#addModal').modal('hide');
          $(".dropify-clear").trigger("click");
        }
      });
    });
    //edit request send
    $('body').on('click','.edit',function(){
      var id=$(this).data('id');
      var url="{{ url('admin/employee/edit') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          $('#edit_part').html(data);
        }
      })
    });
    //delete specific category
    $(document).ready(function(){
      $(document).on("click","#employee_delete",function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $("#delete_form").attr('action',url);
        swal({
          title: 'Are you went to Delete?',
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: 'warning',
          buttons: true,
          dangerMode:true,
        })
        .then((willDelete)=>{
          if (willDelete){
             $("#delete_form").submit();
          }else{
            swal('Safe Data!')
          }
        });
      });
      //Data passed through here
      $("#delete_form").submit(function(e){
        e.preventDefault();
         var url = $(this).attr('action');
         var request = $(this).serialize();
         $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
              toastr.error(data);
              $('#delete_form')[0].reset();
              $('.dataTable').DataTable().ajax.reload();
            }
         });
      });
    });
  </script>
  @endpush
@endsection
 
 
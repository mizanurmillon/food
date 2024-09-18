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
            <h3 class="m-0 text-dark">Leave Application</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('holiday') }}">Leave Application</a></li>
              <li class="breadcrumb-item active">All Leave Application</li>
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
            <h3 class="card-title">Leave Application List</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th>Sl</th>
                          <th>Employee</th>
                          <th>Leave Type</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Leave Days</th>
                          <th>Month</th>
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
                          <th>Employee</th>
                          <th>Leave Type</th>
                          <th>From</th>
                          <th>To</th>
                          <th>Leave Days</th>
                          <th>Month</th>
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
  <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Leave Application Insert</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body">
         <form method="post" action="{{ route('store.leave') }}" id="add_form">
          @csrf
            <div class="row">
              <div class="form-group col-6">
                <label for="exampleInputEmail1">Emplyee<span class="text-danger">*</span></label>
                <select class="form-control" name="employee_id" required>
                  @foreach($employee as $row)
                  <option value="{{ $row->id }}">{{ $row->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-6">
                <label for="exampleInputEmail1">Leave Type<span class="text-danger">*</span></label>
                <select class="form-control" name="leavetype_id">
                  @foreach($leavetype as $row)
                  <option value="{{ $row->id }}">{{ $row->type_name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-4">
                <label for="From">From<span class="text-danger">*</span></label>
                <input type="date" class="form-control start_date" id="From" name="start_date" required>
              </div>
              <div class="form-group col-4">
                <label for="to">To<span class="text-danger">*</span></label>
                <input type="date" class="form-control end_date" id="to" name="end_date" required>
              </div>
              <div class="form-group col-4">
                <label for="num_of_days">Total Days</label>
                <input type="text" class="form-control num_of_days" id="num_of_days" name="leave_day" readonly="">
              </div>
            </div>
            <div class="form-group">
                <label for="status">Status<span class="text-danger">*</span></label>
                <select class="form-control" name="status" required>
                  <option value="1">Approved</option>
                  <option value="3">Declined</option>
                  <option value="0">Pending</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success float-right"><span class="loader d-none">....</span> Submit</button>
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
          <h4 class="modal-title" id="exampleModalLabel">Leave Application Update</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body" id="edit_part">
         
        </div>
      </div>
    </div>
  </div>
  @push('js')
  <script type="text/javascript">

    function dataDiffInDays(date1, date2) {
      //round to the nearest whole number
      return Math.round((date2-date1)/(1000*60*60*24));
    }
    $(document).ready(function(){
      $('.end_date').on('change',function(e){
        var date1=$('.start_date').val();
        var date2=$('.end_date').val();
        var daysDiff=dataDiffInDays(new Date(date1) , new Date(date2));
        var totaldays=daysDiff+1;
        $('.num_of_days').val(totaldays);
      });
      $('.start_date').on('change',function(e){
        var date1=$('.start_date').val();
        var date2=$('.end_date').val();
        var daysDiff=dataDiffInDays(new Date(date1) , new Date(date2));
        var totaldays=daysDiff+1;
        $('.num_of_days').val(totaldays);
      });
    });

    //index data showing
    $(function Leave(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('leave') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'name' , name:'name'},
          {data:'type_name' , name:'type_name'},
          {data:'start_date' , name:'start_date'},
          {data:'end_date' , name:'end_date'},
          {data:'leave_day' , name:'leave_day'},
          {data:'month' , name:'month'},
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
      $.ajax({
        url:url,
        type:'post',
        async:false,
        data:request,
        success:function(data){
          toastr.success(data);
          $('#add_form')[0].reset();
          $('.loader').addClass('d-none');
          $('#addModal').modal('hide');
          $('.dataTable').DataTable().ajax.reload();
        }
      });
    });
    //edit request send
    $('body').on('click','.edit',function(){
      var id=$(this).data('id');
      var url="{{ url('admin/leave/edit') }}/"+id;
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
      $(document).on("click","#leave_delete",function(e){
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

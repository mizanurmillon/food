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
            <h3 class="m-0 text-dark">Pending Reservation</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('reservation') }}">Reservation</a></li>
              <li class="breadcrumb-item active">All Pending Reservation</li>
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
            <h3 class="card-title">Pending Reservation List</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th >Sl</th>
                          <th >Date</th>
                          <th >Month</th>
                          <th >Time</th>
                          <th >Name</th>
                          <th >People</th>
                          <th >Phone</th>
                          <th >Status</th>
                          <th >Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row">
                          
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr role="row">
                          <th >Sl</th>
                          <th >Date</th>
                          <th >Month</th>
                          <th >Time</th>
                          <th >Name</th>
                          <th >People</th>
                          <th >Phone</th>
                          <th >Status</th>
                          <th >Action</th>
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
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Reservation Insert</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body">
         <form method="post" action="{{ route('store.reservation') }}" id="add_form">
          @csrf
            <div class="form-group">
              <label for="date">Date<span class="text-danger">*</span></label>
              <input type="date" class="form-control" id="date" name="r_date" required>
            </div>
             <div class="form-group">
                <label for="timepiker">Time<span class="text-danger">*</span></label>
                <input type="time" class="form-control timepicker" required name="r_time">
            </div>
            <div class="form-group">
              <label for="name">Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="form-group">
              <label for="people">Person<span class="text-danger">*</span></label>
              <input type="number" min="1" class="form-control" id="people" name="people" required>
            </div>
            <div class="form-group">
              <label for="details">Details<span class="text-danger">*</span></label>
              <textarea class="form-control" name="details" id="details"></textarea>
            </div>
            <select class="form-control" name="status">
                <option value="Approved">Approved</option>
                <option value="Pending">Pending</option>
              </select>
            <button type="submit" class="btn btn-success float-right"><span class="loader d-none">....</span> Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Reservation Update</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body" id="edit_part">
         
        </div>
      </div>
    </div>
  </div>
  @push('js')
  <script type="text/javascript">
    //index data showing
    $(function Reservation(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('pending.reservation') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'r_date' , name:'r_date'},
          {data:'r_month' , name:'r_month'},
          {data:'r_time' , name:'r_time'},
          {data:'name' , name:'name'},
          {data:'people' , name:'people'},
          {data:'phone' , name:'phone'},
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
      var url="{{ url('admin/reservation/edit') }}/"+id;
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
      $(document).on("click","#reservation_delete",function(e){
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
    //submitable class call for evrey change
    $(document).on('change','.submitable',function(e){
      $('.dataTable').DataTable().ajax.reload();
    });

  </script>
  @endpush
@endsection

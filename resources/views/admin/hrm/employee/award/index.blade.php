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
            <h3 class="m-0 text-dark">Employee Awards</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('award') }}">Employee Award</a></li>
              <li class="breadcrumb-item active">All Employee Award</li>
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
            <h3 class="card-title">Employee Award</h3>
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
                          <th >Employee - ID</th>
                          <th >Award Name</th>
                          <th >Award</th>
                          <th >Date</th>
                          <th >Month</th>
                          <th >Year</th>
                          <th >Details</th>
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
                          <th >Employee - ID</th>
                          <th >Award Name</th>
                          <th >Award</th>
                          <th >Date</th>
                          <th >Month</th>
                          <th >Year</th>
                          <th >Details</th>
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
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Employee Award Insert</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body">
         <form method="post" action="{{ route('store.award') }}" id="add_form">
          @csrf
            <div class="row">
              <div class="form-group col-4">
                <label>Employee<span class="text-danger">*</span></label>
                <select class="form-control" name="employee_id">
                  @foreach($employee as $row)
                  <option value="{{ $row->id }}">{{ $row->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-4">
                <label for="name">Award Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="award_name" required>
              </div>
              <div class="form-group col-4">
                <label for="award">Award<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="award" name="award" required>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-4">
                <label for="exampleInputEmail1">Award Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="exampleInputEmail1" name="award_date" required >
              </div>
              <div class="form-group col-4">
                <label for="month">Award Month<span class="text-danger">*</span></label>
                <select class="form-control" name="award_month" id="month" required>
                  <option value="January">January</option>
                  <option value="February">February</option>
                  <option value="March">March</option>
                  <option value="April">April</option>
                  <option value="May">May</option>
                  <option value="June">June</option>
                  <option value="July">July</option>
                  <option value="August">August</option>
                  <option value="September">September</option>
                  <option value="Octeber">Octeber</option>
                  <option value="November">November</option>
                  <option value="December">December</option>
                </select>
              </div>
              <div class="form-group col-4">
                <label for="award_year">Award Year<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="award_year" name="award_year" value="{{ date('Y') }}" required>
              </div>
            </div>
              <div class="form-group">
                <label>Details<span class="text-danger">*</span></label>
                <textarea class="form-control" name="details"></textarea>
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
          <h4 class="modal-title" id="exampleModalLabel">Employee Award Update</h4>
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
    $(function Award(){
       table=$('.dataTable').dataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('award') }}",
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'name' , name:'name'},
          {data:'award_name' , name:'award_name'},
          {data:'award' , name:'award'},
          {data:'award_date' , name:'award_date'},
          {data:'award_month' , name:'award_month'},
          {data:'award_year' , name:'award_year'},
          {data:'details' , name:'details'},
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
      var url="{{ url('admin/award/edit') }}/"+id;
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
      $(document).on("click","#award_delete",function(e){
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

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
            <h3 class="m-0 text-dark">Employee Attendance</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('attendance.adjustment') }}">Employee Attendance</a></li>
              <li class="breadcrumb-item active">All Employee Attendance Adjustment</li>
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
            <h3 class="card-title">Employee Attendance Adjustment</h3>
          </div>
          <div class="ml-4 mt-4">
            <div class="row">
              <li class="list-group-item">Employee Name: {{ $user->name }}</li>
              <li class="list-group-item">Employee Id: {{ $user->employee_id }}</li>
              <li class="list-group-item">Phone: {{ $user->phone }}</li>
              <li class="list-group-item">Salary: {{ $user->salary }}</li>
            </div>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th >Employee - ID</th>
                          <th >Date</th>
                          <th >ClockIn</th>
                          <th >ClockOut</th>
                          <th >Month</th>
                          <th >Status</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($attendance as $row)
                            <tr role="row">
                              <td>{{ $user->name }} - {{ $user->employee_id }}</td>
                              <input type="hidden" name="employee_id" id="employee_id" value="{{ $user->id }}">
                              <td>{{ $row->date }}</td>
                              <td>
                                <input type="time" id="{{ $row->date }}" class="form-control form-control-sm clock_in" value="{{ $row->clock_in }}" name="clock_in"></td>
                              <td ><input type="time" id="{{ $row->date }}" class="form-control form-control-sm clock_out" value="{{ $row->clock_out }}" name="clock_out"></td>
                              <td>{{ $row->month }}</td>
                              <td>
                                @if($row->status=="Present")
                                  <span class="badge badge-success">Present</span>
                                @else
                                  <span class="badge badge-danger">Missing</span>
                                @endif
                              </td>
                            </tr>
                          @endforeach
                      </tbody>
                      <tfoot>
                        <tr role="row">
                          <th >Employee - ID</th>
                          <th >Date</th>
                          <th >ClockIn</th>
                          <th >ClockOut</th>
                          <th >Month</th>
                          <th >Status</th>
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
          <h4 class="modal-title" id="exampleModalLabel">Employee attendance insert</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body">
         <form method="post" action="{{ route('missing.attendance.store') }}" id="add_form">
          @csrf
            <div class="row">
              <div class="form-group col-6">
                <label>Employee<span class="text-danger">*</span></label>
                <select class="form-control" name="employee_id">
                  <option disabled="" selected="">---Choose Employee---</option>
                  @foreach($employee as $row)
                  <option value="{{ $row->id }}">{{ $row->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group col-6">
                <label for="date">Attendance Date<span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="date" name="date" required>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-6">
                <label for="time">Clock In<span class="text-danger">*</span></label>
                <input type="time" class="form-control" id="time" name="clock_in" required>
              </div>
              <div class="form-group col-6">
                <label for="clockOut">Clock Out<span class="text-danger">*</span></label>
                <input type="time" class="form-control" id="clockOut" name="clock_out" >
              </div>
            </div>
            <div class="row">
              <div class="form-group col-6">
                <label for="clock_in_note">ClockIn Note</label>
                <input type="text" class="form-control" id="clock_in_note" name="clock_in_note" placeholder="Optional">
              </div>
              <div class="form-group col-6">
                <label for="clock_note">ClockOut Note</label>
                <input type="text" class="form-control" id="clock_note" name="clock_out_note" placeholder="Optional">
              </div>
            </div>
            <button type="submit" class="btn btn-success float-right"><span class="loader d-none">....</span> Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  @push('js')
  <script type="text/javascript">
    
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
          if (!$.isEmptyObject(data.errorMsg)) {
              toastr.error(data.errorMsg);
              $('#add_form')[0].reset();
              $('.loader').addClass('d-none');
              $('#addModal').modal('hide');
            }else{
              toastr.success(data);
              $('#add_form')[0].reset();
              $('.loader').addClass('d-none');
              $('#addModal').modal('hide');
              window.location.reload();
            }
        }
      });
    });
    //clock in time change by ajax
    $('.clock_in').blur(function(e){
      e.preventDefault();
      var id = $("#employee_id").val();
      var date = $(this).attr('id');
      var clock_in = $(this).val();
      $.ajax({
        url:"{{ url('admin/attendance/clockin_change/') }}/"+id+'/'+date+'/'+clock_in,
        type:'get',
        async:false,
        success:function(data){
          toastr.success(data);
        }
      });
    });
    //clock out time change by ajax
    $('.clock_out').blur(function(e){
      e.preventDefault();
      var id = $("#employee_id").val();
      var date = $(this).attr('id');
      var clock_out = $(this).val();
      $.ajax({
        url:"{{ url('admin/attendance/clockout_change/') }}/"+id+'/'+date+'/'+clock_out,
        type:'get',
        async:false,
        success:function(data){
          toastr.success(data);
        }
      });
    });
  </script>
  @endpush
@endsection

@extends('layouts.admin')
@section('admin_content')
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Attendance Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('all.attendance') }}">Attendance</a></li>
                <li class="breadcrumb-item active">Attendance</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

    <!-- Main content -->
    <section class="content">
      <form  method="post" action="{{ route('personwise.attendance.store') }}" id="add_attendance_form">
        @csrf
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-md-6">
                    <label><b>Select Employee</b></label>
                      <select class="form-control form-control-sm selectpicker" name="employee_id" data-live-search="true" id="employee_id">
                        <option disabled selected> ==choose one== </option>
                        @foreach($employee as $row)
                          <option value="{{ $row->id }}">{{ $row->name }} - {{ $row->employee_id }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12">
                <h5 class="card-title">Employee List</h5>
              </div>
            </div>
            <br>
            <div class="create_attendance_tabel">
              <div class="table-responsive">
                <table class="table employee-datatable">
                  <thead class="bg-success">
                    <tr>
                      <th>Employee</th>
                      <th>Clock-In</th>
                      <th>Clock-Out</th>
                      <th>Clock In Note</th>
                      <th>Clock Out Note</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="attendance_row">
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-12">
              <button class="btn btn-success btn-sm float-right">Save</button>
              <button type="btn" class="btn loading_button float-right d-none"><i class="fas fa-spinner"><b>loading...</b></i></button>
            </div>
          </div>
      </form>
    </section>
  </div>
  @push('js')
    <script type="text/javascript">
      $(document).on('change','#employee_id',function(){
        var user_id = $(this).val();
        var name = $(this).data('name');
        var count = 0;

        $('.create_attendance_tabel table').find('tr').each(function() {
          if ($(this).data('user_id') == user_id) {
            count++;
          }
        });

        if (user_id && count==0) {
         $.ajax({
          url:"{{ url('admin/attendance/create/person/wise/row/') }}" + "/" + user_id,
          type:'get',
          success:function(data) {
            $('#attendance_row').append(data);
          }
         });
        }
      });
      $(document).on('click','.btn_remove',function(){
        $(this).closest('tr').remove();
      });

        //add attendance Form Submit
      $('#add_attendance_form').submit(function(e){
        e.preventDefault();
        $('.loading_button').removeClass('d-none');
        var url=$(this).attr('action');
        var request=$(this).serialize();
        $.ajax({
          url:url,
          type:'post',
          data:request,
          success:function(data){
            if (!$.isEmptyObject(data.errorMsg)) {
              toastr.error(data.errorMsg);
              $('.loading_button').addClass('d-none');
            }else{
              toastr.success(data);
              $('.loading_button').addClass('d-none');
              window.location = "{{ route('single.attendance') }}";
            }
          }
        });
      });
  </script>
  @endpush
@endsection
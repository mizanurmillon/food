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
                <li class="breadcrumb-item active">Attendance Adjustment</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

    <!-- Main content -->
    <section class="content">
      <form  method="GET" action="{{ route('adjustment.form') }}">
        @csrf
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group row">
                  <div class="col-md-4">
                    <label><b>Select Employee</b></label>
                      <select class="form-control form-control-sm selectpicker" name="employee_id" data-live-search="true" id="employee_id">
                        <option disabled selected> ==choose one== </option>
                        @foreach($employee as $row)
                          <option value="{{ $row->id }}">{{ $row->name }} - {{ $row->employee_id }}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="col-md-4">
                    <label><b>Month</b></label>
                      <select class="form-control form-control-sm" name="month" id="month">
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="september">september</option>
                        <option value="Octeber">Octeber</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                      </select>
                  </div>
                  <div class="col-md-4">
                    <label><b>Year</b></label>
                    <select class="form-control form-control-sm" name="year">
                      <option value="2021">2021</option>
                      <option value="2022">2022</option>
                      <option value="2023">2023</option>
                      <option value="2024">2024</option>
                      <option value="2025">2025</option>
                      <option value="2026">2026</option>
                      <option value="2027">2027</option>
                      <option value="2028">2028</option>
                      <option value="2029">2029</option>
                      <option value="2030">2030</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-md-12">
            <button class="btn btn-success btn-sm float-right">Save</button>
          </div>
        </div>
      </form>
    </section>
  </div>
  
@endsection
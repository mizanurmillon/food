@extends('layouts.admin')
@section('admin_content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card content-header" style="padding: 10px;">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">SMTP Setting</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">SMTP Setting</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
            <div class="card card-success">
            <div class="card-header">
            <h3 class="card-title">SMTP Setting Page</h3>
            </div>
            <form action="{{ route('smtp.setting.update',$smtp->id) }}" method="post">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>MAIL MAILER</label>
                  <input type="text" class="form-control" name="mail_mailer" value="{{ $smtp->mail_mailer }}">
                </div>
                <div class="form-group">
                  <label>MAIL HOST</label>
                  <input type="text" class="form-control" name="mail_host" value="{{ $smtp->mail_host }}">
                </div>
                <div class="form-group">
                  <label>MAIL PROT</label>
                  <input type="text" class="form-control" name="mail_port" value="{{ $smtp->mail_port }}">
                </div>
                <div class="form-group">
                  <label>MAIL USERNAME</label>
                  <input type="text" class="form-control" name="mail_username" value="{{ $smtp->mail_username }}">
                </div>
                <div class="form-group">
                  <label>MAIL PASSWORD</label>
                  <input type="password" class="form-control" name="mail_password" value="{{ $smtp->mail_password }}">
                </div>
                <div class="input-group-append">
                 <button type="submit" class="btn btn-success">Update</button>
                </div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
@endsection

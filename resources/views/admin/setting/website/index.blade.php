@extends('layouts.admin')
@section('admin_content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card content-header" style="padding: 10px;">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Website Setting</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Website Setting</li>
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
            <h3 class="card-title">Website Setting Page</h3>
            </div>
            <form action="{{ route('website.setting.update',$setting->id) }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label>Currency</label>
                   <select class="form-control" name="currency">
                    <option disabled="" selected="">--Select Currency--</option>
                    <option value="৳" {{ $setting->currency=='৳' ? 'selected="selected"' : '' }}>Taka(৳)</option>
                    <option value="$" {{ $setting->currency=='$' ? 'selected="selected"' : '' }}>USD($)</option>
                    <option value="₹" {{ $setting->currency=='₹' ? 'selected="selected"' : '' }}>Rupee(₹)</option>
                    <option value="€" {{ $setting->currency=='€' ? 'selected="selected"' : '' }}>Euro(€)</option>
                   </select>
                </div>
                <div class="form-group">
                  <label>Phone One</label>
                  <input type="text" class="form-control" name="phone_one" value="{{ $setting->phone_one }}">
                </div>
                <div class="form-group">
                  <label>Phone Two</label>
                  <input type="text" class="form-control" name="phone_two" value="{{ $setting->phone_two }}">
                </div>
                <div class="form-group">
                  <label>Main Email</label>
                  <input type="email" class="form-control" name="main_email" value="{{ $setting->main_email }}">
                </div>
                <div class="form-group">
                  <label>Support Email</label>
                  <input type="email" class="form-control" name="support_email" value="{{ $setting->support_email }}">
                </div>
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" name="address" value="{{ $setting->address }}">
                </div>
                <strong class="text-center text-info">--- Sociual Link ---</strong>
                <div class="form-group">
                  <label>Facebook</label>
                  <input type="text" class="form-control" name="facebook" value="{{ $setting->facebook }}">
                </div>
                <div class="form-group">
                  <label>Twitter</label>
                  <input type="text" class="form-control" name="twitter" value="{{ $setting->twitter }}">
                </div>
                <div class="form-group">
                  <label>Instagram</label>
                  <input type="text" class="form-control" name="instagram" value="{{ $setting->instagram }}">
                </div>
                <div class="form-group">
                  <label>Linkedin</label>
                  <input type="text" class="form-control" name="linkedin" value="{{ $setting->linkedin }}">
                </div>
                <div class="form-group">
                  <label>YouTube</label>
                  <input type="text" class="form-control" name="youtube" value="{{ $setting->youtube }}">
                </div>
                <strong class="text-center text-info">Logo & Favicon</strong>
                <div class="form-group">
                  <label>Main Logo</label>
                  <input type="file" class="form-control"  name="logo">
                  <input type="hidden" name="old_logo" value="{{ $setting->logo }}">
                </div>
                <div class="form-group">
                  <label>Favicon</label>
                  <input type="file" class="form-control" name="favicon">
                  <input type="hidden" name="old_favicon" value="{{ $setting->favicon }}">
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

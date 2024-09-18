@extends('layouts.admin')
@section('admin_content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card content-header" style="padding: 10px;">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Payment Gateway Setting</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
              <li class="breadcrumb-item active">Payment Setting</li>
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
          <div class="col-md-4">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Aamarpay Payment Gateway</h3>
              </div>
              <form action="{{ route('aamarpay.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $aamarpay->id }}">
                <div class="card-body">
                  <input type="hidden" name="id" value="1">
                  <div class="form-group">
                    <label for="id">StoreId</label>
                    <input type="text" id="id" class="form-control" value="{{ $aamarpay->store_id }}" name="store_id">
                  </div>
                  <div class="form-group">
                    <label for="key">Signature Key</label>
                    <input type="text" id="key" class="form-control" value="{{ $aamarpay->signature_key }}" name="signature_key">
                  </div>
                  <div class="form-group">
                    <input type="checkbox" id="box" name="status" value="1" @if($aamarpay->status==1) checked="" @endif>
                    <label for="box">Live Server</label> <small class="text-danger">(Your checkBox are not checked it working for sendbox only)</small>
                  </div>
                  <div class="input-group-append">
                   <button type="submit" class="btn btn-success">Update</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">SSL Commerz Payment Gateway</h3>
              </div>
              <form action="{{ route('ssl.update') }}" method="post">
                 @csrf
                  <input type="hidden" name="id" value="{{ $ssl->id }}">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="ssl">StoreId</label>
                      <input type="text" id="ssl" class="form-control" value="{{ $ssl->store_id }}" name="store_id">
                    </div>
                    <div class="form-group">
                      <label for="name">Signature Key</label>
                      <input type="text" id="name" class="form-control" value="{{ $ssl->signature_key }}" name="signature_key">
                    </div>
                    <div class="form-group">
                      <input type="checkbox" id="status" name="status" value="1" @if($ssl->status==1) checked="" @endif>
                      <label for="status">Live Server</label> <small class="text-danger">(Your checkBox are not checked it working for sendbox only)</small>
                    </div>
                    <div class="input-group-append">
                     <button type="submit" class="btn btn-success">Update</button>
                    </div>
                  </div>
              </form>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Surjopay Payment Gateway</h3>
              </div>
              <form action="{{ route('surjopay.update') }}" method="post">
                 @csrf
                  <input type="hidden" name="id" value="{{ $surjopay->id }}">
                  <div class="card-body">
                    <div class="form-group">
                      <label for="store">StoreId</label>
                      <input type="text" id="store" class="form-control" value="{{ $surjopay->store_id }}" name="store_id">
                    </div>
                    <div class="form-group">
                      <label for="surjopay">Signature Key</label>
                      <input type="text" id="surjopay" class="form-control" value="{{ $surjopay->signature_key }}" name="signature_key">
                    </div>
                    <div class="form-group">
                      <input type="checkbox" id="check" name="status" value="1" @if($surjopay->status==1) checked="" @endif>
                      <label for="check">Live Server</label> <small class="text-danger">(Your checkBox are not checked it working for sendbox only)</small>
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

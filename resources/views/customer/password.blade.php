@extends('layouts.app')

@section('content')
<div class="main__body">
    <div class="profile-inner">
        <div class="container">
            <div class="row pt-2">
                <div class="col-md-3 col-lg-3">
                    @include('customer.sideber')
                </div>
                <div class="col-md-9 col-lg-9 pt-3">
                    <div class="row">
                        <div class="col-lg-9 mt-2">
                            <div class="card p-4">
                                <h3 class="text-center">Password Change</h3>
                                <form action="{{ route('password.store') }}" method="post" style="text-align: left;">
                                    @csrf
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Old Password</label>
                                     <input type="password" name="old_password" required class="form-control" placeholder="Enter the old password">
                                  </div>
                                   <div class="form-group">
                                    <label for="exampleInputEmail1">New Password</label>
                                     <input type="password" name="password" required class="form-control @error('password') is-invalid @enderror" placeholder="Enter the new password">
                                     
                                        @error('password')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                        @enderror
                                  </div>
                                   <div class="form-group">
                                    <label for="exampleInputEmail1">Confrm  Password</label>
                                     <input type="password" name="password_confirmation" required class="form-control" placeholder="re-type password">
                                  </div>
                                  <button type="submit" class="btn btn-success btn-sm">Password Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
@endsection

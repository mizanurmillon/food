@extends('layouts.admin')
@section('admin_content')
	<div class="hold-transition login-page">
		<div class="login-logo">
		    <a href="../../index2.html"><b>Admin</b>Panel</a>
		</div>
  		<!-- /.login-logo -->
	  	<div class="card">
		    <div class="card-body login-card-body">
		      <p class="login-box-msg">Admin Login Panel</p>

		      <form action="{{ route('login') }}" method="post">
		      	@csrf
		      		@if(session('error'))
		               <strong class="text-danger">{{ session('error') }}</strong>
		            @endif
		            @error('email')
		                <span class="invalid-feedback" role="alert">
		                    <strong>{{ $message }}</strong>
		                </span>
		            @enderror
		        <div class="input-group mb-3">
		          <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-envelope"></span>
		            </div>
		          </div>
		        </div>
		        	@error('password')
			            <span class="invalid-feedback" role="alert">
			                <strong>{{ $message }}</strong>
			            </span>
			        @enderror
		        <div class="input-group mb-3">
		          <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-lock"></span>
		            </div>
		          </div>
		        </div>
		        <div class="row">
		          <div class="col-8">
		            <div class="icheck-primary">
		              <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
		              <label for="remember">
		                Remember Me
		              </label>
		            </div>
		          </div>
		          <!-- /.col -->
		          <div class="col-4">
		            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
		          </div>
		          <!-- /.col -->
		        </div>
		      </form>

		      <p class="mb-1">
		        <a href="forgot-password.html">I forgot my password</a>
		      </p>
		    </div>
	    <!-- /.login-card-body -->
	  	</div>
	</div>
@endsection
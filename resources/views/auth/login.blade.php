@extends('layouts.app')

@section('content')
<!-- ===============================SLIDER SECTION START============== -->
            <div class="container__1">
                <div class="forms__container">
                    <div class="signin__signup">
                        <form action="{{ route('login') }}" class="sign__in__form" method="post">
                            @csrf
                            <h2 class="title__1">Sign in</h2>
                            <div class="input__field__login">
                                <i class="fas fa-user"></i>
                                <input type="email" name="email" placeholder="Enter Email Address" required class="@error('email') is-invalid @enderror" value="{{ old('email') }}" />
                            </div>
                            @if(session('error'))
                               <strong class="text-danger">{{ session('error') }}</strong>
                            @endif
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="input__field__login">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" placeholder="Enter The Password" required class=" @error('password') is-invalid @enderror" />
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label style="float: left;" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <input type="submit" value="Login" class="btn-main" />
                            <p class="social__text">Or Sign in with social platforms</p>
                            <div class="social__media">
                                <ul class="banner__social">
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </form>


                        <form action="{{ route('register') }}" method="post" class="sign__up__form">
                            @csrf
                            <h2 class="title">Sign up</h2>
                            <div class="input__field__login">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" class="@error('name') is-invalid @enderror" placeholder="Username" required />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input__field__login">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" required class="@error('name') is-invalid @enderror" placeholder="Email"/>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input__field__login">
                                <i class="fa fa-phone"></i>
                                <input type="text" name="phone" required class="@error('phone') is-invalid @enderror" placeholder="Phone"/>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="input__field__login">
                                <i class="fas fa-lock"></i>
                                <input type="password" name="password" required class="@error('password') is-invalid @enderror" placeholder="Password" />
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="submit" class="btn-main" value="Sign up" />
                            <p class="social__text">Or Sign up with social platforms</p>
                            <div class="social__media">
                                <ul class="banner__social">
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a class="icon social__icon" target="_blank" href="#"><i class="fab fa-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panels__container">
                    <div class="panel left__panel">
                        <div class="content">
                            <h3 class="white__title">New here to go sing up?</h3>
                            <p>
                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Debitis, ex ratione. Aliquid!
                            </p>
                            <button class="btn-black" id="sign-up-btn">
                        Sign up
                      </button>
                        </div>
                        <img src="img/product/8.png" class="image-T" alt="" />
                    </div>
                    <div class="panel right__panel">
                        <div class="content">
                            <h3 class="white__title">You are registared ?</h3>
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum laboriosam ad deleniti.
                            </p>
                            <button class="btn-black" id="sign-in-btn">
                        Sign in
                      </button>
                        </div>
                        <img src="img/product/9.png" class="image-T" alt="" />
                    </div>
                </div>
            </div>

@endsection

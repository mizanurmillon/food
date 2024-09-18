@extends('layouts.app')
@section('content')
@push('css')
@endpush
 
    <!-- ===============================SLIDER SECTION START============== -->
    <section>
        <div class="page-top-baner">
            <div class="banner-sec-bg custom-padding">
                <div class="row">
                    <div class="page-head-ban">
                        <div class="page-text">
                            <h1>
                                Checkout
                            </h1>
                            <P>Home - <span class="page-name">Checkout</span></P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =====================================SHOPING PROGRESS============= -->
    <section>
        <div class="progress-bar-wrapper">
            <ul class="order-pg">
                <li class="active">Your Details</li>
                <li class="active">Your Cart</li>
                <li>Checkout</li>
                <li>Next Steps</li>
            </ul>
        </div>
    </section>
    <!-- =====================================SHOPING PROGRESS END============= -->
    <!-- ===================================ORDER INFORMATION FORM =============== -->

    <section>
        <div class="checkout-info-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <div class="billing-details">
                            <h4 class="form-head">
                                Returning customer? <a href="{{ route('login') }}"> Click here to login</a>
                            </h4>
                            <form class="form-checkout" name="form" method="post">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h5 class="form-head mb-3">Billing Details</h5>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <input type="text" class="form-input" name="txt" placeholder="First Name">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <input type="text" class="form-input" name="txt" placeholder="Last Name">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" class="form-input" name="txt" placeholder="Company Name">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <input type="email" class="form-input" name="email" placeholder="Email">
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <input type="text" class="form-input" name="text" placeholder="Phone">
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea class="form-input-text" rows="5" placeholder="Address"></textarea>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 checkbx">
                                        <input type="checkbox" class="check-form">
                                        <label for="create-accounr">Create an account</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 mt-4">
                                        <h5 class="spa">Shipping Address</h5>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12 mt-2 mb-4 checkbx">
                                        <input type="checkbox" class="check-form">
                                        <label for="create-accounr">Ship to a different address ?</label>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea class="form-input-text" rows="5" placeholder="Order Notes"></textarea>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="shop-checkout-right">
                            <div class="shop-checkout-box">
                                <h5>YOUR ORDER</h5>
                                <div class="shop-checkout-title">
                                    <h6>PRODUCT <span>TOTAL</span></h6>
                                </div>
                                <div class="shop-checkout-row">
                                    @foreach($content as $row)
                                    <p><span>{{ $row->name }}</span> x {{ $row->qty }} <small>{{ $setting->currency }}{{ $row->qty * $row->price }}</small></p>
                                    @endforeach
                                </div>
                                <div class="checkout-total">
                                    <h6>CART SUBTOTAL <small>{{ $setting->currency }}{{ Cart::subtotal() }}</small></h6>
                                </div>
                                @if(Session::has('coupon'))
                                    <div class="checkout-total">
                                        <h6>Coupon ({{ Session('coupon')['name'] }})<small>{{ $setting->currency }}{{ Session('coupon')['discount'] }} <a href="{{ route('remove.coupon') }}" class="text-danger" style="padding-left: 10px;"><i class="fa fa-trash text-danger"></i></a></small></h6>
                                    </div>
                                @else
                                @endif
                                 <div class="checkout-total">
                                    <h6>Text<small>5.00%</small></h6>
                                </div>
                                <div class="checkout-total">
                                    <h6>SHIPPING <small>Free Shipping</small></h6>
                                </div>
                                <div class="checkout-total">
                                    <h6>ORDER TOTAL <small class="price-big">{{ $setting->currency }}{{ Cart::total() }}</small></h6>
                                </div>
                            </div>
                            @if(!Session::has('coupon'))
                                <div class="mb-3">
                                    <form action="{{ route('coupon.apply') }}" method="post">
                                        @csrf
                                        <div class="coupon field_form input-group">
                                            <input type="text" name="coupon" class="form-control" placeholder="Enter Coupon Code.." autocomplete="off">
                                            <div class="input-group-append">
                                                <button class="btn btn-default btn-sm" type="submit">Apply Coupon</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                            @endif
                            <div class="shop-checkout-box">
                                <h5>PAYMENT METHODS</h5>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" checked id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Direct Bank Transfer
                                    </label>
                                </div>
                                <p class="payment-instaction">Make your payment directly into our bank account. Please use your cleared in our account.</p>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault11">
                                    <label class="form-check-label" for="flexRadioDefault11">
                                        Check Payments
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault13">
                                    <label class="form-check-label" for="flexRadioDefault13">
                                        Cash on Delivery
                                    </label>
                                </div>
                                <div class="payment-mode">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault14">
                                    <label class="form-check-label" for="flexRadioDefault14">
                                        PayPal
                                    </label>
                                    <a href="#"><img src="{{ asset('public/frontend') }}/img/icon/paycart.png" alt=""></a><a href="#">What is PayPal?</a>
                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 mt-2 mb-4 checkbx">
                                    <input type="checkbox" class="check-form">
                                    <label for="create-accounr">Ship to a different address ?</label>
                                </div>


                                <div class="checkout-button">
                                    <button class="btn-main">PROCEED TO PAYMENT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===================================ORDER INFORMATION FORM END=============== -->



    
@push('js')
@endpush
@endsection

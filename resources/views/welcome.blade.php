@extends('layouts.app')

@section('content')
@push('css')
@endpush
@include('layouts.front_partial.slider')
<!-- ===============================CATEGORY SLIDER=================== -->
    <section>
        <div class="categroy-sec">
            <div class="category-inner">
                <div class="container-fluid">
                    <div class="baner-slider owl-carousel owl-theme">
                        @foreach($subcategory as $row)
                        <div class="item ">
                            <div class="cat-item-inner ">
                                <a href="#" class="cat-link ">
                                    <!-- Please your category image here -->
                                    <img src="{{ asset('public/files/subcategory/'.$row->image) }}" alt="Image not Found" class="category-img img-fluid">
                                    <div class="cat-name">
                                        <p>{{ $row->subcategory_name }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- banar slider end -->
                </div>
                <!-- container-fluid end -->
            </div>
            <!-- category inner end -->
        </div>
        <!-- catagory sec end -->
    </section>
    <!-- ===============================CATEGORY SLIDER END=============== -->
    <!-- =================================BANNER SECTION START============= -->
    <section>
        <div class="banner-content">
            <div class="container-fluid">
                <div class="banner-sec-bg custom-padding">
                    <div class="banner-inner">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 col-sm-6 my-2">
                                <div class="baner">
                                    <div class="baner-text">
                                        <h3>Organic Food</h3>
                                        <p>100% Pure Natural Food </p>
                                        <em class="shop-now"><a href="">Shop Now</a></em>
                                    </div>
                                    <div class="banar-image">
                                        <!-- Banar image are insert here -->
                                        <img src="{{ asset('public/frontend') }}/img/product/gallery_image1-min-1-768x768.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 my-2">
                                <div class="baner">
                                    <div class="baner-text">
                                        <h3>Fresh First Food</h3>
                                        <p>100% Pure Natural Food </p>
                                        <em class="shop-now"><a href="">Shop Now</a></em>
                                    </div>
                                    <div class="banar-image">
                                        <!-- Banar image are insert here -->
                                        <img src="{{ asset('public/frontend') }}/img/product/gallery_image5-min-768x768.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 my-2">
                                <div class="baner">
                                    <div class="baner-text">
                                        <h3>Organic Food</h3>
                                        <p>100% Pure Natural Food </p>
                                        <em class="shop-now"><a href="">Shop Now</a></em>
                                    </div>
                                    <div class="banar-image">
                                        <!-- Banar image are insert here -->
                                        <img src="{{ asset('public/frontend') }}/img/product/gallery_image2-min-1-768x768.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Row end -->
                    </div>
                    <!-- Banner Inner end -->
                </div>
                <!-- Banner Sec Bg end  -->
            </div>
            <!-- Container end -->
        </div>
        <!-- Banner Content -->
    </section>
    <!-- =================================BANNER SECTION END============= -->
    <!-- =================================TOP RECIPES SECTION START============= -->
    <section>
        <div class="top-recipes">
            <div class="top-recipes-bg">
                <div class="container-fluid custom-padding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="paralex">
                                <img src="{{ asset('public/frontend') }}/img/icon/banner_image_2.png" alt="" class="icon-plx" id="top-recipes-top">
                                <img src="{{ asset('public/frontend') }}/img/icon/—Pngtree—fast food chicken drumstick fried_5746705.png" alt="" class="icon-plx-2" id="top-recipes-left">
                            </div>
                            <div class="top-recipes-inner">
                                <div class="recipes-head">
                                    <h2>Top Recipes</h2>
                                    <a href="">See All <span class="fas fa-long-arrow-alt-right"></span></a>
                                </div>
                                <div class="row">
                                    @foreach($tops as $top)
                                    <div class="col-md-4 col-sm-4 col-12">
                                        <div class="product-list-inner">
                                            <div class="recipes-image">
                                                <img src="{{ asset('public/files/food/'.$top->image) }}" alt="Image not found">
                                            </div>
                                            <div class="recipes-details">
                                                <a href="{{ route('food.details',$top->slug) }}">
                                                    <h5>{{ $top->food_name }}</h5>
                                                </a>
                                                <div class="cat-name-top-recipes">{{ $top->subcategory_name }}</div>
                                                <p class="price">
                                                    @if($top->discount_price>0)
                                                    <del>{{ $setting->currency }} {{ $top->price }}</del> {{ $setting->currency }} {{ $top->discount_price }}
                                                    @else
                                                       {{ $setting->currency }} {{ $top->price }}
                                                    @endif
                                                </p>

                                                <div class="buy-sec">
                                                    <ul class="buy-inner">
                                                        <li>
                                                            <a href="javascript:void(0)" data-id="{{ $top->id }}" class="cart-btn wishlist"><span class="fas fa-heart"></span></a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" data-id="{{ $top->id }}" class="cart-btn quickview" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="fas fa-eye"></span></a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:void(0)" id="add_cart" class="cart-btn" data-id={{ $top->id }}><span class="fas fa-shopping-cart"></span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- row end -->
                </div>
                <!-- container-fluid end-->
            </div>
            <!-- top recipes-bg end-->
        </div>
        <!-- top-recipes end  -->
    </section>
    <!-- =================================TOP RECIPES SECTION END============= -->
    <!-- =================================DISCOUNT SECTION START============= -->
    <section>
        <div class="discount-bg">
            <div class="container-fluid custom-padding">
                <div class="discount-inner">
                    <div class="row">
                        <div class="col-md-6 text-section">
                            <div class="timer-sec">
                                <h1 class="dis-head">Special Discount For All Food Products</h1>
                                <p class="dis-details">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus blandit massa enim Nullam nunc varius.</p>

                                <div class="timer">
                                    <ul id="example">
                                        <li>
                                            <h1 class="days">00</h1>
                                            <p class="days_text">Days</p>
                                        </li>
                                        <li class="seperator">:</li>
                                        <li>
                                            <h1 class="hours">00</h1>
                                            <p class="hours_text">Hours</p>
                                        </li>
                                        <li class="seperator">:</li>
                                        <li>
                                            <h1 class="minutes">00</h1>
                                            <p class="minutes_text">Minutes</p>
                                        </li>
                                        <li class="seperator">:</li>
                                        <li>
                                            <h1 class="seconds">00</h1>
                                            <p class="seconds_text">Seconds</p>
                                        </li>
                                    </ul>

                                    <a href="" class="btn-main">Order Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 discount-img-sec">
                            <img src="{{ asset('public/frontend') }}/img/product/barger.png" alt="" class="discount-img">
                        </div>
                    </div>
                </div>
                <!-- discount inner end -->
            </div>
            <!-- container end  -->
        </div>
        <!-- discount bg end  -->
    </section>
    <!-- =================================DISCOUNT SECTION END============= -->
    <!-- =================================PRODUCT SECTION START============= -->
    <section>
        <div class="product-bg">
            <div class="paralex">
                <img src="{{ asset('public/frontend') }}/img/icon/shape33.png" alt="" class="icon-plx-4" id="paralex-pd">
                <img src="{{ asset('public/frontend') }}/img/icon/shape29.png" alt="" class="icon-plx-5" id="paralex-pd-there">
                <img src="{{ asset('public/frontend') }}/img/icon/shape26.png" alt="" class="icon-plx-6" id="paralex-pd-for">
                <img src="{{ asset('public/frontend') }}/img/icon/shape32.png" alt="" class="icon-plx-3" id="paralex-pd-tow">
            </div>
            <div class="container-fluid custom-padding">
                <div class="row">
                    <div class="section-head">
                        <h2>All Product</h2>
                    </div>
                </div>
                <!-- section  heading row end-->
                <div class="row">
                    <div class="col-lg-12">
                        <ul class="portfolio__menu">
                            <li><button class="menu active" type="button" data-filter="all">all Product</button></li>
                            @foreach($subcategory as $sub)
                            <li><button class="menu" type="button" data-filter=".product-{{ $sub->id }}">{{ $sub->subcategory_name }}</button></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- product category row end -->
                
                <div class="product">
                    <div class="row product-menu">
                        @foreach($catwise_product as $row)
                        <div class="col-md-3 col-sm-6 my-2 col-12 mix product-{{ $row->subcategory_id }}">
                            <div class="product-inner">
                                <div class="pruct-img-sec">
                                    <div class="product-img">
                                        <img src="{{ asset('public/files/food/'.$row->image ) }}" alt="Image not found" class="pd-image">
                                    </div>
                                    <div class="product-details">
                                        {{-- <div class="rating">
                                            <ul>
                                                @if(intval($sum_rating/$count_rating=5))
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    @elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) < $count_rating)
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    @elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) < $count_rating)
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    @elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) < $count_rating)
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    @else
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    @endif
                                                @endif
                                            </ul>
                                        </div> --}}
                                        <a href="{{ route('food.details',$row->slug) }}" class="product-name">
                                            <h5>{{ $row->food_name }}</h5>
                                        </a>
                                        <p class="price pt-2">
                                            @if($row->discount_price>0)
                                            <del>{{ $setting->currency }} {{ $row->price }}</del> {{ $setting->currency }} {{ $row->discount_price }}
                                            @else
                                               {{ $setting->currency }} {{ $row->price }}
                                            @endif
                                        </p>

                                        <div class="buy-sec pd-inside">
                                            <ul class="buy-inner">
                                                <li>
                                                    <a href="javascript:void(0)" data-id="{{ $row->id }}" class="cart-btn wishlist"><span class="fas fa-heart"></span></a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" data-id="{{ $row->id }}" class="cart-btn quickview" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="fas fa-eye"></span></a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" id="add_cart" class="cart-btn" data-id={{ $row->id }}><span class="fas fa-shopping-cart"></span></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- product end  -->
            </div>
            <!-- container end -->
        </div>
        <!-- product-bg end -->
    </section>
    <!-- =================================PRODUCT SECTION END============= -->
            <!-- ============LIFE JEARNY========= -->
            <section>
                <div class="jearny-bg">
                    <div class="bg-filter">
                        <div class="container-fluid custom-padding">
                            <div class="jearny-center">
                                <div class="col-md-10">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <div class="product-jearny-bg">
                                                <img src="{{ asset('public/frontend') }}/img/icon/pizza.svg" alt="">
                                                <div class="jearny-cotent">
                                                    <div class="">
                                                        <h2>530+</h2>
                                                        <p class="juarny-des">pizza</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <div class="product-jearny-bg">
                                                <img src="{{ asset('public/frontend') }}/img/icon/burger.svg" alt="">
                                                <div class="jearny-cotent">
                                                    <div class="">
                                                        <h2>180+</h2>
                                                        <p class="juarny-des">burger</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6 mb-3">
                                            <div class="product-jearny-bg">
                                                <img src="{{ asset('public/frontend') }}/img/icon/drink.svg" alt="">
                                                <div class="jearny-cotent">
                                                    <div class="">
                                                        <h2>250+</h2>
                                                        <p class="juarny-des">drink</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ============LIFE JARNY END========= -->


            <!-- ==================CHEFC===== -->
            <section>
                <div class="chefc-sec my-5">
                    <div class="container-fluid custom-padding">
                        <div class="row">
                            <div class="section-head mb-5">
                                <h2>Our Team</h2>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="chefc-slider owl-carousel owl-theme">
                                <div class="item">
                                    <div class="chefc-card ">
                                        <div class="chefc-img-div" data-bs-toggle="modal" data-bs-target="#chefc">
                                            <div class="img-view">
                                                <img src="{{ asset('public/frontend') }}/img/chefc/chefc-1.jpg" alt="" class="chefc-img">
                                            </div>
                                            <div class="view-info">
                                                <p>View Details</p>
                                            </div>
                                        </div>
                                        <div class="chefc-des">
                                            <h3 class="chefc-name">Andy Moore</h3>
                                            <p class="title">
                                                MASTER CHEF IN BROOKLIN
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="chefc-card ">
                                        <div class="chefc-img-div" data-bs-toggle="modal" data-bs-target="#chefc">
                                            <div class="img-view">
                                                <img src="{{ asset('public/frontend') }}/img/chefc/2 (1).jpg" alt="" class="chefc-img">
                                            </div>
                                            <div class="view-info">
                                                <p>View Details</p>
                                            </div>
                                        </div>
                                        <div class="chefc-des">
                                            <h3 class="chefc-name">Royce N. Burton</h3>
                                            <p class="title">
                                                MASTER CHEF IN BROOKLIN
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="chefc-card ">
                                        <div class="chefc-img-div" data-bs-toggle="modal" data-bs-target="#chefc">
                                            <div class="img-view">
                                                <img src="{{ asset('public/frontend') }}/img/chefc/1 (1).jpg" alt="" class="chefc-img">
                                            </div>
                                            <div class="view-info">
                                                <p>View Details</p>
                                            </div>
                                        </div>
                                        <div class="chefc-des">
                                            <h3 class="chefc-name">Jesse M. Wise</h3>
                                            <p class="title">
                                                MASTER CHEF IN BROOKLIN
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="chefc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="fs-wrapper">
                                                <div class="row">
                                                    <div class="col-md-6 my-2">
                                                        <div class="chegc-image">
                                                            <img src="{{ asset('public/frontend') }}/img/chefc/1.jpg" alt="Image not found">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 my-2">
                                                        <div class="chefc-details">
                                                            <h1 class="chefc-name">Jesse M. Wise</h1>
                                                            <p class="chefc-title">
                                                                MASTER CHEF IN BROOKLIN
                                                            </p>

                                                            <p class="long-description">
                                                                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat. Xillum dolore eu fugiat nulla pariatur. olore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                                            </p>

                                                            <h5 class="find">Find on Social:</h5>
                                                            <ul class="chefc-social">
                                                                <li><a href="" class="social-link"><span class="fab fa-facebook-f"></span></a></li>
                                                                <li><a href="" class="social-link"><span class="fab fa-twitter"></span></a></li>
                                                                <li><a href="" class="social-link"><span class="fab fa-instagram"></span></a></li>
                                                                <li><a href="" class="social-link"><span class="fab fa-pinterest"></span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="success-wrapper"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
            <!-- ==================CHEFC END===== -->

            <!-- =================================CLIENT REVIEWS START============= -->
            <section>
                <div class="client-bg">
                    <div class="container-fluid custom-padding">
                        <div class="row">
                            <div class="section-head mb-5">
                                <h2>What your client says</h2>
                            </div>
                        </div>
                        <!-- row end -->
                        <div class="client-body">
                            <div class="row">
                                <div class="client-reviews  owl-carousel owl-theme">
                                    @foreach($clientsay as $row)
                                    <div class="client-body item">
                                        <div class="column-item elementor-testimonial-item">
                                            <div class="item-box">
                                                <div class="top">
                                                    <div class="details">
                                                        <div class="avatar">
                                                            <div class="elementor-testimonial-image">
                                                                <img src="{{ asset('public/frontend') }}/img/user/avatar-1.jpg" class="attachment-full size-full lazyloaded" alt="">
                                                                <i aria-hidden="true" class="fas fa-quote-left"></i></div>
                                                        </div>
                                                        <div class="info">
                                                            <div class="name">{{ $row->name }}</div>
                                                            <div class="job">Customer</div>
                                                        </div>
                                                    </div>

                                                    <div class="elementor-testimonial-rating">
                                                        @if($row->rating==1)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        @elseif($row->rating==2)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        @elseif($row->rating==3)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="far fa-star"></i>
                                                        <i class="far fa-star"></i>
                                                        @elseif($row->rating==4)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="far fa-star"></i>
                                                        @elseif($row->rating==5)
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        <i class="fas fa-star active"></i>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="content"> "{{ $row->message }}"</div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>

                            </div>
                        </div>
                        <!-- cliend body end  -->
                    </div>
                    <!-- container end -->
                </div>
                <!-- client-bg end -->
            </section>
            <!-- =================================CLIENT REVIEWS END============= -->
            <!--quick view Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body quickview_body">
                    
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script type="text/javascript">
            //add wishlist
            $('body').on('click','.wishlist',function(){
              var id=$(this).attr('data-id');
              $.ajax({
                url: "{{ url('/add-to-wishlist/') }}/"+id,
                type:'get',
                success:function(data){
                 if(data.error) {
                    toastr.error(data.error);
                 }else{
                    toastr.success(data.success);
                 }
                }
              })
            });
            //add cart
            $('body').on('click','#add_cart',function(){
              var id=$(this).attr('data-id');
              $.ajax({
                url: "{{ url('/add-to-cart/') }}/"+id,
                type:'get',
                success:function(data){
                    toastr.success(data);
                    cart();
                    location.reload();
                }
              })
            });
            //add Quickview----
            $('body').on('click','.quickview',function(){
              var id=$(this).attr('data-id');
              $.ajax({
                url: "{{ url('/quick-view-product/') }}/"+id,
                type:'get',
                success:function(data){
                  $('.quickview_body').html(data);
                }
              })
            });
        </script>
    @endpush
@endsection
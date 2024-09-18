@extends('layouts.app')
@section('content')
	@push('css')
	@endpush
    @php
    $sum_rating=App\Models\Admin\Comment::where('food_id',$s_food->id)->sum('rating');
    $count_rating=App\Models\Admin\Comment::where('food_id',$s_food->id)->count('rating');
    @endphp
	<!-- =======================================PRODUCT VIEW SECTION START=========== -->
    <div class="single-pd-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="sp-loading"><img src="img/sp-loading.gif" alt=""><br>LOADING IMAGES</div>
                    <div class="sp-wrap">
                        <a href="{{ asset('public/files/food/'.$s_food->image) }}"><img src="{{ asset('public/files/food/'.$s_food->image) }}" alt="{{ $s_food->food_name }}"></a>
                        <a href="{{ asset('public/files/food/'.$s_food->image) }}"><img src="{{ asset('public/files/food/'.$s_food->image) }}" alt="{{ $s_food->food_name }}"></a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="product-details">
                        <h2 class="product-name-single">
                           {{ $s_food->food_name }}
                        </h2>
                        <div class="pr-rt">
                            <p class="price pt-2">
                                @if($s_food->discount_price>0)
                                <del>{{ $setting->currency }} {{ $s_food->price }}</del> {{ $setting->currency }} {{ $s_food->discount_price }}
                                @else
                                   {{ $setting->currency }} {{ $s_food->price }}
                                @endif
                            </p>
                            <div class="rating">
                                <ul>
                                    @if($sum_rating != NULL)
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
                            </div>
                        </div>
                    </div>
                    <hr>
                    <p class="product-descriotion">
                        {{ $s_food->description }}
                    </p>
                    <hr>
                    <form action="{{ route('add.cart') }}" method="post" id="s_add_cart">
                        @csrf
                        <div class="cart_extra">
                            <input type="hidden" name="id" value="{{ $s_food->id }}">
                            @if($s_food->discount_price==NULL)
                               <input type="hidden" name="price" value="{{ $s_food->price }}">
                            @else
                                <input type="hidden" name="price" value="{{ $s_food->discount_price }}">
                            @endif
                            <div class="cart-product-quantity">
                                <div class="quantity">
                                    <button class="qty-count qty-count--minus minus" data-action="minus" type="button">-</button>
                                    <input class="product-qty qty" type="text" name="quantity" min="0" max="10" value="1" title="Qty" size="4">
                                    <button class="qty-count qty-count--add plus" data-action="add" type="button">+</button>
                                </div>
                            </div>
                            <div class="cart_btn">
                                <button class="btn-main" type="submit">Add to cart</button>
                                <a href="javascript:void(0)" data-id="{{ $s_food->id }}" class="add_wishlist wishlist"><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                    </form>
                    <ul class="product-meta list_none">
                        <li>Category: <a href="#">{{ $s_food->category_name }}</a>, <a href="#">{{ $s_food->subcategory_name }}</a></li>
                    </ul>
                    <div class="lh-social-share d-flex">
                        <p class="share">Share:</p>
                        <ul class="social-ul d-flex">
                            <li><a href="" class="social-link"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="" class="social-link"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="" class="social-link"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="" class="social-link"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="" class="social-link"><i class="fab fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                    <div class="brand-wrap">
                        <h5 class="title-brand">Guaranteed Safe Checkout</h5>
                        <img src="https://demo2wpopal.b-cdn.net/poco/wp-content/uploads/2020/08/trust-symbols.png" data-src="" class="image-responsive lazyloaded">
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- =======================================PRODUCT VIEW SECTION END=========== -->


    <!-- ========================================REVIEW SECTION DESIGN START============= -->

    <section>
        <div class="comment-bg">
            <div class="container-fluid custom-padding">
                <div class="row">
                    <div class="col-md-6">

                        <!-- comments container -->
                        <div class="comment_block">
                            <!-- new comment -->
                            <div class="new_comment">
                                <h2>COMMENTS ({{ $count_rating }})</h2>
                                <ul class="user_comment">
                                    @foreach($comment as $row)
                                    <li class="comments">
                                        <div class="comment_toolbar">
                                            <div class="comment_details">
                                                <ul>
                                                    <div class="user_avatar">
                                                        <img src="{{ asset('public/frontend') }}/img/blog/welcome_image1.png">
                                                    </div>
                                                    <div class="image-name">
                                                        <li><i class="fa fa-pencil"></i> <span class="user">{{ $row->user->name }}</span></li>
                                                        <div class="date-time">
                                                            <li><i class="fa fa-calendar"></i> {{ date('d F , Y'), strtotime($row->comment_date) }}</li>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="rating">
                                                <ul>
                                                    @if($row->rating==5)
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    @elseif($row->rating==4)
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    @elseif($row->rating==3)
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="fas fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    <li><span class="far fa-star"></span></li>
                                                    @elseif($row->rating==2)
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
                                                </ul>
                                            </div>

                                        </div>
                                        <div class="comment_body">
                                            <p>{{ $row->comment }}</p>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>

                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="comment-form">
                            <h2 class="sm-head">WRITE YOUR COMMENT</h2>
                            <form class="contact__form" action="{{ route('comment') }}" method="post">
                                @csrf 
                                <input type="hidden" name="food_id" value="{{ $s_food->id }}">
                                <div class="input__field mt-4">
                                    <select class="form-control" style="width:96%;" name="rating">
                                        <option disabled="" selected="">Selsct Rating</option>
                                        <option value="1">1 Star</option>
                                        <option value="2">2 Star</option>
                                        <option value="3">3 Star</option>
                                        <option value="4">4 Star</option>
                                        <option value="5">5 Star</option>
                                    </select>
                                </div>
                                <div class="input__field">
                                    <textarea placeholder="Message" required name="comment"></textarea>
                                </div>
                                <div class="contact__btn">
                                    <button class="btn-main" type="submit">
                                        <i class="fas fa-paper-plane"></i>
                                        <span>send message</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ========================================REVIEW SECTION DESIGN END=============== -->


    <!-- =================================CLIENT REVIEWS START============= -->
    <section>
        <div class="releted-bg">
            <div class="container-fluid custom-padding">
                <div class="row">
                    <div class="section-head mb-5">
                        <h2>Realeted product</h2>
                    </div>
                </div>
                <!-- row end -->
                <div class="client-body">
                    <div class="row">
                        <div class="releted-product owl-carousel owl-theme">
                        	@foreach($realeted_food as $row)
                            <div class="item">
                                <div class="product-inner">
                                    <div class="pruct-img-sec">
                                        <div class="product-img">
                                            <img src="{{ asset('public/files/food/'.$row->image) }}" alt="Image not found" class="pd-image">
                                        </div>
                                        <div class="product-details">
                                            <div class="rating">
                                                <ul>
                                                    @if($sum_rating != NULL)
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
                                            </div>
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
                                                        <a  href="javascript:void(0)" data-id="{{ $s_food->id }}" class="cart-btn wishlist"><span class="fas fa-heart"></span></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" data-id="{{ $s_food->id }}" class="cart-btn quickview" data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="fas fa-eye"></span></a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0)" id="add_cart" class="cart-btn" data-id={{ $s_food->id }}><span class="fas fa-shopping-cart"></span></a>
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
                </div>
                <!-- cliend body end  -->
            </div>
            <!-- container end -->
        </div>
        <!-- client-bg end -->
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
    </section>
    <!-- =================================CLIENT REVIEWS END============= -->




	@push('js')
    <script>
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
    // s_add_cart-----------
    $('#s_add_cart').submit(function(e){
      e.preventDefault();
       var url = $(this).attr('action');
       var request = $(this).serialize();
       $.ajax({
          url:url,
          type:'post',
          async:false,
          data:request,
          success:function(data){
            toastr.success(data);
            $('#s_add_cart')[0].reset();
            cart();
            location.reload();
          }

       });
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

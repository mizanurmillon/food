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
                                All Product By Subcategory
                            </h1>
                            <P>Home - <span class="page-name">All Product By Subcategory</span></P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===================================CART PRODUCT START================== -->
    <section>
        <div class="cat-product-show-inner my-5">
            <div class="container-fluid custom-padding">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="all-category-list">
                            <h3 class="list-name">All Subcategory</h3>
                            <ul class="cat-list">
                                <li><a href="#" type="button" class="cat-by-link active"  data-filter="all">All Food <span class="count">{{ count($all_food) }}</span></a></li>
                                @foreach($sub_category as $sub)
                                <li><a href="#" class="cat-by-link" type="button" data-filter=".product-{{ $sub->id }}">{{ $sub->subcategory_name }}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9">
                        <div class="row">
                            <div class="product">
                                <div class="row product-menu">
                                    @foreach($all_food as $row)
                                    <div class="col-lg-3 col-md-6 col-sm-6 my-2 col-12 mix sushi product-{{ $row->subcategory_id }}">
                                        <div class="product-inner">
                                            <div class="pruct-img-sec">
                                                <div class="product-img">
                                                    <img src="{{ asset('public/files/food/'.$row->image) }}" alt="Image not found" class="pd-image">
                                                </div>
                                                <div class="product-details">
                                                    <a href="{{ route('food.details',$row->slug) }}" class="product-name">
                                                        <h5>{{ $row->food_name }}</h5>
                                                    </a>
                                                    <p class="price">
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
                                                                <a href="javascript:void(0)" id="add_cart" data-id="{{ $row->id }}" class="cart-btn"><span class="fas fa-shopping-cart"></span></a>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ===========================CART SECTION END======= -->
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
</script>
@endpush
@endsection

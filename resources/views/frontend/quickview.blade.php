@push('css')
@endpush
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img style="width: 400px; height:auto; " src="{{ asset('public/files/food/'.$food->image) }}" alt="{{ $food->food_name }}">
        </div>

        <div class="col-md-6">
            <div class="product-details">
                <h2 class="product-name-single">
                    {{ $food->food_name }}
                </h2>
                <div class="pr-rt">
                    <p class="price-single">
                        @if($food->discount_price>0)
                            <del>{{ $setting->currency }} {{ $food->price }}</del> {{ $setting->currency }} {{ $food->discount_price }}
                        @else
                           {{ $setting->currency }} {{ $food->price }}
                        @endif
                    </p>
                </div>
            </div>
            <hr>
            <p class="product-descriotion">
                {{ $food->description }}
            </p>
            <hr>
            <form action="{{ route('add.to.cart.QV') }}" method="post" id="add_cart_form">
                @csrf
                <input type="hidden" name="id" value="{{ $food->id }}">
                @if($food->discount_price==NULL)
                   <input type="hidden" name="price" value="{{ $food->price }}">
                @else
                    <input type="hidden" name="price" value="{{ $food->discount_price }}">
                @endif

                <div class="cart_extra">
                    <div class="cart-product-quantity">
                        <div class="quantity">
                            <button class="qty-count qty-count--minus minus" data-action="minus" type="button">-</button>
                            <input class="product-qty qty" type="text" name="quantity" min="0" max="10" value="1" title="Qty" size="4">
                            <button class="qty-count qty-count--add plus" data-action="add" type="button">+</button>

                        </div>

                    </div>
                    <div class="cart_btn">
                        <button class="btn-main" type="submit">Add to cart</button>
                        <a class="add_wishlist wishlist" href="javascript:void(0)" data-id="{{ $food->id }}"><i class="far fa-heart"></i></a>
                    </div>
                </div>
            </form>
            <ul class="product-meta list_none">
                <li>Category: <a href="#">{{ @$food->category_name }}</a>, <a href="#">{{ @$food->subcategory_name }}</a></li>
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
<script>
    // Submit Form & store-----------
    $('#add_cart_form').submit(function(e){
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
            $('#add_cart_form')[0].reset();
            cart();
            location.reload();
          }

       });
    });
</script>
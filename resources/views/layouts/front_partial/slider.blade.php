<!-- ===============================SLIDER SECTION START============== -->
            <section>
                <div class="slider">
                    <div class="slider-bg">
                        <div class="slider-item">
                            <div class="image">
                                <!-- Place your baner backgorund image -->
                                <img src="{{ asset('public/frontend') }}/img/baner/banner.jpg" alt="Image not Found" class="img-fluid">
                            </div>
                            <div class="love-icon">
                                <!-- Place your small background image here-->
                                <img src="{{ asset('public/frontend') }}/img/icon/banner_image_1.png" class="love-1 object img-fluid" data-value="5" alt="Image not Found">
                                <img src="{{ asset('public/frontend') }}/img/icon/banner_image_3.png" class="love-3 object img-fluid" data-value="-3" alt="Image not Found">
                                <img src="{{ asset('public/frontend') }}/img/icon/welcome_image.png" class="love-2 object img-fluid" data-value="-8" alt="Image not Found">
                            </div>
                            <div class="slider-focus-img">
                                <div class="slider-content">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="text-sec">
                                                    <div class="sl-content">
                                                        <h1>{{ $slider->food_name }}<span>{{ $slider->category_name }}</span></h1>
                                                        <h2>{{ $slider->subcategory_name }}* {{ $slider->category_name }}</h2>
                                                        <p>*{{ $slider->description }}</p>

                                                        <div class="sl-bt-sec">
                                                            <a href="{{ route('food.details',$slider->slug) }}" class="btn-main">order now</a>

                                                            <p class="n-price">
                                                                @if($slider->discount_price>0)
                                                                {{ $setting->currency }}{{ $slider->discount_price }}
                                                                <span class="old-pc">
                                                                   {{ $setting->currency }}{{ $slider->price }}
                                                                </span>
                                                                @else
                                                                    {{ $setting->currency }}{{ $slider->price }}
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 ban-food-img">
                                                <!-- Please your baner font image -->
                                                <img src="{{ asset('public/files/food/'.$slider->image) }}" class="main-img object img-fluid" data-value="4" alt="Image not Found">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- slider item end -->
                    </div>
                    <!-- slider bg end -->
                </div>
                <!-- slider end  -->
            </section>
            <!-- ===============================SLIDER SECTION START============== -->
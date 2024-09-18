@extends('layouts.app')
@section('content')
@push('css')
@endpush
 
    <section>
        <div class="page-top-baner">
            <div class="banner-sec-bg custom-padding">
                <div class="row">
                    <div class="page-head-ban">
                        <div class="page-text">
                            <h1>
                                Blog
                            </h1>
                            <P>Home - <span class="page-name">Blog</span></P>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ===================================CART PRODUCT START================== -->
    <section>
        <div class="blog-post my-5">
            <div class="container">
                <div class="row">
                    @foreach($blog as $row)
                    <div class="col-md-6 col-lg-4">
                        <div class="blog__card">
                            <div class="blog__image">
                                <img src="{{ asset('public/files/blog/'.$row->image) }}" alt="blog-1">
                            </div>
                            <div class="blog__content">
                                <ul class="blog__details">
                                    <li>
                                        <i class="fas fa-calendar-alt"></i>
                                        <p>{{ date('d M Y',strtotime($row->created_date)) }}</p>
                                    </li>
                                    <li>
                                        <i class="fas fa-share-alt"></i>
                                        <p>5 share</p>
                                    </li>
                                </ul>
                                <div class="blog__title">
                                    <h4><a href="#">{{ $row->title }}.... </a></h4>
                                </div>
                                <ul class="blog__view__more">
                                    <li>
                                        <a class="btn-main" href="#">read more</a>
                                    </li>
                                    <li>
                                        <i class="far fa-comments"></i>
                                        <p>13 comments</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- ===========================CART SECTION END======= -->

@push('js')
@endpush
@endsection

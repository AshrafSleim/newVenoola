@extends('site.layouts.index')
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{trans('site.Product Detail')}}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{trans('site.Products')}}</a></li>
                        <li class="breadcrumb-item active">{{trans('site.Product Detail')}} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <div class="container my-5 py-5 z-depth-1">


        <!--Section: Content-->
        <section class="text-center">

            <!-- Section heading -->


            <div class="row">
                <div class="col-lg-6">

                    <!--Carousel Wrapper-->
                    <div id="carousel-thumb1" class="carousel slide carousel-fade carousel-thumbnails mb-5 pb-4" data-ride="carousel">

                        <!--Slides-->
                        <div class="carousel-inner text-center text-md-left" role="listbox">
                            <div class="carousel-item active">
                                <img src="{{url('/')}}/uploads/{{$product->image}}"
                                     alt="First slide" class="img-fluid">
                            </div>

                        </div>
                        <!--/.Slides-->

                        <!--Thumbnails-->

                        <!--/.Thumbnails-->

                    </div>
                    <!--/.Carousel Wrapper-->



                </div>

                <div class="col-lg-5 text-center text-md-left">

                    <h2 class="h2-responsive text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">{{trans('site.Name')}}   {{session()->get('lang') == 'ar' ? $product->nameAr : $product->name}}</h2>
                    <span class="badge badge-danger product mb-4 ml-xl-0 ml-4">bestseller</span>
                    <span class="badge badge-success product mb-4 ml-2">SALE</span>

                    <h3 class="h3-responsive text-center text-md-left mb-5 ml-xl-0 ml-4">
          <span class="red-text font-weight-bold">
            <strong>{{trans('site.Price')}}  {{$product ->price}}</strong>
          </span>

                    </h3>

                    <div class="font-weight-normal">

                        <p class="ml-xl-0 ml-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente nesciunt atque nemo neque ut officiis nostrum incidunt maiores, magni optio et sunt suscipit iusto nisi totam quis, nobis mollitia necessitatibus.</p>


                        <div class="mt-5">
                            @if(Auth::guard('web')->check())
                                @if($rate != null)
                                    <label for="input-1" class="control-label">Rate our Product</label>
                                    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" value="{{$rate->rate}}" data-max="5" data-size="s" data-step="1" readonly>
                                @else
                                    <label for="input-1" class="control-label">Rate our Product</label>
                                    <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" value="" data-size="s" onchange="rateProduct({{$product->id}});" data-max="5" data-step="1" >
                                @endif
                            @endif

                            <div class="row mt-3 mb-4">
                                <div class="col-md-12 text-center text-md-left text-md-right">
                                    <a class="btn btn-primary btn-rounded cart" id="{{ $product->id }} " data-fancybox-close="" href="#">
                                        <i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> {{trans('site.Add to Cart')}}</a>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </section>
        <!--Section: Content-->



    <!--<div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"> <img class="d-block w-100" src="{{url('/')}}/public/uploads/{{$product->image}}" alt="First slide"> </div>
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev">
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span>
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
						<span class="sr-only">Next</span>
					</a>

                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2>{{trans('site.Name')}}   {{session()->get('lang') == 'ar' ? $product->nameAr : $product->name}}</h2>
                        <h4>{{trans('site.Price')}}  {{$product ->price}}</h4>
						<h5>{{trans('site.Category Name')}}  {{session()->get('lang') == 'ar' ? $product ->categories->nameAr : $product ->categories->name}}</h5>

                            <p>
                                 <ul>
                                    <li>

                                    </li>
                                    <li>

                                    </li>
                                </ul>

                                <div class="price-box-bar">

                                    <div class="cart-and-bay-btn">

                                        <a class="btn hvr-hover cart"  id="{{ $product->id }}" data-fancybox-close="" href="#">{{trans('site.Add to Cart')}}</a>

                                    </div>
                                </div>

                                <div class="add-to-btn">
                                    <div class="add-comp">
                                    </div>
                                    <div class="share-bar">


                                    </div>
                                </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
     End Cart -->

        <!-- Start Instagram Feed  -->
        <div class="instagram-box">
            <div class="main-instagram owl-carousel owl-theme">
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-01.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-02.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-03.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-04.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-05.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-06.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-07.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-08.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-09.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="ins-inner-box">
                        <img src="{{url('/')}}/siteDesign/images/instagram-img-05.jpg" alt="" />
                        <div class="hov-in">
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Instagram Feed  -->
        <script>

            function rateProduct(id) {
                var id=id;
                var rate=document.getElementById("input-1").value;

                // console.log(id);
                // console.log(x);

                $.ajax({
                    url:"/rateProduct/"+id+"/"+rate,
                    type:"get",
                    dataType:"json",
                    data:{'id':id,'rate':rate},
                    success:function(data){

                    },
                    error:function(responsve){

                    }

                });
            }


            $(document).ready(function() {

                $('#rateMe1').mdbRate();
            });


        </script>
        <script>
            lightbox.option({
                'resizeDuration': 200,
                'wrapAround': true
            })
        </script>
        <style>
            .curse{
                cursor: zoom-in;
            }
        </style>
        <script>
        </script>
@endsection

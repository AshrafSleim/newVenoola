@extends('site.layouts.index')
@section('content')
    <!-- Start All Title Box -->

    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            </br>
                            <form action="{{route('siteProduct')}}" method="get">
                                <input type="hidden" name="filter" value="1">


                                <input name="name" type="text" class="form-control border-r"
                                       placeholder="{{trans('site.searchbyname')}}" value="{{isset($_GET['name']) ?$_GET['name'] : ''}}">
                                <select name="category"  class="form-control border-r">
                                    <option value="">{{trans('site.searchcategory')}}</option>
                                    @foreach($categories as $category)
                                        @if(isset($_GET['category']))
                                            <option value="{{$category->id}}" {{$_GET['category'] ==$category->id ?'selected' : ''}}>{{session()->get('lang') == 'ar' ? $category->nameAr : $category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{session()->get('lang') == 'ar' ? $category->nameAr : $category->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                </br>
                                <input name="priceFrom" type="text" class="form-control border-r"
                                       placeholder="{{trans('site.searcbypricefrom')}}" value="{{isset($_GET['priceFrom']) ?$_GET['priceFrom'] : ''}}">
                                <input name="priceTo" type="text" class="form-control border-r"
                                       placeholder="{{trans('site.searchbypriceto')}}" value="{{isset($_GET['priceTo']) ?$_GET['priceTo'] : ''}}">
                                <input name="age" type="text" class="form-control border-r"
                                       placeholder="{{trans('site.searchbyage')}} " value="{{isset($_GET['age']) ?$_GET['age'] : ''}}">

                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>


                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                <div class="toolbar-sorter-right">
                                    <span>{{trans('site.sortby')}}</span>
                                    <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                                        <option value="2">{{trans('site.high')}}</option>
                                        <option value="3">{{trans('site.low')}}</option>
                                        <option value="4">{{trans('site.bestselling')}}</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        @foreach($products as $product)
                                            @if($product->market->active == 'active' && $product->active == 'active')
                                                <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                    <div class="products-single fix">
                                                        <div class="box-img-hover">
                                                            <div class="type-lb">
                                                                <!--<p class="sale">Sale</p>-->
                                                            </div>
                                                            <a href="{{route('siteProductDetail',$product->id)}}" data-toggle="tooltip" data-placement="right" title="View"><img src="{{url('/')}}/public/uploads/{{$product->image}}" class="img-fluid" alt="Image"></a>
                                                            <a class="cart" id="{{ $product->id }}"href="#">{{trans('site.Add to Cart')}}</a>

                                                        </div>
                                                        <div class="why-text">
                                                            <h4>{{session()->get('lang') == 'ar' ? $product->nameAr : $product->name}}</h4>
                                                            <h5>{{$product->market->name}} </h5>
                                                            <h5> {{$product->price}}</h5>
                                                            <label for="input-1" class="control-label">Rate our Product</label>
                                                            <input id="input-1" name="input-1" class="rating rating-loading" data-min="0" value="{{$product->rate}}" data-max="5" data-step="1" disabled readonly>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        @endforeach


                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->
    {{$products->links()}}

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


@endsection

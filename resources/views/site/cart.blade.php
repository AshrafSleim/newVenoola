@extends('site.layouts.index')
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Images</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                @foreach($carts as $cart)
                                    <td class="thumbnail-img">
                                        <a href="#">
                                            <img class="img-fluid" src="{{url('/')}}/uploads/{{$cart['attributes']['image'] }}" alt="" />
                                        </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
                                            {{ $cart['name'] }}
                                        </a>
                                    </td>
                                    <td class="price-pr" >
                                        <p id="price{{$cart['id']}}">{{ $cart['price'] }}</p>
                                    </td>
                                    <td class="quantity-box"><input type="number" size="4"  id="{{$cart['id']}}" onchange="counter({{$cart['id']}})" value="{{ $cart['quantity'] }}" min="0" step="1" class="c-input-text qty text"></td>
                                    <td class="total-pr" id="total{{$cart['id']}}">
                                        <p>{{ $cart['price'] * $cart['quantity'] }}</p>
                                    </td>
                                    <td class="remove-pr">
                                        <form method="POST" action="{{route('shoping.destroy',$cart['id'])}}">
                                            {{csrf_field()}}
                                            {{method_field("DELETE")}}
                                            <button type='submit' style="width:35px;">	<i class="fas fa-times"></i></button>

                                        </form>

                                        </a>
                                    </td>
                            </tr>
                            @endforeach



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>

                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Total</h5>
                            <div class="ml-auto h5 totalOrder" >{{$total}}</div>
                        </div>
                        <hr> </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="{{route('checkout')}}" class="ml-auto btn hvr-hover">Order</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

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

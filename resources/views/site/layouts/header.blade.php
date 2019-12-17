<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Venoola</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{url('/')}}/siteDesign/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{url('/')}}/siteDesign/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{url('/')}}/siteDesign/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{url('/')}}/siteDesign/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{url('/')}}/siteDesign/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{url('/')}}/siteDesign/css/custom.css">
    <link href="{{url('/')}}/siteDesign/css/main.css" rel="stylesheet" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="index.blade.php"><img src="{{url('/')}}/siteDesign/images/logo.png" class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{route('siteHome')}}">Home</a></li>

                    <li class="nav-item"><a class="nav-link" href="{{route('siteProduct')}}">Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{route('siteAllMarkets')}}">Shope</a></li>


                    <li class="nav-item"><a class="nav-link" href="about.html">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact-us.html">Contact Us</a></li>
                    @if(Auth::guard('web')->check())
                        <li class="nav-item"><a class="nav-link" href="{{route('siteLogout')}}">Logout</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">log in</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('siteLogin')}}">Client</a></li>
                                <li><a href="{{route('showVendorLoginForm')}}">Vendor</a></li>

                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">Register</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{route('siteRegister')}}">Client</a></li>
                                <li><a href="{{route('vendorRegister')}}">Vendor</a></li>

                            </ul>
                        </li>
                    @endif
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle arrow" data-toggle="dropdown">Language</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route('en')}}">EN</a></li>
                            <li><a href="{{route('ar')}}">عربى</a></li>

                        </ul>
                    </li>

                </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class=""><a href="{{url('/')}}/shoping">
                            <i class="fa fa-shopping-bag"></i>
                            <span class="badge">{{session()->has('count') ? session()->get('count') : ''}}</span>
                        </a></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">
                    <li>
                        <a href="#" class="photo"><img src="{{url('/')}}/siteDesign/images/img-pro-01.jpg" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Delica omtantur </a></h6>
                        <p>1x - <span class="price">$80.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="{{url('/')}}/siteDesign/images/img-pro-02.jpg" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Omnes ocurreret</a></h6>
                        <p>1x - <span class="price">$60.00</span></p>
                    </li>
                    <li>
                        <a href="#" class="photo"><img src="{{url('/')}}/siteDesign/images/img-pro-03.jpg" class="cart-thumb" alt="" /></a>
                        <h6><a href="#">Agam facilisis</a></h6>
                        <p>1x - <span class="price">$40.00</span></p>
                    </li>
                    <li class="total">
                        <a href="#" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                        <span class="float-right"><strong>Total</strong>: $180.00</span>
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <select class="browser-default custom-select input-group-addon" >
                <option id="search-category" selected>Search By..</option>
                <option id="search-category" value="1">Name</option>
                <option id="search-category" value="2">Category</option>

            </select>
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->

@extends('userVendor.index')
@section('title', 'Venoola | Home')
@section('breadcrumb')
    <li class="breadcrumb-item active">Home</li>
    @endsection
@section('content')
        <div class="container mywithd">
            <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h2>User Control</h2>
                        <p>All Data About Users</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="small-box bg-yellow-gradient">
                    <div class="inner">
                        <h2>Vendor Control</h2>

                        <p> All Data About Vendor </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h2>Markets Controller</h2>
                        <p>All Data About Markets </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h2>Categories Controller</h2>
                            <p>All Data About Categories</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-list-alt"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
        </div>



@endsection



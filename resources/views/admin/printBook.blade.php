@extends('admin.index')
@section('title', 'MinTravel | BookShow')
@section('style')
    <style>
        .btn{
            border: none;
        }
    </style>
@endsection
@section('content')
    <div class="form-content">

        <form action="#"  method="post" class="mb-3 pb-2" enctype="multipart/form-data">
            @csrf
{{--            <div class="row">--}}
{{--                <div class="form-group col-sm-6">--}}
{{--                    <img alt="element 06" class="" src="{{url('siteDesign/addons/default/themes/min/img/logo.png')}}" style="padding-top: 40px;padding-bottom: 30px;">--}}

{{--                </div>--}}

{{--                <div class="form-group col-sm-6">--}}
{{--                    <label>EGYPTOMANIA</label>--}}
{{--                </div>--}}

{{--            </div>--}}

            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$book->name}}" readonly>
                </div>

                <div class="form-group col-sm-6">
                    <label for="code">Code</label>
                    <input type="text" class="form-control" id="code" name="code" value="{{$book->code}}" readonly>
                </div>

            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{$book->address}}" readonly>
                </div>

            </div>
            <div class="row">
                <div class="form-group  col-sm-6">
                    <label for="mobile">Mobile</label>
                    <input type="text" class="form-control " id="mobile" name="mobile" value="{{$book->phone}}" readonly >

                </div>
                <div class="form-group col-sm-6">
                    <label for="total">Total Price</label>
                    <input type="text" class="form-control " id="total" name="total" value="{{$book->total}}" readonly >
                </div>
            </div>
            <div class="row">
                <div class="form-group  col-sm-12">

                    <label >All Product</label>
                    <div class="box table-responsive "style="border: none;">


                        <table  class="table table-striped table-hover table-bordered " >
                            <thead style="background: #26b1b0">
                            <tr style="color: white!important;">
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total Price</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <th class="rowStyle">{{$product->name}}</th>
                                    <th class="rowStyle">{{$product->quantity}}</th>
                                    <th class="rowStyle">{{$product->price}}</th>
                                    <th class="rowStyle">{{$product->price * $product->quantity}}</th>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>

            </br>

        </form>

    </div>
@endsection
@section('script')
@endsection

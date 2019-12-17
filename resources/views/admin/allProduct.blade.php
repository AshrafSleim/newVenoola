@extends('admin.index')
@section('title', 'Venoola | Product')
@section('style')
    <style>
        .rowStyle{
            font-weight: normal;
        }
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
            background-color: #26b1b0 ;
            border: none;
        }
        .btn{
            border: none;
        }
        .form-group {
            margin-bottom: 10px;
        }

    </style>
@endsection

@section('content')
    <div class="content">
        <form id="search_form" action="" method="get" >
            <div class="box-body">
                <input type="hidden" name="filter" value="1">
                <div class="row">

                    <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                        <div class="form-group nw-pd">
                            <input name="name" type="text" class="form-control border-r"
                                   placeholder="Search By Name" value="{{isset($_GET['name']) ?$_GET['name'] : ''}}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd">
                            <select name="category"  class="form-control border-r">
                                <option value="">Search By Category</option>
                                @foreach($categories as $category)
                                    @if(isset($_GET['category']))
                                        <option value="{{$category->id}}" {{$_GET['category'] ==$category->id ?'selected' : ''}}>{{$category->name}}</option>
                                    @else
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd">
                            <select name="event"  class="form-control border-r">
                                <option value="">Search By event</option>
                                @foreach($events as $event)
                                    @if(isset($_GET['event']))
                                        <option value="{{$event->id}}" {{$_GET['event'] ==$event->id ?'selected' : ''}}>{{$event->name}}</option>
                                    @else
                                        <option value="{{$event->id}}">{{$event->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd">
                            <select name="relation"  class="form-control border-r">
                                <option value="">Search By relation</option>
                                @foreach($relations as $relation)
                                    @if(isset($_GET['relation']))
                                        <option value="{{$relation->id}}" {{$_GET['relation'] ==$relation->id ?'selected' : ''}}>{{$relation->name}}</option>
                                    @else
                                        <option value="{{$relation->id}}">{{$relation->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd">
                            <select name="brand"  class="form-control border-r">
                                <option value="">Search By brand</option>
                                @foreach($brands as $brand)
                                    @if(isset($_GET['brand']))
                                        <option value="{{$brand->id}}" {{$_GET['brand'] ==$brand->id ?'selected' : ''}}>{{$brand->name}}</option>
                                    @else
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd">
                            <select name="market"  class="form-control border-r">
                                <option value="">Search By market</option>
                                @foreach($markets as $market)
                                    @if(isset($_GET['market']))
                                        <option value="{{$market->id}}" {{$_GET['market'] ==$market->id ?'selected' : ''}}>{{$market->name}}</option>
                                    @else
                                        <option value="{{$market->id}}">{{$market->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd">
                            <select name="status"  class="form-control border-r">
                                <option value="">Search By status</option>
                                @if(isset($_GET['market']))
                                    <option value="active"  {{$_GET['status'] =='active'?'selected' : ''}}>active</option>
                                    <option value="new"  {{$_GET['status'] =='new' ? 'selected' : ''}}>new</option>
                                @else
                                    <option value="active" >active</option>
                                    <option value="new">new</option>
                                @endif

                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd col-md-1 col-md-offset-6">
                            <button  class="btn btn-primary border-r"  style="background-color: #4b646f" onclick="applySearch({{route('adminAllProduct.index')}})">Search</button>

                        </div>
                    </div>

                </div>
                <div class="row">


                </div>



            </div>

        </form>

        <div class="box table-responsive "style="border: none;">


            <table  class="table table-striped table-hover table-bordered " >
                <thead style="background: #26b1b0">
                <tr style="color: white!important;">
                    <th>Name</th>
                    <th>Image</th>
                    <th>Category name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($products as $product)
                    <tr>
                        <th class="rowStyle">{{$product->name}}</th>
                        <th class="rowStyle"  style="width: 1px "><a data-lightbox="{{url('uploads').'/'.$product->image}}" href="{{url('uploads').'/'.$product->image}}"><i class="fa fa-picture-o size" aria-hidden="true"></i></a></th>
                        <th class="rowStyle">{{$product->categories->name}}</th>
                        <th class="rowStyle">{{$product->counter}}</th>
                        <th class="rowStyle">{{$product->price}}</th>
                        <th class="rowStyle">{{$product->active}}</th>
                        <th class="rowStyle" ><a href="{{route('adminUpdateProduct',$product->id)}}" style="background-color: #4b646f;width: 58px;" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a> <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModaldelete-{{$product->id}}"><i class="fa fa-trash"></i> Delete</button></th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>


            <div class="box-body">
                    <input type="hidden" name="filter" value="1">
                    <div class="row">
                    <div class="col-md-8 col-sm-6 col-xs-12 p-l-0 p-r-0" style="float: left; padding:0;padding-left: 6px;">
                            {{--<button  class="btn btn-primary border-r" onclick="downloadCSV({{ route('export_excel.excel') }})">Export Excel</button>--}}

{{--                            <a href="{{route('user.excel')}}" style="background-color: #26b1b0" class="btn btn-primary border-r">Export Excel</a>--}}
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12 p-l-0 p-r-0 " style="float: right;margin-top: -20px;padding-right: 6px;">
                            {{$products->links()}}
                        </div>

                    </div>


            </div>
        @foreach($products as $product)
            <div class="modal fade bs-example-modal-sm" id="myModaldelete-{{$product->id}}" role="dialog" aria-labelledby="mySmallModalLabel" >
                <div class="modal-dialog modal-sm "  >

                    <!-- Modal content-->
                    <div class="modal-content "style="text-align: center;">

                        <br>
                        <h4 class="deleteModel">Are you sure you want to delete this</h4>
                            <form method="POST" id="myformdelete" action="{{route('deleteAdminProduct.delete',$product->id)}}">
                                @csrf
                                <button type="submit" class="btn btn-default btn-danger deleteButton">Delete</button>
                                <button type="button" class="btn btn-default btn-info deleteButton" style="background-color: #4b646f" data-dismiss="modal">Close</button>
                            </form>
                            <br>


                    </div>

                </div>
            </div>
        @endforeach
    </div>
@endsection

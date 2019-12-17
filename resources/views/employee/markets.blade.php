@extends('employee.index')
@section('title', 'Venoola | Vendor Markets')
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
        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 p-l-0 p-r-0 btn-addnew" style="float: left; padding-bottom: 10px;">
                @if(auth()->guard('employee')->user()->addMarket == 'yes')

                <button type="button"  class="btn btn-info border-r" data-toggle="modal" style="background-color: #4b646f" data-target="#myModalinsert">Add New Market</button>
          @endif
            </div>
        </div>
        <br>

        <div class="box table-responsive "style="border: none;">


            <table  class="table table-striped table-hover table-bordered " >
                <thead style="background: #26b1b0">
                <tr style="color: white!important;">
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($markets as $market)
                    <tr>
                        <th class="rowStyle">{{$market->name}}</th>
                        <th class="rowStyle">{{$market->phone}}</th>
                        <th class="rowStyle"  style="width: 1px "><a data-lightbox="{{url('uploads').'/'.$market->image}}" href="{{url('uploads').'/'.$market->image}}"><i class="fa fa-picture-o size" aria-hidden="true"></i></a></th>
                        <th class="rowStyle" style=""><button type="button" style="background-color: #4b646f" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModalupdate-{{$market->id}}"><i class="fa fa-edit"></i> Edit</button> <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModaldelete-{{$market->id}}"><i class="fa fa-trash"></i> Delete</button>   <a href="{{route('employeeMarketProduct.index',$market->id)}}" style="background-color: #26b1b0" class="btn btn-xs btn-info" ><i class="fa fa-eye"></i> Show product</a></th>
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
                    {{$markets->links()}}
                </div>

            </div>


        </div>
        @foreach($markets as $market)
            <div class="modal fade bs-example-modal-sm" id="myModaldelete-{{$market->id}}" role="dialog" aria-labelledby="mySmallModalLabel" >
                <div class="modal-dialog modal-sm "  >

                    <!-- Modal content-->
                    <div class="modal-content "style="text-align: center;">

                        <br>
                        <h4 class="deleteModel">Are you sure you want to delete this</h4>
                        <form method="POST" id="myformdelete" action="{{route('EmployeeMarket.delete', $market->id)}}">
                            @csrf

                            <button type="submit" class="btn btn-default btn-danger deleteButton">Delete</button>
                            <button type="button" class="btn btn-default btn-info deleteButton" style="background-color: #4b646f" data-dismiss="modal">Close</button>
                        </form>
                        <br>


                    </div>

                </div>
            </div>

            <div class="modal fade" id="myModalupdate-{{$market->id}}" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Market </h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="myforminsert" action="{{route('EmployeeUpdateMarket',$market->id)}}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Market Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$market->name}}" id="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{$market->phone}}" id="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="image">Market logo</label>
                                    <input type="file" class="form-control" id="image" name="image" accept="image/x-png,image/gif,image/jpg,image/jpeg">
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" style="background-color: #26b1b0" class="btn btn-default btn-primary">Update</button>
                                    <button type="button" class="btn btn-default btn-info" style="background-color: #4b646f" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>

        @endforeach
    </div>

    <div class="modal fade" id="myModalinsert" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New Market</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="myforminsert" action="{{route('EmployeeAddNewMarkets',auth()->guard('employee')->user()->vendor_id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Market Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Market logo</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/x-png,image/gif,image/jpg,image/jpeg" required>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" style="background-color: #26b1b0" class="btn btn-default btn-primary">Add</button>
                            <button type="button" class="btn btn-default btn-info" style="background-color: #4b646f" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

@endsection

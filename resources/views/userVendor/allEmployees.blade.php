@extends('userVendor.index')
@section('title', 'Venoola | Employees')
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
    <div class="row">
        <div class="col-md-6 col-sm-12 col-xs-12 p-l-0 p-r-0 btn-addnew" style="float: left; padding-bottom: 10px;">
            <a  class="btn btn-info" style="background-color: #4b646f" href="{{route('vendorAddEmployees')}}" >Add New Employee</a>
        </div>
    </div>
    <br>
        <div class="box table-responsive "style="border: none;">


            <table  class="table table-striped table-hover table-bordered " >
                <thead style="background: #26b1b0">
                <tr style="color: white!important;">
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Add Market</th>
                    <th>Add Category</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <th class="rowStyle">{{$employee->name}}</th>
                        <th class="rowStyle">{{$employee->phone}}</th>
                        <th class="rowStyle">{{$employee->email}}</th>
                        <th class="rowStyle">{{$employee->addMarket}}</th>
                        <th class="rowStyle">{{$employee->addCategory}}</th>
                        <th class="rowStyle" style=""><a href="{{route('vendorUpdateEmployees',$employee->id)}}" style="background-color: #4b646f;width: 58px;" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a> <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModaldelete-{{$employee->id}}"><i class="fa fa-trash"></i> Delete</button></th>
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
                            {{$employees->links()}}
                        </div>

                    </div>


            </div>
        @foreach($employees as $employee)
            <div class="modal fade bs-example-modal-sm" id="myModaldelete-{{$employee->id}}" role="dialog" aria-labelledby="mySmallModalLabel" >
                <div class="modal-dialog modal-sm "  >

                    <!-- Modal content-->
                    <div class="modal-content "style="text-align: center;">

                        <br>
                        <h4 class="deleteModel">Are you sure you want to delete this</h4>
                            <form method="POST" id="myformdelete" action="{{route('vendorDeleteEmployee.delete', $employee->id)}}">
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

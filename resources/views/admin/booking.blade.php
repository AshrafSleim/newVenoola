@extends('admin.index')
@section('title', 'Venoola | Booking')
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
                            <input name="code" type="text" class="form-control border-r"
                                   placeholder="Search By Code" value="{{isset($_GET['code']) ?$_GET['code'] : ''}}">
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12 lft padding-bb">
                        <div class="form-group nw-pd">
                            <input name="name" type="text" class="form-control border-r"
                                   placeholder="Search By Email" value="{{isset($_GET['name']) ?$_GET['name'] : ''}}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                        <div class="form-group nw-pd">
                            <input name="mobile" type="text" class="form-control border-r"
                                   placeholder="Search By Phone" value="{{isset($_GET['mobile']) ?$_GET['mobile'] : ''}}">
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd col-md-1 col-md-offset-6">
                            <button  class="btn btn-primary border-r"  style="background-color: #4b646f" onclick="applySearch({{route('adminBook.index')}})">Search</button>

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
                    <th>Address</th>
                    <th>Phone.NO</th>
                    <th>code</th>
                    <th>pay</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($books as $book)
                    <tr>
                        <th class="rowStyle">{{$book->name}}</th>
                        <th class="rowStyle">{{$book->address}}</th>
                        <th class="rowStyle">{{$book->phone}}</th>
                        <th class="rowStyle">{{$book->code}}</th>
                        <th class="rowStyle">{{$book->pay}}</th>
                        <th class="rowStyle" style="display:block"><button type="button" style="background-color: #4b646f" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#myModalupdate-{{$book->id}}"><i class="fa fa-edit"></i> Edit</button> <button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModaldelete-{{$book->id}}"><i class="fa fa-trash"></i> Delete</button> <a href="{{route('adminShowBook',$book->id)}}"  class="btn btn-xs btn-primary" style="background-color: #4b646f"><i class="fa fa-eye"></i> Show</a> </th>
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
                            {{$books->links()}}
                        </div>

                    </div>


            </div>
        @foreach($books as $book)
            <div class="modal fade bs-example-modal-sm" id="myModaldelete-{{$book->id}}" role="dialog" aria-labelledby="mySmallModalLabel" >
                <div class="modal-dialog modal-sm "  >

                    <!-- Modal content-->
                    <div class="modal-content "style="text-align: center;">

                        <br>
                        <h4 class="deleteModel">Are you sure you want to delete this</h4>
                            <form method="POST" id="myformdelete" action="{{route('adminBook.delete', $book->id)}}">
                                @csrf

                                <button type="submit" class="btn btn-default btn-danger deleteButton">Delete</button>
                                <button type="button" class="btn btn-default btn-info deleteButton" style="background-color: #4b646f" data-dismiss="modal">Close</button>
                            </form>
                            <br>


                    </div>

                </div>
            </div>
            <div class="modal fade" id="myModalupdate-{{$book->id}}" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Pay Status</h4>
                        </div>
                        <div class="modal-body">
                            <form method="POST" id="myformupdate" action="{{route('updateBookStatus', $book->id)}}">
                                @csrf
                                <div class="form-group">
                                    <label for="pay">Pay Status</label>
                                    <select name="pay"  class="form-control border-r">
                                        <option value="new"{{$book->pay == 'new' ? 'selected' : ''}}>New</option>
                                        <option value="done"{{$book->pay == 'done' ? 'selected' : ''}}>Done</option>
                                    </select>
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
@endsection

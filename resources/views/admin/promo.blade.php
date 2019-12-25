@extends('admin.index')
@section('title', 'Venoola | All PromoCode')
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
            <button type="button"  class="btn btn-info border-r" data-toggle="modal" style="background-color: #4b646f" data-target="#myModalinsert">Add New PromoCode</button>
        </div>
    </div>
    <br>

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
                    <div class="col-md-2 col-sm-6 col-xs-12 lft padding-bb">
                        <div class=" nw-pd col-md-1 col-md-offset-6">
                            <button  class="btn btn-primary border-r"  style="background-color: #4b646f" onclick="applySearch({{route('allPromo.index')}})">Search</button>

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
                    <th>Discount</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($promos as $promo)
                    <tr>
                        <th class="rowStyle">{{$promo->name}}</th>
                        <th class="rowStyle">{{$promo->discount}}</th>
                        <th class="rowStyle">{{$promo->endpromo}}</th>
                        <th class="rowStyle"><button type="button" class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModaldelete-{{$promo->id}}"><i class="fa fa-trash"></i> Delete</button></th>
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
                            {{$promos->links()}}
                        </div>

                    </div>


            </div>
        @foreach($promos as $promo)
            <div class="modal fade bs-example-modal-sm" id="myModaldelete-{{$promo->id}}" role="dialog" aria-labelledby="mySmallModalLabel" >
                <div class="modal-dialog modal-sm "  >

                    <!-- Modal content-->
                    <div class="modal-content "style="text-align: center;">

                        <br>
                        <h4 class="deleteModel">Are you sure you want to delete this</h4>
                            <form method="POST" id="myformdelete" action="{{route('deletePromo.delete', $promo->id)}}">
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

    <div class="modal fade" id="myModalinsert" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add New PromoCode</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="myforminsert" action="{{route('AddPromo')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Promo Name</label>
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="discount">Promo Discount</label>
                            <input type="text" class="form-control" name="discount" id="discount" required>
                        </div>
                        <div class="form-group">
                            <label for="endpromo">Promo End Date</label>
                            <input type="date" class="form-control" name="endpromo" id="endpromo" min="2019-12-25" required>
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

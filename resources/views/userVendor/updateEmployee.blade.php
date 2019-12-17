@extends('userVendor.index')
@section('title', 'Venoola | Update Employee')
@section('style')
    <style>
        .btn{
            border: none;
        }
    </style>
@endsection
@section('content')
    <br>
    <div class="form-content">
        <form action="#"  method="post" class="mb-3 pb-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Employee Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$employee->name}}" required>
            </div>
            <div class="form-group">
                <label for="email">Employee email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{$employee->email}}" required>
            </div>
            <div class="form-group">
                <label for="phone">Employee phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{$employee->phone}}" required>
            </div>
            <div class="form-group">
                <label for="">Employee permission add market </label>
                <br>
                <input type="radio" class="form-check-input" id="radio5" name="market" value="yes" {{$employee->addMarket == 'yes' ? 'checked' : ''}} >Yes
                <input type="radio" class="form-check-input" id="radio6" name="market" value="no" {{$employee->addMarket == 'no' ? 'checked' : ''}}>No

            </div>
            <div class="form-group">
                <label for="">Employee permission add category </label>
                <br>
                <input type="radio" class="form-check-input" id="radio5" name="category" value="yes"  {{$employee->addCategory == 'yes' ? 'checked' : ''}}>Yes

                <input type="radio" class="form-check-input" id="radio6" name="category" value="no" {{$employee->addCategory == 'no' ? 'checked' : ''}}>No
            </div>
            <div class="form-group">
                <label for="">All market can show it</label>
                <br>
                @foreach($markets as $market)
                <label class="checkbox-inline"><input type="checkbox" name="markets[]" value="{{$market->id}}" {{in_array($market->id, $employeeMarket) ? 'checked' : ''}}>{{$market->name}}</label>
                @endforeach
            </div>
            </br>
            <div class="row ">
                <div class="form-group col-md-12 ">
                    <button type="submit" class="btn btn-primary" style="background-color: #26b1b0">Save</button >
                    <a href="{{route('vendorEmployees.index',auth()->guard('vendor')->user()->id)}}" class="btn btn-info" style="background-color: #4b646f">Cancel</a>
                </div>
            </div>
        </form>

    </div>
@endsection

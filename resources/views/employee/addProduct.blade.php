@extends('employee.index')
@section('title', 'Venoola | New Product')
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
        <form action="{{route('employeepostAddNewProduct',$id)}}"  method="post" class="mb-3 pb-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}" required>
            </div>
            <div class="form-group">
                <label for="nameAr">Product Name Ar</label>
                <input type="text" class="form-control" id="nameAr" name="nameAr" value="{{old('nameAr')}}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/x-png,image/gif,image/jpg,image/jpeg" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category"  class="form-control border-r" required>
                    <option value="">Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"{{old('category') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age" value="{{old('age')}}" required>
            </div>
            <div class="form-group">
                <label for="counter">Quantity</label>
                <input type="text" class="form-control" id="counter" name="counter" value="{{old('counter')}}" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}" required>
            </div>
            </br>
            <div class="row ">
                <div class="form-group col-md-12 ">
                    <button type="submit" class="btn btn-primary" style="background-color: #26b1b0">Save</button >
                    <a href="{{route('employeeMarketProduct.index',$id)}}" class="btn btn-info" style="background-color: #4b646f">Cancel</a>
                </div>
            </div>
        </form>

    </div>
@endsection

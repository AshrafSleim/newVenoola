@extends('admin.index')
@section('title', 'Venoola | Update Product')
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
        <form action="{{route('adminPostUpdateProduct',$product->id)}}"  method="post" class="mb-3 pb-2" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}" required>
            </div>
            <div class="form-group">
                <label for="nameAr">Product Name Ar</label>
                <input type="text" class="form-control" id="nameAr" name="nameAr" value="{{$product->nameAr}}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/x-png,image/gif,image/jpg,image/jpeg" >
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select name="category"  class="form-control border-r" >
                    <option value="">Category</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"{{$product->category == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="event">event</label>
                <select name="event"  class="form-control border-r" >
                    <option value="">event</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}"{{$product->event_id == $event->id ? 'selected' : ''}}>{{$event->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="relation">relation</label>
                <select name="relation"  class="form-control border-r" >
                    <option value="">relation</option>
                    @foreach($relations as $relation)
                        <option value="{{$relation->id}}"{{$product->relation_id == $relation->id ? 'selected' : ''}}>{{$relation->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="brand">brand</label>
                <select name="brand"  class="form-control border-r" >
                    <option value="">brand</option>
                    @foreach($brands as $brand)
                        <option value="{{$brand->id}}"{{$product->brand_id == $brand->id ? 'selected' : ''}}>{{$brand->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age" value="{{$product->age}}" required>
            </div>
            <div class="form-group">
                <label for="">Gender</label>
                <input type="radio" class="form-check-input" id="radio5" name="type" value="male" {{$product->type == 'male' ? 'checked' : ''}}>Male
                <input type="radio" class="form-check-input" id="radio6" name="type" value="female"{{$product->type == 'female' ? 'checked' : ''}} >Female

            </div>
            <div class="form-group">
                <label for="counter">Quantity</label>
                <input type="text" class="form-control" id="counter" name="counter" value="{{$product->counter}}" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}" required>
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <input type="radio" class="form-check-input" id="radio5" name="status" value="active" {{$product->active == 'active' ? 'checked' : ''}}>active
                <input type="radio" class="form-check-input" id="radio6" name="status" value="new"{{$product->active == 'new' ? 'checked' : ''}} >new

            </div>
            </br>
            <div class="row ">
                <div class="form-group col-md-12 ">
                    <button type="submit" class="btn btn-primary" style="background-color: #26b1b0">Save</button >
                    <a href="{{route('adminAllProduct.index')}}" class="btn btn-info" style="background-color: #4b646f">Cancel</a>
                </div>
            </div>
        </form>

    </div>
@endsection

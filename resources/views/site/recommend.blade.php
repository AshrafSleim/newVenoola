
@extends('site.layouts.index')
@section('content')
<form action="{{route('allSiteFilterProduct')}}" method="get" id="cat">
                                <input type="hidden" name="filter" value="1">

                                <div class="title-left">
                                    <h3 align="center">Find Your Gift</h3>
                                </div>

                                    <select class="browser-default form-control" name="relation">
                                  <option value="">Select Relation</option>
                                        @foreach($relations as $relation)
                                            @if(isset($_GET['relation']))
                                                <option value="{{$relation->id}}" {{$_GET['relation'] ==$relation->id ?'selected' : ''}}>{{session()->get('lang') == 'ar' ? $relation->nameAr : $relation->name}}</option>
                                            @else
                                                <option value="{{$relation->id}}"> {{session()->get('lang') == 'ar' ? $relation->nameAr : $relation->name}} </option>
                                            @endif
                                        @endforeach
                                </select>



                                <div class="md-form">
                                  <input type="number" id="inputMDEx" class="form-control" name="age" placeholder="Age">

                                </div>
                            <div class="md-form center-block"> Gender :
                                <div class="custom-control custom-radio md-form">
                                  <input type="radio" class="form-control custom-control-input" id="defaultGroupExample1" name="type" value="male">
                                  <label class="custom-control-label" for="defaultGroupExample1">Male</label>
                                </div>

                                <!-- Group of default radios - option 2 -->
                                <div class="custom-control custom-radio md-form">
                                  <input type="radio" class="form-control custom-control-input" id="defaultGroupExample2" name="type" value="female" checked>
                                  <label class="custom-control-label" for="defaultGroupExample2">Female</label>
                                </div>
                            </div>
                            </br>

                                <select class="browser-default form-control" name="event">
                                  <option value="">Select Event</option>
                                    @foreach($events as $event)
                                        @if(isset($_GET['event']))
                                            <option value="{{$event->id}}" {{$_GET['event'] ==$event->id ?'selected' : ''}}>{{session()->get('lang') == 'ar' ? $event->nameAr : $event->name}}</option>
                                        @else
                                            <option value="{{$event->id}}">{{session()->get('lang') == 'ar' ? $event->nameAr : $event->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <select class="browser-default form-control" name="brand">
                                  <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                        @if(isset($_GET['brand']))
                                            <option value="{{$brand->id}}" {{$_GET['brand'] ==$brand->id ?'selected' : ''}}>{{session()->get('lang') == 'ar' ? $brand->nameAr : $brand->name}}</option>
                                        @else
                                            <option value="{{$brand->id}}">{{session()->get('lang') == 'ar' ? $brand->nameAr : $brand->name}}</option>
                                        @endif
                                    @endforeach
                                </select>


                                <div class="md-form">
                                  <input type="number" id="inputMDEx" name="price" class="form-control" placeholder="Price $">

                                </div>


                                <button class="btn btn-info btn-block " type="submit">Find Now</button>


                            </form>

                            <style>
                                .custom-control{
                                    display:inline;
                                }
                                .center-block{
                                    margin-left:50px;
                                }
                            </style>
@endsection

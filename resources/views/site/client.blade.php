@extends('site.layouts.index')
@section('content')

    <div class="col-sm-6 col-lg-6 mb-3" style="margin: auto;margin-top: 66px;">
        <div class="title-left">
            <h3 align="center" style="color:black; font-size: 36px;" >{{trans('site.Create New Account')}}</h3>
        </div>

        <form class="mt-3  review-form-box" id="" method="post" action="{{route('sitePostRegister')}}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name" class="mb-0">{{trans('site.yourName')}}</label>
                    <input type="text" class="form-control" id="name" placeholder=" {{trans('site.yourName')}}" name="name" value="{{old('name')}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone" class="mb-0">{{trans('site.Phone')}}</label>
                    <input type="text" class="form-control" id="phone" placeholder="{{trans('site.Phone')}}" name="phone" value="{{old('phone')}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="mb-0">{{trans('site.Email Address')}}</label>
                    <input type="text" class="form-control" id="email" placeholder=" {{trans('site.Email Address')}}" name="email" value="{{old('email')}}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="password" class="mb-0">{{trans('site.Password')}}</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="{{trans('site.Password')}}" required>
                </div>
                <div class="form-group col-md-6">
                    <label>or sign up with:</label>
                    <div id="social">
                        <a href="#" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>

                    </div>


                </div>


                <input class="form-control" type="hidden" name="last_url"  value="{{$last_url}}">

            </div>
            <p style="display: flex;">By clicking
                <em>Sign up</em> you agree to our
                <a href="" target="_blank">terms of service</a></p>

            <button type="submit" class="btn hvr-hover">{{trans('site.Register')}}</button>
        </form>
    </div>


@endsection

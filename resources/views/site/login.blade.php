@extends('site.layouts.index')
@section('content')
    <div class="col-sm-6 col-lg-6 mb-3" style="margin: auto;margin-top: 66px;">
        <div class="title-left">
            <h3 align="center" style="color:black;" >{{trans('site.Account Login')}}</h3>
        </div>
        <form class="mt-3  review-form-box" id="" method="post" action="{{route('sitePostLogin')}}">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email" class="mb-0">{{trans('site.Email Address')}} </label>
                    <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="{{trans('site.Email Address')}}">
                </div>
                <div class="form-group col-md-6">
                    <label for="password" class="mb-0">{{trans('site.Password')}}</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="{{trans('site.Password')}}">
                    <small id="passwordHelpBlock" class="form-text text-right blue-text">
                        <a href="">Reset Password</a>
                    </small>
                </div>
                <div class="form-group col-md-6">
                    <label>or sign in with:</label>
                    <div id="social">
                        <a href="{{route('facebook')}}" class="mx-2" role="button"><i class="fab fa-facebook-f light-blue-text"></i></a>

                    </div>


                </div>

            </div>
            <input class="form-control" type="hidden" name="last_url"  value="{{$last_url}}">

            <button type="submit" class="btn hvr-hover">{{trans('site.Login')}}</button>
        </form>
    </div>
@endsection
